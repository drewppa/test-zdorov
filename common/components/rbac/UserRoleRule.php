<?php
namespace common\components\rbac;

use Yii;
use yii\rbac\Rule;
use common\models\User;

class UserRoleRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'userRole';

    private $_assignments = [];

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $role = $this->userRole($user);
        if ($role) {
            switch ($item->name) {
                case User::ROLE_ADMINISTRATOR:
                    return $role == User::ROLE_ADMINISTRATOR;

                case User::ROLE_MANAGER:
                    return $role == User::ROLE_ADMINISTRATOR || $role == User::ROLE_MANAGER;

                case User::ROLE_GUEST:
                    return in_array($role, [User::ROLE_ADMINISTRATOR, User::ROLE_MANAGER, User::ROLE_GUEST]);
            }
        }
        return false;
    }

    /**
     * @param integer|null $userId ID of user.
     * @return string|false
     */
    protected function userRole($userId)
    {
        $user = Yii::$app->user;
        if ($userId === null) {
            if ($user->isGuest) {
                return User::ROLE_GUEST;
            }
            return false;
        }
        if (!isset($this->_assignments[$userId])) {
            $role = false;
            if (!$user->isGuest && $user->Id == $userId) {
                $role = $user->identity->Role;
            } elseif ($user->isGuest || $user->Id != $userId) {
                $role = User::getRoleById($userId);
            }
            $this->_assignments[$userId] = $role;
        }
        return $this->_assignments[$userId];
    }
}