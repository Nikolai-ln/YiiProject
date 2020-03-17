<?php

namespace app\models;

use Yii;
//use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "city_photo".
 *
 * @property int $city_photo_id
 * @property int $city_id
 * @property string $photo
 * @property int $uploaded_by
 * @property string $description
 *
 * @property City $city
 */
class CityPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $files;
    public static function tableName()
    {
        return 'city_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city_id', 'photo'], 'required'],
            [['city_id', 'uploaded_by'], 'integer'],
            [['photo'], 'string', 'max' => 1024],
            [['description'], 'string', 'max' => 5000],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10, 'on' => 'create'],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1, 'on' => 'update'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'city_id']],
            [['uploaded_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['uploaded_by' => 'user_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'city_photo_id' => 'City Photo ID',
            'city_id' => 'City',
            'files' => 'Photos',
            'uploaded_by' => 'Uploaded by',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city_id']);
    }

    public function getUploadedBy()
    {
        return $this->hasOne(User::className(), ['user_id' => 'uploaded_by']);
    }
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        // ...custom code here...
        if($this->photo){
            $photoPathOld = Yii::$app->basePath.'/web/'.$this->photo; //get the path to the existing file
            @unlink($photoPathOld);
        }
        return true;
    }
}
