<?php
require "config/database.php";
require "config/config.php";

$urunler = $conn->query("SELECT * FROM urunler WHERE submit='gonderildi' ORDER BY id DESC LIMIT 500");
echo "<table class='table'>";
foreach($urunler as $urun) {
	echo "<tr>";
	echo "<td>".$urun['id']."</td><td><a href='".$urun['links']."' target='_blank'>". $urun['links'] . "</a></td>";
	echo "</tr>";
	//header("Refresh:2; url=atilanyorum.php");
   
	
} ?>