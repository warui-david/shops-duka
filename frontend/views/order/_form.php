<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Images;
use yii\bootstrap4\Modal;
use frontend\models\Cart;
use yii\helpers\Url;
use common\models\user;
use frontend\models\Cartitems;
use frontend\models\Product;

$user_id = user::find()->where(['id'=>Yii::$app->user->id])->one();

// $total_product = Cart::find()->JoinWith('product')->all();
// $total_cart = Cart::find()->JoinWith('product')->sum('price');
$total_product = Cartitems::find()->JoinWith('product')->all();
$total_cart = Cartitems::find()->JoinWith('product')->sum('baseprice');
$product = Product::find()->JoinWith('productimages')->all();
?>


<div class="container-fluid" style="margin-left:40px;margin-top: 50px;">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <h3>CHECKOUT</h3>
            </div>
            <div class="col-md-7" style="margin-left: 60px;margin-top: 30px;">
                <h4>1. Shipping info</h4>
                <hr>
                <div class="order">

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>$user_id->id, 'readonly'=> true])->label(false) ?>
    <?= $form->field($model, 'delivery_address') ?>
    <?= $form->field($model, 'paymethod')->dropDownList([ 'Credit Card' => 'Credit Card', 'M-Pesa' => 'M-Pesa', '' => '', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>

</div><!-- order -->
            </div>
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">My Cart</span>
                    <span class="badge badge-secondary badge-pill">Kshs.</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Subtotal</h6>
                            <!-- <small class="text-muted">Brief description</small> -->
                        </div>
                        <span class="text-muted"><?=$total_cart ?></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Estimated tax</span>
                        <strong>0.00</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Kshs.)</span>
                        <strong><?=$total_cart ?></strong>
                    </li>
                </ul>
                <br>
                <a href="<?= Url::to(['site/index']) ?>" class="btn btn-primary btn-lg btn-block">Continue shopping</a>
            </div>
        </div>
    </div>

    </div>
    </div>
    <br>