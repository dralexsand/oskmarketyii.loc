<?php

namespace frontend\controllers;

use frontend\models\Profiles;
use Yii;
use yii\web\Controller;
//use frontend\models\Profiles;

class AjaxController extends Controller
{

    /*public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /*public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }*/

    public function beforeAction($action)
    {
        if ($action->id = 'request') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return '';
    }

    public function actionRequest()
    {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post()['param'];

            $action = $post['action'];

            switch ($action){
                case 'delete_user':
                    $id = $post['id'];
                    $result = Profiles::deleteProfile($id);
                    break;

                case 'add_user':
                    $result = Profiles::createProfile();
                    break;
            }

            return Profiles::getTable();
        }

        /*$param = Yii::$app->request->post('param');
        echo json_encode($param);*/
    }






}

?>