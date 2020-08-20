<?php
/**
 * @var \app\models\Article $article
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <article class="post">

                    <div class="post-thumb">
                        <a href="#"><img src="<?=$article->getImage() ?>" alt=""></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <h6><a href="<?=Url::toRoute(['/site/category', 'id' => $article->category->id]) ?>"> <?=$article->category->title ?></a></h6>

                            <h1 class="entry-title"><a href="#"><?=$article->title ?></a></h1>
                        </header>
                        <div class="entry-content">
                            <p>
                                <?=$article->content ?>
                            </p>
                        </div>
                        
                        <?php foreach ($article->tags as $tag) : ?>
                            <a href="#" class="btn btn-default"><?=$tag->title ?></a>
                        <?php endforeach; ?>

                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize"><?=$article->getDate() ?></span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>



                <div class="bottom-comment"><!--bottom comment-->
                    <h3><?=$article->getComments()->count() ?> Comments:</h3>
                    <p><?php foreach ($article->comments as $comment) : ?>
                        <?= (isset($comment->user->id)) ? $comment->user->name : 'No Author'?></p>

                        <?=$comment->getDate() ?>
                    <div class="comment-text">
                        <p class="para"><i><?=$comment->text ?></i></p>
                    </div>
                        <hr>
                    <?php endforeach; ?>
                </div>



                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>
                    <?php  $form = ActiveForm::begin(['action' => '/site/comment/?id=' . $article->id]) ?>
                    <div class="form-group">
                        <div class="form-g/public
                            <div class="col-md-12">
                        <?=$form->field($commentt, 'text')->textarea()->hint('Пожалуйста, введите ваш комментарий')?>
                    </div>
                </div>
                <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                <?php ActiveForm::end(); ?>
                </form>
            </div><!--end leave comment-->
            </div>


            </div>
        </div>
    </div>
</div>
