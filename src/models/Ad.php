<?php

namespace zacksleo\yii2\ad\models;

use Yii;
use yii\helpers\Url;
use zacksleo\yii2\ad\Module;
use zacksleo\yii2\gallery\behaviors\UploadImageBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%ad}}".
 *
 * @property integer $id
 * @property integer $position_id
 * @property string $name
 * @property string $img
 * @property string $text
 * @property integer $type
 * @property string $url
 * @property integer $status
 * @property integer $order
 */
class Ad extends ActiveRecord
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
            [['name', 'url', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'fileBehavior' => [
                'class' => \nemmo\attachments\behaviors\FileBehavior::className()
            ]
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
            'img' => Module::t('ad', 'Image'),
            'text' => Module::t('ad', 'Text'),
            'type' => Module::t('ad', 'Type'),
            'url' => Module::t('ad', 'Url'),
            'status' => Module::t('ad', 'Status'),
            'order' => Module::t('ad', 'Order'),
        ];
    }

    public function fields()
    {
        return [
            'id',
            'name',
            'order',
            'url',
            'img' => function () {
                if ($this->files && $this->files[0] instanceof \nemmo\attachments\models\File) {
                    return getenv('BASE_URL') . $this->files[0]->getUrl();
                }
                return 'https://ws1.sinaimg.cn/large/a76d6e45gy1fj5d3ckxgej205x05vaa4.jpg';
            }
        ];
    }

    public function getImg()
    {
        if ($this->files && $this->files[0] instanceof \nemmo\attachments\models\File) {
            return $this->files[0]->getUrl();
        }
        return 'https://ws1.sinaimg.cn/large/a76d6e45gy1fj5d3ckxgej205x05vaa4.jpg';
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

    public function getAdPosition()
    {
        return $this->hasOne(AdPosition::className(), ['id' => 'position_id']);
    }
}
