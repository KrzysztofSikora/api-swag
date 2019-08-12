<?php

namespace app\modules\versiSatu\models;

use Yii;












/**
 * @SWG\Definition(
 *   definition="Messages",
 *   type="object",
 *   required={"author", "message"},
 *   @SWG\Property(property="author", type="string"),
 *   @SWG\Property(property="message", type="string")
 * )
 */

/**
 * @SWG\Definition(
 *   definition="CreateMessages",
 *   type="object",
 *   required={"author", "message"},
 *   allOf={
 *       @SWG\Schema(ref="#/definitions/DefMessages"),
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
 * @property int $author
 * @property string $message
 * @property string $priority
 * @property string $created_at
 * @property string $updated_at
 */




/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property string $author
 * @property string $message
 * @property string $created_at
 * @property string $updated_at
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author'], 'string'],
            [['message'], 'string'],
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
            'author' => 'Author',
            'message' => 'Message',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
