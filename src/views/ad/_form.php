<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use zacksleo\yii2\ad\Module;
use zacksleo\yii2\ad\models\AdPosition;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\ad\models\AdPosition */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-position-form">

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>

            <?= $form->field($model, 'position_id')->dropDownList(ArrayHelper::map(AdPosition::findAll(['status' => AdPosition::STATUS_ACTIVE]), 'id', 'name')) ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'type') ?>
            <?= $form->field($model, 'text')->textarea() ?>

            <?= $form->field($model, 'img')->widget(FileInput::className(), [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => false
                ],
                'pluginOptions' => [
                    'initialPreview' => [
                        $model->img,
                    ],
                    'showRemove' => true,
                    'initialPreviewAsData' => true,
                    'initialCaption' => $model->img,
                    'overwriteInitial' => true,
                    'maxFileSize' => 2800
                ]
            ]); ?>

            <?= $form->field($model, 'url') ?>
            <?= $form->field($model, 'status')->dropDownList($model::getStatusList()) ?>
            <?= $form->field($model, 'order')->input('number') ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Module::t('ad', 'Create') : Module::t('ad', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
