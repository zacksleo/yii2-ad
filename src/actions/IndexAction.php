<?php

namespace zacksleo\yii2\ad\actions;

use yii\base\Action;
use zacksleo\yii2\ad\models\Ad;

class IndexAction extends Action
{
    public function run()
    {
        return Ad::find()->orderBy('order')->all();
    }
}
