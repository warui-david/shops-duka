<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Productcolor */
/* @var $form ActiveForm */
?>
<div class="brand">

    <?php $form = ActiveForm::begin([
            'action' =>['product/addcolor'],
            'method'=>'post',
            'id'=>'adda'
        ]); ?>

        <?= $form->field($model, 'colorDesc') ?>

        <?= $form->field($model, 'colorCode') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-outline-dark btn-sm']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- addbrand -->