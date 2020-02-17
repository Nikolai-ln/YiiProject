<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if(!Yii::$app->user->isGuest): ?>
    <p>
        <?= Html::a('Update', ['update', 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'slug' => $model->slug], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <!-- <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'article_id',
            'title',
            'slug',
            'body:ntext',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?> -->
    
    <p class="text-muted">
        <small>
            Created at: <b><?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?></b>
            By: <b><?php echo $model->createdBy->username ?></b>
        </small>
    </p>
    
    <div>
        <?php echo $model->getEncodedBody(); ?>
    </div>

</div>
