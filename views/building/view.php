<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Building */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Buildings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="building-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->building_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->building_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php endif; ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'building_id',
            'name',
            //'city_id',
            //'city.name',
            [
                'label' => 'City',
                'attribute' => 'city.name',
                //'value' => $model->city->name,
            ],
            [
                'label' => 'Photo',
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($item) {
                    if(!$item){
                        return NULL;  
                    }
                    $path = Yii::getAlias('@web');
                    $tag = '<img src="'. $path . '/' . $item->photo. '" />';
                    return $tag;
                }
            ]
         ],
    ]) ?>

</div>
