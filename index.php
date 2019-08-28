<?php 
  //Meli
  include('api.php');
  $auth = new meliAuth('APP_USR-3994323554126164-082722-19cc59369eff407d22c445c650915053-152261380');

  $search = new meliSearch($auth);
  $search->do_search();
  // $response = $webcontact->send();
?>

<!DOCTYPE html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8" />
  <title>Mercado Libre - Test Cristian Torrico</title>
  <meta name="description" content="Test front end para Mercado Libre" />
  <meta charSet="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta name="HandheldFriendly" content="True" />
  <meta http-equiv="cleartype" content="on" />
  <link rel="shortcut icon" href="https://http2.mlstatic.com/ui/navigation/4.5.2/mercadolibre/favicon.ico" />
  <link rel="apple-touch-icon" href="https://http2.mlstatic.com/ui/navigation/4.5.2/mercadolibre/60x60-precomposed.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="https://http2.mlstatic.com/ui/navigation/4.5.2/mercadolibre/76x76-precomposed.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="https://http2.mlstatic.com/ui/navigation/4.5.2/mercadolibre/120x120-precomposed.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="https://http2.mlstatic.com/ui/navigation/4.5.2/mercadolibre/152x152-precomposed.png" />

  <link rel="preload" href="https://http2.mlstatic.com/ui/webfonts/v3.0.0/proxima-nova/proximanova-light.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
  <link rel="preload" href="https://http2.mlstatic.com/ui/webfonts/v3.0.0/proxima-nova/proximanova-regular.woff2" as="font" type="font/woff2" crossorigin="anonymous" />
  <link rel="preload" href="https://http2.mlstatic.com/ui/webfonts/v3.0.0/proxima-nova/proximanova-semibold.woff2" as="font" type="font/woff2" crossorigin="anonymous"/>

  <link rel="stylesheet" href="assets/dist/css/style.css" />
</head>

<body class="page-home">
  <!--[if IE]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <header role="search-box" class="nav">
        <div class="container">
          <a class="nav-logo" href="//www.mercadolibre.com.ar">Mercado Libre Argentina - Donde comprar y vender de todo</a>
          <form class="nav-search" action="https://www.mercadolibre.com.ar/jm/search" method="GET" role="search">
              <input type="text" class="nav-search-input" name="q" placeholder="Nunca dejes de buscar" maxLength="120" autofocus="" autoCapitalize="off" autoCorrect="off" spellcheck="false" autoComplete="off" />
              <button type="submit" class="nav-search-btn">
                  <div role="img" aria-label="Buscar" class="nav-icon-search"></div>
              </button>
          </form>
        </div>
    </header>

  <main>



  </main>

  <script src="assets/dist/js/app.min.js"></script>
</body>

</html>