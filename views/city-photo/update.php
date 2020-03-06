<?php

use yii\helpers\Html;
use app\models\City;

/* @var $this yii\web\View */
/* @var $model app\models\CityPhoto */

$this->title = 'Update City Photo: ' . $model->city->name;
$this->params['breadcrumbs'][] = ['label' => 'City Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->city->name, 'url' => ['view', 'id' => $model->city_photo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
