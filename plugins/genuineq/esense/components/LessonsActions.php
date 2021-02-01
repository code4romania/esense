<?php namespace Genuineq\Esense\Components;

use App;
use Carbon\Carbon;
use Log;
use Lang;
use Auth;
use Flash;
use Event;
use Request;
use Redirect;
use Validator;
use ValidationException;
use Cms\Classes\ComponentBase;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\Students\Models\Student;
use Genuineq\Timetable\Models\Lesson;

/**
 * LessonsActions component
 *
 * Allows to extract and edit lessons.
 */
class LessonsActions extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.esense::lang.components.lessonsActions.name',
            'description' => 'genuineq.esense::lang.components.lessonsActions.description'
        ];
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun()
    {
        /** Define redirect url variable. */
        $redirectUrl = null;
        Event::fire('genuineq.lessons.read.start', [&$this, &$redirectUrl]);

        /** Check if a redirect is required. */
        if ($redirectUrl) {
            return Redirect::to($redirectUrl);
        }

        /** Check if a lesson is accessed. */
        if ($this->param('lessonId')) {
            Event::fire('genuineq.lessons.before.lesson.read', [&$this, $this->param('lessonId'), &$redirectUrl]);

            /** Check if a redirect is required. */
            if ($redirectUrl) {
                return Redirect::to($redirectUrl);
            }

            /** Extract the lesson and send it to the page. */
            $this->page['lesson'] = Lesson::find($this->param('lessonId'));
        }
    }

    /***********************************************
     **************** AJAX handlers ****************
     ***********************************************/

    /**
     * Function that extracts the lessons of a student for a specified date.
     */
    public function onGetStudentDateLessons()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the student. */
        $student = $user->profile->students->where('id', post('student'))->first();

        if ($student) {
            $this->page['lessons'] = $student->getDateLessons(post('date'));
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }
    }

    /**
     * Function that extracts a lesson.
     */
    public function onGetStudentLesson()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the lesson. */
        $lesson = Lesson::find(post('lesson'));

        /** Validate the access to the lesson. */
        $student = $user->profile->students->where('id', $lesson->connection->student->id)->first();

        if ($student) {
            return $lesson;
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }
    }

    /**
     * Function that updates a lesson.
     */
    public function onUpdateStudentLesson()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the lesson. */
        $lesson = Lesson::find(post('lesson'));

        /** Validate the access to the lesson. */
        $student = $user->profile->students->where('id', $lesson->connection->student->id)->first();

        if ($student) {
            /** Extract the data to be validated. */
            $data = [
                'description' => post('description'),
                'feedback' => post('feedback'),
            ];

            /** Create the validation rules. */
            $rules = [
                'description' => 'string',
                'feedback' => 'string',
            ];

            /** Create the validation messages. */
            $messages = [
                'description.string' => Lang::get('genuineq.esense::lang.component.lessonsActions.validation.description_string'),
                'feedback.string' => Lang::get('genuineq.esense::lang.component.lessonsActions.validation.feedback_string'),
            ];

            /** Apply the validation rules. */
            $validation = Validator::make($data, $rules, $messages);
            if ($validation->fails()) {
                throw new ValidationException($validation);
            }

            /** Make the update. */
            $lesson->update($data);

            Flash::success(Lang::get('genuineq.esense::lang.components.lessonsActions.message.lesson_updated_successfully'));
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }
    }

    /**
     * Function that forces the refresh of the specialist-student lessons table
     *  in order to display lessons from  selected year.
     */
    public function onSpecialistLessonsTableUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $specialistProfile = Auth::user()->profile;

        /** Send the user back. */
        $this->page['user'] = $specialistProfile;

        /** Verify current url and extract student ID */
        $studentId = preg_replace(
            '/^(http[s]?:\/\/[a-z.]*)(\/[a-z]*\/[a-z]*\/)/', // pattern matches 'http(s)://(www.)abcdefgh.domain/some/text/'
            "", // replacement
            url()->current() ); // get current URL

       /** Extract the student. */
        $student = $specialistProfile->students->where('id',  $studentId)->first();

        /** Send the year back. */
        $this->page['year'] = post('year');
       /** Send the month back. */
        $this->page['month'] = post('month');

        /** Set the years array. */
        $this->page['years'] = $student->lessons_years;

        /** Set the lessons. */
        $this->page['lessons'] = $student->getLessonsFromMonth(post('month'), post('year'));
    }

    /**
     * Function that forces the refresh of the school-student lessons table
     *  in order to display lessons from selected year.
     */
    public function onSchoolStudentLessonsTableUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Get authenticated user */
        $schoolProfile = Auth::user()->profile;

        /** Send the user back. */
        $this->page['user'] = $schoolProfile;

        /** Verify current url and extract student ID */
        $studentId = (int)preg_replace(
            '/^(http[s]?:\/\/[a-z.]*)(\/[a-z]*\/[a-z]*\/)/', // pattern matches 'http(s)://(www.)abc.domain/some/text/'
            "", // replacement
            url()->current() ); // get current URL

        $student = $schoolProfile->students->where('id', $studentId)->first();

        /** Send the year back. */
        $this->page['year'] = post('year');
        /** Send the month back. */
        $this->page['month'] = post('month');

        /** Send back the years array. */
        $this->page['years'] = $student->lessons_years;

        /** Get the lessons. */
        $this->page['lessons'] = $student->getLessonsFromMonth(post('month'), post('year'));
    }

}