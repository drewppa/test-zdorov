<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [],
        ],
        'formatter' => [
            'dateFormat'     => 'dd.MM.y',
            'datetimeFormat' => 'HH:mm:ss dd.MM.y'
        ],
        'authManager' => [
            'class'          => 'yii\rbac\PhpManager',
            'defaultRoles'   => array_keys(\common\models\User::getRoleList()),
            'itemFile'       => '@common/components/rbac/items.php',
            'assignmentFile' => '@common/components/rbac/assignments.php',
            'ruleFile'       => '@common/components/rbac/rules.php'
        ],
    ],
];
