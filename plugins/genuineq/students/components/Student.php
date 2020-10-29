<?php namespace Genuineq\Students\Components;

use Log;
use Auth;
use Lang;
use Flash;
use Event;
use Input;
use Request;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
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

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        /** Check if a student is accessed. */
        if ($this->param('id')) {
            /** Extract the student and send it to the page. */
            $this->page['student'] = StudentModel::find($this->param('id'));
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
        Event::fire('genuineq.students.create.before.student.create', [&$data, post()]);

        /** Create the student. */
        $student = StudentModel::create($data);

        /** Add student avatar. */
        if (Input::hasFile('avatar')) {
            $student->avatar = Input::file('avatar');
            $student->save();
        }

        /** Fire event after create. */
        Event::fire('genuineq.students.create.after.student.create', [$student]);

        /** Fire event before contact persons create. */
        Event::fire('genuineq.students.create.before.contact.persons.create', [post()]);

        /** Save contact persons. */
        $this->updateContactPersons($student, post());

        /** Fire event before contact persons create. */
        Event::fire('genuineq.students.create.after.contact.persons.create', [post()]);

        Flash::success(Lang::get('genuineq.students::lang.components.students.message.success_creation'));

        $redirectUrl = null;
        /** Fire event before finish. */
        Event::fire('genuineq.students.create.before.finish', [&$redirectUrl, $student]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        return Redirect::refresh();
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
        Event::fire('genuineq.students.update.before.student.update', [&$data, post()]);

        /** Extract the student. */
        $student = StudentModel::find(post('id'));

        /** Update the student. */
        $student->update($data);
        $student->save();

        /** Add student avatar. */
        if (Input::hasFile('avatar')) {
            $student->avatar = Input::file('avatar');
            $student->save();
        }

        /** Fire event after update. */
        Event::fire('genuineq.students.update.after.student.update', [$student]);

        /** Fire event before contact persons update. */
        Event::fire('genuineq.students.update.before.contact.persons.update', [post()]);

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

        /** Extract the student that needs to be archived. */
        $student = StudentModel::find(post('id'));

        /** Fire event before student archive. */
        Event::fire('genuineq.students.student.before.archive', [&$student, post()]);

        if ($student) {
            /** Archive the extracted student. */
            $student->archived = true;
            $student->save();

            Flash::success(Lang::get('genuineq.students::lang.components.students.message.student_archive_successful'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.students::lang.components.students.message.student_archive_failed'));
        }
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

        /** Extract the student that needs to be unziped. */
        $student = StudentModel::find(post('id'));

        /** Fire event before student unzip. */
        Event::fire('genuineq.students.student.before.unzip', [&$student, post()]);

        if ($student) {
            /** Unzip the extracted student. */
            $student->archived = false;
            $student->save();

            Flash::success(Lang::get('genuineq.students::lang.components.students.message.student_unzip_successful'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.students::lang.components.students.message.student_unzip_failed'));
        }
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

        /** Extract the student that needs to be deleted. */
        $student = StudentModel::find(post('id'));

        /** Fire event before student unzipe. */
        Event::fire('genuineq.students.student.before.delete', [&$student, post()]);

        if ($student) {
            /** Delete the extracted student. */
            $student->forceDelete();

            Flash::success(Lang::get('genuineq.students::lang.components.students.message.student_delete_successful'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.students::lang.components.students.message.student_delete_failed'));
        }
    }

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/

    /**
     * Function that parses 5 contact persons from
     *  the input data and creates/updates or deletes contact persons.
     */
    protected function updateContactPersons($student, $data)
    {
        /** Check if contact person 1 data exists. */
        if ($data['contact_1_surname'] && $data['contact_1_name'] && $data['contact_1_phone']) {
            if ($student->contact_person_1) {
                $this->updateContactPerson($student->contact_person_1, $data['contact_1_surname'], $data['contact_1_name'], $data['contact_1_phone'], $data['contact_1_email'], $data['contact_1_observations']);
            } else {
                $contactPerson = $this->createContactPerson($data['contact_1_surname'], $data['contact_1_name'], $data['contact_1_phone'], $data['contact_1_email'], $data['contact_1_observations']);
                $student->contact_person_1_id = $contactPerson->id;
                $student->save();
            }
        } elseif ($student->contact_person_1) {
            /** No data provided. Delete old data. */
            $contactPerson = $student->contact_person_1;
            $contactPerson->delete();

            /** Update student. */
            $student->contact_person_1_id = null;
            $student->save();
        }

        /** Check if contact person 2 data exists. */
        if ($data['contact_2_surname'] && $data['contact_2_name'] && $data['contact_2_phone']) {
            if ($student->contact_person_2) {
                $this->updateContactPerson($student->contact_person_2, $data['contact_2_surname'], $data['contact_2_name'], $data['contact_2_phone'], $data['contact_2_email'], $data['contact_2_observations']);
            } else {
                $contactPerson = $this->createContactPerson($data['contact_2_surname'], $data['contact_2_name'], $data['contact_2_phone'], $data['contact_2_email'], $data['contact_2_observations']);
                $student->contact_person_2_id = $contactPerson->id;
                $student->save();
            }
        } elseif ($student->contact_person_2) {
            /** No data provided. Delete old data. */
            $contactPerson = $student->contact_person_2;
            $contactPerson->delete();

            /** Update student. */
            $student->contact_person_2_id = null;
            $student->save();
        }

        /** Check if contact person 3 data exists. */
        if ($data['contact_3_surname'] && $data['contact_3_name'] && $data['contact_3_phone']) {
            if ($student->contact_person_3) {
                $this->updateContactPerson($student->contact_person_3, $data['contact_3_surname'], $data['contact_3_name'], $data['contact_3_phone'], $data['contact_3_email'], $data['contact_3_observations']);
            } else {
                $contactPerson = $this->createContactPerson($data['contact_3_surname'], $data['contact_3_name'], $data['contact_3_phone'], $data['contact_3_email'], $data['contact_3_observations']);
                $student->contact_person_3_id = $contactPerson->id;
                $student->save();
            }
        } elseif ($student->contact_person_3) {
            /** No data provided. Delete old data. */
            $contactPerson = $student->contact_person_3;
            $contactPerson->delete();

            /** Update student. */
            $student->contact_person_3_id = null;
            $student->save();
        }

        /** Check if contact person 4 data exists. */
        if ($data['contact_4_surname'] && $data['contact_4_name'] && $data['contact_4_phone']) {
            if ($student->contact_person_4) {
                $this->updateContactPerson($student->contact_person_4, $data['contact_4_surname'], $data['contact_4_name'], $data['contact_4_phone'], $data['contact_4_email'], $data['contact_4_observations']);
            } else {
                $contactPerson = $this->createContactPerson($data['contact_4_surname'], $data['contact_4_name'], $data['contact_4_phone'], $data['contact_4_email'], $data['contact_4_observations']);
                $student->contact_person_4_id = $contactPerson->id;
                $student->save();
            }
        } elseif ($student->contact_person_4) {
            /** No data provided. Delete old data. */
            $contactPerson = $student->contact_person_4;
            $contactPerson->delete();

            /** Update student. */
            $student->contact_person_4_id = null;
            $student->save();
        }

        /** Check if contact person 5 data exists. */
        if ($data['contact_5_surname'] && $data['contact_5_name'] && $data['contact_5_phone']) {
            if ($student->contact_person_5) {
                $this->updateContactPerson($student->contact_person_5, $data['contact_5_surname'], $data['contact_5_name'], $data['contact_5_phone'], $data['contact_5_email'], $data['contact_5_observations']);
            } else {
                $contactPerson = $this->createContactPerson($data['contact_5_surname'], $data['contact_5_name'], $data['contact_5_phone'], $data['contact_5_email'], $data['contact_5_observations']);
                $student->contact_person_5_id = $contactPerson->id;
                $student->save();
            }
        } elseif ($student->contact_person_5) {
            /** No data provided. Delete old data. */
            $contactPerson = $student->contact_person_5;
            $contactPerson->delete();

            /** Update student. */
            $student->contact_person_5_id = null;
            $student->save();
        }
    }

    /** Function that creates a contact person with the provided details. */
    protected function createContactPerson($surname, $name, $phone, $email, $description)
    {
        /** Extract the form data. */
        $data = [
            'surname' => $surname,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'description' => $description
        ];

        /** Create the validation rules. */
        $rules = [
            'surname' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'phone' => 'required|numeric',
            'email' => 'required|between:6,255|email|unique:users',
            'description' => 'string',
        ];

        /** Create the validation messages. */
        $messages = [
            'surname.required' => Lang::get('genuineq.students::lang.components.students.validation.surname_required'),
            'surname.regex' => Lang::get('genuineq.students::lang.components.students.validation.surname_string'),
            'name.required' => Lang::get('genuineq.students::lang.components.students.validation.name_required'),
            'name.regex' => Lang::get('genuineq.students::lang.components.students.validation.name_string'),
            'phone.required' => Lang::get('genuineq.students::lang.components.students.validation.birthdate_required'),
            'phone.numeric' => Lang::get('genuineq.students::lang.components.students.validation.birthdate_date'),
            'email.between' => Lang::get('genuineq.students::lang.components.students.validation.email_between'),
            'email.email' => Lang::get('genuineq.students::lang.components.students.validation.email_email'),
            'description.string' => Lang::get('genuineq.students::lang.components.students.validation.description_string'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        return ContactPerson::create([
            'surname' => $surname,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'description' => $description
        ]);
    }

    /** Function that updates a contact person with the provided details. */
    protected function updateContactPerson($contactPerson, $surname, $name, $phone, $email, $description)
    {
        /** Extract the form data. */
        $data = [
            'surname' => $surname,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'description' => $description
        ];

        /** Create the validation rules. */
        $rules = [
            'surname' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'phone' => 'required|numeric',
            'email' => 'required|between:6,255|email|unique:users',
            'description' => 'string',
        ];

        /** Create the validation messages. */
        $messages = [
            'surname.required' => Lang::get('genuineq.students::lang.components.students.validation.surname_required'),
            'surname.regex' => Lang::get('genuineq.students::lang.components.students.validation.surname_string'),
            'name.required' => Lang::get('genuineq.students::lang.components.students.validation.name_required'),
            'name.regex' => Lang::get('genuineq.students::lang.components.students.validation.name_string'),
            'phone.required' => Lang::get('genuineq.students::lang.components.students.validation.birthdate_required'),
            'phone.numeric' => Lang::get('genuineq.students::lang.components.students.validation.birthdate_date'),
            'email.between' => Lang::get('genuineq.students::lang.components.students.validation.email_between'),
            'email.email' => Lang::get('genuineq.students::lang.components.students.validation.email_email'),
            'description.string' => Lang::get('genuineq.students::lang.components.students.validation.description_string'),
        ];

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Update the contact person. */
        $contactPerson->update([
            'surname' => $surname,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'description' => $description
        ]);
        $contactPerson->save();
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
