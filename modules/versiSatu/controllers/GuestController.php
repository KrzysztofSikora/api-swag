<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\modules\versiSatu\models\forms\RegisterForm;
use yii\filters\AccessControl;
use app\modules\versiSatu\models\forms\LoginForm;
use app\modules\versiSatu\models\User;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\web\Response;

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

    public function actionUsers()
    {
        $params = Yii::$app->params;

        $user = User::find()->all();
        $result = $user;

        return $this->apiItem($result);

    }

    /**
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
     * Register
     *
     * @return mixed
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
