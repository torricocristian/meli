<?php
function curlExecFollow($ch, &$maxredirect = null) {

 // we emulate a browser here since some websites detect
 // us as a bot and don't let us do our job
 $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.5)".
               " Gecko/20041107 Firefox/1.0";
 curl_setopt($ch, CURLOPT_USERAGENT, $user_agent );
 curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest", "Content-Type: application/json; charset=utf-8"));
 curl_setopt( $curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
 $mr = $maxredirect === null ? 5 : intval($maxredirect);

 if (filter_var(ini_get(‘open_basedir’), FILTER_VALIDATE_BOOLEAN) === false
     && filter_var(ini_get(‘safe_mode’), FILTER_VALIDATE_BOOLEAN) === false
 ) {

   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, $mr > 0);
   curl_setopt($ch, CURLOPT_MAXREDIRS, $mr);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

 } else {

   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

   if ($mr > 0)
   {
     $original_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
     $newurl = $original_url;

     $rch = curl_copy_handle($ch);

     curl_setopt($rch, CURLOPT_HEADER, true);
     curl_setopt($rch, CURLOPT_NOBODY, true);
     curl_setopt($rch, CURLOPT_FORBID_REUSE, false);
     do
     {
       curl_setopt($rch, CURLOPT_URL, $newurl);
       $header = curl_exec($rch);
       if (curl_errno($rch)) {
         $code = 0;
       } else {
         $code = curl_getinfo($rch, CURLINFO_HTTP_CODE);
         if ($code == 301 || $code == 302) {
           preg_match('/Location:(.*?)\n/i', $header, $matches);
           $newurl = trim(array_pop($matches));

           // if no scheme is present then the new url is a
           // relative path and thus needs some extra care
           if(!preg_match("/^https?:/i", $newurl)){
             $newurl = $original_url . $newurl;
           }
         } else {
           $code = 0;
         }
       }
     } while ($code && --$mr);

     curl_close($rch);

     if (!$mr)
     {
       if ($maxredirect === null)
       trigger_error('Too many redirects.', E_USER_WARNING);
       else
       $maxredirect = 0;

       return false;
     }
     curl_setopt($ch, CURLOPT_URL, $newurl);
   }
 }
 return curl_exec($ch);
}


class meliAuth{
    var $key=null;

    function meliAuth($key){
        $this->key = $key;
    }
}

class meliSearch{
   var $auth = null;
   var $BASE_SEARCH_URL = 'https://api.mercadolibre.com/sites/MLA/search?';
   var $search_data = null;
   var $querystring_data_key = "q";
   var $search_results = null;
   var $limit = 4;

   function meliSearch($auth, $search_data=null) {
        $this->auth = $auth;
        if($search_data){
            $this->search_data = $search_data;
        }else{
            $this->search_data = $_REQUEST[$this->querystring_data_key];
        }
       
    }

    static function deploySearch($data){
        switch ($data) {
            case 'ARS':
                $symbol = '$';
                break;
            case 'USD':
                $symbol = 'U$S';
                break;
        }

        return $symbol;
    }

    static function deployImage($imageUrl){
       return str_replace("-I.jpg", "-V.jpg",$imageUrl);
    }

    function doSearch($limit = 4){

        if ($this->search_data == null){
            echo "No search parameters were given";
        }else{
            try {
                $url = $this->BASE_SEARCH_URL . "q=" . $this->search_data . "&limit=" .$limit . "&access_token=" . $this->auth->key;
                $url = str_replace(" ","%20",$url);
		        $curlInit = curl_init();
                curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curlInit, CURLOPT_URL, $url);
                curl_setopt($curlInit, CURLOPT_TIMEOUT, 60);
                curl_setopt($curlInit, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt( $curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                $this->search_results = curlExecFollow($curlInit);
                echo curl_getinfo($ch);
                if(curl_exec($curlInit) === FALSE) 
                {
                    die("Curl failed: " . curl_error($curlInit));  // Never goes here
                }
                curl_close($curlInit);
                return $this->search_results;

            } catch (Exception $e) {
                $this->search_results = null;
                echo "Error executing query.";
            }
        }
    }

}


class meliItems{
  var $auth = null;
  var $BASE_SEARCH_URL = 'https://api.mercadolibre.com/items/';
  var $search_results = null;

  function meliItems($auth) {
       $this->auth = $auth;
  }

   function getItemById($idItem){
          $url = $this->BASE_SEARCH_URL . $idItem . "?access_token=" . $this->auth->key;
          $url = str_replace(" ","%20",$url);


          $curlInit = curl_init();
          curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curlInit, CURLOPT_URL, $url);
          curl_setopt($curlInit, CURLOPT_TIMEOUT, 60);
          curl_setopt($curlInit, CURLOPT_FOLLOWLOCATION, true);
          curl_setopt( $curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
          $this->search_results = curlExecFollow($curlInit);
          echo curl_getinfo($ch);
          if(curl_exec($curlInit) === FALSE) 
          {
              die("Curl failed: " . curl_error($curlInit));  // Never goes here
          }
          curl_close($curlInit);
          return $this->search_results;
   }


   static function deployCondition($data){
      switch ($data) {
            case 'new':
                $condition = 'Nuevo';
                break;
            case 'old':
                $condition = 'Viejo';
                break;
        }

        return $condition;
    }
      

}

?>
