<?php
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Post;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0,0,0,.125);
        border-radius: .25rem;
    }
    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }
    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card-title {
        margin-bottom: .75rem;
    }
    .card-text:last-child {
        margin-bottom: 0;
    }
    .card-text {
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card-text {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .card-text:last-child {
        margin-bottom: 0;
    }
    .card-text {
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card-text {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .card-text:last-child {
        margin-bottom: 0;
    }
    .card-text {
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card-text {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .card-text:last-child {
        margin-bottom: 0;
    }
    .card-text {
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card-text {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .card-text:last-child {
        margin-bottom: 0;
    }
    .card-text {
        flex: 1 1 auto;
        padding: 1.25rem;
    }
    .card-text {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    .card-text:last-child {
        margin-bottom: 0;
    }
    .card-text {
        flex: 1 1 auto;
        padding: 1.25rem;
    }

</style>
<div class="post-index">
    
    <h1><?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function ($model, $key, $index, $widget) {
        $content = strlen($model->content) > 100 ? substr($model->content, 0, 100) . '...' : $model->content;
        return '<div class="card mb-4 shadow-sm">
                    <img class="card-img-top" src="' . Yii::getAlias('@web') . '/' . $model->image . '" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">' . $model->title . '</h5>
                        <p class="card-text">' . $content . '</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                ' . Html::a('View', ['post/view', 'id' => $model->id], ['class' => 'btn btn-sm btn-outline-secondary']) . '
                                ' . Html::a('Edit', ['post/update', 'id' => $model->id], ['class' => 'btn btn-sm btn-outline-secondary']) . '
                                ' . Html::a('Delete', ['post/delete', 'id' => $model->id], [
                                    'class' => 'btn btn-sm btn-outline-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) . '
                            </div>
                            <small class="text-muted">' . $model->created_at . '</small>
                        </div>
                    </div>
                </div>';
    },
    'summary' => '',
    'options' => [
        'tag' => 'div',
        'class' => 'row',
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-md-4',
    ],
]); ?>

    <?= Html::a('Create Post', ['post/create'], ['class' => 'btn btn-success']);?>

</div>