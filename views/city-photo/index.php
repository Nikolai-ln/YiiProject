<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CityPhotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'City Photos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-photo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Upload City Photo', ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a('Show City Photos', ['photos'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Show City Gallery', ['gallery'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Show City Gallery2', ['gallery2'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Show City Gallery3', ['gallery3'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'city_photo_id',
            [
                'attribute'=>'city_id',
                'value' => 'city.name',
                //'filter'=>ArrayHelper::map(\app\models\City::find()->asArray()->orderBy(['name' => SORT_ASC])->all(), 'city_id', 'name'),
                'filter' => Html::activeDropDownList($searchModel, 'city_id', ArrayHelper::map(\app\models\City::find()->asArray()->orderBy(['name' => SORT_ASC])
                                    ->all(), 'city_id', 'name'),['class'=>'form-control','prompt' => '-- Select City --']),
            ],
            'photo',
            // [
            //     'label' => 'Photos',
            //     'attribute' => 'files',
            //     'format' => 'html',
            //     'value' => function($item) {
            //         if($item->photo) {
            //             $path = Yii::getAlias('@web');
            //             $tag = '<img src="'. $path . '/' . $item->photo. '" style="max-width:850px" />';
            //             return $tag;
            //         }
            //         else
            //             return NULL;
            //     }
            // ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
