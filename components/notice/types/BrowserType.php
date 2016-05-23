<?php

namespace app\components\notice\types;

use app\models;

class BrowserType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function sendNotification()
    {
        $data = $this->getPreparedData();
        if (!empty($data['user_id'])) {
            $userNotice = new models\UserNotice($data);
            $userNotice->save();
        } else {
            $users = models\User::getList();
            /** @var models\User $user */
            foreach ($users as $user) {
                if ($data['from_user_id'] != $user->id) {
                    $userNotice = new models\UserNotice($data);
                    $userNotice->user_id = $user->id;
                    $userNotice->save();
                }
            }
        }
    }
}