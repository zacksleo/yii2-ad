<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/12
 * Time: 22:22
 */

namespace zacksleo\yii2\ad\tests;

use yii;
use zacksleo\yii2\ad\models\AdPosition;

class AdPositionControllerTest extends TestCase
{
    /**
     * @var \zacksleo\yii2\ad\models\AdPosition;
     */
    public $position;

    public function setUp()
    {
        parent::setUp();
        $this->position = $this->create();
    }

    public function testIndex()
    {
        $position = Yii::$app->runAction('ad/adposition/index');
        $this->assertTrue(count($position) == 1);
    }

    public function testView()
    {
        $position = Yii::$app->runAction('ad/adposition/view', ['id' => $this->position->id]);
        $this->assertTrue($position == $this->position);
    }

    public function testUpdate()
    {
        $data = [
            'AdPosition' => [
                'id' => $this->position->id,
                'name' => "position two",
                'slug' => "position one slug",
                'size' => "200*400",
                'status' => AdPosition::STATUS_ACTIVE
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $res = Yii::$app->runAction('ad/adposition/update', ['id' => $this->position->id]);
        $this->assertTrue($res);
    }

    public function testDelete()
    {
        $res = Yii::$app->runAction('ad/adposition/delete', ['id' => $this->position->id]);
        $this->assertTrue($res > 0);
    }

    private function create()
    {
        $data = [
            'AdPosition' => [
                'name' => "position one",
                'slug' => "position one slug",
                'size' => "200*400",
                'status' => AdPosition::STATUS_ACTIVE
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $position = Yii::$app->runAction('ad/adposition/create');
        $this->assertTrue($position->id > 0);
        return $position;
    }
}
