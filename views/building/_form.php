<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\City;

/* @var $this yii\web\View */
/* @var $model app\models\Building */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="building-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'city_id')->textInput() ?> -->
    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map(City::find()->select(['name', 'city_id'])->all(), 'city_id', 'cityName'),['class' => 'form-control inline-block']); ?>
    <!-- we use city_id to access that field in the model, we have to change that label to City in Building.php -->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
