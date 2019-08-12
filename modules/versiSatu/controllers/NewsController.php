<?php

namespace app\modules\versiSatu\controllers;

use app\components\Controller;
use app\modules\versiSatu\models\News;
use yii\web\NotFoundHttpException;
use Yii;

class NewsController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/v1/news",
     *     summary="Get list news",
     *     tags={"News"},
     *     @SWG\Response(
     *         response=200,
     *         description="News",
     *         @SWG\Schema(
     *            type="array",
     *            @SWG\Items(ref="#/definitions/News")
     *         )
     *     ),
     *     @SWG\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @SWG\Schema(ref="#/definitions/Unauthorized")
     *     )
     * )
     */

    public function actionIndex()
    {
        $news = News::find()
            ->orderBy('id')
            ->all();

        return $this->apiCollection($news);
    }

    /**
     * @SWG\Post(
     *     path="/v1/news",
     *     summary="Create data news",
     *     tags={"News"},
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Data News",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/CreateNews"),
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="Data news",
     *         @SWG\Schema(ref="#/definitions/News")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @SWG\Schema(ref="#/definitions/ErrorValidate")
     *     )
     * )
     */

    public function actionCreate()
    {
        $dataRequest['News'] = Yii::$app->request->getBodyParams();
        $model = new News();
        throw new NotFoundHttpException('Resource not found');
        if($model->load($dataRequest) && $model->save()) {
            return $this->apiCreated($model);
        }

        return $this->apiValidate($model->errors);
    }

    /**
     * @SWG\Put(
     *     path="/v1/news/{id}",
     *     summary="Update data news",
     *     tags={"News"},
     *     @SWG\Parameter(
     *         ref="#/parameters/id"
     *     ),
     *     @SWG\Parameter(
     *         name="body",
     *         in="body",
     *         description="Data News",
     *         required=true,
     *         @SWG\Schema(ref="#/definitions/UpdateNews"),
     *     ),
     *     @SWG\Response(
     *         response=202,
     *         description="Data news",
     *         @SWG\Schema(ref="#/definitions/News")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="ValidateErrorException",
     *         @SWG\Schema(ref="#/definitions/ErrorValidate")
     *     )
     * )
     */

    public function actionUpdate($id)
    {
        $dataRequest['News'] = Yii::$app->request->getBodyParams();
        $model = $this->findModel($id);
        if($model->load($dataRequest) && $model->save()) {
            return $this->apiUpdated($model);
        }

        return $this->apiValidate($model->errors);
    }

    /**
     * @SWG\Get(
     *     path="/v1/news/{id}",
     *     summary="Get data news",
     *     tags={"News"},
     *     @SWG\Parameter(
     *         ref="#/parameters/id"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="Data news",
     *         @SWG\Schema(ref="#/definitions/News")
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Resource not found",
     *         @SWG\Schema(ref="#/definitions/Not Found")
     *     )
     * )
     */

    public function actionView($id)
    {
        return $this->apiItem($this->findModel($id));
    }

    /**
     * @SWG\Delete(
     *     path="/v1/news/{id}",
     *     summary="Delete data news",
     *     tags={"News"},
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
     */

    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()) {
            return $this->apiDeleted(true);
        }
        return $this->apiDeleted(false);
    }

    protected function findModel($id)
    {
        if(($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Resource not found');
        }
    }
}
