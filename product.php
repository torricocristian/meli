<?php 

  include('includes/config.php');
  include('api.php');


   $auth = new meliAuth('APP_USR-3994323554126164-082915-cd9dea8847bc351ca2f8ab25566b4efe-152261380');
   $itemClass = new meliItems($auth);

   $item = json_decode($itemClass->getItemById($_GET['id']));
?>

<?php include('includes/head.php');?>

<body>
  <!--[if IE]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    

    <main>

        <?php include('includes/header.php') ?>

        <section class="product">
            <div class="container">
                <div class="product__image">
                    <figure>
                        <img src="<?= $item->pictures[0]->secure_url ?>" alt="<?= $item->title?>">
                    </figure>
                </div>
                <div class="product__info">
                    <span class="item__sold"><?= meliItems::deployCondition($item->condition)?> - <?= $item->sold_quantity?> vendidos</span>
                    <h1 class="item__title"><?= $item->title?></h1>
                    <span class="item__price">$<?= $item->price?></span>
                    <a href="" class="btn btn__primary">Comprar</a>
                </div>
            </div>
        </section>


    </main>

<?php include('includes/footer.php'); ?>