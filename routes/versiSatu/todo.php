<?php

return [

    'GET todo' => 'to-do/index',
    'OPTIONS todo' => 'to-do/index',

    'GET todo/{id}' => 'to-do/get-one',
    'OPTIONS todo/{id}' => 'to-do/get-one',

    'PUT todo/{id}' => 'to-do/update',
    'OPTIONS todo/{id}' => 'to-do/update',

    'POST todo' => 'to-do/create',
    'OPTIONS todo' => 'to-do/create',

    'DELETE todo/{id}' => 'to-do/delete',
    'OPTIONS todo/{id}' => 'to-do/delete',

    'DELETE todo/delete-all' => 'to-do/delete-all',
    'OPTIONS todo/delete-all' => 'to-do/delete-all',

];