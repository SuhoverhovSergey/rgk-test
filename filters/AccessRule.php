<?php

namespace app\filters;

use app\models\Role;

class AccessRule extends \yii\filters\AccessRule
{
    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@' || $role === Role::ROLE_USER) {
                if (!$user->getIsGuest()) {
                    return true;
                }
            } elseif (!$user->getIsGuest() && $role == $user->getIdentity()->role_id) {
                return true;
            } elseif ($user->can($role)) {
                return true;
            }
        }

        return false;
    }
}