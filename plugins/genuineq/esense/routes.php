<?php

Route::group(
    [
        'prefix' => 'api/lessons',
        'namespace' => 'Genuineq\Esense\Http\Controllers',
        'middleware' => ['web'],
    ],
    function () {
        Route::get('students', 'StudentsController')->name('api.lessons.students');

        Route::post('lesson', 'LessonController')->name('api.lessons.lesson');
    }
);
