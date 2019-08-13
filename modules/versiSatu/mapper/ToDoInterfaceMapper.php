<?php

use app\modules\versiSatu\models\ToDo;


interface ToDoInterfaceMapper
{
    /**
     * @param ToDo $toDo
     * @return array
     */
    public function mapToData(ToDo $toDo): array;
}