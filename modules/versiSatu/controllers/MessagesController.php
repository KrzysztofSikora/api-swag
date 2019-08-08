<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\models\Messages;
use app\models\ToDo;
use yii\filters\AccessControl;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\web\NotFoundHttpException;

class MessagesController extends Controller
{
    public function behaviors() {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['http://192.168.0.108','http://localhost:3000','*'],
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
     *   definition="DefMessages",
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
        $toDos = Messages::find()
            ->orderBy('id')
            ->all();
        return $this->apiCollection($toDos);
    }

    public function actionGetOne(string $id)
    {
        $toDos = Messages::findOne($id);
        return $this->apiCollection($toDos);
    }


    /**
     * @param string $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionUpdate(string $id): array
    {
        $dataRequest['Messages'] = Yii::$app->request->post();
        $model = $this->findModel($id);
        if($model->load($dataRequest)) {

            $model->updated_at = date("Y-m-d H:i:s");
            if($model->save()) {
                return $this->apiUpdated($model);

            } else {
                return $this->apiValidate($model->errors);

            }
        }

    }

    /**
     * @return array
     */
    public function actionCreate(): array
    {
        $dataRequest['Messages'] = Yii::$app->request->post();
        $model = new Messages();
        if($model->load($dataRequest)) {
            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");
            if($model->save()) {
                return $this->apiCreated($model);
            } else {
                return $this->apiValidate($model->errors);
            }
        }

    }

    /**
     * @param string $id
     * @return array
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(string $id): array
    {
        if($this->findModel($id)->delete()) {
            return $this->apiDeleted(true);
        }
        return $this->apiDeleted(false);
    }

    /**
     * @return array
     */
    public function actionDeleteAll(): array
    {
        if(ToDo::deleteAll()) {
            return $this->apiDeleted(true);
        }
        return $this->apiDeleted(false);
    }




    //@todo move this method to services

    /**
     * @param string $id
     * @return Messages|null
     * @throws NotFoundHttpException
     */
    protected function findModel(string $id)
    {
        if(($model = Messages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Resource not found');
        }
    }


}
