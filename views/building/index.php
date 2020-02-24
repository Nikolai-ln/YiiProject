<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BuildingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buildings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Building', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'building_id',
            'name',
            //  [
            //     'label' => 'City', 
            //     'attribute'=>'city_id',
            //     'value'=>'city.name',
            //     ],
            ['label'=>'City', 'attribute'=>'city_id', 'value'=>'city.name'], //we use city function in Building.php, city is property of function getCity
            //['label'=>'City', 'value'=>function ($model, $index, $widget) { return $model->city->name; }],
            //'city_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
