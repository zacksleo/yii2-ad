<?php

use yii\helpers\Html;
use yii\grid\GridView;
use zacksleo\yii2\ad\Module;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('ad', 'Ad Positions');
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
            'position_id',
            'type',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
