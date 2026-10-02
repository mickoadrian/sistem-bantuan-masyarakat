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
    <title>Laporan Penerima Obat</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style>
       @media print {
           .no-print {
               display: none;
           }
       }
       .panel-heading {
           display: flex;
           justify-content: space-between;
           align-items: center;
       }
   </style>
</head>
<body>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Laporan Penerima Obat
                        <div class="no-print">
                            <form method="post" action="cetaklaporan1.php" target="_blank" style="display: inline-block; margin-left: 10px;">
                                <?php if (isset($_POST['filter_tgl'])) : ?>
                                    <input type="hidden" value="<?php echo htmlspecialchars($_POST['tglmulai']); ?>" name="tglmulai">
                                    <input type="hidden" value="<?php echo htmlspecialchars($_POST['tglakhir']); ?>" name="tglakhir">
                                <?php elseif (isset($_POST['filter_keyword'])) : ?>
                                    <input type="hidden" value="<?php echo htmlspecialchars($_POST['carilaporan']); ?>" name="kunci">
                                <?php endif; ?>
                                <button type="submit" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Export to PDF</button>
                            </form>
                            <button onclick="window.print()" class="btn btn-info"><i class="fa fa-print"></i> Cetak</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th>No. KK</th>
                                        <th>Nama</th>
                                        <th>Alamat KK/KTP</th>
                                        <th>Nama Obat</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor = 1;
                                    $query = "SELECT pnb.id_penerimabantuan, pd.nokk, pd.nama_penduduk, pd.alamat_ktp, pd.alamat_domisili, jnb.nama_jenisbantuan, pnb.keterangan, pnb.lastupdated 
                                              FROM tb_penduduk pd 
                                              JOIN tb_penerimabantuan pnb ON pd.id_penduduk = pnb.id_penduduk 
                                              JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan";

                                    if (isset($_POST['filter_tgl'])) {
                                        $tglmulai = $_POST['tglmulai'];
                                        $tglakhir = $_POST['tglakhir'];
                                        $tglakhir_lengkap = $tglakhir . " 23:59:59";

                                        if (!empty($tglmulai) && !empty($tglakhir)) {
                                            $query .= " WHERE pnb.lastupdated BETWEEN ? AND ?";
                                            $stmt = $koneksi->prepare($query . " ORDER BY pnb.lastupdated DESC");
                                            $stmt->bind_param("ss", $tglmulai, $tglakhir_lengkap);
                                        }
                                    } elseif (isset($_POST['filter_keyword'])) {
                                        $kunci = "%" . $_POST['carilaporan'] . "%";
                                        $query .= " WHERE pd.nokk LIKE ? OR pd.nama_penduduk LIKE ? OR pd.alamat_ktp LIKE ? OR pd.alamat_domisili LIKE ? OR jnb.nama_jenisbantuan LIKE ?";
                                        $stmt = $koneksi->prepare($query . " ORDER BY pnb.lastupdated DESC");
                                        $stmt->bind_param("sssss", $kunci, $kunci, $kunci, $kunci, $kunci);
                                    }

                                    if (isset($stmt)) {
                                        $stmt->execute();
                                        $ambil = $stmt->get_result();
                                        if ($ambil->num_rows > 0) {
                                            while ($pecah = $ambil->fetch_assoc()) {
                                    ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $nomor++; ?></td>
                                                    <td><?php echo htmlspecialchars($pecah['nokk']); ?></td>
                                                    <td><?php echo htmlspecialchars($pecah['nama_penduduk']); ?></td>
                                                    <td><?php echo htmlspecialchars($pecah['alamat_ktp']); ?></td>
                                                    <td><?php echo htmlspecialchars($pecah['nama_jenisbantuan']); ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($pecah['lastupdated'])); ?></td>
                                                    <td><?php echo htmlspecialchars($pecah['keterangan']); ?></td>
                                                </tr>
                                    <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="7" class="text-center">Tidak ada data yang ditemukan</td></tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="7" class="text-center">Silakan gunakan filter untuk menampilkan laporan.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>