<?php

$host = getenv('MYSQL_HOST');
$dbname = getenv('MYSQL_DATABASE');

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host=localhost;dbname=yii2basic",
    'username' => 'root',
    'password' => 'cr2032',
    'charset' => 'utf8',
];