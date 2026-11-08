<?php
error_reporting(0);
require "config/database.php";
require "config/config.php";

?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Anasayfa - Dolap Botu</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
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
              <a class="nav-link" href="sepet.php" >
                <span class="icon-bg"><i class="mdi mdi-heart"></i></span>
                <span class="menu-title">Sepete Ekle</span>
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
              <a class="nav-link" href="sepet.php" >
                <span class="icon-bg"><i class="mdi mdi-heart"></i></span>
                <span class="menu-title">Sepete Ekle</span>
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
            
            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Anasayfa </h2>
              <div class="d-sm-flex justify-content-xl-between align-items-center mb-2">
              </div>
            </div>
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Açılan Hesap Sayısı</h5>
                            <h2 class="mb-4 text-dark font-weight-bold"><?php     
    $sorgu = $conn->prepare("SELECT COUNT(*) FROM hesaplar");
    $sorgu->execute();
    $say = $sorgu->fetchColumn();
    echo htmlspecialchars($say); //
    ?></h2>
                            <br> <br> <br>
                            <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Captcha Resolver Bakiye</h5>
                            <h2 class="mb-4 text-dark font-weight-bold"><?php     
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.capmonster.cloud/getBalance");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("clientKey"=>$apikey)));
    $response = curl_exec($ch);
    if(strpos($response, 'balance') !== false) {
    $json = json_decode($response);
    echo $json->balance;
    }else{
      echo "apikey hatalı";
    }
    ?></h2>
                            <br> <br> <br>
							       <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-account-circle icon-md absolute-center text-dark"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Yorum Gönderilen Hesap Sayısı</h5>
                            <h2 class="mb-4 text-dark font-weight-bold"><?php     
    $sorgu = $conn->prepare("SELECT COUNT(*) FROM yorumblacklist");
    $sorgu->execute();
    $say = $sorgu->fetchColumn();
    echo $say; //
    ?></h2>
                            <br> <br> <br>
                            <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-comment icon-md absolute-center text-dark"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body text-center">
                            <h5 class="mb-2 text-dark font-weight-normal">Bugünkü İşlem Sayısı</h5>
                            <h2 class="mb-4 text-dark font-weight-bold"><?php     
    $sorgu = $conn->prepare("SELECT COUNT(*) FROM islemler WHERE tarih like '".date("d.m.Y")."%'");
    $sorgu->execute();
    $say = $sorgu->fetchColumn();
    echo htmlspecialchars($say); 
    ?></h2>
                            <br> <br> <br>
                            <div class="dashboard-progress dashboard-progress-2 d-flex align-items-center justify-content-center item-parent"><i class="mdi mdi-calendar icon-md absolute-center text-dark"></i></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12  grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-xl-flex justify-content-between mb-2">
                              <h4 class="card-title">Son İşlemler</h4>
                   </div>
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Kullanıcı Adı</th>
                          <th>İşlem</th>
                          <th>Gönderilen</th>
                          <th>Durum</th>
                          <th>Tarih</th>
                        </tr>
                      </thead>
                      <tbody>


                      <?php

$sorgu = $conn->query("SELECT * FROM islemler ORDER BY id DESC LIMIT 500");

  while($sonuc = $sorgu->fetch()){

                      ?>
<tr>
                          <td><?php echo mb_strtolower($sonuc["username"]); ?></td>
                          <td><?php echo $sonuc["islem"]; ?></td>
                          <td><?php echo $sonuc["gonderilen"]; ?></td>
                          <?php if($sonuc["status"] == "gönderildi"){
                            echo '<td><label class="badge badge-success">Gönderildi</label></td>';
                          }else{
                            echo '<td><label class="badge badge-danger">Başarısız</label></td>';
                            }
                            ?>

                          <td><?php echo $sonuc["tarih"]; ?></td>
                        </tr>
                     <?php
                      } ?>



                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </div>
                </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Dolap Botu 2022</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Coded by <a href="#" target="_blank">Dolap Botu</a></span>
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