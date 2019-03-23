<?php

namespace app\controllers;

use Yii;
use app\models\Document;
use app\models\Employee;
use app\models\DocumentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function beforeAction($action)
	{
	   Yii::$app->language = 'el'; 
	   
	   return parent::beforeAction($action);
	}

    /**
     * Lists all Document models.
     * @return mixed
     */
    public function actionIndex()
    {
		$searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		$employee_id=$this->findModel($id)->user_id;
		
        return $this->render('view', [
            'model' => $this->findModel($id),
            'employee' => Employee::findOne($employee_id),
        ]);
    }

    /**
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Document();
                       
        $employee_list = ArrayHelper::map(Employee::find()->asArray()->all(), 'id', 'name');
              
        if ($model->load(Yii::$app->request->post())){
        
            $image = $model->uploadImage();
            
        if ($model->save()) {
			
		    if ($image !== false) {
				
				 $app_path = Yii::$app->basePath;
		 			     			         			          			         		         
		         $file_name=iconv('UTF-8', 'greek//TRANSLIT',$model->registry_number.'.png');
		 
		         $file_path=Yii::$app->params['uploadpath'].$file_name;
		 
		         $image->saveAs($app_path.$file_path);
                }
            
            Yii::$app->session->setFlash('success', Yii::t('app_translate', 'Document created successfully'));
			
            return $this->redirect(['view', 'id' => $model->id]);
        }
      }
        return $this->render('create', [
            'model' => $model,'employee_list' => $employee_list,
        ]);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldfilepath=Yii::$app->params['uploadpath'].$model->registry_number.'.png';
        $oldimagepath=Yii::$app->basePath.Yii::$app->params['imagepath'].$model->registry_number.'.png';
        
        $oldregistry=$model->registry_number;
        
        $employee_list = ArrayHelper::map(Employee::find()->asArray()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {
			
			$image = $model->uploadImage();
			
			$newregistry=Yii::$app->request->post('Document')['registry_number'];
			
			if ($oldregistry!==$newregistry) {
				
				 $newfilepath=Yii::$app->basePath.Yii::$app->params['imagepath'].$newregistry.'.png';
				 rename($oldimagepath,$newfilepath);
				 				 				 
				 }
        
	        if ($model->save()) {
				
				 //rename($oldfilepath,$newregistry.'.png');
				
				 if ($image !== false) {
					 
				 $model->deleteImage($oldfilepath); 
					
				 $app_path = Yii::$app->basePath;
				 		 
				 $file_name=iconv('UTF-8', 'greek//TRANSLIT',$model->registry_number.'.png');
				 
				 $file_path=Yii::$app->params['uploadpath'].$file_name;
				 
				 $image->saveAs($app_path.$file_path);
				}
		  
		  Yii::$app->session->setFlash('success', Yii::t('app_translate', 'Document updated successfully'));
			 
          return $this->redirect(['view', 'id' => $model->id]);
	      } 
	    }  
        return $this->render('update', [
            'model' => $model,'employee_list' => $employee_list,
        ]);
      }

    /**
     * Deletes an existing Document model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $file_path=Yii::$app->params['uploadpath'].$model->registry_number.'.png';
        
        if ($model->delete()) {
            if (!$model->deleteImage($file_path)) {
                Yii::$app->session->setFlash('error', Yii::t('app_translate', 'Error deleting image'));
            }
            
           Yii::$app->session->setFlash('success', Yii::t('app_translate', 'Document deleted successfully'));  
        }
             
        return $this->redirect(['index']);
    }

    /**
     * Finds the Document model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Document the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Document::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
