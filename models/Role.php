<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "role".
 *
 * @property integer $id
 * @property string $name
 *
 * @property User[] $users
 */
class Role extends ActiveRecord
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'name' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['role_id' => 'id']);
    }
}
