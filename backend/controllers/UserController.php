<?php
namespace backend\controllers;

use Yii;
use backend\components\ControllerAbstract;
use common\models\User;

/**
 * User controller
 */
class UserController extends ControllerAbstract
{

    /**
     * Access rules of AccessControl.
     * @see AccessControl.
     * @return array
     */
    protected function accessRules()
    {
        return [
            [
                'actions' => ['index'],
                'allow' => true,
                'roles' => ['@'],
            ],
            [
                'actions' => ['update', 'delete'],
                'allow' => true,
                'roles' => [User::ROLE_ADMINISTRATOR],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => User::search(),
            'statusList'   => User::getStatusList(),
            'roleList'     => User::getRoleList(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = new \backend\models\UserForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save($id)) {
                Yii::$app->session->setFlash('success', 'Данные пользователя успешно сохранены.');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка при сохранении данных пользователя.');
            }
            return $this->redirect(['index']);
        } else {
            $model->setAttributes(User::findOne($id)->attributes, false);
            return $this->render('update', [
                'model'      => $model,
                'roleList'   => User::getRoleList(),
                'statusList' => User::getStatusList(),
            ]);
        }
    }

    public function actionDelete($id)
    {
        if (Yii::$app->user->Id != $id && User::findOne($id)->delete()) {
            Yii::$app->session->setFlash('success', 'Пользователь успешно удалён.');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при удалении пользователя.');
        }
        return $this->redirect(['index']);
    }


}
