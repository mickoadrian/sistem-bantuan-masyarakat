<?php
$ambil=$koneksi->query("SELECT COUNT(*) AS jumlah_penerima FROM tb_penerimabantuan");
   $data = $ambil->fetch_assoc();
?>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            font-family: 'Poppins', Arial, sans-serif;
        }

        .glass-container {
            width: 100%;
            max-width: 1000px;
            padding: 18px 24px;
            border-radius: 16px;

            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);

            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .running-text {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
        }

        .page-title-animated {
            display: inline-block;
            color: #ffffff;
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            animation: runningText 20s linear infinite;
        }

        @keyframes runningText {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(-100%);
            }
        }

        @media (max-width: 768px) {
            .page-title-animated {
                font-size: 16px;
            }
        }
    .panel-back {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: none;
    }
    .panel-back:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .icon-box {
        border-radius: 50% !important;
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        margin-right: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .icon-box i {
    font-size: 28px;
    color: #fff;
    line-height: 50px;
}

.bg-color-blue {
    background: linear-gradient(135deg, #3498db, #2980b9);
}

.bg-color-green {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
}

.bg-color-red {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
}

.set-icon {
    display: inline-block;
}


    .text-box p {
        color: #777;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0;
    }
    .main-text {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }
    .page-title-animated {
        font-weight: 700;
        color: #2c3e50;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        line-height: 1.4;
    }
    .home-banner-image {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        transition: transform 0.5s;
        max-width: 100%;
        height: auto;
    }
    .home-banner-image:hover {
        transform: scale(1.02);
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default" style="border:none; box-shadow:none; background:transparent;">
            <div class="panel-body">
                <div class="glass-container">
                    <div class="running-text">
                        <h2 class="page-title-animated">
                            SISTEM DISTRIBUSI BANTUAN OBAT-OBATAN &nbsp; | &nbsp;
                            GAMPONG KASEH SAYANG &nbsp; | &nbsp;
                            KECAMATAN MANYAK PAYED &nbsp; | &nbsp;
                            KABUPATEN ACEH TAMIANG
                        </h2>
                    </div>
                </div>
                <div class="text-center">
                    <img src="assets/img/banjir_aceh_tamiang.jpg" class="img-responsive home-banner-image" alt="Banjir di Aceh Tamiang">
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row text-center">
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-group"></i>
                </span>
                <div class="text-box">
                    <div class="main-text">
                        <?php echo $data['jumlah_penerima']; ?>
                        <br>PENERIMA
                    </div>                            
                    <p>Total Penerima Obat</p> 
                </div>
            </div>
        </div>

        <?php
        $ambil2=$koneksi->query("SELECT COUNT(*) AS jumlah_bantuan FROM tb_jenisbantuan");
        $data2 = $ambil2->fetch_assoc();
        ?>
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-table"></i>
                </span>
                <div class="text-box">
                    <div class="main-text">
                        <?php echo $data2['jumlah_bantuan']; ?>
                        <br>JENIS OBAT
                    </div>                            
                    <p>Total Jenis Obat Tersedia</p> 
                </div>
            </div>
        </div>

        <?php
            $ambil3=$koneksi->query("SELECT COUNT(*) as pengguna FROM tb_user");
            $data3 = $ambil3->fetch_assoc();
        ?>
        <div class="col-md-4 col-sm-4">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-user"></i>
                </span>
                <div class="text-box">
                    <div class="main-text">
                        <?php echo $data3['pengguna']; ?>
                        <br>PENGGUNA
                    </div>                            
                    <p>Total pengguna sistem</p> 
                </div>
            </div>
        </div>
    </div>

<!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>

    <script>
        $(document).ready(function () {
            document.getElementById("btn_home").classList.add('active-menu');
        });
    </script>