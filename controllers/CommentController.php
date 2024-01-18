<?php
namespace app\controllers;

use Yii;
use app\models\Comment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CommentController extends Controller
{
    public function actionCreate()
{
    $model = new Comment();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['post/view', 'id' => $model->post_id]);
    }

    throw new NotFoundHttpException('The requested page does not exist.');
}

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['post/index']);
    }

    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}