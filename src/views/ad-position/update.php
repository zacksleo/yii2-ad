<?php

use yii\helpers\Html;
use zacksleo\yii2\ad\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\ad\models\AdPosition */

$this->title = Module::t('ad', 'Update', [
    'modelClass' => 'Ad Position',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('ad', 'Ad Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('ad', 'Update');
?>
<div class="ad-position-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
