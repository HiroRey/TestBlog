<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $dateCurrentCreate
 * @property string|null $content
 * @property string|null $image
 * @property int|null $viewed
 * @property int|null $userId
 * @property int|null $status
 * @property int|null $categoryId
 *
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'content', 'image'], 'string'],
            [['description', 'content', 'title'], 'required'],
            [['dateCurrentCreate'], 'safe'],
            [['viewed', 'userId', 'status', 'categoryId'], 'integer'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'dateCurrentCreate' => 'Date Current Create',
            'content' => 'Content',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'userId' => 'User ID',
            'status' => 'Status',
            'categoryId' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[ArticleTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['articleID' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['articleId' => 'id']);
    }
}
