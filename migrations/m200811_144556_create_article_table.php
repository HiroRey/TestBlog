<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%article}}`.
 */
class m200811_144556_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200),
            'description' => $this->text(),
            'dateCurrentCreate' => $this->dateTime()->defaultExpression('NOW()'),
            'content' => $this->text(),
            'image' => $this->text(),
            'viewed' => $this->integer(),
            'userId' => $this->integer(),
            'status' => $this->integer(),
            'categoryId' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
