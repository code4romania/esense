<?php return [
    'plugin' => [
        'name' => 'Timetable',
        'description' => 'Timetable for sessions scheduling',
    ],
    'records' => [
        'title' => 'Records',
        'manage_records' => 'Manage records',
        'name' => 'Records',
    ],
    'record' => [
        'day' => 'Day',
        'start_hour' => 'Start hour',
        'end_hour' => 'End hour',
        'title' => 'Title',
        'description' => 'Description',
        'feedback' => 'Feedback',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'deleted_at' => 'Deleted at',
        'create' => 'Add record',
        'update' => 'Edit record',
        'delete' => 'Delete record',
    ],
    'flash' => [
        'create' => 'Record created successfully.',
        'update' => 'Record updated successfully.',
        'delete' => 'Record deleted successfully.',
    ],
    'component' => [
        'timetable' => [
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
                'record_created_successfully' => 'Record created successfully.',
                'record_updated_successfully' => 'Record updated successfully.',
                'record_deleted_successfully' => 'Record deleted successfully.',
                'no_records' => 'No records found.'
            ],
        ],
    ],
    'backend' => [
        'timetable' => [
            'fields' => [
                'records' => 'Records',
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
                'create' => 'Add record',
                'update' => 'Edit record',
                'delete' => 'Delete record',
            ],
            'list' => [
                'delete_selected_confirm' => 'Are you sure you want to delete selected items?'
            ],
        ],
    ],
];
