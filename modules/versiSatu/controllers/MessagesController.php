<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\modules\versiSatu\models\Messages;
use app\modules\versiSatu\models\ToDo;
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

    /**
     * @SWG\Get(
     *   path="/v1/messages",
     *   summary="messages app",
     *   tags={"Messages"},
     *   @SWG\Response(
     *     response=200,
     *     description="Detail Information ToDo App",
     *     @SWG\Schema(ref="#/definitions/About")
     *   ),
     *  @SWG\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @SWG\Schema(ref="#/definitions/Unauthorized")
     *     )
     * )
     */

    public function actionIndex()
    {
        $toDos = Messages::find()
            ->orderBy('id')
            ->all();
        return $this->apiCollection($toDos);
    }


    /**
     * @SWG\Get(
     *   path="/v1/messages/{id}",
     *   summary="get one messages item",
     *   tags={"Messages"},
     *   @SWG\Parameter(
     *        ref="#/parameters/id"
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="Detail Information messages App",
     *     @SWG\Schema(ref="#/definitions/About")
     *   ),
     *  @SWG\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @SWG\Schema(ref="#/definitions/Unauthorized")
     *     )
     * )
     */

    public function actionGetOne(string $id)
    {
        $toDos = Messages::findOne($id);
        return $this->apiCollection($toDos);
    }


    /**
     * @SWG\Put(
     *     path="/v1/messages/{id}",
     *     summary="messages app update",
     *     tags={"Messages"},
     *     @SWG\Parameter(
     *         ref="#/parameters/id"
     *     ),
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Create new messages item",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/ToDo"),
     *     ),
     *     @SWG\Response(
     *         response=202,
     *         description="Messages"
     *
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @SWG\Schema(ref="#/definitions/ErrorValidate")
     *     )
     * )
     *
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
     * @SWG\Post(
     *     path="/v1/messages",
     *     summary="Create messages item",
     *     tags={"Messages"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Create new Messages item",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/Messages"),
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Data news",
     *         @SWG\Schema(ref="#/definitions/CreateMessages")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @SWG\Schema(ref="#/definitions/ErrorValidate")
     *     )
     * )
     *
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
     * @SWG\Delete(
     *     path="/v1/messages/{id}",
     *     summary="Delete messages item",
     *     tags={"Messages"},
     *     @SWG\Parameter(
     *         ref="#/parameters/id"
     *     ),
     *     @SWG\Response(
     *         response=202,
     *         description="Status Delete",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Resource not found",
     *         @SWG\Schema(ref="#/definitions/Not Found")
     *     )
     * )
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
     * @SWG\Delete(
     *     path="/v1/messages/delete-all",
     *     summary="Delete messages all items",
     *     tags={"Messages"},
     *     @SWG\Response(
     *         response=202,
     *         description="Status Delete",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Resource not found",
     *         @SWG\Schema(ref="#/definitions/Not Found")
     *     )
     * )
     *
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
