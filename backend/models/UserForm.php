<?php

namespace backend\models;

use yii\base\Model;
use common\models\User;

/**
 * UserForm is the model behind the user form.
 */
class UserForm extends Model
{
    public $Email;
    public $Password;
    public $Role;
    public $Status;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Email'], 'email'],
            [['Password'], 'string'],
            [['Role', 'Status'], 'integer'],
            ['Role', 'in', 'range' => [User::ROLE_MANAGER, User::ROLE_ADMINISTRATOR]],
            ['Status', 'default', 'value' => User::STATUS_ACTIVE],
            ['Status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_INACTIVE]],
        ];
    }

    /**
     * Сохранение данных.
     * @return User|null
     */
    public function save($id)
    {
        if (!$this->validate()) {
            return null;
        }

        $user = User::findOne($id);

        $user->setAttributes($this->getAttributes());

        if ($this->Password) {
            $user->setPassword($this->Password);
            $user->generateAuthKey();
        }

        return $user->save() ? $user : null;
    }


}
