<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Productuom */
/* @var $form ActiveForm */
?>
<div class="brand">

    <?php $form = ActiveForm::begin([
            'action' =>['product/adduom'],
            'method'=>'post',
            'id'=>'adda'
        ]); ?>

        <?= $form->field($model, 'uomDesc') ?>
        <?= $form->field($model, 'uomPrice') ?>
        <?= $form->field($model, 'quantity') ?>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-outline-dark btn-sm']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- addbrand -->