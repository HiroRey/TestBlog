<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\assets\PublicAsset;
use app\models\User;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
if(isset(Yii::$app->user->id)) {
    $admin = User::findOne(Yii::$app->user->id);
}
PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar main-menu navbar-default">
    <div class="container">
        <div class="menu-content">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>


            <ul class="nav navbar-nav text-uppercase">
                <li><a href="<?= Url::toRoute(['site/index'])?>"><?= Yii::t('common', 'Home'); ?></a></li>
                <?php if(Yii::$app->user != Yii::$app->user->isGuest) : ?>
                <?php if ($admin->isAdmin === 1) : ?>
                    <li><a href="<?= Url::toRoute(['/admin/article/index'])?>">Admin Panel</a></li>
                <?php endif; ?>
              <?php endif; ?>
            </ul>


                <div class="i_con">
                    <ul class="nav navbar-nav text-uppercase">
                        <?php if(Yii::$app->user->isGuest):?>
                            <li><a href="<?= Url::toRoute(['site/login'])?>">Login</a></li>
                            <li><a href="<?= Url::toRoute(['site/signup'])?>">Register</a></li>
                        <?php else: ?>
                            <?= Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->email . ')',
                                ['class' => 'btn btn-link logout', 'style'=>"padding-top:10px;"]
                            )
                            . Html::endForm() ?>
                        <?php endif;?>
                    </ul>
                </div>


            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
    <!-- /.container-fluid -->
</nav>


<?=$content ?>

<footer class="footer-widget-se/public>
    <div class="container">

    </div>
    <div class="footer-copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center">&copy; 2020 <a href="#"> Test Project, </a> Built with <i
                                class="fa fa-heart"></i> by <a href="#">Ivan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
