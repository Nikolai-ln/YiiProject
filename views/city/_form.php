<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
    <?php if(!Yii::$app->user->isGuest): ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    <?php endif; ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
