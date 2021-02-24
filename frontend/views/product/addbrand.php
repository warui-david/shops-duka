<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Productbrand */
/* @var $form ActiveForm */
?>
<div class="brand">

    <?php $form = ActiveForm::begin([
            'action' =>['product/addbrand'],
            'method'=>'post',
            'id'=>'adda'
        ]); ?>

        <?= $form->field($model, 'brandName') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-outline-dark btn-sm']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- addbrand -->