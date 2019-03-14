<?php

namespace zacksleo\yii2\ad\assets;

use yii\web\AssetBundle;

class DatetimeAsset extends AssetBundle
{
    public $sourcePath = '@npm/bootstrap-datetime-picker';

    public $css = [
        "css/bootstrap-datetimepicker.min.css"
    ];
    public $js = [
        "js/bootstrap-datetimepicker.js",
        'js/locales/bootstrap-datetimepicker.zh-CN.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
