<?php

use yii\db\Migration;

/**
 * Class m190801_132949_todo_item_priority
 */
class m190801_132949_todo_item_priority extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('todo', 'priority', $this->string());
    }

    public function down()
    {
        echo "m190801_132949_todo_item_priority cannot be reverted.\n";

        return false;
    }

}
