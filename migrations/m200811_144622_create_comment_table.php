<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m200811_144622_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text(),
            'dateCurrentCreate' => $this->dateTime()->defaultExpression('NOW()'),
            'userId' => $this->integer(),
            'articleId' => $this->integer(),
            'status' => $this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_id',
            'comment',
            'userId'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-user_id',
            'comment',
            'UserId',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `article_id`
        $this->createIndex(
            'idx-article_id',
            'comment',
            'articleId'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-article_id',
            'comment',
            'articleId',
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
