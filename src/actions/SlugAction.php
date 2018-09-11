<?php

namespace zacksleo\yii2\ad\actions;

use yii\base\Action;
use zacksleo\yii2\ad\models\Ad;
use zacksleo\yii2\ad\models\AdPosition;

class SlugAction extends Action
{
    public $slug;

    public function run()
    {
        if (($position = AdPosition::findOne(['slug' => $this->slug, 'status' => AdPosition::STATUS_ACTIVE])) == null) {
            return [];
        }
        return Ad::find()->orderBy('order DESC')
            ->where(
                [
                    'position_id' => $position->id,
                    'status' => Ad::STATUS_ACTIVE
                ]
            )
            ->all();
    }
}
