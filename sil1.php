

<?php
if(!empty($_GET["id"])){
include("config/database.php");


$sql = "DELETE FROM yorumcu WHERE id=?";
$stmt= $conn->prepare($sql);
$stmt->execute([$_GET["id"]]);
echo "başarıyla silindi";
header("Refresh:2; url=ekle.php");
}else{
	echo "hata";
	
}