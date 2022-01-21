<?php

namespace app\controllers;
use Yii;
use app\models\Article;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;


class ArticleController extends \yii\web\Controller
{
    public function actionCreate()
    {
        $model = new \app\models\Article();
        $imageName = Yii::$app->security->generateRandomString();


        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->image = UploadedFile::getInstance($model, 'image');

                if ($model->image) {
                    $model->article_image = 'uploads/' . $imageName .'.'. $model->image->extension;
                    if ($model->image->saveAs($model->article_image)){
                        $model->image = NULL;
                    }
                }
                if ($model->save()){
                    $this->redirect('index');
                }else{
                    $error = VarDumper::dumpAsString($model->errors);
                    Yii::$app->session->addFlash('message', $error);
                }

            }else{
                 $error = VarDumper::dumpAsString($model->errors);
                 Yii::$app->session->addFlash('message', $error);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionDetail()
    {
        return $this->render('detail');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
