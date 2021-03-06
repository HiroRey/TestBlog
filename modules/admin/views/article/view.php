<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set Image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Set Category', ['set-category', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Set Tags', ['set-tags', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'dateCurrentCreate',
            'content:ntext',
            [
                'format' => 'html',
                'label' => 'Image',
                'value' => function($data) {
                    return Html::img($data->getImage(), ['width' => 200]);
                }
            ],
            'viewed',
            ['format' => 'html',
                'label' => 'Tag',
                'value' => function($data) {
                    $str = '';
                        foreach ($data->tags as $tag) {
                            $str .= Html::label($tag->title) . '<br>';
                        }
                    return $str;
                }],
            'userId',
            'status',
            [
                'format' => 'html',
                'label' => 'Category',
                'value' => function($data) {
            if (!empty($data->category->title)) {
                return Html::label($data->category->title);
            }
                }
            ],
        ],
    ]) ?>

</div>
