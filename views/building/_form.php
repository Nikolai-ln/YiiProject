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
    <?= $form->field($model, 'city')->dropDownList(ArrayHelper::map(City::find()->select(['name', 'city_id'])->all(), 'city_id', 'cityName'),['class' => 'form-control inline-block']); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
