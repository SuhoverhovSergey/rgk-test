<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "notice_type".
 *
 * @property integer $id
 * @property string $name
 *
 * @property NoticeTypeRel[] $noticeTypeRels
 */
class NoticeType extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice_type';
    }

    public static function getList()
    {
        return self::find()->orderBy('name')->all();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoticeTypeRels()
    {
        return $this->hasMany(NoticeTypeRel::className(), ['notice_type_id' => 'id']);
    }
}
