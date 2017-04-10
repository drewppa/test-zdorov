<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Пользователи</h1>
    </div>

    <?php
    $controlElementList = [];
    if (\Yii::$app->user->can('userUpdate')) {
        $controlElementList[] = '{update}';
    }
    if (\Yii::$app->user->can('userDelete')) {
        $controlElementList[] = '{delete}';
    }

    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'Email:text:Эл. почта',
        [
            'label' => 'Статус',
            'value' => function($data) use ($statusList) {
                if (isset($statusList[$data->Status])) {
                    $status = $statusList[$data->Status];
                } else {
                    $status = $data->Status;
                }
                return $status;
            }
        ],
        [
            'label' => 'Роль',
            'value' => function($data) use ($roleList) {
                if (isset($roleList[$data->Role])) {
                    $role = $roleList[$data->Role];
                } else {
                    $role = $data->Role;
                }
                return $role;
            }
        ],
    ];
    if ($controlElementList) {
        $gridColumns[] = ['class' => 'yii\grid\ActionColumn', 'template' => implode(' ', $controlElementList)];
    }
    ?>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'      => $gridColumns,
    ]); ?>

</div>
