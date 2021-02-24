<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Payments */

$this->title = Yii::t('app', 'Update Payments: {name}', [
    'name' => $model->paymentId,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->paymentId, 'url' => ['view', 'id' => $model->paymentId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="payments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
