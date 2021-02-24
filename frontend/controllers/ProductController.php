<?php

namespace frontend\controllers;

use frontend\models\Cartitems;
use Yii;
use frontend\models\Product;
use frontend\models\Productbrand;
use frontend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\Productimages;
use yii\web\UploadedFile;
use frontend\models\Productcart;
use frontend\models\Productcolor;
use frontend\models\Productuom;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * 
     * @return string
     */
    
    public function actionCart()
    {
        return $this->render('cart');
    }
    

    public function actionAddtocart($productid,$userid,$quantity)
    {
        $checkcart = Productcart::find()->where(['userId'=>$userid])->andWhere(['cartStatus'=>'Active'])->asArray()->one();
        if(empty($checkcart)){
            if($this->createCart($userid,$productid,$quantity)){
                return json_encode('true');
            }
            
        }else {
            $this->createCartItems($checkcart['cartId'],$productid,$quantity);
        }
         
    }
    
    public function createCart($userid,$productid,$quantity){
        $model = New Productcart();
        $data = ['Productcart'=>['userId'=>$userid,'total'=>0,'cartStatus'=>'Active','createdBy'=>yii::$app->user->id]];
        if($model->load($data) && $model->save()){
            $this->createCartItems($model->cartId,$productid,$quantity);
        }
        return false;
    }
    
    public function createCartItems($cartId,$productid,$quantity){
        $model = New Cartitems();
        $data = ['Cartitems'=>['cartId'=>$cartId,'productId'=>$productid,'quantity'=>$quantity]];
        if($model->load($data) && $model->save()){
            return true;
        }
        return false;
    }


    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $image= new Productimages();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($this->saveImage($model->productId,Yii::$app->request->post()['Productimages'])){
                return $this->redirect(['view', 'id' => $model->productId]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'image'=>$image
        ]);
    }
    
    /**
     * 
     * @param  $productId
     * @param  $imagedata
     */
    public function saveImage($productId,$imagedata){
        
        $model = new Productimages();
                
        if($model->load(["Productimages"=>['imagePath'=>$imagedata['imagePath']]])){
            //generates images with unique names
            $imageName = bin2hex(openssl_random_pseudo_bytes(10));
            $model->imagePath = UploadedFile::getInstance($model, 'imagePath');
            //saves file in the root directory
            $model->imagePath->saveAs('uploads/.'.$imageName.'.'.$model->imagePath->extension);
            //save in the db
            $model->imagePath='uploads/'.$imageName.'.'.$model->imagePath->extension;
            $model->productId = $productId;
            if($model->save()){
                return true;
            }
        }
        return false;
    }
    public function actionAddbrand()
    {
        $model = new \frontend\models\Productbrand();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect(['create']);
            }
        }
        
        return $this->renderAjax('addbrand', [
            'model' => $model,
        ]);
    }
    
    public function Productbrand($brandId){
        $model = New Productbrand();
        $data= array('Productbrand'=>['brandId'=>$brandId]);
        
        if($model->load($data) && $model->save()){
            return true;
        }
        return false;
    }
    public function actionAddcolor()
    {
        $model = new \frontend\models\Productcolor();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect(['create']);
            }
        }
        
        return $this->renderAjax('addcolor', [
            'model' => $model,
        ]);
    }
    
    public function Productcolor($colorId){
        $model = New Productcolor();
        $data= array('Productcolor'=>['colorId'=>$colorId]);
        
        if($model->load($data) && $model->save()){
            return true;
        }
        return false;
    }

    public function actionAdduom()
    {
        $model = new \frontend\models\Productuom();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->save()) {
                return $this->redirect(['create']);
            }
        }
        
        return $this->renderAjax('adduom', [
            'model' => $model,
        ]);
    }
    
    public function Productuom($uomId){
        $model = New Productuom();
        $data= array('Productuom'=>['colorId'=>$uomId]);
        
        if($model->load($data) && $model->save()){
            return true;
        }
        return false;
    }
    
    public function actionImgform()
{
    $model = new \frontend\models\Productimages();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            return;
        }
    }

    return $this->render('_imgform', [
        'model' => $model,
    ]);
}

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->productId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
