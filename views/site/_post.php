<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $model app\models\Post */

?>

<div class="post">
    <h2><?= Html::encode($model->title) ?></h2>
    <p><?= Html::encode($model->content) ?></p>
    <p><a href="<?= Url::to(['post/view', 'id' => $model->id]) ?>">Read more</a></p>
</div>