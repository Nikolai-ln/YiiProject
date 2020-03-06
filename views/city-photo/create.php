<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CityPhoto */

$this->title = 'Upload City Photo';
$this->params['breadcrumbs'][] = ['label' => 'City Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
