<div>
    <a href="<?php echo \yii\helpers\Url::to(['/article/view', 'slug' => $model->slug]) ?>">
        <h3><?php echo \yii\helpers\Html::encode($model->title) ?></h3>
    </a>
    <div>
        <!-- <?php echo \yii\helpers\StringHelper::truncateWords(\yii\helpers\Html::encode($model->body), 20) ?> -->
        <?php echo \yii\helpers\StringHelper::truncateWords($model->getEncodedBody(), 20) ?>
        <p class="text-muted text-right">
        <small>
            Created at: <b><?php echo Yii::$app->formatter->asRelativeTime($model->created_at) ?></b>
            By: <b><?php echo $model->createdBy->username ?></b><br>
            <?php if($model->created_at != $model->updated_at): ?>
            Updated at: <b><?php echo Yii::$app->formatter->asRelativeTime($model->updated_at) ?></b>
            <?php endif; ?>
            <!-- By: <b><?php echo $model->updatedBy->username ?></b> -->
        </small>
    </p>
    </div>
</div>