<?php

/** @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Редактирование данных пользователя</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                <?php $form = ActiveForm::begin(['id' => 'user-form']); ?>

                    <?= $form->field($model, 'Email')
                             ->label('Email') ?>

                    <?= $form->field($model, 'Password')
                             ->label('Пароль')
                             ->passwordInput(['value' => '']) ?>

                    <?= $form->field($model, 'Role')
                             ->label('Роль')
                             ->dropdownList($roleList) ?>

                    <?= $form->field($model, 'Status')
                             ->label('Статус')
                             ->dropdownList($statusList) ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Сохранить', [
                            'class' => 'btn btn-success btn-lg',
                            'name'  => 'user-button',
                        ]) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>

</div>
