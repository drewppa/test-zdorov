<?php

/** @var $this yii\web\View */
/** @var $dataProvider yii\data\ActiveDataProvider */

use kartik\grid\GridView;
use kartik\export\ExportMenu;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Заявки</h1>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
        <?php
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns'      => [
                'Name:text:Название',
                [
                    'label' => 'Товар',
                    'value' => function($data) {
                        return $data->goods->Name;
                    },
                ],
                'Price:raw:Цена',
                'Phone:text:Телефон',
            ],
        ]);
        ?>
        </div>
    </div>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],
            'ClientName:text:Имя клиента',
            'Name:text:Название',
            [
                'label' => 'Товар',
                'value' => function($data) {
                    return $data->goods->Name;
                },
            ],
            'Phone:text:Телефон',
            'CreatedAt:datetime:Дата',
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
            'Comment:text:Комментарий',
            'Price:raw:Цена',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update}'],
        ],
        'exportConfig'=> [
            GridView::CSV => [
                'label'           => 'CSV',
                'icon'            => '',
                'iconOptions'     => '',
                'showHeader'      => false,
                'showPageSummary' => false,
                'showFooter'      => false,
                'showCaption'     => false,
                'filename'        => 'yii',
                'alertMsg'        => 'created',
                'options'         => ['title' => 'Semicolon -  Separated Values'],
                'mime'            => 'application/csv',
                'config'          => [
                    'colDelimiter' => ";",
                    'rowDelimiter' => "\r\n",
                ],
            ],
        ],
    ]); ?>

</div>
