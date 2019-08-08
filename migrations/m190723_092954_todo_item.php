<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190723_092954_todo_item
 */
class m190723_092954_todo_item extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('todo' ,[
            'id' => Schema::TYPE_PK,
            'done' => Schema::TYPE_BOOLEAN,
            'content' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
        ]);
    }

    public function down()
    {
        echo "m190723_092954_todo_item cannot be reverted.\n";

        return false;
    }

}
