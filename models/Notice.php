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
    protected $types;
    /**
     * @var array
     */
    protected static $list = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice';
    }

    public static function getListByCode($code)
    {
        if (!isset(self::$list[$code])) {
            self::$list[$code] = static::find()->where(['code' => $code])->orderBy('created')->all();
        }
        return self::$list[$code];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'from_user_id', 'title', 'types'], 'required'],
            [['from_user_id', 'to_user_id'], 'integer'],
            [['text'], 'string'],
            [['created', 'types'], 'safe'],
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
            'types' => 'Типы',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateTypes();
        parent::afterSave($insert, $changedAttributes);
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

    public function getTypes()
    {
        return $this->hasMany(NoticeType::className(), ['id' => 'notice_type_id'])->viaTable('notice_type_rel', ['notice_id' => 'id']);
    }

    public function updateTypes()
    {
        NoticeTypeRel::deleteAll(['and', 'notice_id' => $this->id, ['not in', 'notice_type_id', $this->types]]);
        $typeList = NoticeTypeRel::getListByNoticeId($this->id);
        $exist = [];
        foreach ($typeList as $type) {
            $exist[] = $type->notice_type_id;
        }
        $newTypes = array_diff($this->types, $exist);
        foreach ($newTypes as $typeId) {
            $typeRel = new NoticeTypeRel();
            $typeRel->notice_id = $this->id;
            $typeRel->notice_type_id = $typeId;
            $typeRel->save();
        }
    }
}
