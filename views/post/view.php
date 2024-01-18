
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

<div id="replying-to-message"></div>

<?php $form = ActiveForm::begin(['action' => ['comment/create']]); ?>

<?= $form->field($commentModel, 'content')->textarea(['rows' => 6]) ?>

<?= $form->field($commentModel, 'post_id')->hiddenInput(['value' => $model->id])->label(false) ?>

<?= $form->field($commentModel, 'parent_id')->hiddenInput(['id' => 'parent-id-input'])->label(false) ?>

<div class="form-group">
    <?= Html::submitButton('Submit Comment', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<h2>Comments</h2>

<?php if (empty($model->comments)): ?>
    <p>No comments yet.</p>
<?php else: ?>
    <div class="comments">
        <?php
        function displayComments($comments, $level = 0) {
            foreach ($comments as $comment) {
                echo '<div class="comment" style="margin-left: ' . ($level * 20) . 'px;">';
                echo '<div class="comment-content">';
                echo '<p>' . Html::encode($comment->content) . '</p>';
                echo '</div>';
                echo '<div class="comment-actions">';
                echo Html::a('Reply', '#', ['class' => 'reply-button', 'data-id' => $comment->id]);
                echo Html::a('Delete', ['comment/delete', 'id' => $comment->id], ['class' => 'delete-button']);
                echo '</div>';
                echo '</div>';
                if (!empty($comment->replies)) {
                    displayComments($comment->replies, $level + 1);
                }
            }
        }

        displayComments($model->comments);
        ?>
    </div>
<?php endif; ?>

<?php
$script = <<< JS
$(document).ready(function() {
    $('.reply-button').click(function(e) {
        e.preventDefault();
        var commentId = $(this).data('id');
        var commentContent = $(this).closest('.comment').find('.comment-content p').text();
        console.log('Reply button clicked. Comment ID:', commentId);
        $('#parent-id-input').val(commentId);
        var parentId = $('#parent-id-input').val();
        console.log('Parent ID input value:', parentId);
        $('#replying-to-message').html('<p>Replying to: ' + commentContent + '</p>');
        $('#comment-input').focus();
    });
});
JS;
$this->registerJs($script);
?>

<style>
    .comments {
        margin-top: 20px;
    }

    .comment {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    .comment-content {
        margin-bottom: 10px;
    }

    .comment-actions {
        display: flex;
        justify-content: flex-end;
    }

    .reply-button,
    .delete-button {
        margin-left: 10px;
    }
</style>

