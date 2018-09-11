<?php

use yii\helpers\Html;
use yii\grid\GridView;
use zacksleo\yii2\ad\Module;
use zacksleo\yii2\ad\models\Ad;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => '广告位', 'url' => \yii\helpers\Url::to(['default/index'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-position-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('ad', 'Create'), ['create', 'slug' => $_GET['slug']], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'img',
                'value' => function ($model) {
                    return $model->getImg();
                },
                'format' => ['image', ['style' => 'max-width:100px;max-height:100px']],
            ],
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
