<?php

/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/10
 * Time: 下午12:29
 */

namespace zacksleo\yii2\ad\tests;

use yii;
use kartik\form\ActiveForm;
use yii\base\Object;
use yii\helpers\FormatConverter;
use yii\web\UploadedFile;
use zacksleo\yii2\ad\models\Ad;
use zacksleo\yii2\ad\models\AdPosition;

class AdTest extends TestCase
{
    public function testSave()
    {
        $model = new Ad();
        $model->detachBehavior('fileBehavior');
        $model->name = "i am name";
        $model->status = Ad::STATUS_ACTIVE;
        $this->assertFalse($model->validate());

        $model->position_id = "1a";
        $this->assertFalse($model->validate());

        $model->position_id = 2;
        $model->type = "1a";
        $this->assertFalse($model->validate());

        $model->type = 1;
        $model->position_id = 2;
        $model->order = 1;
        $this->assertTrue($model->save());
    }

    public function testUpdate()
    {
        $model = new Ad();
        $model->detachBehavior('fileBehavior');
        $model->position_id = 2;
        $model->name = "page-banner";
        //$model->img = UploadedFile::getInstanceByName('image');
        $model->text = "text";
        $model->type = 1;
        $model->url = "link-url";
        $model->status = 1;
        $model->order = 1;
        $model->available_from = time();
        $model->to = time();
        $this->assertTrue($model->save());
        $find = Ad::findOne(['id' => $model->id]);
        $find->detachBehavior('fileBehavior');
        $find->text = "mg-path";
        $find->img = "text";
        $res = $find->save();
        $this->assertTrue($res);
        $this->assertTrue($model->delete() > 0);
    }

    public function testGetStatusList()
    {
        $status = Ad::getStatusList();
        $this->assertTrue(count($status) == 2);
    }

    /**
     * @inheritdoc
     */
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $_FILES = [
            'image' => [
                'name' => 'userpic.jpg',
                'type' => 'image/jpeg',
                'size' => 74463,
                'tmp_name' => __DIR__ . '/img-path/php79AD.tmp',
                'error' => 0,
            ],
            'txt' => [
                'name' => 'test.txt',
                'type' => 'file/txt',
                'size' => 74463,
                'tmp_name' => __DIR__ . '/img-path/test.txt',
                'error' => 0,
            ],
        ];
    }
}
