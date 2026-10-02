<?php
include('fpdf/pdf_mc_table.php');
include('koneksi.php');
//error_reporting(0);
$pdf = new PDF_MC_Table('L');
$pdf->AddPage();

$pdf->Cell(0,8,'',0,1);
date_default_timezone_set('Asia/Jakarta');
$tgl = date("d-m-Y");
$pdf->SetFont('Times','',12);

$pdf->SetFont('Times','B',15);
$pdf->Cell(0,8,'LAPORAN DISTRIBUSI OBAT-OBATAN',0,1,'C');

$pdf->SetFont('Times','B',12);
$pdf->Cell(0,6,'GAMPONG KASEH SAYANG, KEC. MANYAK PAYED, KAB. ACEH TAMIANG',0,1,'C');


$pdf->Cell(10,5,'',0,1);

$pdf->SetFont('Times','B',11);

$pdf->Cell(10,8,'No',1,0,'C');
$pdf->Cell(35,8,'No. KK',1,0,'C');
$pdf->Cell(50,8,'Nama Penerima',1,0,'C');
$pdf->Cell(70,8,'Alamat KTP/KK',1,0,'C');
$pdf->Cell(35,8,'Nama Obat',1,0,'C');
$pdf->Cell(30,8,'Tanggal',1,0,'C');
$pdf->Cell(47,8,'Keterangan',1,1,'C');

$pdf->SetFont('Times','',11);
$pdf->SetWidths(Array(10,35,50,70,35,30,47));
$pdf->SetAligns(Array('C','','','','','C',''));
$pdf->SetLineHeight(7);

if (isset($_POST['tglmulai']) && isset($_POST['tglakhir'])) {
    $tglmulai = $_POST['tglmulai'];
    $tglakhir = $_POST['tglakhir'];
    $tglakhir_lengkap = $tglakhir . " 23:59:59";

    $query = "SELECT pd.nokk, pd.nama_penduduk, pd.alamat_ktp, jnb.nama_jenisbantuan, pnb.keterangan, pnb.lastupdated 
              FROM tb_penduduk pd 
              JOIN tb_penerimabantuan pnb ON pd.id_penduduk = pnb.id_penduduk 
              JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan 
              WHERE pnb.lastupdated BETWEEN ? AND ? ORDER BY pnb.lastupdated DESC";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("ss", $tglmulai, $tglakhir_lengkap);
}elseif (isset($_POST['kunci'])) {
    $kunci = "%" . $_POST['kunci'] . "%";
    $query = "SELECT pd.nokk, pd.nama_penduduk, pd.alamat_ktp, jnb.nama_jenisbantuan, pnb.keterangan, pnb.lastupdated 
              FROM tb_penduduk pd 
              JOIN tb_penerimabantuan pnb ON pd.id_penduduk = pnb.id_penduduk 
              JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan 
              WHERE pd.nokk LIKE ? OR pd.nama_penduduk LIKE ? OR pd.alamat_ktp LIKE ? OR pd.alamat_domisili LIKE ? OR jnb.nama_jenisbantuan LIKE ? 
              ORDER BY pnb.lastupdated DESC";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssss", $kunci, $kunci, $kunci, $kunci, $kunci);
}

if (isset($stmt)) {
    $stmt->execute();
    $ambil = $stmt->get_result();
    $nomor = 1;
    while ($item = $ambil->fetch_assoc()) {
        $pdf->Row(array(
            $nomor++,
            $item['nokk'],
            $item['nama_penduduk'],
            $item['alamat_ktp'],
            $item['nama_jenisbantuan'],
            date('d-m-Y', strtotime($item['lastupdated'])),
            $item['keterangan'],
        ));
    }
}

$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->SetX(-90);
$pdf->Cell(80, 6, 'Manyak Payed, ' . $tgl, 0, 1, 'C');

$pdf->SetX(-90);
$pdf->Cell(80, 6, 'Datok Penghulu', 0, 1, 'C');

$pdf->Ln(25);

$pdf->SetX(-90);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(80, 6, '( ........................................... )', 0, 1, 'C');

$pdf->Output('Laporan-Distribusi-Obat-' . $tgl . '.pdf', 'I');