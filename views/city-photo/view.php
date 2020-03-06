<?php

use yii\helpers\Html;
use app\models\City;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CityPhoto */

?> <h1> <?php $this->title = $model->city->name; ?> </h1> <?php
$this->params['breadcrumbs'][] = ['label' => 'City Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="city-photo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->city_photo_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->city_photo_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'city_photo_id',
            //'city_id',
            [
                'label' => 'City',
                'attribute' => 'city.name',
            ],
            [
                'label' => 'Photos',
                'attribute' => 'files',
                'format' => 'html',
                'value' => function($item) {
                    if($item->photo) {
                        $path = Yii::getAlias('@web');
                        $tag = '<img src="'. $path . '/' . $item->photo. '" style="max-width:1031px" />';
                        return $tag;
                    }
                    else
                        return NULL;
                }
            ]
            //'photo',
        ],
    ]) ?>

</div>
