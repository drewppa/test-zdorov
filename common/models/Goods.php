<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * Goods model
 *
 * @property integer $Id
 * @property string  $Name
 */
class Goods extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%Goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
        ];
    }

    /**
     * @return array
     */
    public static function getSimpleList()
    {
        $result = [];
        $list = static::find()->orderBy('Name ASC')->all();
        foreach ($list as $item) {
            $result[$item->Id] = $item->Name;
        }
        return $result;
    }


}
