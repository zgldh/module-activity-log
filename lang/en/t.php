<?php

return [
    'title'  => "Activity Log",
    'models' => [
        'activity_log' => [
            'title'  => 'Activity Log',
            'fields' => [
                'log_name'     => 'Log Name',
                'subject_id'   => 'Subject ID',
                'subject_type' => 'Subject Type',
                'description'  => 'Description',
                'causer_id'    => 'Causer ID',
                'causer_type'  => 'Causer Type',
            ]
        ],
    ],
    'terms'  => [
    ]
];
