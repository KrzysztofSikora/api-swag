<?php

namespace app\modules\versiSatu\models;

use Yii;

/**
 * @SWG\Definition(
 *   definition="ToDo",
 *   type="object",
 *   required={"done", "content"},
 *   @SWG\Property(property="done", type="integer"),
 *   @SWG\Property(property="content", type="string")
 * )
 */

/**
 * @SWG\Definition(
 *   definition="CreateToDo",
 *   type="object",
 *   required={"done", "content"},
 *   allOf={
 *       @SWG\Schema(ref="#/definitions/DefToDo"),
 *       @SWG\Schema(
 *           required={"id"},
 *           @SWG\Property(property="id", format="int64", type="integer")
 *       )
 *   }
 * )
 */


/**
 * This is the model class for table "todo".
 *
 * @property int $id
 * @property int $done
 * @property string $content
 * @property string $priority
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 * @property User $user

 */
class ToDo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'todo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['done', 'user_id'], 'integer'],
            [['content', 'priority'], 'string'],
            [['created_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'done' => 'Done',
            'priority' => 'Priority',
            'user_id' => 'User_Id',
            'content' => 'Content',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id']);
    }
}
