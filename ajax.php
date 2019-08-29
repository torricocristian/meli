<?php 

  include('api.php');
  $action = $_POST['action'];

  if($action == 'getItemsSearch'){

    $auth = new meliAuth('APP_USR-3994323554126164-082722-19cc59369eff407d22c445c650915053-152261380');
    $search = new meliSearch($auth);
    $response = json_decode($search->doSearch());
    $items = $response->results;

    die(json_encode($items));
  }
?>