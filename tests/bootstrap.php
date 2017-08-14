<?php
/**
 * Created by PhpStorm.
 * User: zjw
 * Date: 2017/8/7
 * Time: 下午3:52
 */
// ensure we get report on all possible php errors
error_reporting(-1);
define('YII_ENABLE_ERROR_HANDLER', false);
define('YII_DEBUG', true);

require_once(__DIR__ . '/../vendor/autoload.php');
require_once(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@tests', __DIR__);

Yii::setAlias('@migrate', dirname(__DIR__) . '/src/migrations');

Yii::setAlias('@zacksleo\yii2\ad\messages', dirname(__DIR__) . '/src/messages');

Yii::setAlias("@frontend", __DIR__ . '/img-path/front');

Yii::setAlias("@web", __DIR__ . '/img-path/web');
