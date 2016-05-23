<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\db\ActiveRecord;
use app\components\notice;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 */
class Article extends ActiveRecord implements notice\EventInterface
{
    const SHORT_TEXT_LENGTH = 200;

    const EVENT_NOTICE_CREATE_ARTICLE = 'createArticle';
    const EVENT_NOTICE_UPDATE_ARTICLE = 'updateArticle';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function getNoticeParams()
    {
        return [
            'articleName' => $this->title,
            'moreLink' => Html::a('Читать далее', ['/article/view', 'id' => $this->id]),
            'shortText' => mb_substr($this->text, 0, self::SHORT_TEXT_LENGTH),
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->trigger($insert ? self::EVENT_NOTICE_CREATE_ARTICLE : self::EVENT_NOTICE_UPDATE_ARTICLE);
    }
}
