<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\file\FileInput;


/* @var $this yii\web\View */
/* @var $model app\models\Document */
/* @var $form yii\widgets\ActiveForm */

$model->registry_date=Yii::$app->formatter->asDate($model->registry_date);

?>

<div class="document-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=> 'multipart/form-data']]); ?>

    <?= $form->field($model, 'subject')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'registry_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registry_protocol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registry_date')->widget(DatePicker::classname(),[
       'options' => ['placeholder' => Yii::t('app_translate', 'Select Date ...') ],
       'pluginOptions' => [
       'autoclose'=>true,
       'format' => 'dd-mm-yyyy']])?> 

    <?= $form->field($model, 'consigner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consignee')->textInput(['maxlength' => true]) ?>
   
     
    <?= $form->field($model, 'registry_preview')->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*'],'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]]); ?>
   
    <?= $form->field($model, 'user_id')->dropDownList($employee_list,['prompt'=>Yii::t('app_translate', 'Select Employee:')]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app_translate', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
