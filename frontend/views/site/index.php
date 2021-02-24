<?php

use frontend\models\Shoes;
use frontend\models\Images;
use yii\bootstrap4\Modal;
use frontend\models\Cart;
use yii\helpers\Url;
use frontend\models\Product;

$products = Product::find()->joinWith('productimages')->all();
//var_dump($products); exit();
?>




<!-- <Homepage> -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 col-sm-12 text-center">
      <div class="wrapper text-center">
        <img class="search-icon text-center" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU2Ljk2NiA1Ni45NjYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU2Ljk2NiA1Ni45NjY7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPHBhdGggZD0iTTU1LjE0Niw1MS44ODdMNDEuNTg4LDM3Ljc4NmMzLjQ4Ni00LjE0NCw1LjM5Ni05LjM1OCw1LjM5Ni0xNC43ODZjMC0xMi42ODItMTAuMzE4LTIzLTIzLTIzcy0yMywxMC4zMTgtMjMsMjMgIHMxMC4zMTgsMjMsMjMsMjNjNC43NjEsMCw5LjI5OC0xLjQzNiwxMy4xNzctNC4xNjJsMTMuNjYxLDE0LjIwOGMwLjU3MSwwLjU5MywxLjMzOSwwLjkyLDIuMTYyLDAuOTIgIGMwLjc3OSwwLDEuNTE4LTAuMjk3LDIuMDc5LTAuODM3QzU2LjI1NSw1NC45ODIsNTYuMjkzLDUzLjA4LDU1LjE0Niw1MS44ODd6IE0yMy45ODQsNmM5LjM3NCwwLDE3LDcuNjI2LDE3LDE3cy03LjYyNiwxNy0xNywxNyAgcy0xNy03LjYyNi0xNy0xN1MxNC42MSw2LDIzLjk4NCw2eiIgZmlsbD0iIzAwMDAwMCIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />
        <input class="search text-center" placeholder="Search" type="text">
        <!-- <img class="clear-icon" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUxLjk3NiA1MS45NzYiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxLjk3NiA1MS45NzY7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPGc+Cgk8cGF0aCBkPSJNNDQuMzczLDcuNjAzYy0xMC4xMzctMTAuMTM3LTI2LjYzMi0xMC4xMzgtMzYuNzcsMGMtMTAuMTM4LDEwLjEzOC0xMC4xMzcsMjYuNjMyLDAsMzYuNzdzMjYuNjMyLDEwLjEzOCwzNi43NywwICAgQzU0LjUxLDM0LjIzNSw1NC41MSwxNy43NCw0NC4zNzMsNy42MDN6IE0zNi4yNDEsMzYuMjQxYy0wLjc4MSwwLjc4MS0yLjA0NywwLjc4MS0yLjgyOCwwbC03LjQyNS03LjQyNWwtNy43NzgsNy43NzggICBjLTAuNzgxLDAuNzgxLTIuMDQ3LDAuNzgxLTIuODI4LDBjLTAuNzgxLTAuNzgxLTAuNzgxLTIuMDQ3LDAtMi44MjhsNy43NzgtNy43NzhsLTcuNDI1LTcuNDI1Yy0wLjc4MS0wLjc4MS0wLjc4MS0yLjA0OCwwLTIuODI4ICAgYzAuNzgxLTAuNzgxLDIuMDQ3LTAuNzgxLDIuODI4LDBsNy40MjUsNy40MjVsNy4wNzEtNy4wNzFjMC43ODEtMC43ODEsMi4wNDctMC43ODEsMi44MjgsMGMwLjc4MSwwLjc4MSwwLjc4MSwyLjA0NywwLDIuODI4ICAgbC03LjA3MSw3LjA3MWw3LjQyNSw3LjQyNUMzNy4wMjIsMzQuMTk0LDM3LjAyMiwzNS40NiwzNi4yNDEsMzYuMjQxeiIgZmlsbD0iIzAwMDAwMCIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" /> -->
      </div>
    </div>
  </div>
</div>

<div class="container-fluid text-center text-md-left">
  <div class="row">
    <div class="col-md-6 col-sm-12 shop">
      <div class="title">
        For the cool kids
        <br>
        <div class="title2">
          The only way to be cool is to rock the Ndula
        </div>
        <div class="col-md-6 text-center shop">
          <a href="<?= Url::to(['site/items']) ?>" class="btn btn-secondary btn-lg btn-block">Shop</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6">
      <img src="../images/backg.jpg" class="img-fluid">
    </div>
  </div>
</div>
<br>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5 col-sm-6">
      <div class="card text-white bg-dark mb-3 w-120">
        <div class="card-body img-overlay">
          <h5>Men's</h5>
          <img src="../images/men5.jpg" class="img-fluid" alt="">
        </div>
        <div class="text-center">
          <a href="<?= Url::to(['site/items']) ?>" class="btn btn-primary text-center btn-lg">View Items</a>
        </div>
        <br>
      </div>
    </div>

    <div class="col-md-5 col-sm-6  margin-right">
      <div class="card text-white bg-dark mb-3 w-120">
        <div class="card-body">
          <h5 class="card-title">Women's</h5>
          <img src="../images/men2.jpg" class="img-fluid" alt="">
        </div>
        <div class="text-center">
          <a href="<?= Url::to(['site/women']) ?>" class="btn btn-primary text-center btn-lg">View Items</a>
        </div>
        <br>
      </div>
    </div>
    <div class="col-md-1"></div>

  </div>
</div>
</div>
<br>

<br>

<div class="container-fluid text-center text-md-left mail">
  <div class="row">
    <div class=col-md-3></div>
    <div class="col-md-6 col-sm-12">
      <h3>New Releases</h3>

      <?php foreach ($products as $product) { ?>

        <div class="card">
          <div class="row">
            <aside class="col-sm-5 border-right">
              <article class="gallery-wrap">
                <div class="img-big-wrap">
                  <div> <a href="#"><img src="<?= yii::$app->request->baseUrl . '/' . $product->productimages[0]->imagePath ?>"></a></div>
                </div> <!-- slider-product.// -->
                <div class="img-small-wrap">
                  <div class="item-gallery"> <img src="<?= yii::$app->request->baseUrl . '/' . $product->productimages[0]->imagePath ?>"> </div>
                </div> <!-- slider-nav.// -->
              </article> <!-- gallery-wrap .end// -->
            </aside>
            <aside class="col-sm-7">
              <article class="card-body p-5">
                <h3 class="title3 mb-3"><?= $product->productName  ?></h3>

                <p class="price-detail-wrap">
                  <span class="price h3 text-warning">
                    <span class="currency">KES </span><span class="num"><?= $product->basePrice  ?></span>
                  </span>

                </p> <!-- price-detail-wrap .// -->
                <dl class="item-property">
                  <dt>Description</dt>
                  <dd>
                    <p><?= $product->productDesc  ?></p>
                  </dd>
                </dl>
                <dl class="param param-feature">
                  <dt>Model#</dt>
                  <dd>12345611</dd>
                </dl> <!-- item-property-hor .// -->
                <dl class="param param-feature">
                  <dt>Color</dt>
                  <dd>Black and white</dd>
                </dl> <!-- item-property-hor .// -->
                <dl class="param param-feature">
                  <dt>Delivery</dt>
                  <dd>Russia, USA, and Europe</dd>
                </dl> <!-- item-property-hor .// -->

                <hr>
                <div class="row">
                  <div class="col-sm-5">
                    <dl class="param param-inline">
                      <dt>Quantity: </dt>
                      <dd>
                        <select id="quantity_<?= $product->productId ?>" class="form-control form-control-sm quantity" style="width:70px;">
                          <option> 1 </option>
                          <option> 2 </option>
                          <option> 3 </option>
                        </select>
                      </dd>
                    </dl> <!-- item-property .// -->
                  </div> <!-- col.// -->
                  <div class="col-sm-7">
                    <dl class="param param-inline">
                      <dt>Size: </dt>
                      <dd>
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                          <span class="form-check-label">SM</span>
                        </label>
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                          <span class="form-check-label">MD</span>
                        </label>
                        <label class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                          <span class="form-check-label">XXL</span>
                        </label>
                      </dd>
                    </dl> <!-- item-property .// -->
                  </div> <!-- col.// -->
                </div> <!-- row.// -->
                <hr>
                <a href="#" class="btn btn-lg btn-primary text-uppercase"> Buy now </a>
                <a href="#" baseUrl="<?= Yii::$app->request->baseUrl ?>" productid="<?= $product->productId ?>" userid="<?= Yii::$app->user->id ?>" class="btn btn-lg btn-outline-primary text-uppercase addtocart"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
              </article> <!-- card-body.// -->
            </aside> <!-- col.// -->
          </div> <!-- row.// -->
        </div> <!-- card.// -->
      <?php } ?>
    </div>


      <div class="container-fluid text-center text-md-left mail"><br>
        <br>
        <br>
        <br>
        <div class="row">
          <div class="col-md-12 col-sm-8 text-center">
            <h4>Up your shoe game</h4></a>
          </div>
          <br>
          <div class="col-md-12 col-sm-8 text-center">
            <h4>Get notified immediately there is a new drop</h4></a>
          </div>
          <br><br>
          <div class="col-md-12 col-sm-8 text-center">
            <a href="#" class="btn btn-secondary text-centre">
              <h3>Join our mailing list</h3>
            </a>
          </div>
        </div>
        <br>
        <br>
        <br>
        <br>
      </div>

      <?php
      Modal::begin([
        'title' => '<h4>My Cart</h4>',
        'id' => 'addtocart',
        'size' => 'modal-lg'
      ]);
      echo "<div id='addtocartContent'></div>";
      Modal::end();
      ?>