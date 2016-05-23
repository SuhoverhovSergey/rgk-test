<?php

namespace app\components\notice\types;

use Yii;
use app\models;

class EmailType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function sendNotification()
    {
        $data = $this->getPreparedData();
        $userFrom = models\User::findIdentity($data['from_user_id']);

        if (!empty($data['user_id'])) {
            $userTo = models\User::findIdentity($data['user_id']);
            Yii::$app->mailer->compose()
                ->setFrom($userFrom->username)
                ->setTo($userTo->username)
                ->setSubject($data['title'])
                ->setHtmlBody($data['text'])
                ->send();
        } else {
            $messages = [];
            $users = models\User::getList();
            /** @var models\User $user */
            foreach ($users as $user) {
                if ($data['from_user_id'] != $user->id) {
                    $messages[] = Yii::$app->mailer->compose()
                        ->setFrom($userFrom->username)
                        ->setTo($user->username)
                        ->setSubject($data['title'])
                        ->setHtmlBody($data['text']);
                }
            }
            Yii::$app->mailer->sendMultiple($messages);
        }
    }
}