<?php

/** @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\datetime\DateTimePicker;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Редактирование заявки</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                <?php $form = ActiveForm::begin(['id' => 'order-form']); ?>

                    <?= $form->field($model, 'ClientName')
                             ->label('Имя клиента') ?>

                    <?= $form->field($model, 'Name')
                             ->label('Название') ?>

                    <?= $form->field($model, 'Phone')
                             ->label('Номер телефона') ?>

                    <?= $form->field($model, 'GoodsId')
                             ->dropDownList($goodsList)
                             ->label('Товар') ?>

                    <?php $model->CreatedAt = date("d.m.Y h:i", (integer) $model->CreatedAt); ?>
                    <?= $form->field($model, 'CreatedAt')
                             ->widget(DateTimePicker::className(), [
                                 'removeButton'  => false,
                                 'type'          => DateTimePicker::TYPE_INPUT,
                                 'options'       => ['placeholder' => 'Ввод даты/времени...'],
                                 'convertFormat' => true,
                                 'value'         => date("d.m.Y h:i", (integer) $model->CreatedAt),
                                 'pluginOptions' => [
                                     'format'    => 'dd.MM.yyyy hh:i',
                                     'autoclose' => true,
                                     'weekStart' => 1,
                                     'startDate' => '01.05.2015 00:00',
                                     'todayBtn'  => true,
                                 ],
                             ])
                             ->label('Дата') ?>

                    <?= $form->field($model, 'Price')
                             ->label('Цена') ?>

                    <?= $form->field($model, 'Comment')
                             ->textarea(['rows' => 6])
                             ->label('Комментарий') ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Сохранить', [
                            'class' => 'btn btn-success btn-lg',
                            'name'  => 'order-button',
                        ]) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>

</div>
