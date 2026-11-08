<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Begeni Gönder Para Sonra</title>
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="./assets/js/jquery.min.js"></script>
</head>

<body>
  <div class="container-scroller">

    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo-dark.png" alt="logo" /></a>
      </div>
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
    </nav>

                  <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-category">ANA</li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <span class="icon-bg"><i class="mdi mdi-cube"></i></span>
                <span class="menu-title">Anasayfa</span>
              </a>
            </li>
            <li class="nav-item nav-category">ARAÇLAR</li>
			
            <li class="nav-item">
              <a class="nav-link" href="comment" >
                <span class="icon-bg"><i class="mdi mdi-comment"></i></span>
                <span class="menu-title">Yorum Botu</span>
              </a>
			  </li>
		
			
            <li class="nav-item">
              <a class="nav-link" href="follow.php" >
                <span class="icon-bg"><i class="mdi mdi-account-plus"></i></span>
                <span class="menu-title">Takipçi Gönder</span>
              </a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="followgericek.php" >
                <span class="icon-bg"><i class="mdi mdi-account-plus"></i></span>
                <span class="menu-title">Takipçi Gönder Parayı Sonra</span>
              </a>
            </li>
			   <li class="nav-item">
              <a class="nav-link" href="unfollow.php" >
                <span class="icon-bg"><i class="mdi mdi-account-plus"></i></span>
                <span class="menu-title">Takipçi Geri Çek</span>
              </a>
            </li>
			
            <li class="nav-item">
              <a class="nav-link" href="like.php" >
                <span class="icon-bg"><i class="mdi mdi-heart"></i></span>
                <span class="menu-title">Begeni Gönder</span>
              </a>
			  </li>
			    <li class="nav-item">
              <a class="nav-link" href="likegericek.php" >
                <span class="icon-bg"><i class="mdi mdi-heart"></i></span>
                <span class="menu-title">Begeni Gönder Para Sonra</span>
              </a>
			  </li>
			  
			  <li class="nav-item">
              <a class="nav-link" href="unlike.php" >
                <span class="icon-bg"><i class="mdi mdi-heart"></i></span>
                <span class="menu-title">Begeniyi Geri Çek</span>
              </a>
            </li>
			
            <li class="nav-item">
              <a class="nav-link" href="teklif.php" >
                <span class="icon-bg"><i class="mdi mdi-ticket"></i></span>
                <span class="menu-title">Teklif Gönder</span>
              </a>
            </li>
			
          </ul>
        </nav>


      <div class="main-panel">
        <div class="content-wrapper">
          <center>
            <div class="col-md-8" style="width: 100%;">
              <div class="card" style="width: 100%;">
                <div class="card-header bg-dark mb-3">
                </div>
                <div class="card-body">
                  <h4 class="card-title">Dolap Begeni Botu</h4>
                  <p class="card-description"> Toplam Hesap Sayınız Kadar Begeni Gönderebilirsiniz </p>
                  <!-- 13.07.2022 -->
                  <p class="card-description">
                    <label for="urladet">Ürün Sayısı Seçin: </label>
                    <select name="urladet" id="urladet">
                      <option value="1">1</option>
                      <option value="7">7</option>
					  <option value="10">10</option>
                      <option value="15">15</option>
                      <option value="20">20</option>
                      <option value="25">25</option>
					  <option value="34">34</option>
                      <option value="50">50</option>
					  <option value="60">60</option>
					  <option value="66">66</option>
					  <option value="70">70</option>
                    </select>
                  </p>
                  <span id="aciklama">Ürün Linkini/Linklerini Girin. Örnek: 'https://dolap.com/urun/diger-bordo-tava-tava-seti-yeni-etiketli-istanbulavmmm-158065737'</span>
                  <br>
                  <script>
                    function jqueryBekle() {
                      if (window.jQuery) {
                        var jq, url, urladet, begeni, i;
                        jq = window.jQuery;
                        url = jq('#urladet');

                        url.on('change', function() {
                          urladet = this.value;
                          inputOlustur();
                        });

                        function inputOlustur() {
                          jq('#urlalan').empty();
                          for (i = 0; i < urladet; i++) {
                            jq('<input type="text" class="form-control magaza" id="magaza" placeholder="Ürün Linki"><br>').appendTo('#urlalan');
                          }
                          if (urladet == 1) {
                            begeni = '<div id="begeniaralik"><input type="number" class="form-control" id="likeid" placeholder="Begeni Adeti"></div>';
                            jq('#urlalan').append(begeni);
                          } else {
                            begeni = '<div id="begeniaralik"><input type="number" class="form-control" id="likemin" placeholder="Begeni Adeti Min."><input type="number" class="form-control" id="likemax" placeholder="Begeni Adeti Max."></div>';
                            jq('#urlalan').append(begeni);
                          }
                        }
                      } else {
                        setTimeout(jqueryBekle, 1000);
                      }
                    }
                    jqueryBekle();
                  </script>
                  <div id="urlalan">
                    <input type="text" class="form-control magaza" id="magaza" placeholder="Ürün Linki"><br>
                    <div id="begeniaralik">
                      <input type="number" class="form-control" id="likeid" placeholder="Begeni Adeti">
                    </div>
                  </div>
                  <style>
                    #aciklama {
                      display: block;
                      text-align: left;
                      font-size: 14px;
                      color: #cd0000;
                    }

                    #begeniaralik {
                      display: flex;
                    }

                    #likemin {
                      margin-right: 15px;
                    }
                  </style>
                  <!-- 13.07.2022 -->
                  <center>
                    <p id="result"></p>
                    <div class="col-md-12">
                      <button type="submit" id="baslat" class="btn btn-inverse-success btn-fw"> Başlat </button>
                    </div>
                  </center>
                </div>
              </div>
            </div>
          </center>
          <br>
          <center>
            <div class="col-lg-6">
              <div class="card border">
                <div class="card-body">
                  <h5 class="card-title text-success">Durum</h5>
                  <hr>
                  <p id="true"></p>
                </div>
              </div>
            </div>
            <br>
            <script>
              $('#baslat').click(function() {
                document.getElementById("result").innerText = "Lütfen Bekleyiniz..";
                var data;
                if ($('#urladet').val() == 1) {
                  data = 'adet=' + $('#likeid').val() + '&url=' + $('#magaza').val();
                } else {
                  var linklist = [];
                  $('.magaza').each(function() {
                    linklist.push($(this).val());
                  });
                  var filtered = linklist.filter(element => {
                    return element !== '';
                  });
                  data = 'adetmin=' + $('#likemin').val() + '&adetmax=' + $('#likemax').val() + '&links=' + filtered;
                }
                // 13.07.2022
                $.ajax({
                  type: 'POST',
                  url: 'api/likegericek.php',
                  data: data,
                  success: function(cevap) {
                    document.getElementById("result").innerText = "İşlem Bitti!";
                    $("#true").html(cevap);
                  }
                  //
                });
              });
            </script>
        </div>
      </div>
    </div>
    </center>
</body>
<footer class="footer">
  <div class="footer-inner-wraper">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
      <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © DOLAPBOT 2021</span>
      <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Coded by <a href="#" target="_blank">DOLAPBOT</a></span>
    </div>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="assets/vendors/chart.js/Chart.min.js"></script>
<script src="assets/vendors/jquery-circle-progress/js/circle-progress.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="assets/js/off-canvas.js"></script>
<script src="assets/js/hoverable-collapse.js"></script>
<script src="assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="assets/js/dashboard.js"></script>
<!-- End custom js for this page -->
</body>

</html>