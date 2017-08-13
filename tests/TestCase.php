<?php
namespace yii\web;

/**
 * Mock for the is_uploaded_file() function for web classes.
 * @return boolean
 */
function is_uploaded_file($filename)
{
    return file_exists($filename);
}

/**
 * Mock for the move_uploaded_file() function for web classes.
 * @return boolean
 */
function move_uploaded_file($filename, $destination)
{
    return copy($filename, $destination);
}

namespace zacksleo\yii2\ad\tests;

use pheme\settings\models\Setting;
use PHPUnit_Framework_TestCase;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/7
 * Time: 下午1:49
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    public $model;

    protected function setUp()
    {
        parent::setUp();
        $this->mockWebApplication();
        $this->createTestDbData();
    }

    protected function tearDown()
    {
        $this->destroyTestDbData();
        $this->destroyApplication();
    }

    /**
     * Populates Yii::$app with a new application
     * The application will be destroyed on tearDown() automatically.
     *
     * @param array $config The application configuration, if needed
     * @param string $appClass name of the application class to create
     */
    protected function mockApplication($config = [], $appClass = '\yii\console\Application')
    {
        return new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost:3306;dbname=test',
                    'username' => 'root',
                    'password' => '',
                    'tablePrefix' => 'tb_'
                ],
                'i18n' => [
                    'translations' => [
                        '*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                        ]
                    ]
                ],
            ],
            'modules' => [
                'ad' => [
                    'class' => 'zacksleo\yii2\ad\Module',
                    'controllerNamespace' => 'zacksleo\yii2\ad\tests\controllers'
                ]
            ]
        ], $config));
    }

    protected function mockWebApplication($config = [], $appClass = '\yii\web\Application')
    {
        return new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost:3306;dbname=test',
                    'username' => 'root',
                    'password' => '',
                    'tablePrefix' => 'tb_'
                ],
                'i18n' => [
                    'translations' => [
                        '*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                        ]
                    ]
                ],
            ],
            'modules' => [
                'ad' => [
                    'class' => 'zacksleo\yii2\ad\Module',
                    'controllerNamespace' => 'zacksleo\yii2\ad\tests\controllers'
                ]
            ]

        ], $config));
    }

    /**
     * @return string vendor path
     */
    protected function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }

    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyApplication()
    {
        if (Yii::$app && Yii::$app->has('session', true)) {
            Yii::$app->session->close();
        }
        Yii::$app = null;
    }

    protected function destroyTestDbData()
    {
    }

    protected function createTestDbData()
    {
        $db = Yii::$app->getDb();
        $adSql = <<<EOF
            -- auto-generated definition
            create table tb_ad
            (
                id int auto_increment
                    primary key,
                position_id int not null,
                name varchar(255) not null,
                img varchar(255) null,
                text text null,
                type smallint(6) null,
                url varchar(255) null,
                status tinyint(1) null,
                `order` smallint(6) null
            )
EOF;

        $positionSql = <<<EOF
            -- auto-generated definition
            create table tb_ad_position
            (
                id int auto_increment
                    primary key,
                name varchar(255) not null,
                slug varchar(255) not null,
                size varchar(255) null,
                status tinyint(1) null,
                constraint slug
                    unique (slug)
            )
EOF;

        $gallerySql = <<<EOF
            -- auto-generated definition
            create table tb_gallery
            (
                id int auto_increment
                    primary key,
                name varchar(50) not null,
                status smallint(1) default '0' not null,
                created_at datetime not null,
                updated_at datetime not null
            )
            ;
            
            create index idx_gallery_id_status
                on tb_gallery (id, status)
            ;
EOF;

        $galleryFileSql = <<<EOF
            -- auto-generated definition
            create table tb_gallery_file
            (
                id int auto_increment
                    primary key,
                gallery_id int not null,
                file varchar(255) not null,
                caption varchar(255) null,
                position int(1) default '0' null
            )
            ;
            
            create index idx_gallery_galleryId
                on tb_gallery_file (gallery_id)
            ;
EOF;

        try {
            $db->createCommand($adSql)->execute();
            $db->createCommand($positionSql)->execute();
            $db->createCommand($gallerySql)->execute();
            $db->createCommand($galleryFileSql)->execute();
        } catch (Exception $e) {
            return;
        }
    }
}
