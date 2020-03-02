<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building".
 *
 * @property int $building_id
 * @property string $name
 * @property int $city_id
 * @property string $photo
 *
 * @property City $city
 */
class Building extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file; // we use it in _form.php file
    public static function tableName()
    {
        return 'building';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'city_id'], 'required'],
            [['city_id'], 'integer'],
            // [['file'], 'file'],
            [['name'], 'string', 'max' => 55],
            [['photo'], 'string', 'max' => 1024],
            // [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'city_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'building_id' => 'Building ID',
            'name' => 'Name',
            'city_id' => 'City', //we change the label, it is visible in create and update pages
            'file' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city_id']);
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
