<?php

namespace app\modules\ModUsuarios\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\ModUsuarios\models\EntUsuarios;
use app\models\EntLeads;
use app\modules\ModUsuarios\models\Utils;

class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'dash-board',
                    'logout',
                    'ver-leads',
                    'add-lead',
                    'list-add-lead'
                    ],
                'rules' => [
                    [
                        'actions' => [
                            'dash-board',                    
                            'logout',
                            'ver-leads',
                            'add-lead',
                            'list-add-lead'
                            ],
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
     * @inheritdoc
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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
    * Dashboard
    */
    public function actionDashBoard(){
        $idUsuario = Yii::$app->user->identity->id_usuario;
        // @todo mandar cuantas leads completos e incompletos tiene el usuario
        return $this->render("dash-board");
    }

    public function actionListAddLead(){
        $idUser = Yii::$app->user->identity->id_usuario;
        $empresas = EntUsuarios::find()->where(['b_habilitado'=>1])->andWhere(['!=', 'id_usuario', $idUser])->orderBy('txt_username')->all();
        return $this->render("list-add-lead", [
            'empresas' => $empresas
        ]);
    }

    public function actionGetLead(){

        return $this->render("get-lead");
    }

    public function actionAddLead(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $lead = new EntLeads();
        $idUser = Yii::$app->user->identity->id_usuario;

        if(isset($_POST['telefono']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['destino'])){
            $lead->id_usuario_lead_destino = $_POST['destino'];
            $lead->id_usuario_lead_origen = $idUser;
            $lead->txt_descripcion = $_POST['descripcion'];
            $lead->txt_token = "lead_" . md5 ( uniqid ( "lead_" ) ) . uniqid ();;
            $lead->txt_nombre_contacto = $_POST['nombre'];
            $lead->txt_numero_contacto = $_POST['telefono'];
            $lead->b_habilitado = 1;

            if($lead->save()){
                if($this->primerEmail($lead->txt_token)){
                    return ['status'=>'success'];
                }
            }else{
                return ['status'=>'error'];
            }
        }
    }

    private function primerEmail($token = null){
        $lead = EntLeads::find()->where(['txt_token'=>$token])->one();
        $user = EntUsuarios::find()->where(['id_usuario'=>$lead->id_usuario_lead_destino])->one();

        // Enviar correo de activación
		$utils = new Utils();
		// Parametros para el email
		$parametrosEmail = [
            'url' => Yii::$app->urlManager->createAbsoluteUrl(['modUsuarios/site/ver-leads?token=' . $lead->txt_token ]),
		    'user' => $user->getNombreCompleto(),
            'nombre_contacto' => $lead->txt_nombre_contacto,
            'numero_contacto' => $lead->txt_numero_contacto,
            'descripcion' => $lead->txt_descripcion
        ];

		// Envio de correo electronico
		if($utils->sendPrimerEmail($user->txt_email,$parametrosEmail)){
            return true;
        }else{
            return false;
        }
        
    }

    public function actionVerLeads($token = null){
        $lead = EntLeads::find()->where(['txt_token'=>$token])->andWhere(['b_habilitado'=>1])->andWhere(['b_atendido'=>0])->one();
        $idUser = Yii::$app->user->identity->id_usuario;

        return $this->render("view-lead",[
            'lead' => $lead,
            'idUser' => $idUser
        ]);        
    }

    public function actionAtenderLead($token = null){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $lead = EntLeads::find()->where(['txt_token'=>$token])->andWhere(['b_habilitado'=>1])->andWhere(['b_atendido'=>0])->one();
        $user = EntUsuarios::find()->where(['id_usuario'=>$lead->id_usuario_lead_origen])->one();

        if($lead){
            $lead->b_habilitado = 0;
            $lead->b_atendido = 1;
            $lead->fch_atencion_lead = date('Y-m-d g:i:s');
            if($lead->save()){
                // Enviar correo de activación
                $utils = new Utils();
                // Parametros para el email
                $parametrosEmail = [
                    'user' => $user->getNombreCompleto(),
                    'nombre_contacto' => $lead->txt_nombre_contacto,
                    'numero_contacto' => $lead->txt_numero_contacto,
                    'descripcion' => $lead->txt_descripcion
                ];

                // Envio de correo electronico
                if($utils->sendEmailAtendido($user->txt_email,$parametrosEmail)){

                    return [
                        'status' => 'success'
                    ];
                }
            }
        }
        return [
            'status' => 'error'
        ]; 
    }
}
