<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use zacksleo\yii2\ad\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\ad\models\AdPosition */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('ad', 'Ad Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-position-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Module::t('ad', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('ad', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            'size',
            [
                'attribute' => 'status',
                'value' => $model::getStatusList()[$model->status]
            ],
        ],
    ]) ?>

</div>
