<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\components\rbac\UserRoleRule;
use common\models\User;

class RbacController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $userUpdate = $auth->createPermission('userUpdate');
        $userUpdate->description = 'Update user`s data';
        $auth->add($userUpdate);

        $userDelete = $auth->createPermission('userDelete');
        $userDelete->description = 'Delete a user';
        $auth->add($userDelete);

        $rule = new UserRoleRule();
        $auth->add($rule);

        $admin = $auth->createRole(User::ROLE_ADMINISTRATOR);
        $admin->description = 'Администратор';
        $admin->ruleName = $rule->name;
        $auth->add($admin);

        $manager = $auth->createRole(User::ROLE_MANAGER);
        $manager->description = 'Менеджер';
        $manager->ruleName = $rule->name;
        $auth->add($manager);

        $auth->addChild($admin, $userUpdate);
        $auth->addChild($admin, $userDelete);
    }


}
