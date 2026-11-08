<?php

if($_POST["kullaniciadi"]){
$username = $_POST["kullaniciadi"];
$password = $_POST["pass"];
#### KÜTÜPHANELERİMİZİ YÜKLÜYORUZ ####
include("config/database.php");
include("library/anticaptcha.php");
include("library/recaptchaV2proxyless.php");
require "config/config.php";
/////////////////////////////////
$api = new RecaptchaV2Proxyless();
$api->setVerboseMode(true);
$api->setKey($apikey);
$api->setWebsiteURL("https://dolap.com/giris");
$api->setWebsiteKey("6LdUCqQUAAAAADFMYHEjWJjZWDCcov0F17XJ1jww");
$body = json_encode(array("username"=>$username,"password"=>$password));
$karakter = strlen($body);
if (!$api->createTask()) {
    $api->debout("API v2 send failed - ".$api->getErrorMessage(), "red");
    return false;
}
$taskId = $api->getTaskId();
if (!$api->waitForResult()) {
    $api->debout("Geçilemedi", "red");
    $api->debout($api->getErrorMessage());
} else {
    $recaptchaToken =   $api->getTaskSolution();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://dolap.com/giris?captchaToken=$recaptchaToken");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'accept: */*',
        'accept-language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
        "content-length: $karakter",
        'content-type: application/json;charset=UTF-8',
        'cookie: _ga=GA1.2.421777417.1626110287; _fbp=fb.1.1626110288037.1267869766; _gcl_au=1.1.1756262934.1635008382; _gid=GA1.2.630098128.1635512267; cto_bundle=fU34jF94WGlqYTVQa3hxMnpaYkUzS1h4MGhaSjAlMkJmMFhaZFRzQnVHNkhSN2FZOVQ2aW84WDFWQkJoanFDeHozcUU1VVJoc3VzUVpwa0NaNVM4ZWhnbiUyRjZ6N0NpNkdFb3NGeGhHNklNJTJCa1pncHc5NWx2UGtFc05XNHdacDl6eWpGQmhGOGI2Vnl0WFhGJTJGNHZRZ0c3V2FTa0J2QSUzRCUzRA; _gat=1; _gat_UA-80073361-1=1; privacy_cookie_policy=1',
        'origin: https://dolap.com',
        'referer: https://dolap.com/giris',
        'user-agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36',
        'x-requested-with: XMLHttpRequest'
        ));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    $result = curl_exec($ch);
    $jsondata = json_decode($result, true);
    $token = $jsondata["accessToken"];
    if(strpos($result, 'accessToken') !== false) {
        $query = $conn->prepare("INSERT INTO yorumcu SET username = :username, password = :password, token = :token");
        $insert = $query->execute(array(
            "username" => $username,
            "password" => $password,
            "token" => $token
        ));
        $last_id = $conn->lastInsertId();
            echo "Veritabanına Eklenmiştir!";
    }else{
            echo "Bilgileri Kontrol Edin!";
    }
    }
	echo "";
header("Refresh:2; url=category-comment.php");

}
?>