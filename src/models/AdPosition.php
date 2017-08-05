<?php

namespace zacksleo\yii2\ad\models;

use Yii;
use zacksleo\yii2\ad\Module;

/**
 * This is the model class for table "{{%ad_position}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $size
 * @property integer $status
 */
class AdPosition extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ad_position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            ['slug', 'unique'],
            [['status'], 'integer'],
            [['name', 'slug', 'size'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ad', 'ID'),
            'name' => Module::t('ad', 'Name'),
            'slug' => Module::t('ad', 'Slug'),
            'size' => Module::t('ad', 'Size'),
            'status' => Module::t('ad', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAds()
    {
        return $this->hasMany(Ad::className(), ['position_id' => 'id']);
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
