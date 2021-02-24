<?php

namespace frontend\controllers;

use frontend\models\Mpesastkrequests;
use Yii;
use frontend\models\Payments;
use frontend\models\PaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\xyz\MpesaApi;

/**
 * PaymentsController implements the CRUD actions for Payments model.
 */
class PaymentsController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function beforeAction($action)
    {
        if ($action->id == 'ipn' ) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Payments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Payments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Payments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Payments();

    //     if (\Yii::$app->request->post()) {
    //         $response = $this->pay(\Yii::$app->request->post()['Payments']);
    //         $this->processRespose($response,\Yii::$app->request->post());
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }


   /** Mpesa intergration
     *
     * @return void|unknown
     */
    public function actionCreate()
    {
        $model = new \frontend\models\Payments();
        if (\Yii::$app->request->post()) {
            $response = $this->pay(\Yii::$app->request->post()['Payments']);
            $this->processRespose($response,\Yii::$app->request->post());
        return $this->redirect(['site/index']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function pay($postData){
        $mpesa_api = new MpesaApi();
       // var_dump($postData); exit();
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $postData['amount'];
        $PhoneNumber = $postData['phoneCode'].$postData['phoneNumber'];
        $PartyA = $postData['phoneCode'].$postData['phoneNumber'];
        $PartyB = 174379;
     //   $UserId = $postData['userId'];
        $CallBackURL = 'https://8f9a207eff0b.ngrok.io/shops/xyz/confirm?token=KUstudents51234567qwerty';
        $AccountReference =  'David';
        $TransactionDesc = 'David';
        $configs = array(
            'AccessToken' => $this->generateToken(),
            'Environment' => 'sandbox',
            'Content-Type' => 'application/json',
            'Verbose' => 'true',
        );
        $api = 'stk_push';
        $LipaNaMpesaPasskey= 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
        $timestamp ='20'.date("ymdhis");
        $BusinessShortCode = 174379;
        $parameters = array(
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => base64_encode($BusinessShortCode.$LipaNaMpesaPasskey.$timestamp),
            'Timestamp' => $timestamp,
            'TransactionType' => $TransactionType,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'PhoneNumber' =>$PhoneNumber,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc,
        );
        $response = $mpesa_api->call($api, $configs, $parameters);
        return $response;
    }
    private function generateToken(){
        $mpesa_api = new MpesaApi();
        $configs = array(
            'Environment' => 'sandbox',
            'Content-Type' => 'application/json',
            'Verbose' => '',
        );
        $api = 'generate_token';
        $parameters = array(
            'ConsumerKey' => 'GBBEh7X0ajsH8VmYoIGP4I5AEGjjWOSa',
            'ConsumerSecret' => 'M33sB1TAUc7AcP6P',
        );
        $response = $mpesa_api->call($api, $configs, $parameters);
        return $response['Response']['access_token'];
    }
    public function processRespose($response,$postData) {
        $model = new \frontend\models\Payments();

        if (array_key_exists('errorCode', $response['Response'])) {
            
            $model->load($postData);
            var_dump($model); exit();
            $model->save();
            $Msg = '<div class="alert alert-danger alert-dismissable" role="alert">
                    <h3>THE FOLLOWING ERROR HAS ACCURED WHILE TRYING TO PROCESS YOUR REQUEST</h3>
                     <h5> ERROR CODE: '.$response['Response']['errorCode'].'</h5>
                     <h6>'.$response['Response']['errorMessage'].'</h6><h6>For more information Please Contact Support Via: 0704081087</h6>
                    </div>';
            \Yii::$app->session->setFlash('error', $Msg);
            $this->redirect(['site/index']);
        }else{
            $model->load($postData);
            if (array_key_exists('MerchantRequestID', $response['Response'])) {
                $model->MerchantRequestID = $response['Response']['MerchantRequestID'];
                $this->saveRequestData($response,$postData['Payments']['orderId']);
            }
            $model->save();
            $Msg = '<div class="alert alert-success alert-dismissable" role="alert">
                            <h5> '.$response['Response']['CustomerMessage'].'</h5>
                          </div>';
            \Yii::$app->session->setFlash('success', $Msg);
            $this->redirect(['site/index']);
        }
    }
    public function saveRequestData($response,$orderId){
        $model = new \frontend\models\MpesaStkRequests();
        $model->amount = $response['Parameters']['Amount'];
        $model->phone = $response['Parameters']['PhoneNumber'];
        $model->reference = $response['Parameters']['AccountReference'];
        $model->description = $response['Parameters']['TransactionDesc'];
        $model->CheckoutRequestID = $response['Response']['CheckoutRequestID'];
        $model->MerchantRequestID = $response['Response']['MerchantRequestID'];
        $model->orderId = $orderId;
        $model->userId = \yii::$app->user->Id;
        $model->save();
        return $model;
    }

    /**
     * Updates an existing Payments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->paymentId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Payments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Payments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Payments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Payments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
