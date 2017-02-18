<?php

use yii\helpers\Html;
use zacksleo\yii2\ad\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\ad\models\AdPosition */

$this->title = Module::t('ad', 'Create');
$this->params['breadcrumbs'][] = ['label' => Module::t('ad', 'Ad Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-position-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
