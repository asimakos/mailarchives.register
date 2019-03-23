<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\date\DatePicker;
use kartik\detail\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Document */

$photopath="@web".$model->registry_preview;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app_translate', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="document-view">

    <!--
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::img($photopath,["alt"=>"archive image thumbnail","width"=>160,"height"=>160]); ?>
     -->
     
    <h1><?= Html::encode($model->subject) ?></h1> 
   
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
            ['attribute'=>'subject','type' => DetailView::INPUT_TEXT],
            //'subject:ntext',
            ['attribute'=>'registry_number','type' => DetailView::INPUT_TEXT],
            //'registry_number',
            ['attribute'=>'registry_protocol','type' => DetailView::INPUT_TEXT],
            //'registry_protocol',
            [
		    'label' => Yii::t('app_translate', 'Registration Date'),
		    'type'=>DetailView::INPUT_DATE,
		    'value' => Yii::$app->formatter->asDate($model->registry_date),
		    'widgetOptions' => [
                    'pluginOptions'=>['format'=>'d-M-Y']
                ],
		     //'format' => ['date','yyyy-mm-dd'],
             ],
            //['attribute'=>'registry_date','label'=>'Date','format'=>'html'],
            //'registry_date:date',
            ['attribute'=>'consigner','type' => DetailView::INPUT_TEXT],
            //'consigner',
            ['attribute'=>'consignee','type' => DetailView::INPUT_TEXT],
            //'consignee',
            [
		    'label'=>Yii::t('app_translate', 'Registry Preview'),
		    'value'=>$photopath,
		    'format' => ['image',['width'=>550,'height'=>550]],
		    ],
            //'registry_preview',
           // 'user_id',
           [
		    'label'=>Yii::t('app_translate', 'User ID'),
		    'value'=>$employee->name,
		    'type' => DetailView::INPUT_TEXT
		   ],
          ],
      ]) ?>

</div>
