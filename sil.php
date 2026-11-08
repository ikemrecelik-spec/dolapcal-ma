<?php

include("config/database.php");

?>

<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hesaplar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
  </head>
  <body>
<div class="container">
  		<div class="row">
  		<h4 class="page-header text-center"> HESAP TABLOSU</h4>
<table class="table table-bordered">
  <thead>
    <tr>
	  <th scope="col">Kullanıcı Adı</th>
      <th scope="col">Şifre</th>
<th scope="col">Sil</th>
    </tr>
  </thead>
  <tbody>
  <?php

$sorgu = $conn->query("SELECT * FROM yorumcu ORDER BY id LIMIT 50");

//doganemre
  while($sonuc = $sorgu->fetch()){

                      ?>
<tr>
                          <td><?php echo $sonuc["username"]; ?></td>
                          <td><?php echo $sonuc["password"]; ?></td>
                       <td><label class="label label-warning"><a href="sil1.php?id=<?php echo $sonuc["id"]; ?>">Sil</a></label></td>
                        </tr>
      <?php
      } 
	  ?>
  </tbody>
</table>
	
			</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  </body>
</html>