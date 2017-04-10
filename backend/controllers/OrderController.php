<?php
namespace backend\controllers;

use Yii;
use backend\components\ControllerAbstract;

/**
 * Order controller
 */
class OrderController extends ControllerAbstract
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => \common\models\Order::search(),
            'statusList'   => \common\models\Order::getStatusList(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new \backend\models\OrderForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save($id)) {
                Yii::$app->session->setFlash('success', 'Заявка успешно сохранена.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении заявки.');
            }
            return $this->redirect(['index']);
        } else {
            $model->setAttributes(\common\models\Order::findOne($id)->attributes, false);
            return $this->render('update', [
                'model'     => $model,
                'goodsList' => \common\models\Goods::getSimpleList(),
            ]);
        }
    }


}
