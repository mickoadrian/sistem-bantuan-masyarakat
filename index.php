<?php
session_start();

include "koneksi.php";

if (!isset($_SESSION['user'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Sistem Informasi Distribusi Obat</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- DATETIME PICKER -->
    <link rel="stylesheet" href="assets/css/datepicker.css">
</head>
<body>
	<div id="wrapper">
        <?php
            $id_user = $_SESSION['user']['id_user'];
            $akses=$koneksi->query("SELECT * FROM tb_user usr LEFT JOIN tb_role rol ON usr.id_role=rol.id_role where usr.id_user='$id_user'");
            $data=$akses->fetch_assoc();
        ?>
        <!-- /. NAV TOP  -->
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="font-size: 22px;">
                    Sistem Obat
                </a>
                <div class="header-right">
                    <a href="logout.php" class="btn btn-logout-custom"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <h5 class="user-profile-name"><?php echo $data['nama_user']; ?></h5>
                    </li>
                    <li>
                        <a href="index.php" id="btn_home"><i class="fa fa-home icon-home"></i>  HOME</a>
                    </li>

                    <?php
                        if ($data["nama_role"]=="admin") {
                            echo '
                            <li>
                                <a  href="?page=datapenduduk" id="btn_penduduk"><i class="fa fa-group icon-penduduk"></i> Data Penduduk</a>
                            </li>
                            <li>
                                <a  href="?page=datapenerimabantuan" id="btn_penerima"><i class="fa fa-medkit icon-penerima"></i>  Data Penerima Obat</a>
                            </li>
                            <li>
                                <a  href="?page=dataadmin" id="btn_admin"><i class="fa fa-desktop icon-admin"></i>  Data Administrator</a>
                            </li>';
                        }
                    ?>
                    <li>
                        <a href="?page=laporan" id="btn_laporan"><i class="fa fa-book icon-laporan"></i>  Laporan</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- /. NAV SIDE  -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info alert-dismissable" style="display: none;" id="notifi" name="notifi">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                    </div>
                    <?php
                        error_reporting(E_ALL^(E_NOTICE | E_WARNING));
                        $page = $_GET['page'];
                        $aksi = $_GET['aksi'];

                        if ($page == ""){
                            include "home.php";
                        }elseif($page == "laporan") {
                            include "laporan.php";
                        }elseif($data['nama_role'] == 'admin'){
                            if ($page == "datapenduduk") {
                                if ($aksi == ""){
                                    include "penduduk.php";
                                }elseif ($aksi=="tambahdata") {
                                    include "tambahpenduduk.php";
                                }elseif ($aksi == "editdata") {
                                    include "editpenduduk.php";
                                } 
                            }elseif($page == "datapenerimabantuan") {
                                include "penerimabantuan.php";
                            }elseif($page == "dataadmin") {
                                include "administrator.php";
                            }elseif($page == "admin/databantuan") {
                                include "jenisbantuan.php";
                            }elseif($page == "admin/datapengguna") {
                                include "pengguna.php";
                            } else {
                                include "home.php";
                            }
                        } else {
                            echo "<h3>Akses ditolak!</h3>";
                        }
                    ?>
                </div>
                <div class="modal fade modalNotif" name="modalNotif">
                    <div class="modal-dialog modal-xs">
                        <div class="modal-content notifContent">
                            
                        </div>
                    </div>
                </div>    
            </div>
        </div>
	</div>
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>

     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('.dataTables_penduduk').dataTable({
                "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
            });
            $('.dataTables_penerimabantuan').dataTable({
                "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
            });
            $('.dataTables_caripenduduk').dataTable({
                
                "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
            });

            $('.dataTables_jenis').dataTable({
                
                "lengthMenu": [2, 5, 10, 25]
            });

            $('.dataTables_user').dataTable({
                
                "lengthMenu": [2, 5, 10, 25]
            });

            $('.dataTables_laporan').dataTable({
                
                "lengthMenu": [ 5, 10, 25, 50, 75, 100 ]
            });

        });  
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/bootstrap-datepicker.js"></script>
</body>
</html>
