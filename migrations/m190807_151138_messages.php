<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190807_151138_messages
 */
class m190807_151138_messages extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('messages' ,[
            'id' => Schema::TYPE_PK,
            'author' => Schema::TYPE_TEXT,
            'message' => Schema::TYPE_TEXT,
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
        ]);
    }

    public function down()
    {
        echo "m190807_151138_messages cannot be reverted.\n";

        return false;
    }
}
