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

/**
 * StudentAccess component
 *
 * Allows to create, accept and decline student access requests.
 */
class StudentAccess extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.esense::lang.components.studentAccess.name',
            'description' => 'genuineq.esense::lang.components.studentAccess.description'
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
     * Function that creates an student access request.
     */
    public function onCreateStudentAccessRequest()
    {
        if (!Auth::check()) {
            $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the student ID and the student. */
        $studentId = json_decode(post('student'), true)[0]['value'];
        $student = Student::find($studentId);

        /** Create the request access. */
        $student->specialists()->attach(
            $user->profile,
            [
                'approved' => false,
                'message' => post('message'),
                'seen' => false
            ]
        );

        Flash::success(Lang::get('genuineq.esense::lang.components.studentAccess.message.success_creation'));

        return Redirect::refresh();
    }

    /**
     * Function that accepts an student access request.
     */
    public function onAcceptStudentAccessRequest()
    {
        if (!Auth::check()) {
            $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the student. */
        $student = $user->profile->myStudents()->whereId(post('student'))->first();

        if ($student) {
            /** Approve the request */
            $student->specialists()->updateExistingPivot(post('specialist'), ['seen' => 1, 'approved' => 1]);

            Flash::success(Lang::get('genuineq.esense::lang.components.studentAccess.message.success_approval'));
        } else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentAccess.message.failed_approval'));
        }

        return Redirect::refresh();
    }

    /**
     * Function that declines an student access request.
     */
    public function onDeclineStudentAccessRequest()
    {
        if (!Auth::check()) {
            $redirectUrl = $component->pageUrl(RedirectHelper::loginRequired());
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the student. */
        $student = $user->profile->myStudents()->whereId(post('student'))->first();

        if ($student) {
            /** Decline the request */
            $student->specialists()->detach(post('specialist'));

            Flash::success(Lang::get('genuineq.esense::lang.components.studentAccess.message.success_decline'));
        } else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentAccess.message.failed_decline'));
        }

        return Redirect::refresh();
    }
}
