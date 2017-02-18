<?php

namespace zacksleo\yii2\ad\models;

use Yii;
use zacksleo\yii2\ad\Module;

/**
 * This is the model class for table "{{%ad}}".
 *
 * @property integer $id
 * @property integer $position_id
 * @property string $name
 * @property string $image
 * @property string $text
 * @property integer $type
 * @property string $url
 * @property integer $status
 * @property integer $order
 */
class Ad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_id', 'name'], 'required'],
            [['position_id', 'type', 'status', 'order'], 'integer'],
            [['text'], 'string'],
            [['name', 'image', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ad', 'ID'),
            'position_id' => Module::t('ad', 'Position ID'),
            'name' => Module::t('ad', 'Name'),
            'image' => Module::t('ad', 'Image'),
            'text' => Module::t('ad', 'Text'),
            'type' => Module::t('ad', 'Type'),
            'url' => Module::t('ad', 'Url'),
            'status' => Module::t('ad', 'Status'),
            'order' => Module::t('ad', 'Order'),
        ];
    }
}
