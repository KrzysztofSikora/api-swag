<?php
require(__DIR__ . '/../vendor/autoload.php');

// load .env
$env = __DIR__ . '/../';


//var_dump((new Dotenv\Dotenv($env))->load());
//die();

if(getenv('APP_ENV') !== 'production') {
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}
define("API_HOST", getenv('API_HOST'));

require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
