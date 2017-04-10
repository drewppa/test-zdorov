<?php
namespace common\models;

use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

/**
 * Order model
 *
 * @property integer $Id
 * @property string  $ClientName
 * @property string  $Name
 * @property integer $GoodsId
 * @property string  $Phone
 * @property integer $CreatedAt
 * @property string  $Status
 * @property string  $Comment
 * @property float   $Price
 */
class Order extends ActiveRecord
{
    const STATUS_ACCEPTED = 1;
    const STATUS_REFUSED  = 2;
    const STATUS_MARRIAGE = 3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ClientName', 'GoodsId', 'CreatedAt'], 'required'],
            [['Name', 'Comment', 'Phone'], 'string'],
            [['Price'], 'double'],
            [['Status', 'GoodsId', 'CreatedAt'], 'integer'],
        ];
    }

    /**
     * Получение списка статусов заявки.
     * @return array
     */
    public static function getStatusList()
    {
        return [
            static::STATUS_ACCEPTED => 'Принята',
            static::STATUS_REFUSED  => 'Отказана',
            static::STATUS_MARRIAGE => 'Брак',
        ];
    }

    public function getGoods()
    {
        return $this->hasOne(\common\models\Goods::class, ['Id' => 'GoodsId']);
    }

    public static function search()
    {
        $query = static::find()
            ->joinWith([
                'goods' => function ($query) {
                    $query->alias('Goods');
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
