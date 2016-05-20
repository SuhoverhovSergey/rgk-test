<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "notice".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $from_user_id
 * @property integer $to_user_id
 * @property string $title
 * @property string $text
 * @property string $type
 * @property string $created
 *
 * @property User $toUser
 * @property User $fromUser
 */
class Notice extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'from_user_id', 'title', 'type'], 'required'],
            [['from_user_id', 'to_user_id'], 'integer'],
            [['text'], 'string'],
            [['created'], 'safe'],
            [['name', 'code', 'title', 'type'], 'string', 'max' => 255],
            [['to_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['to_user_id' => 'id']],
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
            'name' => 'Name',
            'code' => 'Code',
            'from_user_id' => 'From User ID',
            'to_user_id' => 'To User ID',
            'title' => 'Title',
            'text' => 'Text',
            'type' => 'Type',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToUser()
    {
        return $this->hasOne(User::className(), ['id' => 'to_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromUser()
    {
        return $this->hasOne(User::className(), ['id' => 'from_user_id']);
    }
}