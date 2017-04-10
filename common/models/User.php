<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $Id
 * @property string  $Email
 * @property string  $AuthKey
 * @property string  $Password
 * @property integer $Role
 * @property integer $Status
 * @property string  $Password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * Статус пользователя: Неактивен.
     * @var integer
     */
    const STATUS_INACTIVE    = 0;
    /**
     * Статус пользователя: Активен.
     * @var integer
     */
    const STATUS_ACTIVE      = 1;

    /**
     * Роль пользователя: Гость.
     * @var integer
     */
    const ROLE_GUEST         = 0;
    /**
     * Роль пользователя: Менеджер.
     * @var integer
     */
    const ROLE_MANAGER       = 5;
    /**
     * Роль пользователя: Администратор.
     * @var integer
     */
    const ROLE_ADMINISTRATOR = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%User}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['Role', 'in', 'range' => [self::ROLE_MANAGER, self::ROLE_ADMINISTRATOR]],
            ['Status', 'default', 'value' => self::STATUS_ACTIVE],
            ['Status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * Получение списка статусов пользователя.
     * @return array
     */
    public static function getStatusList()
    {
        return [
            static::STATUS_INACTIVE => 'Неактивен',
            static::STATUS_ACTIVE   => 'Активен',
        ];
    }

    /**
     * Получение списка ролей пользователя.
     * @return array
     */
    public static function getRoleList()
    {
        return [
            static::ROLE_MANAGER       => 'Менеджер',
            static::ROLE_ADMINISTRATOR => 'Администратор',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['Id' => $id, 'Status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public static function search()
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'Id' => SORT_DESC,
                ],
            ],
        ]);

        return $dataProvider;
    }

    /**
     * Finds user by email
     *
     * @param  string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['Email' => $email, 'Status' => self::STATUS_ACTIVE]);
    }

    /**
     * Получение роли пользователя по его идентификатору.
     * @param  integer $id Идентификатор пользователя.
     * @return integer|false
     */
    static public function getRoleById($id)
    {
        return (new Query)
            ->select('Role')
            ->from(self::tableName())
            ->where(['Id' => $id])
            ->scalar();
    }

    /**
     * Получение роли пользователя.
     * @return integer|null
     */
    public function getRole()
    {
        $identity = $this->getIdentity();
        return $identity !== null ? $identity->Role : null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->AuthKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->Password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->Password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->AuthKey = Yii::$app->security->generateRandomString();
    }


}
