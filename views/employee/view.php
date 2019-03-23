<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app_translate', 'Employees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="employee-view">

   <!--
    <h1><?= Html::encode($this->title) ?></h1>
    -->
    
    <h1><?= Html::encode($model->name) ?></h1> 
    <br/>
    
    <p>
        <?= Html::a(Yii::t('app_translate', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app_translate', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app_translate', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            ['attribute'=>'name','type' => DetailView::INPUT_TEXT],
            ['attribute'=>'job', 'type' => DetailView::INPUT_TEXT],
            ['attribute'=>'employer', 'type' => DetailView::INPUT_TEXT],
            ['attribute'=>'email','format'=>'email','type' => DetailView::INPUT_TEXT],
            ['attribute'=>'mobile', 'type' => DetailView::INPUT_TEXT],
        ],
    ]) ?>

</div>
