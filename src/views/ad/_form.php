<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use zacksleo\yii2\ad\Module;
use zacksleo\yii2\ad\models\AdPosition;
use zacksleo\yii2\ad\assets\DatetimeAsset;

$css = <<<CSS
.file-preview-image{max-width:200px;max-height:200px;}
CSS;
$this->registerCss($css);

/* @var $this yii\web\View */
/* @var $model zacksleo\yii2\ad\models\AdPosition */
/* @var $form yii\widgets\ActiveForm */
DatetimeAsset::register($this);
$js = <<<JS
  $(".bs-datepicker").datetimepicker({
     format: "yyyy-mm-dd hh:ii",
     language:'zh-CN',
     autoclose: true,
     todayBtn: true
  });
  $('.fa-calendar').parent().click(function() {
    $(this).prev().datetimepicker('show');
  });
JS;
$this->registerJs($js, \yii\web\View::POS_END);
?>

<div class="ad-position-form">

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>

            <?= $form->field($model, 'position_id')->dropDownList(ArrayHelper::map(AdPosition::findAll(['status' => AdPosition::STATUS_ACTIVE]), 'id', 'name')) ?>
            <?= $form->field($model, 'name') ?>

            <?= \nemmo\attachments\components\AttachmentsInput::widget([
                'id' => 'file-input',
                'model' => $model,
                'options' => [
                    'multiple' => false
                ],
                'pluginOptions' => [
                    'maxFileCount' => 1
                ]
            ]) ?>

            <?= $form->field($model, 'url') ?>

            <?= $form->field($model, 'available_from', [
                'inputTemplate' => '<div class="input-group date">{input}<span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>',
            ])->textInput([
                'class' => 'form-control bs-datepicker',
                'readonly' => true,
            ]) ?>

            <?= $form->field($model, 'available_to', [
                'inputTemplate' => '<div class="input-group date">{input}<span class="input-group-addon"><i class="fa fa-calendar"></i></span></div>',
            ])->textInput([
                'class' => 'form-control bs-datepicker',
                'readonly' => true,
            ]) ?>

            <?= $form->field($model, 'status')->dropDownList($model::getStatusList()) ?>
            <?= $form->field($model, 'order')->input('number') ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Module::t('ad', 'Create') : Module::t('ad', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>