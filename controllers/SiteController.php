<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Article::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'PageSize' => 3]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $posts = Article::find()->orderBy('viewed desc')->limit(3)->all();
        $lastPosts = Article::find()->orderBy('dateCurrentCreate desc')->limit(3)->all();
        $categories = Category::find()->all();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'posts' => $posts,
            'lastPosts' => $lastPosts,
            'categories' => $categories
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionSignup()
    {
        $user = new User;
        if(\Yii::$app->request->isPost)
        {
            $user->load(\Yii::$app->request->post());
                if($user->save())
                {
                    $this->redirect('login');
                }
        }

        return $this->render('signup', ['model' => $user]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionView($id)
    {

        $article = Article::findOne($id);
        $posts = Article::find()->orderBy('viewed desc')->limit(3)->all();
        $lastPosts = Article::find()->orderBy('dateCurrentCreate desc')->limit(3)->all();
        $categories = Category::find()->all();

        return $this->render('single', [
            'article' => $article,
            'posts' => $posts,
            'lastPosts' => $lastPosts,
            'categories' => $categories
        ]);
    }
    public function actionCategory($id)
    {
        $query = Article::find()->where(['categoryId' => $id]) ;
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'PageSize' => 6]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $posts = Article::find()->orderBy('viewed desc')->limit(3)->all();
        $lastPosts = Article::find()->orderBy('dateCurrentCreate desc')->limit(3)->all();
        $categories = Category::find()->all();

        return $this->render('category',[
            'models' => $models,
            'pages' => $pages,
            'posts' => $posts,
            'lastPosts' => $lastPosts,
            'categories' => $categories
        ]);
    }
}
