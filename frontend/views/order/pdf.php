<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Cart;
use frontend\models\Shoes;
/* @var $this yii\web\View */
/* @var $model frontend\models\Order */

$total_shoes = Cart::find()->JoinWith('shoe')->all();
$total_cart = Cart::find()->JoinWith('shoe')->sum('price');
\yii\web\YiiAsset::register($this);
?>

    <h1><?= \Yii::$app->User->username ?></h1>
    <h2>This is your order receipt</h2>
    <?php foreach ($total_shoes as $shoe) { ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="margin-top: 30px;">
                    <h7 style="font-weight: bold;">-><strong><?= $shoe->shoe->shoe_name ?></strong></h7>
                </div>
                <div class="col-md-2" style="margin-top: 30px;">
                   Price              Kshs. <?= $shoe->shoe->price ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <br>
    <div>Total : <strong><?=$total_cart ?></strong></div>

