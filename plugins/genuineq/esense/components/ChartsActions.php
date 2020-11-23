<?php namespace Genuineq\Esense\Components;

use App;
use Log;
use Lang;
use Auth;
use Flash;
use Request;
use Redirect;
use Validator;
use ValidationException;
use Cms\Classes\ComponentBase;
use Genuineq\User\Helpers\RedirectHelper;
use Genuineq\Students\Models\Student;
use Genuineq\Timetable\Models\Lesson;

/**
 * ChartsActions component
 *
 * Allows to extract new data for charts.
 */
class ChartsActions extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'genuineq.esense::lang.components.chartsActions.name',
            'description' => 'genuineq.esense::lang.components.chartsActions.description'
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
     * Function that forces the refresh of the specialist activity chart
     *  in order to display a different period on time.
     */
    public function onSpecialistActivityChartUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Send the user back. */
        $this->page['user'] = Auth::user();

        /** Set the new year. */
        $this->page['year'] = post('year');
        /** Set the years array. */
        $this->page['years'] = Auth::user()->profile->lessons_years;
        /** Set the durations. */
        $this->page['durations'] = Auth::user()->profile->getYearLessonsDurations(post('year'));
    }

    /**
     * Function that forces the refresh of the specialist school activity
     *  chart in order to display a different period on time.
     */
    public function onSpecialistSchoolActivityChartUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Send the user back. */
        $this->page['user'] = Auth::user();

        /** Set the new year. */
        $this->page['year'] = post('year');
        /** Set the years array. */
        $this->page['years'] = Auth::user()->profile->school->lessons_years;
        /** Set the durations. */
        $this->page['durations'] = Auth::user()->profile->school->getYearLessonsDurations(post('year'));
    }

    /**
     * Function that forces the refresh of the school activity chart
     *  in order to display a different period on time.
     */
    public function onSchoolActivityChartUpdate()
    {
        if (!Auth::check()) {
            return Redirect::guest($this->pageUrl(RedirectHelper::loginRequired()));
        }

        /** Send the user back. */
        $this->page['user'] = Auth::user();

        /** Set the new year. */
        $this->page['year'] = post('year');
        /** Set the years array. */
        $this->page['years'] = Auth::user()->profile->lessons_years;
        /** Set the durations. */
        $this->page['durations'] = Auth::user()->profile->getYearLessonsDurations(post('year'));
    }
}
