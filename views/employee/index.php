<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\grid\GridView;
use kartik\export\ExportMenu;
use app\models\Employee;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app_translate', 'Employees');
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
	    'attribute' => 'name',
	    'filterType' => GridView::FILTER_SELECT2,
	    'filter' => ArrayHelper::map(Employee::find()->orderBy('name')->asArray()->all(), 'name', 'name'), 
	    'filterWidgetOptions' => [
	        'pluginOptions' => ['allowClear' => true],
	    ],
	    'filterInputOptions' => ['placeholder' => Yii::t('app_translate', 'Any name')],
	    'format' => 'raw'  
	],
	[
	     'attribute' => 'job', 
	],
	[
	   'attribute'=>'employer', 
	   'filterType' => GridView::FILTER_SELECT2,
	   'filter' => ArrayHelper::map(Employee::find()->orderBy('employer')->asArray()->all(), 'employer', 'employer'), 
	   'filterWidgetOptions' => [
	        'pluginOptions' => ['allowClear' => true],
	    ],
	    'filterInputOptions' => ['placeholder' => Yii::t('app_translate', 'Any employer')],
	    'format' => 'raw'  
    ],
    [
	     'attribute' => 'email',
	     'format' => 'email', 
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
	
	$grid_title=Yii::t('app_translate', 'Employees');
 
?>

<div class="employee-index">
   <!--
    <h1><?= Html::encode($this->title) ?></h1>
    -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>	
     <?= Html::a(Yii::t('app_translate', 'Create Employee'), ['create'], ['class' => 'btn btn-success']) ?>
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
