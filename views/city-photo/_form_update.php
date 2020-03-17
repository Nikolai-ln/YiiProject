<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\City;

/* @var $this yii\web\View */
/* @var $model app\models\CityPhoto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-photo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->select(['name', 'city_id'])->all(), 'city_id', 'cityName'),
                                                                                    ['class' => 'form-control inline-block']); ?>

    <?= $form->field($model, 'files[]')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
