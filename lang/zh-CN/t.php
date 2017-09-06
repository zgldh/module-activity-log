<?php

return [
    'title'  => "操作记录管理",
    'models' => [
        'activity_log' => [
            'title'  => '操作记录',
            'fields' => [
                'log_name'     => '日志名',
                'subject_id'   => '对象ID',
                'subject_type' => '对象类型',
                'description'  => '描述',
                'causer_id'    => '发起者ID',
                'causer_type'  => '发起者类型',
            ]
        ],
    ],
    'terms'  => [
    ]
];
