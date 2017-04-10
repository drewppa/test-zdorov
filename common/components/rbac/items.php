<?php
return [
    'userUpdate' => [
        'type' => 2,
        'description' => 'Update user`s data',
    ],
    'userDelete' => [
        'type' => 2,
        'description' => 'Delete a user',
    ],
    10 => [
        'type' => 1,
        'description' => 'Администратор',
        'ruleName' => 'userRole',
        'children' => [
            'userUpdate',
            'userDelete',
        ],
    ],
    5 => [
        'type' => 1,
        'description' => 'Менеджер',
        'ruleName' => 'userRole',
    ],
];
