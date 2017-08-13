<?php
use zacksleo\yii2\ad\models\AdPosition;
use zacksleo\yii2\ad\tests\TestCase;
use yii\web\UploadedFile;

/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/12
 * Time: 22:18
 */
class AdControllerTest extends TestCase
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

    public function testCreate()
    {
        $data = [
            'Ad' => [
                'img' => UploadedFile::getInstanceByName('image'),
                'position_id' => $this->position->id,
                'name' => "page-banner",
                'text' => 'text',
                'url' => 'link-url',
                'status' => 1,
                'order' => 1,
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $response = Yii::$app->runAction('ad/ad/create');
        $this->delete($response->id);
    }

    public function testUpdate()
    {
        $data = [
            'Ad' => [
                'img' => UploadedFile::getInstanceByName('image'),
                'position_id' => $this->position->id,
                'name' => "page-banner",
                'text' => 'text',
                'url' => 'link-url',
                'status' => 1,
                'order' => 1,
            ]
        ];
        Yii::$app->request->bodyParams = $data;
        $response = Yii::$app->runAction('ad/ad/create');
        $this->assertTrue($response->id > 0);
        $data['Ad']['id'] = $response->id;
        $data['Ad']['name'] = "page-banner updated";
        Yii::$app->request->bodyParams = $data;
        $response = Yii::$app->runAction('ad/ad/update', ['id' => $response->id]);
        $this->assertTrue($response->id > 0);
        $this->view($response->id);
        $this->delete($response->id);
    }

    private function delete($id)
    {
        $response = Yii::$app->runAction('ad/ad/delete', ['id' => $id]);
        $this->assertTrue($response > 0);
    }

    private function view($id)
    {
        $response = Yii::$app->runAction('ad/ad/view', ['id' => $id]);
        $this->assertTrue($response->id == $id);
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
