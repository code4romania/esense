<?php namespace Genuineq\Students\Components;

use Log;
use Lang;
use Flash;
use Event;
use Input;
use Request;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\ComponentBase;
use Genuineq\Students\Models\Student;
use Genuineq\Students\Models\ContactPerson;

/**
 * Students component
 *
 * Handels the CRUD operations for students.
 */
class Students extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.students::lang.components.students.name',
            'description' => 'genuineq.students::lang.components.students.description'
        ];
    }

    /**
     * Executed when this component is initialized
     */
    public function prepareVars()
    {
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        $this->prepareVars();
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
            'birthdate' => post('birthdate'),
            'hearing_impairment' => ((Input::has('hearing_impairment')) ? (1) : (0)),
            'visual_impairment' => ((Input::has('visual_impairment')) ? (1) : (0)),
            // 'gender' => ''
        ];

        /** Create the validation rules. */
        $rules = [
            'surname' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'name' => ['required', 'regex:/^[a-zA-Z0123456789 -]*$/i'],
            'description' => 'required|string',
            'birthdate' => 'required|date|date_format:d-m-Y',
            'hearing_impairment' => 'boolean',
            'visual_impairment' => 'boolean',
            // 'gender' => 'required|in:male,female'
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
            // 'gender.required' => Lang::get('genuineq.students::lang.components.students.validation.gender_required'),
            // 'gender.in' => Lang::get('genuineq.students::lang.components.students.validation.gender_in'),
        ];

        /** Fire event before student validation. */
        Event::fire('genuineq.students.create.before.student.validate', [&$data, &$rules, &$messages, post()]);

        /** Apply the validation rules. */
        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /** Fire event before student create. */
        Event::fire('genuineq.students.create.before.student.create', [&$data, &$rules, &$messages, post()]);

        /** Create the Student. */
        $student = Student::create([
            'surname' => $data['surname'],
            'name' => $data['name'],
            'description' => $data['description'],
            'birthdate' => date_format(date_create_from_format('d-m-Y', $data['birthdate']), 'Y-m-d'),
            'hearing_impairment' => $data['hearing_impairment'],
            'visual_impairment' => $data['visual_impairment'],
            // 'gender' => $data['gender'],
        ]);

        /** Fire event after create. */
        Event::fire('genuineq.students.create.after.student.create', [$student]);

        /** Fire event before contact persons create. */
        Event::fire('genuineq.students.create.before.contact.persons.create', [post()]);

        /** Save contact persons. */
        $this->createContactPersons($student, post());

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

    /***********************************************
     ******************* Helpers *******************
     ***********************************************/

    /**
     * Function that parses 5 contact persons from
     *  the input data and adds them to the database.
     */
    protected function createContactPersons($student, $data)
    {
        /** Check if contact person 1 has been added. */
        if ($data['contact_1_surname'] && $data['contact_1_name'] && $data['contact_1_phone']) {
            $contactPerson = $this->createContactPerson($data['contact_1_surname'], $data['contact_1_name'], $data['contact_1_phone'], $data['contact_1_email'], $data['contact_1_observations']);
            $student->contact_person_1_id = $contactPerson->id;
        }

        /** Check if contact person 2 has been added. */
        if ($data['contact_2_surname'] && $data['contact_2_name'] && $data['contact_2_phone']) {
            $contactPerson = $this->createContactPerson($data['contact_2_surname'], $data['contact_2_name'], $data['contact_2_phone'], $data['contact_2_email'], $data['contact_2_observations']);
            $student->contact_person_2_id = $contactPerson->id;
        }

        /** Check if contact person 3 has been added. */
        if ($data['contact_3_surname'] && $data['contact_3_name'] && $data['contact_3_phone']) {
            $contactPerson = $this->createContactPerson($data['contact_3_surname'], $data['contact_3_name'], $data['contact_3_phone'], $data['contact_3_email'], $data['contact_3_observations']);
            $student->contact_person_3_id = $contactPerson->id;
        }

        /** Check if contact person 4 has been added. */
        if ($data['contact_4_surname'] && $data['contact_4_name'] && $data['contact_4_phone']) {
            $contactPerson = $this->createContactPerson($data['contact_4_surname'], $data['contact_4_name'], $data['contact_4_phone'], $data['contact_4_email'], $data['contact_4_observations']);
            $student->contact_person_4_id = $contactPerson->id;
        }

        /** Check if contact person 5 has been added. */
        if ($data['contact_5_surname'] && $data['contact_5_name'] && $data['contact_5_phone']) {
            $contactPerson = $this->createContactPerson($data['contact_5_surname'], $data['contact_5_name'], $data['contact_5_phone'], $data['contact_5_email'], $data['contact_5_observations']);
            $student->contact_person_5_id = $contactPerson->id;
        }

        /** Update the student. */
        $student->save();
    }

    /** Function that creates a contact person with provided details. */
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
}
