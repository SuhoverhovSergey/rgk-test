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

    public static function getListByCode($code)
    {
        return static::find()->where(['code' => $code])->orderBy('created')->all();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'from_user_id', 'title'], 'required'],
            [['from_user_id', 'to_user_id'], 'integer'],
            [['text'], 'string'],
            [['created'], 'safe'],
            [['name', 'code', 'title'], 'string', 'max' => 255],
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
            'name' => 'Название',
            'code' => 'Код события',
            'from_user_id' => 'От кого',
            'to_user_id' => 'Кому',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'created' => 'Дата создания',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticeTypeRels()
    {
        return $this->hasMany(NoticeTypeRel::className(), ['notice_id' => 'id']);
    }
}
