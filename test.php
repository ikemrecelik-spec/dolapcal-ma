<?php
error_reporting(0);

function dolap($token){
  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://apollo.trendyol.com/dolap/auth",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
      "authorization: Bearer $token",
      "cache-control: no-cache",
      "connection: close",
      "content-length: 0",
      "host: apollo.trendyol.com",
      "platform: android",
      "user-agent: okhttp/4.9.3",
      "x-advertising-id: 34d88027-334e-4e62-a606-92e23f18ce1b",
      "x-version: 6.25.0.663"
    ),
  ));
  
  $response = curl_exec($curl);
  return $response;
}

require_once ("../class/trendyol.class.php");
include("../config/database.php");

$filename = "../accounts.txt";
$fp = fopen($filename, "r");
$content = fread($fp, filesize($filename));
$la = explode("\n", $content);
fclose($fp);
$api = new trendyol();
foreach($la as $a){


$parcala = explode(":", $a);

$login = $api->mobilelogin(trim($parcala[0]),trim($parcala[1]));
$json = json_decode($login,true);

$token=$json["accessToken"];
$dolap = dolap($token);
$dolaptoken = json_decode($dolap,true)["token"];
if(strpos($dolap, 'token') !== false) {
  $query = $conn->prepare("INSERT INTO dolap SET  mail = :mail, accessToken = :accessToken");
  $insert = $query->execute(array(
      "accessToken" => $dolaptoken,
      "mail" => trim($parcala[0])
  ));
  $last_id = $conn->lastInsertId();
  echo "Hesap Eklendi - Mail: $parcala[0] \r\n";
}else{
  echo $dolap;
}
}