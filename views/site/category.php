<?php

use yii\helpers\Url;
use yii\widgets\LinkPager; ?>
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($models as $model) : ?>
                <article class="post post-list">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="post-thumb">
                                <a href="<?=Url::toRoute(['/site/view', 'id' => $model->id]) ?>"><img src="<?=$model->getImage(); ?>" alt="" class="pull-left"></a>

                                <a href="<?=Url::toRoute(['/site/view', 'id' => $model->id]) ?>" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="post-content">
                                <header class="entry-header text-uppercase">
                                    <h6><a href="#"><?=$model->category->title; ?></a></h6>

                                    <h1 class="entry-title"><a href="<?=Url::toRoute(['/site/view', 'id' => $model->id])?>"><?=$model->title; ?></a></h1>
                                </header>
                                <div class="entry-content">
                                    <p><?=$model->description ?>
                                    </p>
                                </div>
                                <div class="social-share">
                                    <span class="social-share-title pull-left text-capitalize">By <?=$model->author->name?> On <?=$model->getDate(); ?></span>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>

                <?php
                echo LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
            </div>

            <?=$this->render('/layouts/sidebar', [
                'posts' => $posts,
                'lastPosts' => $lastPosts,
                'categories' => $categories]) ?>
        </div>
    </div>
</div>
