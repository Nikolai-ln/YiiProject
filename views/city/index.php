<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;
?>

<ul>
<?php foreach ($cities as $city): ?>
    <li>
        <?= Html::encode("{$city->name}"); ?>
    </li>
<?php endforeach; ?>
</ul>
<?php echo LinkPager::widget(['pagination' => $pagination]); ?>