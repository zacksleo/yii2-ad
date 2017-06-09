<?php

use yii\helpers\Html;
use yii\grid\GridView;
use zacksleo\yii2\ad\Module;
use zacksleo\yii2\ad\models\Ad;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('ad', 'Ads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-position-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('ad', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'position_id',
                'value' => 'adPosition.name'
            ],
            'type',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Ad::getStatusList()[$model->status];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
