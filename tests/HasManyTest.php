<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/10
 * Time: 下午3:41
 */

namespace zacksleo\yii2\ad\tests;


use zacksleo\yii2\ad\models\Ad;
use zacksleo\yii2\ad\models\AdPosition;

class HasManyTest extends TestCase
{
    /**
     * @var \zacksleo\yii2\ad\models\Ad;
     */
    public $model1;

    /**
     * @var \zacksleo\yii2\ad\models\Ad;
     */
    public $model2;

    /**
     * @var \zacksleo\yii2\ad\models\AdPosition;
     */
    public $positionModel;

    public function setUp()
    {
        parent::setUp();
        $this->positionModel = new AdPosition();
        $this->createData();
    }

    public function testHasMany()
    {
        $list = $this->positionModel->getAds();
        $this->assertTrue($list->count() == 2);
        foreach ($list->all() as $key => $v) {
            $this->assertTrue($v->position_id == $this->positionModel->id);
        }
        $this->model2->delete();
        $this->model1->delete();
        $this->positionModel->delete();
    }

    public function testHasOne()
    {
        $list1 = $this->model1->getAdPosition();
        $list2 = $this->model2->getAdPosition();
        $this->assertTrue($list1->count() == 1);
        $this->assertTrue($list2->count() == 1);
        $this->assertTrue($list1->one()['name'] == $this->positionModel->name);
        $this->model2->delete();
        $this->model1->delete();
        $this->positionModel->delete();
    }

    private function createData()
    {
        $this->positionModel->name = "position one";
        $this->positionModel->slug = "slug one";
        $this->positionModel->size = "200*400";
        $this->positionModel->status = AdPosition::STATUS_ACTIVE;
        $this->assertTrue($this->positionModel->save());

        $this->model1 = new Ad();
        $this->model1->position_id = $this->positionModel->id;
        $this->model1->name = "ad one";
        $this->model1->img = "img.jpg";
        $this->model1->text = "position one";
        $this->model1->type = 1;
        $this->model1->url = "https://www.baidu.com";
        $this->model1->status = Ad::STATUS_ACTIVE;
        $this->assertTrue($this->model1->save());

        $this->model2 = new Ad();
        $this->model2->position_id = $this->positionModel->id;
        $this->model2->name = "ad two";
        $this->model2->img = "img.jpg";
        $this->model2->text = "position one";
        $this->model2->type = 1;
        $this->model2->url = "https://www.google.com";
        $this->model2->status = Ad::STATUS_ACTIVE;
        $this->assertTrue($this->model2->save());
    }
}