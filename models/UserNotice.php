<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_notice".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property integer $from_user_id
 * @property integer $user_id
 * @property string $created
 * @property boolean $viewed
 *
 * @property User $user
 * @property User $fromUser
 */
class UserNotice extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_notice';
    }

    /**
     * @param $id
     * @return array|null|UserNotice
     */
    public static function findById($id)
    {
        return self::find()->where(['id' => $id, 'user_id' => Yii::$app->user->identity->getId()])->one();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'from_user_id', 'user_id'], 'required'],
            [['text'], 'string'],
            [['from_user_id', 'user_id'], 'integer'],
            [['created', 'viewed'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['from_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['from_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'from_user_id' => 'От кого',
            'fromUser.username' => 'От кого',
            'user_id' => 'User ID',
            'created' => 'Дата отправки',
            'viewed' => 'Прочитано',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(User::className(), ['id' => 'from_user_id']);
    }
}
