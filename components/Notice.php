<?php

namespace app\components;

use Yii;
use yii\base\Event;
use yii\base\Component;
use yii\base\BootstrapInterface;
use yii\helpers\FileHelper;
use app\models;
use app\components\notice\TypeFactory;
use app\components\notice\types\AbstractType;

class Notice extends Component implements BootstrapInterface
{
    /**
     * @var array
     */
    protected $events = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->getEvents();
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        foreach ($this->events as $class => $events) {
            foreach ($events as $eventName) {
                Event::on($class, $eventName, function ($event) use ($eventName) {
                    $noticeList = models\Notice::getListByCode($eventName);
                    if ($noticeList) {
                        /** @var models\Notice $notice */
                        foreach ($noticeList as $notice) {
                            $noticeTypes = $notice->types;
                            /** @var models\NoticeType $noticeType */
                            foreach ($noticeTypes as $noticeType) {
                                /** @var AbstractType $noticeType */
                                $noticeType = TypeFactory::createType($noticeType->name, $notice, $event);
                                $noticeType->sendNotification();
                            }
                        }
                    }
                });
            }
        }
    }

    public function getEvents()
    {
        if (empty($this->events)) {
            $modelsDir = Yii::getAlias('@app/models');
            $files = FileHelper::findFiles($modelsDir);

            $events = [];
            foreach ($files as $file) {
                $className = 'app\models\\' . basename($file, '.php');
                $constants = (new \ReflectionClass($className))->getConstants();
                foreach ($constants as $constant => $value) {
                    if (preg_match('/^EVENT_NOTICE_.+$/', $constant)) {
                        $events[$className][$constant] = $value;
                    }
                }
            }

            $this->events = $events;
        }
        return $this->events;
    }

    public function prepareEventsDataForSelect()
    {
        $noticeEvents = $this->getEvents();
        $data = [];
        foreach ($noticeEvents as $class => $events) {
            foreach ($events as $eventName) {
                $data[$eventName] = $eventName;
            }
        }
        return $data;
    }

    public function getEventsParams()
    {
        $noticeEvents = $this->getEvents();
        $params = [];
        foreach ($noticeEvents as $class => $events) {
            $eventObject = new $class;
            foreach ($events as $eventName) {
                $params[$eventName] = array_keys($eventObject->getNoticeParams());
            }
        }
        return $params;
    }
}