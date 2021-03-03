<?php namespace Genuineq\Esense\Http\Controllers;

use Log;
use Lang;
use Request;
use Exception;
use Carbon\Carbon;
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

        /** Validate the date. */
        if (Carbon::now()->format('Y-m-d') != post('date')) {
            return response()->json(
                ['error' => Lang::get('genuineq.esense::lang.components.lessonsActions.message.invalid_date'),],
                Response::HTTP_FORBIDDEN
            );
        }

        /** Validate the hours. */
        if (post('startHour') >= post('endHour')) {
            return response()->json(
                ['error' => Lang::get('genuineq.esense::lang.components.lessonsActions.message.invalid_hours'),],
                Response::HTTP_FORBIDDEN
            );
        }

        /** Validate the category. */
        /** Extract the exercises categories. */
        $categoriesSlugs = $auth->user()->profile->exercises_categories->pluck('slug')->toArray();
        if (!in_array(post('category'), $categoriesSlugs)) {
            return response()->json(
                ['error' => Lang::get('genuineq.esense::lang.components.lessonsActions.message.invalid_category') . implode(", ", $categoriesSlugs),],
                Response::HTTP_FORBIDDEN
            );
        }

        /** Create a new Lesson. */
        $lesson = Lesson::create([
            'day' => post('date'),
            'start_hour' => post('start_hour'),
            'end_hour' => post('end_hour'),
            'duration' => post('duration') ?? (strtotime(post('end_hour')) - strtotime(post('start_hour'))),

            // 'start_hour' => post('startHour'),
            // 'end_hour' => post('endHour'),
            // 'duration' => post('duration') ?? (strtotime(post('endHour')) - strtotime(post('startHour'))),

            'title' => ((post('title')) ? (post('title')) : ('')),
            'description' => ((post('description')) ? (post('description')) : ('')),
            'feedback' => ((post('feedback')) ? (post('feedback')) : ('')),
            'connection_id' => $student->connections->where('specialist_id', $auth->user()->profile->id)->first()->id,
            'category' => post('category')
        ]);

        return response()->json(
            [$lesson, 'message' => Lang::get('genuineq.esense::lang.components.lessonsActions.message.save_successful')],
            Response::HTTP_CREATED
        );
    }
}
