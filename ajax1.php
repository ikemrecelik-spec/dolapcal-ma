<?php

$minLikes = (int) readline("Enter the minimum number of likes: ");
$maxLikes = (int) readline("Enter the maximum number of likes: ");


// Bu fonksiyon, verilen link için teklifleri sorgular
function teklifsor($link)
{
    $productId = explode("-", $link);
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

// Bu fonksiyon, verilen link ve teklif bilgisiyle teklif gönderir
function teklifgonder($link, $bid, $token)
{
    $productId = explode("-", $link);
    $productId = $productId[count($productId) - 1];
    $body = json_encode(array("bidAmount" => $bid, "productId" => $productId));
    $karakter = strlen($body);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.dolap.com/product/bid",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "PUT",
        CURLOPT_POSTFIELDS => $body,
        CURLOPT_HTTPHEADER => array(
            "access-token: $token",
            "appplatform: android",
            "appversion: 274",
            "categorygroup: WOMAN",
            "content-length: $karakter",
            "content-type: application/json; charset=UTF-8",
            "host: api.dolap.com",
            "user-agent: okhttp/4.9.1"
        ),
    ));
    $response = curl_exec($curl);
    if (strpos(curl_getinfo($curl, CURLINFO_HTTP_CODE), '200') !== false) {
        return json_encode(array("success" => "true"));
    } else {
        return $response;
    }
}
error_reporting(0);

// Veritabanýndan linkleri almak için baðlantýyý kurma
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dolap";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Linkleri veritabanýndan seçme
$sql = "SELECT links FROM urunler";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<select class="form-control" id="fiyat">';

    // Her bir link için teklif sorma ve teklif gönderme
    while ($row = mysqli_fetch_assoc($result)) {
        $link = $row["links"];
        $sor = teklifsor($link);

        if (json_decode($sor, true)["quickBids"]) {
            $count = count(json_decode($sor, true)["quickBids"]);
            for ($i = 0; $i < $count; $i++) {
                if (json_decode($sor, true)["quickBids"][$i]["discount"] == 10) {
                    echo '<option value="' . json_decode($sor, true)["quickBids"][$i]["bidPrice"] . '">%';
                    echo json_decode($sor, true)["quickBids"][$i]["discount"];
                    echo ' Ýndirim Fiyat ' . json_decode($sor, true)["quickBids"][$i]["bidPrice"] . 'TL </option>';
                }
            }
        } else {
            echo '<p>' . json_decode($sor, true)["message"] . '</p>';
        }

        // Teklif gönderme arayüzü için form
        echo '<form action="" method="POST">';
        echo '<input type="hidden" name="link" value="' . $link . '">';
        echo '<input type="text" name="fiyat" placeholder="Teklif Fiyatý">';
        echo '<input type="number" name="adet" placeholder="Teklif Adedi">';
        echo '<button type="submit">Teklif Gönder</button>';
        echo '</form>';

        // Formdan gelen teklifleri iþleme
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $link = $_POST["link"];
            $fiyat = $_POST["fiyat"];
            $adet = $_POST["adet"]; // Get the number of bids from the form input
            $sorgu = $conn->query("SELECT * FROM hesaplar ORDER BY rand() LIMIT $adet");

            for ($i = 0; $i < $adet; $i++) {
                $sonuc = $sorgu->fetch();
                $kullanici = $sonuc['nickname'];
                $token = $sonuc['accessToken'];
                $teklif = teklifgonder($link, $fiyat, $token);

                if (strpos(json_decode($teklif, true)["success"], 'true') !== false) {
                    echo '<p class="card-text text-success"><label class="badge badge-success">Baþarýlý ? </label> Kullanýcý: ' . $kullanici . ' - Teklif Gönderildi! </p>';
                    $query = $conn->prepare("INSERT INTO islemler SET username = :username, islem = :islem, gonderilen = :gonderilen, status = :status, tarih = :tarih");
                    $insert = $query->execute(array(
                        "username" => $kullanici,
                        "islem" => "teklif",
                        "gonderilen" => $link,
                        "status" => "gönderildi",
                        "tarih" => date("d.m.Y-H.i.s")
                    ));
                } else {
                    echo '<p class="card-text text-danger"><label class="badge badge-danger">Baþarýsýz ? </label> Kullanýcý: ' . $kullanici . ' - Teklif Gönderilemedi!  ' . json_decode($teklif, true)["message"] . '</p>';
                    $query = $conn->prepare("INSERT INTO islemler SET username = :username, islem = :islem, gonderilen = :gonderilen, status = :status, tarih = :tarih");
                    $insert = $query->execute(array(
                        "username" => $kullanici,
                        "islem" => "teklif",
                        "gonderilen" => $link,
                        "status" => "Gönderilemedi",
                        "tarih" => date("d.m.Y-H.i.s")
                    ));
                }
            }
        }
    }

    echo "</select>";
} else {
    echo "No links found in the database.";
}

mysqli_close($conn);
?>
