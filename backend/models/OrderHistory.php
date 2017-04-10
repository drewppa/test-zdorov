<?php
namespace backend\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Order History model
 *
 * @property integer $Id
 * @property integer $UserId
 * @property integer $OrderId
 * @property string  $Previous
 * @property string  $Current
 * @property integer $CreatedAt
 */
class OrderHistory extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%OrderHistory}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserId', 'OrderId', 'CreatedAt'], 'required'],
            [['Previous', 'Current'], 'string'],
            [['UserId', 'OrderId', 'CreatedAt'], 'integer'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::class, ['Id' => 'UserId']);
    }

    public static function search()
    {
        $query = static::find()
            ->joinWith([
                'user' => function ($query) {
                    $query->alias('User');
                }
            ]);

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

}
