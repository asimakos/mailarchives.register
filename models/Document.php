<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\components\FormatdateBehavior;

/**
 * This is the model class for table "document".
 *
 * @property int $id
 * @property string $subject
 * @property string $registry_number
 * @property string $registry_protocol
 * @property string $registry_date
 * @property string $consigner
 * @property string $consignee
 * @property string $registry_preview
 * @property int $user_id
 *
 * @property Employee $user
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject', 'registry_number', 'registry_protocol', 'registry_date', 'consigner', 'consignee', 'user_id'], 'required'],
            [['subject'], 'string'],
            [['registry_date'], 'safe'],
            [['user_id'], 'integer'],
            [['registry_number', 'registry_protocol'], 'string', 'max' => 200],
            [['consigner', 'consignee'], 'string', 'max' => 300],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['registry_preview'],'file','skipOnEmpty'=>true,'extensions'=>'png,jpg,gif'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            //'subject' => 'Subject',
            'subject' => Yii::t('app_translate', 'Subject'),
            'registry_number' => Yii::t('app_translate', 'Registry Number'),
            'registry_protocol' => Yii::t('app_translate', 'Registry Protocol'),
            'registry_date' => Yii::t('app_translate', 'Registry Date'),
            'consigner' => Yii::t('app_translate', 'Consigner'),
            'consignee' => Yii::t('app_translate', 'Consignee'),
            'registry_preview' => Yii::t('app_translate', 'Registry Preview'),
            'user_id' => Yii::t('app_translate', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Employee::className(), ['id' => 'user_id']);
    }
    
    // Upload image
    
    public function uploadImage() {
  
	  $image = UploadedFile::getInstance($this, 'registry_preview');
	  
	  $this->registry_preview="/images/photos/".$this->registry_number.".png";
  
	  if (empty($image)) {
	         return false;
	        }
	  return $image;
	  
    }
    
    // Delete image
    
     public function deleteImage($filepath){
		 
		 if (empty($filepath) || !file_exists($filepath)) {
		     return false;
		 }
		 
		 if (!unlink($filepath)){
		    return false;
		 }
		    
		 $this->registry_preview=null;
		 
		 return true;       
		 
	 }
    
       
     public function behaviors() {
		 
         return [
            // anonymous behavior, behavior class name only
            FormatdateBehavior::className(),
         ];
      }        
}
