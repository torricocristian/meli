<?php 

  include('includes/config.php');
  include('api.php');


  $auth = new meliAuth('APP_USR-3994323554126164-082915-cd9dea8847bc351ca2f8ab25566b4efe-152261380');
    if(!isset($_GET['q'])){
      $search = new meliSearch($auth,'iPod');
    }else{
      $search = new meliSearch($auth);
    }


    $response = json_decode($search->doSearch());
    $items = $response->results;
?>

<?php include('includes/head.php');?>

<body class="page-results">
  <!--[if IE]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <input type="hidden" id="domain" value="<?= $baseURL ?>">

    <main>

    <header role="search-box" class="nav">
        <div class="container">
          <a class="nav-logo" href="//www.mercadolibre.com.ar">Mercado Libre Argentina - Donde comprar y vender de todo</a>
          <form class="nav-search" action="<?= $baseURL ?>" method="GET" role="search">
              <input type="text" class="nav-search-input" name="q" placeholder="Nunca dejes de buscar" maxLength="120" autofocus="" autoCapitalize="off" autoCorrect="off" spellcheck="false" autoComplete="off" />
              <button type="submit" class="nav-search-btn">
                  <div role="img" aria-label="Buscar" class="nav-icon-search"></div>
              </button>
          </form>
        </div>
    </header>

    <section id="searchResults">
      <div class="loader"></div>
      <div class="container">

        
        <?php if($items):?>

          <?php foreach($items as $row):?>
            <div class="item">
              <a href="<?= $baseURL ?>product.php?id=<?= $row->id?>" class="item__image">
                  <img src="<?= meliSearch::deployImage($row->thumbnail)?>" alt="<?= $row->title ?>" width="160" heigth="160">
              </a>
              <div class="item__info">
                <div class="item__price__container">
                  <div class="item__price"><?= meliSearch::deploySearch($row->currency_id).$row->price ?></div>

                  <?php if($row->shipping->free_shipping == 1):?>
                    <div class="item__shopping-cart"></div>
                  <?php endif?>

                </div>
                <h2 class="item__title">
                  <a href="<?= $baseURL ?>product.php?id=<?= $row->id?>">
                    <?= $row->title ?>
                  </a>
                </h2>
                <div class="item__location">
                  <?= $row->address->city_name?>
                </div>
              </div>
            </div>
          <?php endforeach ?>

        <?php endif; ?>

      </div>
    </section>

  </main>

<?php include('includes/footer.php'); ?>