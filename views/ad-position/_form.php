<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zacksleo\yii2\ad\Module;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\ad\models\AdPosition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-position-form">

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList($model::getStatusList()) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Module::t('ad', 'Create') : Module::t('ad', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
