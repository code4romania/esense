<?php namespace Genuineq\Esense\Components;

use App;
use Log;
use Lang;
use Auth;
use Mail;
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
 * StudentActions component
 *
 * Allows to create, accept and decline student access requests and student transfer requests.
 */
class StudentActions extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.esense::lang.components.studentActions.name',
            'description' => 'genuineq.esense::lang.components.studentActions.description'
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
     * Function that creates a student access request.
     */
    public function onCreateStudentAccessRequest()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
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

        Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.access_request_success_creation'));

        return Redirect::refresh();
    }

    /**
     * Function that accepts a student access request.
     */
    public function onAcceptStudentAccessRequest()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the student. */
        $student = $user->profile->myStudents()->whereId(post('student'))->first();

        /** pass variables to mail view */
        $data = [
            'name' => $student->name,
        ];

        if ($student) {
            /** Approve the request */
            $student->specialists()->updateExistingPivot(post('specialist'), ['seen' => 1, 'approved' => 1]);

            /** Send access granted info email */
            Mail::send('genuineq.esense::mail.access_granted', $data, function($message) use ($student)
            {
                $message->to($student->email);
            });

            Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.access_request_success_approval'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.access_request_failed_approval'));
        }
    }

    /**
     * Function that declines a student access request.
     */
    public function onDeclineStudentAccessRequest()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the student. */
        $student = $user->profile->myStudents()->whereId(post('student'))->first();

        /** pass variables to mail view */
        $data = [
            'name' => $student->name,
        ];

        if ($student) {
            /** Decline the request */
            $student->specialists()->detach(post('specialist'));

            /** Send access granted info email */
            Mail::send('genuineq.esense::mail.access_rejected', $data, function($message) use ($student)
            {
                $message->to($student->email);
            });

            Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.access_request_success_decline'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.access_request_failed_decline'));
        }
    }

    /**
     * Function that loads the students of a specialist.
     */
    public function onStudentsLoad()
    {
        /** Extract the specialist. */
        $specialist = Specialist::find(post('specialist'));

        /* Extract all the specialists in JSON format. */
        foreach ($specialist->myStudents as $student) {
            $students[$student->full_name] = $student->id;
        }

        /** Return the students cities in JSON format. */
        return $students;
    }

    /**
     * Function that creates a student transfer request.
     */
    public function onCreateStudentTransferRequest()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the from specialist. */
        $fromSpecialist = Specialist::find(post('specialist'));
        if ($fromSpecialist) {
            /** Extract the student. */
            $student = $fromSpecialist->myStudents()->whereId(post('student'))->first();

            if ($student) {
                /** Create the student transfer. */
                $studentTransfer = StudentTransfer::create(['student_id' => post('student'), 'from_specialist_id' => post('specialist'), 'to_specialist_id' => $user->profile->id]);

                Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_success_creation'));
            } else {
                Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_failed_creation'));
            }
        }else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_failed_creation'));
        }
    }

    /**
     * Function that accepts a student transfer request.
     */
    public function onAcceptStudentTransferRequest()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the student. */
        $student = $user->profile->myStudents()->whereId(post('student'))->first();
        /** Extract the transfer request. */
        $transferRequest = $user->profile->transferRequests()->where('student_id', $student->id)->where('to_specialist_id', post('specialist'))->whereNull('approved')->first();

        if ($transferRequest) {
            /** Approve the request */
            $transferRequest->approved = true;
            $transferRequest->save();

            /** Transfer the ownership. */
            $student->owner_id = post('specialist');
            $student->save();

            /** pass variables to mail view */
            $data = [
                'name' => $student->name,
            ];

            /** Create specialist connection for new owner. */
            if (!$student->specialists()->whereId($student->owner_id)->first()) {
                $student->specialists()->attach($student->owner_id, ['approved' => true]);
            }

            /** Remove specialist connection for old owner. */
            $student->specialists()->detach($user->profile);

            /** Mark all other transfer requests for the same student as declined. */
            foreach ($user->profile->transferRequests()->where('student_id', $student->id)->whereNull('approved')->get() as $key => $transferRequest) {
                $transferRequest->spproved = false;
            }

            /** Mark all other access requests for the same student as declined. */
            foreach ($user->profile->access_notifications->where('student_id', $student->id) as $key => $accessRequest) {
                $student->specialists()->detach($accessRequest);
            }

            /** Send access granted info email */
            Mail::send('genuineq.esense::mail.transfer_accepted', $data, function($message) use ($student)
            {
                $message->to($student->email);
            });

            Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_success_approval'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_failed_approval'));
        }
    }

    /**
     * Function that declines an student transfer request.
     */
    public function onDeclineStudentTransferRequest()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Extract the user. */
        $user = Auth::getuser();

        /** Extract the student. */
        $student = $user->profile->myStudents()->whereId(post('student'))->first();
        /** Extract the transfer request. */
        $transferRequest = $user->profile->transferRequests()->where('student_id', post('student'))->where('to_specialist_id', post('specialist'))->whereNull('approved')->first();

        /** pass variables to mail view */
        $data = [
            'name' => $student->name,
        ];

        if ($transferRequest) {
            /** Approve the request */
            $transferRequest->approved = false;
            $transferRequest->save();

            /** Send access granted info email */
            Mail::send('genuineq.esense::mail.transfer_rejected', $data, function($message) use ($student)
            {
                $message->to($student->email);
            });

            Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_success_decline'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_failed_decline'));
        }
    }
}
