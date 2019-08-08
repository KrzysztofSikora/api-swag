<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use InstagramScraper\Instagram;
use yii\filters\AccessControl;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class BotController extends Controller
{

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                // restrict access to
                'Origin' => ['http://192.168.0.108','http://localhost:3000','*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'OPTIONS', '*'],
                // Allow only POST and PUT methods
                'Access-Control-Request-Headers' => ['*'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Allow-Credentials' => null,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 86400,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        return $behaviors ;
    }

    /**
     * @SWG\Definition(
     *   definition="Bot",
     *   type="object",
     *   required={"name", "description", "version", "baseUrl"},
     *   allOf={
     *     @SWG\Schema(
     *       @SWG\Property(property="name", type="string", description="Name App"),
     *       @SWG\Property(property="description", type="string", description="Detail Information App"),
     *       @SWG\Property(property="version", type="string", description="Version APP"),
     *       @SWG\Property(property="baseUrl", type="string", description="Base Url APP")
     *     )
     *   }
     * )
     */
    public function actionIndex()
    {
        return [
            '0' => ["content" => "Something 1", "done" => true, "id" => 0],
            '1' => ["content" => "Something 2", "done" => false, "id" => 1],
            '2' => ["content" => "Something 3", "done" => true, "id" => 2],
            '3' => ["content" => "Something 4", "done" => true, "id" => 3],
            '4' => ["content" => "Something 5", "done" => true, "id" => 4],

        ];
    }

}
