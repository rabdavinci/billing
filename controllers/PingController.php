<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class PingController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
			            'actions' => ['index'],
			            'allow' => true,
			            'roles' => ['@'],
			        ],
			    ],
			],
		];
	}

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * pong.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::$app->response->statusCode = 201;

        $obj = new \stdClass();
        $obj->request = 'ping';
        $obj->response =  Yii::$app->response->statusCode;
        
        return json_encode($obj);
    }
}
