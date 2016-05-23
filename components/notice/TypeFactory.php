<?php

namespace app\components\notice;

use yii\base\Event;
use app\models\Notice;

class TypeFactory
{
    /**
     * @var array
     */
    protected static $types = [
        'email' => types\EmailType::class,
        'browser' => types\BrowserType::class,
    ];

    /**
     * @param $type
     * @param Notice $notice
     * @param Event $event
     * @return types\AbstractType|null
     */
    public static function createType($type, Notice $notice, Event $event)
    {
        $baseClass = types\AbstractType::class;
        $targetClass = self::$types[$type] ?? null;
        if ($targetClass && class_exists($targetClass) && is_subclass_of($targetClass, $baseClass)) {
            return new $targetClass($notice, $event);
        }
        return null;
    }
}