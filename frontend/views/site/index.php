<?php

/** @var $this yii\web\View */
/** @var $model \frontend\models\OrderForm */
/** @var $goodsList array */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Сделайте заказ!</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                <?php $form = ActiveForm::begin(['id' => 'order-form']); ?>

                    <?= $form->field($model, 'name')
                             ->textInput(['autofocus' => true])
                             ->label('Имя') ?>

                    <?= $form->field($model, 'phone')
                             ->label('Номер телефона') ?>

                    <?= $form->field($model, 'goodsId')
                             ->dropDownList($goodsList)
                             ->label('Товар') ?>

                    <?= $form->field($model, 'comment')
                             ->textarea(['rows' => 6])
                             ->label('Комментарий') ?>

                    <div class="form-group text-center">
                        <?= Html::submitButton('Заказать', [
                            'class' => 'btn btn-success btn-lg',
                            'name'  => 'order-button',
                        ]) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
