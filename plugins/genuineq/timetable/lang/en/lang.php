<?php return [
    'plugin' => [
        'name' => 'Timetable',
        'description' => 'Timetable for sessions scheduling',
    ],
    'lessons' => [
        'title' => 'Lessons',
        'manage_lessons' => 'Manage lessons',
        'name' => 'Lessons',
    ],
    'lesson' => [
        'day' => 'Day',
        'start_hour' => 'Start hour',
        'end_hour' => 'End hour',
        'title' => 'Title',
        'description' => 'Description',
        'feedback' => 'Feedback',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'deleted_at' => 'Deleted at',
        'create' => 'Add lesson',
        'update' => 'Edit lesson',
        'delete' => 'Delete lesson',
    ],
    'flash' => [
        'create' => 'Lesson created successfully.',
        'update' => 'Lesson updated successfully.',
        'delete' => 'Lesson deleted successfully.',
    ],
    'component' => [
        'timetable' => [
            'name' => 'Timetable',
            'description' => 'A simple controller for showing timetable',

            'validation' => [
                'day_required' => 'Date is required.',
                'day_date' => 'The format of this field must be a date.',
                'start_hour_required' => 'Start hour is required.',
                'start_hour_time' => 'Start hour should have a valid format.',
                'end_hour_required' => 'End hour is required.',
                'end_hour_time' => 'End hour should have a valid format.',
                'title_required' => 'Title is required.',
                'title_string' => 'The Title field must be a string.',
                'description_text' => '',
                'feedback_text' => '',
            ],
            'messages' => [
                'lesson_created_successfully' => 'Lesson created successfully.',
                'lesson_updated_successfully' => 'Lesson updated successfully.',
                'lesson_deleted_successfully' => 'Lesson deleted successfully.',
                'no_lessons' => 'No lessons found.'
            ],
        ],
    ],
    'backend' => [
        'timetable' => [
            'fields' => [
                'lessons' => 'Lessons',
                'day' => 'Day',
                'day_comment' => 'Select the date.',
                'start_hour' => 'Start hour',
                'start_hour_comment' => 'Select the start hour.',
                'end_hour' => 'End hour',
                'end_hour_comment' => 'Select the end hour.',
                'title' => 'Title',
                'title_comment' => 'Insert a descriptive title.',
                'description' => 'Description',
                'description_comment' => 'Add a short description.',
                'feedback' => 'Feedback',
                'feedback_comment' => 'Add a feedback.',
            ],
            'columns' => [
                'id' => 'id',
                'day' => 'Day',
                'start_hour' => 'Start hour',
                'end_hour' => 'End hour',
                'title' => 'Title',
                'description' => 'Description',
                'feedback' => 'Feedback',
                'created_at' => 'Created at',
                'updated_at' => 'Updated at',
                'deleted_at' => 'Deleted at',
            ],
            'form' => [
                'create' => 'Add lesson',
                'update' => 'Edit lesson',
                'delete' => 'Delete lesson',
            ],
            'list' => [
                'delete_selected_confirm' => 'Are you sure you want to delete selected items?'
            ],
        ],
    ],
];
