<?php

namespace backend\components;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

abstract class ControllerAbstract extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => $this->accessRules(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
        ];
    }

    /**
     * Access rules of AccessControl.
     * @see AccessControl.
     * @return array
     */
    protected function accessRules()
    {
        return [
            [
                'actions' => ['login', 'error'],
                'allow' => true,
            ],
            [
                'actions' => ['logout', 'index', 'view', 'update', 'delete'],
                'allow' => true,
                'roles' => ['@'],
            ],
        ];
    }

    /**
     * Declares the allowed HTTP verbs.
     * Please refer to VerbFilter::actions on how to declare the allowed verbs.
     * @return array
     */
    protected function verbs()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


}
