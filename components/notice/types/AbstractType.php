<?php

namespace app\components\notice\types;

use yii\base\Event;
use app\models\Notice;

abstract class AbstractType
{
    /**
     * @var Notice
     */
    protected $notice;
    /**
     * @var Event
     */
    protected $event;

    public function __construct(Notice $notice, Event $event)
    {
        $this->notice = $notice;
        $this->event = $event;
    }

    public function prepareData($data)
    {
        $sender = $this->event->sender;
        $params = $sender->getNoticeParams();
        foreach ($params as $name => $value) {
            $data = str_replace('{' . $name . '}',  $value, $data);
        }
        return $data;
    }

    public function getPreparedData()
    {
        $notice = $this->notice;
        $title = $this->prepareData($notice->title);
        $text = $this->prepareData($notice->text);

        return [
            'title' => $title,
            'text' => $text,
            'from_user_id' => $notice->from_user_id,
            'user_id' => $notice->to_user_id,
        ];
    }

    abstract public function sendNotification();
}