<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/10
 * Time: 下午12:29
 */

namespace zacksleo\yii2\ad\tests;

use GuzzleHttp\Client;
use yii;
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use mongosoft\file\UploadBehavior;
use yii\base\Object;
use yii\helpers\FormatConverter;
use yii\web\UploadedFile;
use zacksleo\yii2\ad\models\Ad;
use zacksleo\yii2\ad\models\AdPosition;

class AdModelTest extends TestCase
{
    /**
     * @var \zacksleo\yii2\ad\models\Ad;
     */
    public $model;

    public $positionId;

    public function setUp()
    {
        parent::setUp();
        $this->model = new Ad();
        $position = new AdPosition();
        $position->name = "banner";
        $position->slug = "slug";
        $position->size = "200*400";
        $position->status = AdPosition::STATUS_ACTIVE;
        $position->save();
        $this->positionId = $position->id;
    }

    public function testRules()
    {
        $this->model->name = "i am name";
        $this->model->status = Ad::STATUS_ACTIVE;
        $this->assertFalse($this->model->validate());
        $this->model->position_id = $this->positionId;
        $this->assertTrue($this->model->validate());
        $this->delPosition();
    }

    public function testAdd()
    {
        $this->model->position_id = $this->positionId;
        $this->model->name = "page-banner";
        $this->model->img =  UploadedFile::getInstanceByName('image');
        $this->model->text = "text";
        $this->model->type = 1;
        $this->model->url = "link-url";
        $this->model->status = 1;
        $this->model->order = 1;
        $this->model->scenario = "insert";
        $this->assertTrue($this->model->save());
        $this->assertTrue($this->model->delete() > 0);
        $this->delPosition();
    }

    public function testUpdate()
    {
        $this->model->position_id = $this->positionId;
        $this->model->name = "page-banner";
        $this->model->img = 'img-path';
        $this->model->text = "text";
        $this->model->type = 1;
        $this->model->url = "link-url";
        $this->model->status = 1;
        $this->model->order = 1;
        $this->model->scenario = "insert";
        $this->assertTrue($this->model->save());
        $find = Ad::findOne(['id' => $this->model->id]);
        $find->text = "mg-path";
        $find->img = "text";
        $find->scenario = "update";
        $this->assertTrue($find->save());
        $this->assertTrue($this->model->delete() > 0);
        $this->delPosition();
    }

    public function testDelete()
    {
        $this->assertTrue(AdPosition::findOne(['id' => $this->positionId])->delete() > 0);
    }

    public function testGetStatusList()
    {
        $status = Ad::getStatusList();
        $this->assertTrue(count($status) == 2);
        $this->delPosition();
    }

    private function delPosition()
    {
        $find = AdPosition::findOne(['id' => $this->positionId]);
        $this->assertTrue($find->delete() > 0);
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
        ];
    }
}
