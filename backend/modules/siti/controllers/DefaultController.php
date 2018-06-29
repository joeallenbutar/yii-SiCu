<?php

namespace backend\modules\siti\controllers;

use Yii;
use yii\web\Controller;
use backend\modules\siti\models\LoginForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\modules\siti\models\SignupForm;


class DefaultController extends Controller
{
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
      // if (!Yii::$app->user->isGuest) {
      //     return $this->goHome();
      // }
      // $this->layout = 'loginLayout';
      // $model = new LoginForm();
      // if ($model->load(Yii::$app->request->post()) && $model->login()) {
      //     return $this->redirect(['/siti/default/index']);
      // } else {
      //         'model' => $model,
      //     return $this->render('login', [
      //     ]);
      // }
      return $this->render('index');
    }

    public function actionWarning()
    {
        return $this->render('warning');
    }

     public function actionCuti(){
        return $this->render('cuti');
    }

     public function actionIzin(){
        return $this->render('izin');
     }

     public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'loginLayout';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/siti/default/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionSignup()
    {
//        if (Yii::$app->user->id != 4) {
//            return $this->redirect(['/site/index']);
//
//        }


        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                    return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

     public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionChangePassword()
    {
    $id = \Yii::$app->user->id;

    try {
        $model = new \backend\modules\siti\models\ChangePasswordForm($id);
    } catch (InvalidParamException $e) {
        throw new \yii\web\BadRequestHttpException($e->getMessage());
    }

    if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
        \Yii::$app->session->setFlash('success', 'Password Changed!');
    }

    return $this->render('changePassword', [
        'model' => $model,
    ]);
    }
}

//$model = new SignupForm();
//        $model2 = new \backend\modules\siti\models\TJenisCuti;
//        if ($model->load(Yii::$app->request->post())&&$model2->load(Yii::$app->request->post())) {
//            $model2->nama_cuti=$_POST['TJenisCuti']['nama_cuti'];
//            $model2->lama_cuti=5;
//            $model2->keterangan='gitulah';
//            $model2->save();
//            if ($user = $model->signup()) {
//                    return $this->goHome();
