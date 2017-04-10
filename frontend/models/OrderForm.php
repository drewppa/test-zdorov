<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Order;

/**
 * OrderForm is the model behind the order form.
 */
class OrderForm extends Model
{

    public $name;
    public $phone;
    public $comment;
    public $goodsId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'goodsId'], 'required'],
            [['comment'], 'string'],
        ];
    }

    /**
     *
     * @return Order|null
     */
    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $order = new Order();
        $order->ClientName = $this->name;
        $order->GoodsId    = $this->goodsId;
        $order->Phone      = $this->phone;
        $order->Comment    = $this->comment;
        $order->CreatedAt  = time();

        return $order->save() ? $order : null;
    }


}
