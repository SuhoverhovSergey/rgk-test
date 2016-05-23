<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "notice_type_rel".
 *
 * @property integer $id
 * @property integer $notice_id
 * @property integer $notice_type_id
 *
 * @property NoticeType $noticeType
 * @property Notice $notice
 */
class NoticeTypeRel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_type_rel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notice_id', 'notice_type_id'], 'required'],
            [['notice_id', 'notice_type_id'], 'integer'],
            [['notice_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NoticeType::className(), 'targetAttribute' => ['notice_type_id' => 'id']],
            [['notice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Notice::className(), 'targetAttribute' => ['notice_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notice_id' => 'Notice ID',
            'notice_type_id' => 'Notice Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticeType()
    {
        return $this->hasOne(NoticeType::className(), ['id' => 'notice_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotice()
    {
        return $this->hasOne(Notice::className(), ['id' => 'notice_id']);
    }
}
