<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card">
        <img class="card-img-top" src="<?= Yii::getAlias('@web') . '/' . $model->image ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $model->title ?></h5>
            <p class="card-text"><?= $model->content ?></p>
            <p class="card-text"><small class="text-muted">Category ID: <?= $model->category_id ?></small></p>
            <p class="card-text"><small class="text-muted">Created at: <?= $model->created_at ?></small></p>
        </div>
    </div>

</div>