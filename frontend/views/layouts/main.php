<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>
  <?php $this->beginBody() ?>

  <!-- <div class="wrap"> -->
  <nav class="navbar navbar-expand-sm title3  navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <div class="text-center">
          <a class="navbar-brand logo font-bold" href="#"><span class="title4">DUKA SHOEZ</span></a>
          <!-- <img src="images/shoe logo4.jpg" class="img-fluid" alt=""> -->
          </a>
        </div>
        <li class="nav-item">
          <a class="nav-link title3" href="<?= Url::to(['site/index']) ?>">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link title3" href="<?= Url::to(['site/index']) ?>">About</a>
        </li>
        <li class="nav-item dropdown dmenu">
          <a class="nav-link dropdown-toggle title3" href="#" id="navbardrop" data-toggle="dropdown">
            Our Store
          </a>
          <div class="dropdown-menu title3 sm-menu">
            <a class="dropdown-item title3" href="<?= Url::to(['site/items']) ?>">Men</a>
            <a class="dropdown-item title3" href="<?= Url::to(['site/women']) ?>">Women</a>
            <a class="dropdown-item title3" href="<?= Url::to(['site/kids']) ?>">Kids</a>
            <a class="dropdown-item title3" href="<?= Url::to(['site/items']) ?>">Accessories</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link title3" href="#">Contact Us</a>
        </li>
        <!-- <li class="nav-item title3 dropdown dmenu">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </a>
          <div class="dropdown-menu sm-menu">
            <a class="dropdown-item title3" href="<?= Url::to(['site/shop']) ?>">My cart</a>
            <a class="dropdown-item title3" href="<?= Url::to(['order/create']) ?>">Checkout</a>
          </div>
        </li> -->

        <li class="nav-item px-3 text-uppercase mb-0 position-relative d-none d-lg-flex">
          <div id="cart" class="d-none">
          </div>
          <a href="<?= Url::to(['site/shop']) ?>" class="cart position-relative d-inline-flex" aria-label="View your shopping cart">
            <i class="fas fa fa-shopping-cart fa-2x"></i>
            <span class="cart-basket d-flex align-items-center justify-content-center">
              0
            </span>
          </a>
        </li>


        <li>
          <div class="col-md-6" style="margin-left: 300px;">
            
              <a href="<?= Url::to(['product/index']) ?>" class="btn btn-secondary">Add Products</a>
            
          </div>
        </li>



        <li class="nav-item dropdown dmenu" style="margin-left: 50px;">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <i class="fa fa-user-o fa-2x" aria-hidden="true"></i>
          </a>

          <div class="dropdown-menu sm-menu">
            <a class="dropdown-item" href="<?= Url::to(['site/login']) ?>">Log in</a>
            <a class="dropdown-item" href="<?= Url::to(['site/signup']) ?>">Sign up</a>
            <a class="dropdown-item" href="<?= Url::to(['site/logout']) ?>">Log out</a>

          </div>
        </li>

      </ul>

    </div>
  </nav>
  <!-- --<navbar end> -->


  <div class="container-fluid">
    <?= Breadcrumbs::widget([
      'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>
  </div>
  <!-- </div> -->

  <?= $this->render('footer.php') ?>

  <?php $this->endBody() ?>

  <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script type="text/javascript" scr="custom.js"></script>


  <script>
    $(document).ready(function() {
      var form_count = 1,
        form_count_form, next_form, total_forms;
      total_forms = $("fieldset").length;
      $(".next").click(function() {

        let previous = $(this).closest("fieldset").attr('id');
        let next = $('#' + this.id).closest('fieldset').next('fieldset').attr('id');
        $('#' + next).show();
        $('#' + previous).hide();
        setProgressBar(++form_count);

      });

      $(".previous").click(function() {

        let current = $(this).closest("fieldset").attr('id');
        let previous = $('#' + this.id).closest('fieldset').prev('fieldset').attr('id');
        $('#' + previous).show();
        $('#' + current).hide();
        setProgressBar(--form_count);

      });
      setProgressBar(form_count);

      function setProgressBar(curStep) {
        var percent = parseFloat(100 / total_forms) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
          .css("width", percent + "%")
          .html(percent + "%");
      }
    });
  </script>


</body>

</html>
<?php $this->endPage() ?>