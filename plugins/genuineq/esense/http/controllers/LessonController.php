<?php namespace Genuineq\Esense\Http\Controllers;

use Log;
use Lang;
use Request;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Genuineq\JWTAuth\Classes\JWTAuth;
use Genuineq\Students\Models\Student;
use Genuineq\Timetable\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Starts a trip for the authenticated user
     *
     * @param JWTAuth $auth
     * @param Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function __invoke(JWTAuth $auth, Request $request)
    {
        /** Extract the student. */
        $student = $auth->user()->profile->students->where('id', post('student'))->first();

        /** Validate the access to the student. */
        if (!$student) {
            return response()->json(
                ['error' => Lang::get('genuineq.esense::lang.components.lessonsActions.message.no_access'),],
                Response::HTTP_FORBIDDEN
            );
        }

        /** Create a new Lesson. */
        $lesson = Lesson::create([
            'day' => post('date'),
            'start_hour' => post('startHour'),
            'end_hour' => post('endHour'),
            'title' => post('title'),
            'description' => post('description'),
            'feedback' => post('feedback'),
            'connection_id' => $student->connections->where('specialist_id', $auth->user()->profile->id)->first()->id,
            'category' => post('category')
        ]);

        return response()->json(
            [$lesson, 'message' => Lang::get('genuineq.esense::lang.components.lessonsActions.message.save_successful')],
            Response::HTTP_CREATED
        );
    }
}
