<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

use yii\grid\GridView;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Журнал</h1>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Пользователь',
                'value' => function($data) {
                    return $data->user->Email;
                },
            ],
            'CreatedAt:datetime:Дата',
            [
                'attribute' => 'Previous',
                'label'     => 'До',
                'content'   => function($data) {
                    $text = '';
                    $temp = unserialize($data->Previous);
                    if (is_array($temp)) {
                        foreach ($temp as $field => $value) {
                            $text .= $field . ': ' . $value . '<br/>';
                        }
                    }
                    return $text;
                },
            ],
            [
                'attribute' => 'Current',
                'label'     => 'После',
                'content'   => function($data) {
                    $text = '';
                    $temp = unserialize($data->Current);
                    if (is_array($temp)) {
                        foreach ($temp as $field => $value) {
                            $text .= $field . ': ' . $value . '<br/>';
                        }
                    }
                    return $text;
                },
            ],
        ]
    ]); ?>

</div>
