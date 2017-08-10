<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/10
 * Time: 下午12:29
 */

namespace zacksleo\yii2\ad\tests;


use zacksleo\yii2\ad\models\AdPosition;

class AdPositionTest extends TestCase
{
    /**
     * @var \zacksleo\yii2\ad\models\AdPosition
     */
    public $model;

    public function setUp()
    {
        parent::setUp();
        $this->model = new AdPosition();
    }

    public function testRules()
    {
        $this->model->name = "i am the first position";
        $this->model->slug = "i am the first slug";
        $this->model->size = "i am the first size";
        $this->model->status = '1';
        $this->assertTrue($this->model->validate());
        $this->model->status = '1a';
        $this->assertFalse($this->model->validate());
    }

    public function testAdd()
    {
        $this->model->name = "i am the first position";
        $this->model->slug = "i am the first slug";
        $this->model->size = "200*400";
        $this->model->status = AdPosition::STATUS_ACTIVE;
        $this->assertTrue($this->model->save());
        $this->assertTrue($this->model->delete() > 0);
    }

    public function testUpdate()
    {
        $this->model->name = "banner";
        $this->model->slug = "slug";
        $this->model->size = "200*400";
        $this->model->status = AdPosition::STATUS_ACTIVE;
        $this->assertTrue($this->model->save());
        $find = AdPosition::findOne(['id' => $this->model->id]);
        $find->status = AdPosition::STATUS_INACTIVE;
        $this->assertTrue($find->save());
        $this->assertTrue($find->delete() > 0);
    }

    public function testGetStatusList()
    {
        $res = AdPosition::getStatusList();
        $this->assertTrue($res[1] == 'Active');
        $this->assertTrue($res[0] == 'Inactive');
    }
}