<?php
namespace app\modules\versiSatu\services;


use app\modules\versiSatu\models\ToDo;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Created by PhpStorm.
 * User: krzysztof
 * Date: 13.08.19
 * Time: 20:33
 */

class ToDoService
{
    /**
     * @param string $id
     * @return ToDo|null
     * @throws NotFoundHttpException
     */
    public function findModel(string $id): Todo
    {
        $user = Yii::$app->user->identity;
        $user_id = $user->getId();

        $model = ToDo::find()->where(['id'=>$id])->andWhere(['user_id' => $user_id])->one();
        //@todo add user id
        if($model !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Resource not found');
        }
    }
}