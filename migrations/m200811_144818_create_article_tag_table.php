<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article_tag}}`.
 */
class m200811_144818_create_article_tag_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article_tag}}', [
            'id' => $this->primaryKey(),
            'articleID' => $this->integer(),
            'tagId' => $this->integer()
        ]);


        // creates index for column `article_id`
        $this->createIndex(
            'idx-article_id',
            'article_tag',
            'articleId'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-articleId',
            'article_tag',
            'articleId',
            'article',
            'id',
            'CASCADE'
        );

        // creates index for column `article_id`
        $this->createIndex(
            'idx-tag_id',
            'article_tag',
            'tagId'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-tag_id',
            'article_tag',
            'tagId',
            'tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article_tag}}');
    }
}
