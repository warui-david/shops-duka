<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\User;
use frontend\models\Country;
use frontend\models\Order;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payments */
/* @var $form yii\widgets\ActiveForm */
$user = ArrayHelper::map(User::find()->all(), 'id', 'username');
?>

<div class="payments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orderId')->dropDownList(ArrayHelper::map(Order::find()->all(), 'order_id', 'delivery_address')) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'phoneCode')->dropDownlist(ArrayHelper::map(Country::find()->all(), 'couPhoneCode', 'countryName')) ?>

    <?= $form->field($model, 'phoneNumber')->textInput() ?>

    <?= $form->field($model, 'userId')->hiddenInput(['value'=>yii::$app->user->id])->label(false) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'paid' => 'Paid', 'not paid' => 'Not paid', '' => '', ], ['prompt' => '']) ?>

    <!-- <?= $form->field($model, 'createdAt')->textInput() ?> -->

    <?= $form->field($model, 'createdBy')->hiddenInput(['value'=>yii::$app->user->id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
