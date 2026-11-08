<?php
error_reporting(0);
function teklifsor($link) {
    $productId = explode("-",$link);
    $productId = $productId[count($productId) - 1];
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api-gateway.dolap.com/product/bid/quickbids?productId=$productId",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "access-token: 8941a545-5524-4a1a-9954-13ec72ce787e32f3e5b1-4251-470b-9227-cc5cbc4ddce2",
        "appplatform: android",
        "appversion: 274",
        "categorygroup: WOMAN",
        "content-type: application/json",
        "host: api-gateway.dolap.com",
        "user-agent: okhttp/4.9.1"
      ),
    ));
    return curl_exec($curl);
    }
$link = $_POST["link"];
$sor = teklifsor($link);
if(json_decode($sor,true)["quickBids"]){
echo '<select class="form-control" id="fiyat">';
$count = count(json_decode($sor,true)["quickBids"]);
for($i=0;$i<$count; $i++){
echo '<option value="'.json_decode($sor,true)["quickBids"][$i]["bidPrice"].'">%'.json_decode($sor,true)["quickBids"][$i]["discount"].' İndirim Fiyat '.json_decode($sor,true)["quickBids"][$i]["bidPrice"].'TL </option>';
}
echo "</select>";
}else{
  echo '<p>'.json_decode($sor,true)["message"].'</p>';
}


