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
            ['img', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['insert', 'update']],
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
                'attribute' => 'img',
                'scenarios' => ['insert', 'update'],
                'placeholder' => '@app/modules/user/assets/images/userpic.jpg',
                'galleryId' => 1
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
        $fields = parent::fields();
        unset($fields['id'], $fields['position_id'], $fields['name'], $fields['text'], $fields['type'], $fields['status'], $fields['order']);
        $fields['img'] = function () {
            $path = str_replace('api/uploads/', '', $this->getUploadUrl('img'));
            if (isset($_ENV['API_HOST'])) {
                $url = $_ENV['API_HOST'] . 'files/' . $path;
            } else {
                $url = Url::to(['file/view', 'path' => $path], true);
            }
            return $url;
        };
        return $fields;
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
