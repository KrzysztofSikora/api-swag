<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use Yii;

class AuthController extends Controller
{

    /**
     * @SWG\Get(
     *   path="/v1/me",
     *   summary="Get current user",
     *   tags={"Auth"},
     *   @SWG\Response(
     *     response=200,
     *     description="Data user",
     *     @SWG\Schema(ref="#/definitions/CurrentUser")
     *   ),
     *   @SWG\Response(
     *     response=401,
     *     description="Unauthorized",
     *     @SWG\Schema(ref="#/definitions/Unauthorized")
     *   )
     * )
     */


    //@todo mapper for all records
    public function actionMe()
    {
        $user = Yii::$app->user->identity;

        /* remove token */
        unset($user['token']);

        return $this->apiItem($user->todo);
    }
}
