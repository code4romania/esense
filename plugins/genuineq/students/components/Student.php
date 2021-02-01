<?php namespace Genuineq\Students\Components;

use Log;
use Lang;
use Flash;
use Event;
use Input;
use Redirect;
use Validator;
use ValidationException;
use \System\Models\File;
use Cms\Classes\ComponentBase;
use Genuineq\Students\Models\Student as StudentModel;
use Genuineq\Students\Models\ContactPerson;

/**
 * Students component
 *
 * Handels the CRUD operations for students.
 */
class Student extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.students::lang.components.students.name',
            'description' => 'genuineq.students::lang.components.students.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'throwBeforeStudentCreateStart' => [
                 'title'       => 'genuineq.students::lang.components.students.options.title',
                 'description' => 'genuineq.students::lang.components.students.options.description',
                 'default'     => false,
                 'type'        => 'checkbox',
            ]
        ];
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        /** Define redirect url variable. */
        $redirectUrl = null;
        Event::fire('genuineq.students.student.read.start', [&$this, &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Check if a student is accessed. */
        if ($this->param('studentId')) {
            Event::fire('genuineq.students.before.student.read', [&$this, $this->param('studentId'), &$redirectUrl]);

            /** Check if a redirect is required. */
            if ($redirectUrl) {
                return Redirect::to($redirectUrl);
            }

            /** Extract the student and send it to the page. */
            $this->page['student'] = StudentModel::find($this->param('studentId'));
        } elseif ($this->property('throwBeforeStudentCreateStart')) {
            /** Fire event before student create start. */
            Event::fire('genuineq.students.before.student.create.start', [&$this, $this->param('studentId'), &$redirectUrl]);

            /** Check if a redirect is required. */
            if ($redirectUrl) {
                return Redirect::to($redirectUrl);
            }
        }
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Function that handels the creation of a new student.
     */
    public function onCreateStudent()
    {
        /** Define redirect url variable. */
        $redirectUrl = null;
        Event::fire('genuineq.students.student.create.start', [&$this, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Extract the form data. */
        $data = [
            'surname' => post('surname'),
            'name' => post('name'),
            'description' => post('description'),
            'birthdate' => date_format(date_create_from_format('d-m-Y', post('birthdate')), 'Y-m-d'),
            'hearing_impairment' => ((Input::has('hearing_impairment')) ? (1) : (0)),
            'visual_impairment' => ((Input::has('visual_impairment')) ? (1) : (0)),
            'gender' => post('gender')
        ];

        /** Validate the student data. */
        $this->validateStudentData($data, post());

        /** Fire event before student create. */
        Event::fire('genuineq.students.before.student.create', [&$data, post()]);

        /** Create the student. */
        $student = StudentModel::create($data);

        /** Add student avatar. */
        if (Input::hasFile('avatar')) {
            $student->avatar = Input::file('avatar');
            $student->save();
        }

        /** Fire event after create. */
        Event::fire('genuineq.students.after.student.create', [$student]);

        /** Fire event before contact persons create. */
        // Event::fire('genuineq.students.create.before.contact.persons.create', [post()]);

        /** Save contact persons. */
        $this->updateContactPersons($student, post());

        /** Fire event before contact persons create. */
        // Event::fire('genuineq.students.create.after.contact.persons.create', [post()]);

        Flash::success(Lang::get('genuineq.students::lang.components.students.message.success_creation'));

        $redirectUrl = null;
        /** Fire event before finish. */
        Event::fire('genuineq.students.before.student.create.finish', [&$redirectUrl, $student]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }
    }

    /**
     * Function that handels the update of a student.
     */
    public function onUpdateStudent()
    {
        /** Define redirect url variable. */
        $redirectUrl = null;
        Event::fire('genuineq.students.student.update.start', [&$this, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Extract the form data. */
        $data = [
            'surname' => post('surname'),
            'name' => post('name'),
            'description' => post('description'),
            'birthdate' => date_format(date_create_from_format('d-m-Y', post('birthdate')), 'Y-m-d'),
            'hearing_impairment' => ((Input::has('hearing_impairment')) ? (1) : (0)),
            'visual_impairment' => ((Input::has('visual_impairment')) ? (1) : (0)),
            'gender' => post('gender')
        ];

        /** Validate the student data. */
        $this->validateStudentData($data, post());

        /** Fire event before student update. */
        Event::fire('genuineq.students.update.before.student.update', [&$student, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Extract the student. */
        $student = StudentModel::find(post('id'));

        /** Update the student. */
        $student->update($data);

        /** Add student avatar. */
        if (Input::hasFile('avatar')) {
            $student->avatar = Input::file('avatar');
            $student->save();
        }

        /** Fire event after update. */
        Event::fire('genuineq.students.update.after.student.update', [$student]);

        /** Fire event before contact persons update. */
        // Event::fire('genuineq.students.update.before.contact.persons.update', [post()]);

        /** Save contact persons. */
        $this->updateContactPersons($student, post());

        /** Fire event before contact persons update. */
        Event::fire('genuineq.students.update.after.contact.persons.update', [post()]);

        Flash::success(Lang::get('genuineq.students::lang.components.students.message.success_update'));

        $redirectUrl = null;
        /** Fire event before finish. */
        Event::fire('genuineq.students.update.before.finish', [&$redirectUrl, $student]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        return Redirect::refresh();
    }

    /**
     * Function that archives a student.
     */
    public function onStudentArchive()
    {
        /** Define redirect url variable. */
        $redirectUrl = null;
        Event::fire('genuineq.students.student.archive.start', [&$this, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Fire event before student archive. */
        Event::fire('genuineq.students.student.before.archive', [&$student, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Extract the student that needs to be archived. */
        $student = StudentModel::find(post('id'));

        /** Archive the extracted student. */
        $student->archived = true;
        $student->save();

        Flash::success(Lang::get('genuineq.students::lang.components.students.message.student_archive_successful'));

        return Redirect::refresh();
    }

    /**
     * Function that unzips a student.
     */
    public function onStudentUnzip()
    {
        /** Define redirect url variable. */
        $redirectUrl = null;
        Event::fire('genuineq.students.student.unzip.start', [&$this, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Fire event before student unzip. */
        Event::fire('genuineq.students.student.before.unzip', [&$student, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Extract the student that needs to be unziped. */
        $student = StudentModel::find(post('id'));

        /** Unzip the extracted student. */
        $student->archived = false;
        $student->save();

        Flash::success(Lang::get('genuineq.students::lang.components.students.message.student_unzip_successful'));

        return Redirect::refresh();
    }

    /**
     * Function that deletes a student.
     */
    public function onStudentDelete()
    {
        /** Define redirect url variable. */
        $redirectUrl = null;
        Event::fire('genuineq.students.student.delete.start', [&$this, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Fire event before student delete. */
        Event::fire('genuineq.students.student.before.delete', [&$student, post(), &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Extract the student that needs to be deleted. */
        $student = StudentModel::find(post('id'));

        /** Delete the extracted student. */
        $student->delete();

        Flash::success(Lang::get('genuineq.students::lang.components.students.message.student_delete_successful'));

        return Redirect::refresh();
    }

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/

    /**
     * Function that parses 5 contact persons from the input data
     *  and creates/updates or deletes contact persons.
     */
    protected function updateContactPersons($student, $data)
    {
        /** Delete all existing contact persons. */
        $student->contact_persons->each(function ($item, $key) {
            $item->delete();
        });

        /** Parse all contact persons input data. */
        for ($i = 1; $i <= 5; $i++) {
            /** Check if any of the mandatory contact person data exists for index $i. */
            if ($data['contact_' . $i . '_surname'] || $data['contact_' . $i . '_name'] || $data['contact_' . $i . '_phone']) {
                /** Extract the data. */
                $contactPersonData = [
                    'student_id' => $student->id,
                    'surname' => $data['contact_' . $i . '_surname'],
                    'name' => $data['contact_' . $i . '_name'],
                    'phone' => $data['contact_' . $i . '_phone'],
                    'email' => $data['contact_' . $i . '_email'],
                    'description' => $data['contact_' . $i . '_observations']
                ];

                /** Validate the data. */
                $this->validateContactPersonData($contactPersonData);

                /** Create the contact person. */
                ContactPerson::create($contactPersonData);
            }
        }
    }

    /**
     * Function that validates the data for a contact person.
     */
    protected function validateContactPersonData($data)
    {
        /** Create the validation rules. */
        $rules = [
            'surname' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'phone' => 'required|numeric',
            'email' => 'between:6,255|email',
            'description' => 'string',
        ];

        /** Create the validation messages. */
        $messages = [
            'surname.required' => Lang::get('genuineq.students::lang.components.students.validation.surname_required'),
            'surname.regex' => Lang::get('genuineq.students::lang.components.students.validation.surname_string'),
            'name.required' => Lang::get('genuineq.students::lang.components.students.validation.name_required'),
            'name.regex' => Lang::get('genuineq.students::lang.components.students.validation.name_string'),
            'phone.required' => Lang::get('genuineq.students::lang.components.students.validation.phone_required'),
            'phone.numeric' => Lang::get('genuineq.students::lang.components.students.validation.phone_numeric'),
            'email.between' => Lang::get('genuineq.students::lang.components.students.validation.email_between'),
            'email.email' => Lang::get('genuineq.students::lang.components.students.validation.email_email'),
            'description.string' => Lang::get('genuineq.students::lang.components.students.validation.description_string'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }
    }

    /**
     * Function that validates the data for a student.
     */
    protected function validateStudentData($data, $post)
    {
        /** Create the validation rules. */
        $rules = [
            'surname' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'description' => 'required|string',
            'birthdate' => 'required|date|date_format:Y-m-d',
            'hearing_impairment' => 'boolean',
            'visual_impairment' => 'boolean',
            'gender' => 'required|in:male,female'
        ];

        /** Create the validation messages. */
        $messages = [
            'surname.required' => Lang::get('genuineq.students::lang.components.students.validation.surname_required'),
            'surname.regex' => Lang::get('genuineq.students::lang.components.students.validation.surname_string'),
            'name.required' => Lang::get('genuineq.students::lang.components.students.validation.name_required'),
            'name.regex' => Lang::get('genuineq.students::lang.components.students.validation.name_string'),
            'description.required' => Lang::get('genuineq.students::lang.components.students.validation.description_required'),
            'description.string' => Lang::get('genuineq.students::lang.components.students.validation.description_string'),
            'birthdate.required' => Lang::get('genuineq.students::lang.components.students.validation.birthdate_required'),
            'birthdate.date' => Lang::get('genuineq.students::lang.components.students.validation.birthdate_date'),
            'birthdate.date_format' => Lang::get('genuineq.students::lang.components.students.validation.birthdate_date_format'),
            'hearing_impairment.boolean' => Lang::get('genuineq.students::lang.components.students.validation.hearing_impairment_boolean'),
            'visual_impairment.boolean' => Lang::get('genuineq.students::lang.components.students.validation.visual_impairment_boolean'),
            'gender.required' => Lang::get('genuineq.students::lang.components.students.validation.gender_required'),
            'gender.in' => Lang::get('genuineq.students::lang.components.students.validation.gender_in'),
        ];

        /** Fire event before student validation. */
        Event::fire('genuineq.students.before.student.validate', [&$data, &$rules, &$messages, $post]);

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }
    }
}