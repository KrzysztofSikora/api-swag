<?php

use app\modules\versiSatu\models\ToDo;

class ToDoMapper implements ToDoInterfaceMapper
{
    public function mapToData(ToDo $toDo): array
    {
        // TODO: Implement mapToData() method.

        $var = 'val';
        return [
            'field' => $var
        ];
    }
}