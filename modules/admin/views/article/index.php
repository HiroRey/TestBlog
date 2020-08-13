<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            ['format' => 'html',
                'label' => 'Tag',
                'value' => function($data) {
                    $str = '';
                    foreach ($data->tags as $tag) {
                        $str .= Html::label($tag->title) . '<br>';
                    }
                    return $str;
                }],
            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]); ?>


</div>
