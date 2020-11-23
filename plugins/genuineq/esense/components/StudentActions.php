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
use Genuineq\Esense\Models\TransferRequest;
use Genuineq\Esense\Models\AccessRequest;

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

        /** Extract the student ID. */
        $studentId = json_decode(post('student'), true)[0]['value'];

        /** Check if user has a school and specified student is among school students. */
        if (!$user->profile->school || !$user->profile->school_students->where('id', $studentId)->first()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }

        /** Extract the student. */
        $student = Student::find($studentId);
        /** Extract the specialist. */
        $specialist = Specialist::find(json_decode(post('student'), true)[0]['teacher']);

        if ($specialist) {
            /** Create the request access. */
            AccessRequest::create([
                'student_id' => $studentId,
                'from_specialist_id' => $specialist->id,
                'to_specialist_id' => $user->profile->id,
                'approved' => false,
                'message' => post('message'),
                'seen' => false,
            ]);

            Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.access_request_success_creation'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.access_request_failed_creation'));
        }
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

        /** Extract the access request. */
        $accessRequest = $user->profile->accessRequests()->whereStudentId($student->id)->whereToSpecialistId(post('specialist'))->whereApproved(false)->whereSeen(false)->first();

        if ($accessRequest) {
            /** Approve the request. */
            $accessRequest->seen = true;
            $accessRequest->approved = true;
            $accessRequest->save();

            /** Pass variables to mail. */
            $data = ['name' => $student->full_name];

            $toSpecialist = $accessRequest->toSpecialist;

            /** Give access to the specialist. */
            $student->specialists()->attach($toSpecialist);

            /** Send access granted email. */
            Mail::send('genuineq.esense::mail.access_granted', $data, function($message) use ($toSpecialist){
                $message->to($toSpecialist->user->email);
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

        /** Extract the access request. */
        $accessRequest = $user->profile->accessRequests()->whereStudentId($student->id)->whereToSpecialistId(post('specialist'))->whereApproved(false)->whereSeen(false)->first();

        if ($accessRequest) {
            /** Reject the request. */
            $accessRequest->seen = true;
            $accessRequest->approved = false;
            $accessRequest->save();

            /** Pass variables to mail. */
            $data = ['name' => $student->full_name];

            $toSpecialist = $accessRequest->toSpecialist;

            /** Send access rejected email. */
            Mail::send('genuineq.esense::mail.access_rejected', $data, function($message) use ($toSpecialist){
                $message->to($toSpecialist->user->email);
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

        /** Check if user has a school and specified student is among school students. */
        if (!$user->profile->school || !$user->profile->school_students->where('id', post('student'))->first()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::accessDenied()));
        }

        /** Extract the from specialist. */
        $fromSpecialist = Specialist::find(post('specialist'));
        if ($fromSpecialist) {
            /** Extract the student. */
            $student = $fromSpecialist->myStudents()->whereId(post('student'))->first();

            if ($student) {
                /** Create the student transfer. */
                $transferRequest = TransferRequest::create(['student_id' => post('student'), 'from_specialist_id' => post('specialist'), 'to_specialist_id' => $user->profile->id]);

                Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_success_creation'));
            } else {
                Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_failed_creation'));
            }
        } else {
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

            /** Create specialist connection for new owner if missing. */
            if (!$student->specialists->where('id', $student->owner_id)->first()) {
                $student->specialists()->attach($student->owner_id);
            }

            /** Remove specialist connection for old owner. */
            $student->specialists()->detach($user->profile);

            /** Pass variables to mail. */
            $data = ['name' => $student->full_name];

            /** Mark all other transfer requests for the same student as declined and inform the specialists. */
            foreach ($user->profile->transferRequests()->where('student_id', $student->id)->whereNull('approved')->get() as $key => $transferRequest) {
                $transferRequest->approved = false;
                $transferRequest->save();

                $toSpecialist = $transferRequest->toSpecialist;

                /** Send transfer rejected email. */
                Mail::send('genuineq.esense::mail.transfer_rejected', $data, function($message) use ($toSpecialist){
                    $message->to($toSpecialist->user->email);
                });
            }

            /** Mark all other access requests for the same student as declined and inform the specialists. */
            foreach ($user->profile->accessRequests()->where('student_id', $student->id) as $key => $accessRequest) {
                /** Reject the request. */
                $accessRequest->seen = true;
                $accessRequest->approved = false;
                $accessRequest->save();

                $toSpecialist = $transferRequest->toSpecialist;

                /** Send access rejected email. */
                Mail::send('genuineq.esense::mail.access_rejected', $data, function($message) use ($toSpecialist){
                    $message->to($toSpecialist->user->email);
                });
            }

            $toSpecialist = $transferRequest->toSpecialist;

            /** Send transfer accepted email. */
            Mail::send('genuineq.esense::mail.transfer_accepted', $data, function($message) use ($toSpecialist){
                $message->to($toSpecialist->user->email);
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

        if ($transferRequest) {
            /** Approve the request */
            $transferRequest->approved = false;
            $transferRequest->save();

            /** Pass variables to mail. */
            $data = ['name' => $student->full_name];

            $toSpecialist = $transferRequest->toSpecialist;

            /** Send transfer rejected email. */
            Mail::send('genuineq.esense::mail.transfer_rejected', $data, function($message) use ($toSpecialist){
                $message->to($toSpecialist->user->email);
            });

            Flash::success(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_success_decline'));

            return Redirect::refresh();
        } else {
            Flash::error(Lang::get('genuineq.esense::lang.components.studentActions.message.transfer_request_failed_decline'));
        }
    }
}
