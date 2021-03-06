<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\Tag;
use app\models\UploadImage;
use Yii;
use app\models\Article;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->saveArticle()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSetImage($id)
    {
        $model = new UploadImage();

    if(\Yii::$app->request->isPost)
    {
       $file = UploadedFile::getInstance($model, 'image');
       $article = $this->findModel($id);

       if ($article->saveImage($model->upload($file, $article->image))) {
           $this->redirect('/admin/article/view?id=' . $article->id);
       }
    }
        return $this->render('set-image', ['model' => $model]);
    }

    public function actionSetCategory($id)
    {
        $model = $this->findModel($id);


        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

        if(\Yii::$app->request->isPost)
        {
            $category = \Yii::$app->request->post('Category');

            if($model->saveCategory($category))
            {
                $this->redirect('/admin/article/view?id=' . $model->id);
            }
        }

        return $this->render('set-category', ['model' => $model,
            'categories' => $categories]);
    }

    public function actionSetTags($id)
    {
        $model = $this->findModel($id);
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

        if(\Yii::$app->request->isPost)
        {
            $tag = \Yii::$app->request->post('Tags');

            if($model->saveTags($tag))
            {
                $this->redirect('/admin/article/view?id=' . $id);
            }
        }

        return $this->render('set-tags', ['model' => $model,
            'tags' => $tags]);
    }
}
