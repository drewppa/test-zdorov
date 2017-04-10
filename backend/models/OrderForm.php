<?php

namespace backend\models;

use yii\base\Model;
use common\models\Order;
use yii;

/**
 * OrderForm is the model behind the order form.
 */
class OrderForm extends Model
{
    public $ClientName;
    public $Name;
    public $GoodsId;
    public $Phone;
    public $CreatedAt;
    public $Status;
    public $Comment;
    public $Price;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ClientName', 'Phone', 'GoodsId'], 'required'],
            [['Name', 'Comment', 'Phone'], 'string'],
            [['Price'], 'double'],
            [['Status', 'GoodsId'], 'integer'],
            [['CreatedAt'], 'filter', 'filter' => function ($value) {
                if (!preg_match("/^[\d\+]+$/", $value) && $value > 0) {
                    return strtotime($value);
                } else{
                    return $value;
                }
            }]
        ];
    }

    /**
     *
     * @return Order|null
     */
    public function save($id)
    {
        if (!$this->validate()) {
            return null;
        }

        $order = Order::findOne($id);

        $previous = [];
        $current  = [];
        foreach ($order->getAttributes() as $attr => $value) {
            if (isset($this->$attr) && $value != $this->$attr) {
                $previous[$attr] = $order->$attr;
                $current[$attr]  = $this->$attr;
            }
        }

        $order->setAttributes($this->getAttributes());

        if ($previous || $current) {
            $orderHistory = new \backend\models\OrderHistory();
            $orderHistory->UserId    = Yii::$app->user->identity->Id;
            $orderHistory->OrderId   = $id;
            $orderHistory->Previous  = serialize($previous);
            $orderHistory->Current   = serialize($current);
            $orderHistory->CreatedAt = time();
            $orderHistory->save();
        }

        return $order->save() ? $order : null;
    }


}
