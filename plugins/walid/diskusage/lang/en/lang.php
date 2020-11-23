<?php

return [
    'plugin' => [
        'name' => 'Disk Usage',
        'description' => 'Manage disk name and path',
    ],
    'reportwidgets' => [
        'label' => 'Disk Usage',
        'find_disk_error_1' => 'Unable to find disk, please <a href="',
        'find_disk_error_2' => '"> <u><strong>add some disks</strong></u></a> then select a disk from widget options',
    ],
    'backend' => [
        'addnew' => 'Add new disk',
        'disks' => 'Disks',
        'form' => [
            'name' => [
                'label' => 'Disk name',
                'comment' => 'Displayed as widget title',
            ],
            'path' => [
                'label' => 'Disk path',
                'comment' => 'Full path to mounted disk',
            ],
            'description' => [
                'label' => 'Description',
                'comment' => 'What is this hard disk is used for?',
            ],
        ],

    ],
];
