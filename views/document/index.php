<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Document;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use slavkovrn\lightbox\LightBoxWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app_translate', 'Documents');
$this->params['breadcrumbs'][] = $this->title;


$gridColumns = [
	[
	    'class' => 'kartik\grid\SerialColumn',
	    'contentOptions' => ['class' => 'kartik-sheet-style'],
	    'header' => '',
	    'headerOptions' => ['class' => 'kartik-sheet-style']
	],
	[    
	    //'class' => 'kartik\grid\EditableColumn',
	    'attribute' => 'subject',
	    'filterType' => GridView::FILTER_SELECT2,
	    'filter' => ArrayHelper::map(Document::find()->orderBy('subject')->asArray()->all(), 'subject', 'subject'), 
	    'filterWidgetOptions' => [
	        'pluginOptions' => ['allowClear' => true],
	    ],
	    'filterInputOptions' => ['placeholder' => Yii::t('app_translate', 'Any subject')],
	    'format' => 'raw'  
	],
	[    
	    'attribute' => 'registry_number',
	    'filterType' => GridView::FILTER_SELECT2,
	    'filter' => ArrayHelper::map(Document::find()->orderBy('registry_number')->asArray()->all(), 'registry_number', 'registry_number'), 
	    'filterWidgetOptions' => [
	        'pluginOptions' => ['allowClear' => true],
	    ],
	    'filterInputOptions' => ['placeholder' => Yii::t('app_translate', 'Any registry number')],
	    'format' => 'raw'  
	],
	[    
	    'attribute' => 'registry_protocol',
	    'filterType' => GridView::FILTER_SELECT2,
	    'filter' => ArrayHelper::map(Document::find()->orderBy('registry_protocol')->asArray()->all(), 'registry_protocol', 'registry_protocol'), 
	    'filterWidgetOptions' => [
	        'pluginOptions' => ['allowClear' => true],
	    ],
	    'filterInputOptions' => ['placeholder' => Yii::t('app_translate', 'Any registry protocol')],
	    'format' => 'raw'  
	],
	[
		'attribute'=>'registry_date',
		'value' => function ($model, $index, $widget) {
			return Yii::$app->formatter->asDate($model->registry_date);
		},
		'filterType' => GridView::FILTER_DATE,
		'filterWidgetOptions' => [
			'pluginOptions' => [
				'format' => 'yyyy-mm-dd',
				'autoclose' => true,
				'todayHighlight' => true,
			]
		],
	],
	[
	    'attribute' => 'registry_preview', 
	    'format' => 'html',
	    'value' => function ($model, $key, $index, $widget) { 
			
			$images = [               // images at popup window of prettyPhoto galary
		              1 => [
							'src' => Url::to('@web'.$model->registry_preview),
							'title' => Yii::t('app_translate', 'Preview document'),
							],
			          ];
			
			return LightBoxWidget::widget([
                    'id'     =>'lightbox',  // id of plugin should be unique at page
                    'class'  =>'galary',    // class of plugin to define style
                    'height' =>'70px',     // height of image visible in widget
                    'width' =>'70px',      // width of image visible in widget
                    'images' => $images,
                ]);
			
			// $img_link=Html::img('@web'.$model->registry_preview,['alt'=> $model->registry_protocol,'class'=>'img-thumbnail','width'=>60,'height'=>60]); 
			// return Html::a("Image",'@web'.$model->registry_preview, ['class'=>'lightbox']);
		  },
	], 
	 ['class' => 'yii\grid\ActionColumn'],  
 ]; 
 
 $customDropdown = [
    'options' => ['tag' => false], 
    'linkOptions' => ['class' => 'dropdown-item']
  ];
 
 $fullExportMenu = ExportMenu::widget([
	    'dataProvider' => $dataProvider,
	    'columns' => $gridColumns,
	    'target' => ExportMenu::TARGET_BLANK,
	    'asDropdown' => false, // this is important for this case so we just need to get a HTML list    
	    'dropdownOptions' => [
	    'label' => '<i class="fas fa-external-link-alt"></i> Full'
	    ],
	     'exportConfig' => [ // set styling for your custom dropdown list items
	        ExportMenu::FORMAT_CSV => $customDropdown,
	        ExportMenu::FORMAT_TEXT => $customDropdown,
	        ExportMenu::FORMAT_HTML => $customDropdown,
	        ExportMenu::FORMAT_PDF => $customDropdown,
	        ExportMenu::FORMAT_EXCEL => $customDropdown,
	        ExportMenu::FORMAT_EXCEL_X => $customDropdown,
	    ],
	]);
	
	$grid_title=Yii::t('app_translate', 'Documents');
   
?>
<div class="document-index">
     <!--
    <h1><?= Html::encode($this->title) ?></h1>
    -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app_translate', 'Create Document'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'panel' => [
	        'type' => GridView::TYPE_PRIMARY,
           'heading' => "<h3 class='panel-title'><i class='fas fa-book'></i> $grid_title </h3>",
		    ],
		    'exportContainer' => [
		        'class' => 'btn-group mr-2'
		    ],
        'toolbar' => [
		       '{export}',
          ],
        'export' => [
        'itemsAfter'=> [
            '<div role="presentation" class="dropdown-divider"></div>',
            '<div class="dropdown-header">Export All Data</div>',
            $fullExportMenu
        ]
     ],
       
]); ?>
    
    
</div>
