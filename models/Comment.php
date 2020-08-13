<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $dateCurrentCreate
 * @property int|null $userId
 * @property int|null $articleId
 * @property int|null $status
 *
 * @property Article $article
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['dateCurrentCreate'], 'safe'],
            [['userId', 'articleId', 'status'], 'integer'],
            [['articleId'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['articleId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
            'dateCurrentCreate' => 'Date Current Create',
            'userId' => 'User ID',
            'articleId' => 'Article ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'articleId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->dateCurrentCreate);
    }
}
