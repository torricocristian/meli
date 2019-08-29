<?php 

  include('api.php');
  $action = $_POST['action'];

  if($action == 'getItemsSearch'){

    $auth = new meliAuth('APP_USR-3994323554126164-082915-cd9dea8847bc351ca2f8ab25566b4efe-152261380');
    $search = new meliSearch($auth);
    $response = json_decode($search->doSearch());
    $items = $response->results;

    die(json_encode($items));
  }
?>