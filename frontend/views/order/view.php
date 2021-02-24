<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Order */

// $this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container text-center">
    <h1 class="title">CONGRATULATIONS</h1><br>
    <h1>You are a dope customer</h1>
</div>
<br>
<div class="order-view text-center">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Generate Order Report', ['pdf', 'id' => $model->order_id], ['class' => 'btn btn-success']) ?>

    </p>


</div>