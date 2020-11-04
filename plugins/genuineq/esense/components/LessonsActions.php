<?php namespace Genuineq\Esense\Components;

use App;
use Log;
use Lang;
use Auth;
use Flash;
use Request;
use Redirect;
use Cms\Classes\ComponentBase;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\Profile\Models\Specialist;
use Genuineq\Students\Models\Student;
use Genuineq\Esense\Helpers\DataReadHelper;
use Genuineq\Esense\Models\StudentTransfer;

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
        $student = $user->profile->students()->whereId(post('student'))->first();

        if ($student) {
            $this->page['lessons'] = $student->getDateLessons(post('date'));
        } else {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }
    }
}
