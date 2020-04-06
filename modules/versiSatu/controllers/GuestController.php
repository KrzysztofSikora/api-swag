<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\modules\versiSatu\models\forms\RegisterForm;
use app\modules\versiSatu\models\forms\LoginForm;
use app\modules\versiSatu\models\User;
use Yii;
use yii\filters\auth\HttpBearerAuth;

class GuestController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
            'only' => ['index'],
        ];

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['http://192.168.0.108','http://localhost','*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'OPTIONS', '*'],
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => null,
                'Access-Control-Max-Age' => 86400,
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        return $behaviors ;
    }


    /**
     * @SWG\Definition(
     *   definition="About",
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

    /**
     * @SWG\Get(
     *   path="/v1/about",
     *   summary="About app",
     *   tags={"Guest"},
     *   @SWG\Response(
     *     response=200,
     *     description="Detail Information App",
     *     @SWG\Schema(ref="#/definitions/About")
     *   )
     * )
     */

    public function actionIndex()
    {
        $params = Yii::$app->params;
        return [
            'name' => $params['name'],
            'description' => $params['description'],
            'version' => $params['version'],
            'baseUrl' => $this->baseUrl()
        ];
    }

    /**
     * @SWG\GET(
     *     path="/v1/users",
     *     summary="Get all users",
     *     tags={"Guest"},
     *     description="Get all users",
     *     @SWG\Response(
     *         response=200,
     *         description="Data user",
     *
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *
     *     )
     * )
     */
    public function actionUsers()
    {
        $params = Yii::$app->params;

        $user = User::find()->all();
        $result = $user;

        return $this->apiItem($result);

    }



    /**
     * @SWG\Post(
     *     path="/v1/login",
     *     summary="Login to the application",
     *     tags={"Guest"},
     *     description="Login to app for get Token access",
     *     @SWG\Parameter(
     *         name="username",
     *         in="formData",
     *         type="string",
     *         description="Your Username",
     *         required=true,
     *     ),
     *     @SWG\Parameter(
     *         name="password",
     *         in="formData",
     *         type="string",
     *         description="Your Password",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="data user",
     *         @SWG\Schema(ref="#/definitions/LoginForm")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @SWG\Schema(ref="#/definitions/ErrorValidate")
     *     )
     * )
     *
     * Login
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $dataRequest['LoginForm'] = Yii::$app->request->post();
        $model = new LoginForm();
        if ($model->load($dataRequest) && ($result = $model->login())) {
            return $this->apiItem($result);
        }

        return $this->apiValidate($model->errors);
    }


    /**
     * @SWG\Post(
     *     path="/v1/register",
     *     summary="Register new user",
     *     tags={"Guest"},
     *     description="Register new user",
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Data Register",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/NewUser"),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Data user",
     *         @SWG\Schema(ref="#/definitions/LoginForm")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @SWG\Schema(ref="#/definitions/ErrorValidate")
     *     )
     * )
     * Register
     *
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public function actionRegister()
    {
        $dataRequest['RegisterForm'] = Yii::$app->request->getBodyParams();
        $model = new RegisterForm();
        if ($model->load($dataRequest)) {
            if ($user = $model->register()) {
                return $this->apiCreated($user);
            }
        }
        return $this->apiValidate($model->errors);
    }
}
