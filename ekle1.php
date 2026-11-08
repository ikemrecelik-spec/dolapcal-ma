<?php
function randomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $result = '';
    for ($i = 0; $i < $length; $i++) {
        $result .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $result;
}

if ($_POST["kullaniciadi"]) {
    $username = $_POST["kullaniciadi"];
    $password = $_POST["pass"];
    include("config/database.php");
    require "config/yorumcuekle.php";

    $time = time();
    $url = "https://api-gateway.dolap.com/member/login/";
    $randomcookie = randomString(16);
    $postdata = array(
        "username" => $username,
        "password" => $password,
        "memberCookie" => $randomcookie,
        "advertisingId" => "00000000-0000-0000-0000-000000000000"
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postdata,
        CURLOPT_HTTPHEADER => array(
            "accept: */*",
            "accept-language: tr-tr",
            "appplatform: ios",
            "appversion: 253",
            "cache-control: no-cache",
            "categorygroup: WOMAN",
            "connection: close",
            "content-type: application/json",
            "host: api.dolap.com",
            "postman-token: eff1228e-d79d-3d9c-6318-23042c927f95",
            "user-agent: dolap/2 CFNetwork/1325.0.1 Darwin/21.1.0",
            "x-epoch-seconds: $time",
            "x-signature: 5cab951838fadd0cfe570febf21b1a04aa71bff90faafc47e1d3a6b730d3da493f43d76a26fb4dd6c79930d145e5bfa8762466d9cc9ab983e5eb0872f7b8d1c0"
        ),
    ));

    $response = curl_exec($curl);
    $jsondata = json_decode($response, true);
    $error_message = "Kullanıcı adı veya parola yanlış!";

    if ($jsondata) {
        if (array_key_exists("accessToken", $jsondata)) {
            // Başarılı giriş, "accessToken" anahtarının mevcut olduğu kod buraya gelecek
        } else {
            // "accessToken" anahtarı bulunamadığında verilecek hata mesajı
            echo $error_message;
        }
    } else {
        // Giriş yapılamadığında verilecek hata mesajı
        echo $error_message;
    }

    curl_close($curl);
} else {
    // Giriş yapılamadığında verilecek hata mesajı
    echo $error_message;
}
?>