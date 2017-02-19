<?php

namespace zacksleo\yii2\ad\models;

use Yii;
use zacksleo\yii2\ad\Module;
use zacksleo\yii2\gallery\behaviors\UploadImageBehavior;

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

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

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
            ['image', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['insert', 'update']],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => UploadImageBehavior::className(),
                'attribute' => 'image',
                'scenarios' => ['insert', 'update'],
                'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                'galleryId' => 4,
            ],
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

    /**
     * 状态列表
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Module::t('ad', 'Active'),
            self::STATUS_INACTIVE => Module::t('ad', 'Inactive'),
        ];
    }
}
