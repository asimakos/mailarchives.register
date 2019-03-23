<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property string $job
 * @property string $employer
 * @property string $email
 * @property string $mobile
 *
 * @property Document[] $documents
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'job', 'employer', 'email', 'mobile'], 'required'],
            [['name', 'job'], 'string', 'max' => 300],
            [['employer'], 'string', 'max' => 500],
            [['email'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app_translate','ID'),
            'name' => Yii::t('app_translate','Name'),
            'job' => Yii::t('app_translate','Job'),
            'employer' => Yii::t('app_translate','Employer'),
            'email' => Yii::t('app_translate','Email'),
            'mobile' => Yii::t('app_translate','Mobile'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['user_id' => 'id']);
    }
}
