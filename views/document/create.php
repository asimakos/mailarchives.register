<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Document */

$this->title = Yii::t('app_translate', 'Create Document');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app_translate', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'employee_list' => $employee_list,
    ]) ?>

</div>
