<?php

use yii\db\Migration;

/**
 * Class m190812_184208_todo_user_relation
 */
class m190812_184208_todo_user_relation extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {


        $this->addColumn('todo','user_id',  $this->integer());
        $this->addForeignKey('fk_' . 'todo' . '_' . 'user', 'todo', 'user_id', 'users', 'id', 'CASCADE');

    }

    public function down()
    {
        echo "m190812_184208_todo_user_relation cannot be reverted.\n";

        return false;
    }


}
