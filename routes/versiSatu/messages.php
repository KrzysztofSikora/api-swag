<?php

return [

    'GET messages' => 'messages/index',
    'OPTIONS messages' => 'messages/index',

    'GET messages/{id}' => 'messages/get-one',
    'OPTIONS messages/{id}' => 'messages/get-one',

    'PUT messages/{id}' => 'messages/update',
    'OPTIONS messages/{id}' => 'messages/update',

    'POST messages' => 'messages/create',
    'OPTIONS messages' => 'messages/create',

    'DELETE messages/{id}' => 'messages/delete',
    'OPTIONS messages/{id}' => 'messages/delete',

    'DELETE messages/delete-all' => 'messages/delete-all',
    'OPTIONS messages/delete-all' => 'messages/delete-all',

];