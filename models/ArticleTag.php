<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_tag".
 *
 * @property int $id
 * @property int|null $articleID
 * @property int|null $tagId
 *
 * @property Article $article
 * @property Tag $tag
 */
class ArticleTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['articleID', 'tagId'], 'integer'],
            [['articleID'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['articleID' => 'id']],
            [['tagId'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tagId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'articleID' => 'Article ID',
            'tagId' => 'Tag ID',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'articleID']);
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tagId']);
    }
}
