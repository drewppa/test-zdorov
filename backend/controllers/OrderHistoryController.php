<?php
namespace backend\controllers;

use backend\components\ControllerAbstract;

/**
 * OrderHistory controller.
 */
class OrderHistoryController extends ControllerAbstract
{

    /**
     * Список изменений данных заявок.
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => \backend\models\OrderHistory::search(),
        ]);
    }


}
