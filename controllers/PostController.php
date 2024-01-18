<?php
namespace app\controllers;

use Yii;
use app\models\Post;
use yii\web\Controller;
use yii\web\UploadedFile;

class PostController extends Controller
{
    // ...

    public function actionCreate()
{
    $model = new Post();

    if ($model->load(Yii::$app->request->post())) {
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile'); // Get the instance of uploaded file

        // Validate the uploaded file before saving it
        if ($model->validate(['imageFile'])) {
            $model->created_at = date('Y-m-d H:i:s', time()); // Convert UNIX timestamp to datetime format
            $model->category_id = 1; // Set a default category ID

            $model->image = 'uploads/' . $model->imageFile->baseName . '.' . $model->imageFile->extension;

            // Save the uploaded file to the 'uploads' directory
            $model->imageFile->saveAs($model->image);

            if ($model->save(false)) { // Skip validation as it's already done
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                var_dump($model->errors);
                die();
            }
        } else {
            // Handle validation errors
            var_dump($model->errors);
            die();
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}

    public function actionView($id)
{
    $model = $this->findModel($id);

    return $this->render('view', [
        'model' => $model,
    ]);
}

public function actionIndex()
{
    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => \app\models\Post::find(),
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}

public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}

public function actionDelete($id)
{
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
}

protected function findModel($id)
{
    if (($model = Post::findOne($id)) !== null) {
        return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
}


} 