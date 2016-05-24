<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Role;
use app\filters\AccessRule;

class BaseController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'controllers' => ['site'],
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'controllers' => ['site'],
                        'actions' => ['index', 'logout', 'viewed'],
                        'allow' => true,
                        'roles' => [Role::ROLE_USER],
                    ],
                    [
                        'controllers' => ['article'],
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [Role::ROLE_USER],
                    ],
                    [
                        'controllers' => ['article', 'notice'],
                        'allow' => true,
                        'roles' => [Role::ROLE_ADMIN],
                    ],
                ],
            ],
        ];
    }
}