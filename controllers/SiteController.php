<?php

namespace app\controllers;

use app\models\Companies;
use app\models\User;
use Codeception\Exception\ElementNotFound;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionCompanies()
    {
        if(Yii::$app->user->getIsGuest()) {
            return $this->redirect(['site/login']);
        }

        $companies = Companies::find()->orderBy('name')->all();
        return $this->render('companies', ['companies' => $companies]);
    }

    public function actionCompany($id = null)
    {
        if(Yii::$app->user->getIsGuest()) {
            return $this->redirect(['site/login']);
        }

        if($id == null) {
            $this->redirect(['site/companies']);
        }

        $company = Companies::findOne(['id' => $id]);

        if(!$company) {
            $this->redirect(['site/companies']);
        }

        return $this->render('company', ['company' => $company]);
    }

    public function actionSave($id = null)
    {
        if(Yii::$app->user->getIsGuest() || $id == null || !Yii::$app->user->identity->isAdmin()) {
            throw new NotFoundHttpException();
        }

        $company = Companies::findOne(['id' => $id]);
        if(!$company) {
            throw new NotFoundHttpException();
        }

        $request = Yii::$app->request;

        $company->name = $request->post('companyName');
        $company->inn = $request->post('companyINN');
        $company->director = $request->post('companyDirector');
        $company->address = $request->post('companyAddress');
        $company->save();
    }

    public function actionCreate()
    {
        if(Yii::$app->user->getIsGuest() || !Yii::$app->user->identity->isAdmin()) {
            throw new NotFoundHttpException();
        }

        $company = new Companies();

        $request = Yii::$app->request;

        $company->name = $request->post('companyName');
        $company->inn = $request->post('companyINN');
        $company->director = $request->post('companyDirector');
        $company->address = $request->post('companyAddress');
        $company->save();

        $response = Yii::$app->response;
        $response->setStatusCode(201);
        $response->content = $company->id;
        $response->send();
    }

    public function actionUsers()
    {
        if(Yii::$app->user->getIsGuest() || !Yii::$app->user->identity->isAdmin()) {
            return $this->redirect(['site/index']);
        }

        $users = User::find()->orderBy('username')->all();
        return $this->render('users', ['users' => $users]);
    }

    public function actionUser($id = null)
    {
        if(Yii::$app->user->getIsGuest()) {
            return $this->redirect(['site/login']);
        }

        if($id == null) {
            $this->redirect(['site/users']);
        }

        $user = User::findOne(['id' => $id]);

        if(!$user) {
            $this->redirect(['site/users']);
        }

        return $this->render('user', ['user' => $user]);
    }

    public function actionSaveuser($id = null)
    {
        if(Yii::$app->user->getIsGuest() || $id == null || !Yii::$app->user->identity->isAdmin()) {
            throw new NotFoundHttpException();
        }

        $user = User::findOne(['id' => $id]);
        if(!$user) {
            throw new NotFoundHttpException();
        }

        $request = Yii::$app->request;

        $user->username = $request->post('username');
        $user->password = $request->post('password');
        $user->role = $request->post('role');
        $user->save();
    }
}
