<?php
session_start();
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');
$lastupdated = date("Y-m-d H:i:s");

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $stmt = $koneksi->prepare("SELECT * FROM tb_user WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    $ambil = $stmt->get_result();
    $data = $ambil->fetch_assoc();
    $ygcocok = $ambil->num_rows;
    if ($ygcocok >= 1 && isset($data['password']) && password_verify($_POST["password"], $data["password"])) {
        $_SESSION["user"] = $data;
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">LOGIN BERHASIL</h2>
            <p class="text-muted">Selamat datang di sistem.</p>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="index.php" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
        //$ubahstatus=$koneksi->query("UPDATE tb_user SET session=session+1 WHERE id_user='$id_user'");
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">LOGIN GAGAL</h2>
            <p class="text-danger">Periksa kembali username dan password dengan benar!</p>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'tambahpenduduk') {
    // nik dan alamat_domisili tidak ada di form, diasumsikan string kosong
    $nik = "";
    $alamat_domisili = "";
    $stmt = $koneksi->prepare("INSERT INTO tb_penduduk (nik, nokk, nama_penduduk, alamat_ktp, alamat_domisili, telp, lastupdated) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nik, $_POST['nokk'], $_POST['nama'], $_POST['alamatktp'], $alamat_domisili, $_POST['telp'], $lastupdated);
    $simpan = $stmt->execute();
    if ($simpan) {
        echo '
            <div class="modal-body text-center">
                <div style="margin-bottom: 15px;">
                    <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
                </div>
                <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DISIMPAN</h2>
            </div>
            <div class="modal-footer" style="text-align: center; border-top: none;">
                <a href="?page=datapenduduk" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
            </div>';
    } else {
        echo '
            <div class="modal-body text-center">
                <div style="margin-bottom: 15px;">
                    <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
                </div>
                <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL SIMPAN DATA</h2>
            </div>
            <div class="modal-footer" style="text-align: center; border-top: none;">
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
            </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_view_penduduk') {
    error_reporting(0);
    $id_penduduk = $_POST['data_id'];
    $stmt = $koneksi->prepare("SELECT * FROM tb_penduduk WHERE id_penduduk=?");
    $stmt->bind_param("i", $id_penduduk);
    $stmt->execute();
    $ambil = $stmt->get_result();
    $data = $ambil->fetch_assoc();
?>
    <input type="hidden" name="id_pen" id="id_pen" value="<?php echo $data['id_penduduk']; ?>">
    <div class="form-group">
        <label>No. KK</label>
        <input class="form-control" name="nokk_edit" id="nokk_edit" type="text" value="<?php echo $data['nokk']; ?>" required>
    </div>
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input class="form-control" name="nama_edit" id="nama_edit" type="text" value="<?php echo $data['nama_penduduk']; ?>" required>
    </div>
    <div class="form-group">
        <label>Alamat KK/KTP</label>
        <textarea class="form-control" name="alamatktp_edit" id="alamatktp_edit" rows="3" style="resize: none;" required><?php echo $data['alamat_ktp']; ?></textarea>
    </div>
    <div class="form-group">
        <label>No. Telp</label>
        <input class="form-control" name="telp_edit" id="telp_edit" type="number" value="<?php echo $data['telp']; ?>">
    </div>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_save_penduduk') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    // nik_edit dan alamatdomisili_edit tidak ada di form
    $stmt = $koneksi->prepare("UPDATE tb_penduduk SET nokk=?, nama_penduduk=?, alamat_ktp=?, telp=?, lastupdated=? WHERE id_penduduk=?");
    $stmt->bind_param("sssssi", $_POST['nokk_edit'], $_POST['nama_edit'], $_POST['alamatktp_edit'], $_POST['telp_edit'], $lastupdated, $_POST['idpenduduk']);
    $ubah = $stmt->execute();
    if ($ubah) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DIUBAH</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="?page=datapenduduk" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL UBAH DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_view_penduduk') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penduduk = $_POST['data_id'];
    $stmt = $koneksi->prepare("SELECT * FROM tb_penduduk WHERE id_penduduk=?");
    $stmt->bind_param("i", $id_penduduk);
    $stmt->execute();
    $ambil = $stmt->get_result();
    $data = $ambil->fetch_assoc();
?>
    <input type="hidden" name="id_pen_hps" id="id_pen_hps" value="<?php echo $data['id_penduduk']; ?>">
    <div class="text-center" style="margin-bottom: 20px;">
        <i class="fa fa-exclamation-triangle fa-4x" style="color: #f39c12;"></i>
        <h3 style="margin-top: 10px;">Apakah Anda Yakin?</h3>
        <p>Data penduduk berikut akan dihapus permanen:</p>
    </div>
    <div class="well well-sm">
        <strong>Nama : </strong> <?php echo $data['nama_penduduk']; ?><br>
        <strong>Alamat : </strong> <?php echo $data['alamat_ktp']; ?>
    </div>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_penduduk') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penduduk = $_POST['data_id'];

    // Cek dulu apakah penduduk ada di data penerima bantuan
    $stmt_cek = $koneksi->prepare("SELECT id_penduduk FROM tb_penerimabantuan WHERE id_penduduk=?");
    $stmt_cek->bind_param("i", $id_penduduk);
    $stmt_cek->execute();
    $cek = $stmt_cek->get_result();
    $hasilcek = $cek->num_rows;

    if ($hasilcek > 0) {
        $hapus = false;
    } else {
        $stmt_hapus = $koneksi->prepare("DELETE FROM tb_penduduk WHERE id_penduduk=?");
        $stmt_hapus->bind_param("i", $id_penduduk);
        $hapus = $stmt_hapus->execute();
    }

    if ($hapus) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DIHAPUS</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="index.php?page=datapenduduk" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL HAPUS DATA</h2>';
        if ($hasilcek > 0) {
            echo '<p class="text-danger">NOTE : Data Penduduk tersebut sudah ada di data penerima obat. Silahkan hapus terlebih dahulu di Data Penerima Obat</p>';
        }
        echo '
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'tambahpenerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    
    $ids_obat = $_POST['id_jenisbantuan'];
    $sukses = false;

    // Pastikan input adalah array, jika tidak (single select lama), bungkus dalam array
    if (!is_array($ids_obat)) {
        $ids_obat = array($ids_obat);
    }

    foreach ($ids_obat as $id_obat) {
        $stmt = $koneksi->prepare("INSERT INTO tb_penerimabantuan (id_penduduk, id_jenisbantuan, keterangan, lastupdated) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $_POST['id_penduduk_penerima'], $id_obat, $_POST['keterangan'], $lastupdated);
        $simpan = $stmt->execute();

        if ($simpan) {
            $stmt_restok = $koneksi->prepare("UPDATE tb_jenisbantuan SET jumlah_bantuan=jumlah_bantuan-1 WHERE id_jenisbantuan = ?");
            $stmt_restok->bind_param("i", $id_obat);
            $stmt_restok->execute();
            $sukses = true;
        }
    }

    if ($sukses) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DISIMPAN</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="?page=datapenerimabantuan" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL SIMPAN DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_view_penerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penerimabantuan = $_POST['id_penerimabantuan'];
    $stmt = $koneksi->prepare("SELECT pnb.id_penerimabantuan,pdk.id_penduduk,pdk.nokk,pdk.nama_penduduk,pdk.alamat_ktp,pdk.alamat_domisili,jnb.id_jenisbantuan,pnb.keterangan FROM tb_penerimabantuan pnb JOIN tb_penduduk pdk ON pnb.id_penduduk = pdk.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan=jnb.id_jenisbantuan WHERE pnb.id_penerimabantuan = ?");
    $stmt->bind_param("i", $id_penerimabantuan);
    $stmt->execute();
    $ambil = $stmt->get_result();
    $data = $ambil->fetch_assoc();
?>
    <label>Cari Penduduk (opsional jika ingin mengubah)</label>
    <div class="form-group input-group">
        <input type="text" class="form-control" id="carinik" name="carinik" placeholder="Cari dan pilih data penduduk...">
        <span class="input-group-btn">
            <button class="btn btn-default btn_caripenduduk_edit" type="button" data-toggle="modal" data-target="#modalCari"><i class="fa fa-search"></i></button>
        </span>
    </div>
    <input id="id_penerimaedit" name="id_penerimaedit" type="hidden" value="<?php echo $data['id_penerimabantuan']; ?>">
    <input id="id_penduduk_penerimaedit" name="id_penduduk_penerimaedit" type="hidden" value="<?php echo $data['id_penduduk']; ?>">
    <div class="form-group">
        <label>No. KK</label>
        <input class="form-control" id="nokk_penerimaedit" name="nokk_penerimaedit" type="text" value="<?php echo $data['nokk']; ?>" disabled>
    </div>
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input class="form-control" id="nama_penerimaedit" name="nama_penerimaedit" type="text" value="<?php echo $data['nama_penduduk']; ?>" disabled>
    </div>
    <div class="form-group">
        <label>Alamat KK/KTP</label>
        <textarea class="form-control" name="alamatktp_penerimaedit" id="alamatktp_penerimaedit" rows="2" style="resize: none;" disabled><?php echo $data['alamat_ktp']; ?></textarea>
    </div>
    <div class="form-group">
        <label>Nama Obat</label>
        <select class="form-control" name="id_jenisbantuanedit" id="id_jenisbantuanedit">
            <option disabled>--Pilih jenis obat--</option>
            <?php
            $ambil_bantuan = $koneksi->query("SELECT * FROM tb_jenisbantuan where jumlah_bantuan > 0");
            while ($pecah = $ambil_bantuan->fetch_assoc()) { ?>
                <option value="<?php echo $pecah["id_jenisbantuan"]; ?>" <?php if ($pecah["id_jenisbantuan"] == $data["id_jenisbantuan"]) { echo 'selected="selected"'; } ?>>
                    <?php echo $pecah['nama_jenisbantuan']; ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <input class="form-control" id="keterangan_edit" name="keterangan_edit" value="<?php echo $data['keterangan']; ?>" type="text">
    </div>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_save_penerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $idpenduduk = $_POST['id_penduduk'];
    $idpenerima = $_POST['id_penerimabantuan'];
    $idjenis = $_POST['id_jenisbantuan'];
    $keterangan = $_POST['keterangan'];

    $stmt_cek = $koneksi->prepare("SELECT id_jenisbantuan FROM tb_penerimabantuan WHERE id_penerimabantuan=?");
    $stmt_cek->bind_param("i", $idpenerima);
    $stmt_cek->execute();
    $cekjenis = $stmt_cek->get_result();
    $jenis = $cekjenis->fetch_assoc();
    $idj = $jenis['id_jenisbantuan'];

    if ($idjenis != $idj) {
        $stmt_restok = $koneksi->prepare("UPDATE tb_jenisbantuan SET jumlah_bantuan=jumlah_bantuan-1 WHERE id_jenisbantuan = ?");
        $stmt_restok->bind_param("i", $idjenis);
        $stmt_restok->execute();

        $stmt_restok2 = $koneksi->prepare("UPDATE tb_jenisbantuan SET jumlah_bantuan=jumlah_bantuan+1 WHERE id_jenisbantuan = ?");
        $stmt_restok2->bind_param("i", $idj);
        $stmt_restok2->execute();
    }

    $stmt_ubah = $koneksi->prepare("UPDATE tb_penerimabantuan SET id_penduduk=?, id_jenisbantuan=?, keterangan=?, lastupdated=? WHERE id_penerimabantuan=?");
    $stmt_ubah->bind_param("iissi", $idpenduduk, $idjenis, $keterangan, $lastupdated, $idpenerima);
    $ubah = $stmt_ubah->execute();
    if ($ubah) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DIUBAH</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="?page=datapenerimabantuan" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL UBAH DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_view_penerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penerimabantuan = $_POST['data_id'];
    $stmt = $koneksi->prepare("SELECT pnb.id_penerimabantuan,pdk.nama_penduduk,pdk.nokk,jnb.nama_jenisbantuan FROM tb_penerimabantuan pnb JOIN tb_penduduk pdk ON pnb.id_penduduk=pdk.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan WHERE pnb.id_penerimabantuan=?");
    $stmt->bind_param("i", $id_penerimabantuan);
    $stmt->execute();
    $ambil = $stmt->get_result();
    $data = $ambil->fetch_assoc();
?>
    <input type="hidden" name="id_penerima_hps" id="id_penerima_hps" value="<?php echo $data['id_penerimabantuan']; ?>">
    <div class="text-center" style="margin-bottom: 20px;">
        <i class="fa fa-exclamation-triangle fa-4x" style="color: #f39c12;"></i>
        <h3 style="margin-top: 10px;">Apakah Anda Yakin?</h3>
        <p>Data penerima obat berikut akan dihapus:</p>
    </div>
    <div class="well well-sm">
        <strong>Nama : </strong> <?php echo $data['nama_penduduk']; ?><br>
        <strong>No. KK : </strong> <?php echo $data['nokk']; ?><br>
        <strong>Obat : </strong> <?php echo $data['nama_jenisbantuan']; ?>
    </div>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_penerima') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_penerimabantuan = $_POST['data_id'];
    $stmt = $koneksi->prepare("DELETE FROM tb_penerimabantuan WHERE id_penerimabantuan=?");
    $stmt->bind_param("i", $id_penerimabantuan);
    $hapus = $stmt->execute();
    if ($hapus) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DIHAPUS</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="index.php?page=datapenerimabantuan" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL HAPUS DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'tambahbantuan') {
    $stmt = $koneksi->prepare("INSERT INTO tb_jenisbantuan (nama_jenisbantuan, jenis, jumlah_bantuan, satuan, keterangan, lastupdated) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error pada database: " . $koneksi->error);
    }
    $stmt->bind_param("ssisss", $_POST['nama_bantuan'], $_POST['jenis_bantuan'], $_POST['jml_bantuan'], $_POST['satuan'], $_POST['ket_bantuan'], $lastupdated);
    $simpan = $stmt->execute();
    if ($simpan) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DISIMPAN</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="?page=dataadmin" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL SIMPAN DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_view_jenis') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    // $id_penerimabantuan = $_POST[id_penerimabantuan];
    $stmt = $koneksi->prepare("SELECT * FROM tb_jenisbantuan WHERE id_jenisbantuan = ?");
    $stmt->bind_param("i", $_POST['id_jenis']);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
?>
    <input type="hidden" id="id_jenisedit" name="id_jenisedit" value="<?php echo $data['id_jenisbantuan']; ?>">
    <div class="form-group">
        <label>Nama Obat</label>
        <input class="form-control" name="nama_bantuanedit" id="nama_bantuanedit" type="text" value="<?php echo $data['nama_jenisbantuan']; ?>" required>
    </div>
    <div class="form-group">
        <label>Jenis Obat</label>
        <select class="form-control" name="jenis_bantuanedit" id="jenis_bantuanedit" required>
            <option value="Tablet" <?php if($data['jenis']=='Tablet') echo 'selected'; ?>>Tablet</option>
            <option value="Sirup" <?php if($data['jenis']=='Sirup') echo 'selected'; ?>>Sirup</option>
            <option value="Alat Kesehatan" <?php if($data['jenis']=='Alat Kesehatan') echo 'selected'; ?>>Alat Kesehatan</option>
            <option value="Injeksi" <?php if($data['jenis']=='Injeksi') echo 'selected'; ?>>Injeksi</option>
        </select>
    </div>
    <div class="form-group">
        <label>Jumlah Stok</label>
        <input class="form-control" name="jml_bantuanedit" id="jml_bantuanedit" type="number" value="<?php echo $data['jumlah_bantuan']; ?>" required>
    </div>
    <div class="form-group">
        <label>Satuan</label>
        <input class="form-control" name="satuanedit" id="satuanedit" type="text" value="<?php echo $data['satuan']; ?>">
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <textarea class="form-control" name="ket_bantuanedit" id="ket_bantuanedit" rows="2" style="resize: none;"><?php echo $data['keterangan']; ?></textarea>
    </div>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_save_jenis') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $stmt = $koneksi->prepare("UPDATE tb_jenisbantuan SET nama_jenisbantuan=?, jenis=?, jumlah_bantuan=?, satuan=?, keterangan=?, lastupdated=? WHERE id_jenisbantuan=?");
    $stmt->bind_param("ssisssi", $_POST['nama_jenis'], $_POST['jenis_bantuan'], $_POST['jmlh_jenis'], $_POST['satuan_jenis'], $_POST['keterangan'], $lastupdated, $_POST['id_jenis']);
    $ubah = $stmt->execute();
    if ($ubah) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DIUBAH</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="?page=dataadmin" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL UBAH DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_view_jenis') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_jenisbantuan = $_POST['id_jenisb'];
    $stmt = $koneksi->prepare("SELECT * FROM tb_jenisbantuan WHERE id_jenisbantuan=?");
    $stmt->bind_param("i", $id_jenisbantuan);
    $stmt->execute();
    $ambil = $stmt->get_result();
    $data = $ambil->fetch_assoc();
?>
    <input type="hidden" name="id_jenis_hps" id="id_jenis_hps" value="<?php echo $data['id_jenisbantuan']; ?>">
    <div class="text-center" style="margin-bottom: 20px;">
        <i class="fa fa-exclamation-triangle fa-4x" style="color: #f39c12;"></i>
        <h3 style="margin-top: 10px;">Apakah Anda Yakin?</h3>
        <p>Data jenis obat berikut akan dihapus:</p>
    </div>
    <div class="well well-sm">
        <strong>Nama : </strong> <?php echo $data['nama_jenisbantuan']; ?><br>
        <strong>Jumlah : </strong> <?php echo $data['jumlah_bantuan']; ?><br>
        <strong>Keterangan : </strong> <?php echo $data['keterangan']; ?>
    </div>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_jenis_ok') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_jenisbantuan = $_POST['data_id'];

    // Cek dulu apakah jenis bantuan ini digunakan di tb_penerimabantuan
    $stmt_cek = $koneksi->prepare("SELECT id_jenisbantuan FROM tb_penerimabantuan WHERE id_jenisbantuan=?");
    $stmt_cek->bind_param("i", $id_jenisbantuan);
    $stmt_cek->execute();
    $cek = $stmt_cek->get_result();
    $hasilcek = $cek->num_rows;

    if ($hasilcek > 0) {
        $hapus = false;
    } else {
        $stmt_hapus = $koneksi->prepare("DELETE FROM tb_jenisbantuan WHERE id_jenisbantuan=?");
        $stmt_hapus->bind_param("i", $id_jenisbantuan);
        $hapus = $stmt_hapus->execute();
    }

    if ($hapus) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DIHAPUS</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="index.php?page=dataadmin" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL HAPUS DATA</h2>';
        if ($hasilcek > 0) {
            echo '<p class="text-danger">NOTE : Data jenis obat telah digunakan di Data Penerima Obat. Silahkan hapus terlebih dahulu di Data Penerima Obat</p>';
        }
        echo '
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'tambahuser') {
    $hashed_pass = password_hash($_POST['pass_user'], PASSWORD_DEFAULT);
    $stmt = $koneksi->prepare("INSERT INTO tb_user (nama_user, username, password, id_role, lastupdated) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $_POST['nama_user'], $_POST['username_user'], $hashed_pass, $_POST['id_role'], $lastupdated);
    $simpanuser = $stmt->execute();
    if ($simpanuser) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DISIMPAN</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="?page=dataadmin" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL SIMPAN DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_view_user') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $id_user = $_POST['id_user'];
    $stmt = $koneksi->prepare("SELECT * FROM tb_user WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $ambil = $stmt->get_result();
    $data = $ambil->fetch_assoc();
?>
    <input type="hidden" id="id_useredit" name="id_useredit" value="<?php echo $data['id_user']; ?>">
    <div class="form-group">
        <label>Nama Lengkap</label>
        <input class="form-control" name="nama_useredit" id="nama_useredit" type="text" required value="<?php echo $data['nama_user']; ?>">
    </div>
    <div class="form-group">
        <label>Username</label>
        <input class="form-control" name="username_useredit" id="username_useredit" type="text" required value="<?php echo $data['username']; ?>">
    </div>
    <div class="form-group">
        <label>Password Baru (opsional)</label>
        <input class="form-control" name="pass_useredit" id="pass_useredit" type="password" placeholder="Kosongkan jika tidak ingin diubah">
    </div>
    <div class="form-group">
        <label>Hak Akses</label>
        <select class="form-control" name="hakakses_edit" id="hakakses_edit" required>
            <option disabled>--Pilih Hak Akses--</option>
            <?php
            $ambil_role = $koneksi->query("SELECT * FROM tb_role ORDER BY nama_role ASC");
            while ($pecah = $ambil_role->fetch_assoc()) { ?>
                <option value="<?php echo $pecah["id_role"]; ?>" <?php if ($pecah["id_role"] == $data["id_role"]) { echo 'selected="selected"'; } ?>>
                    <?php echo ucwords($pecah['nama_role']); ?></option>
            <?php } ?>
        </select>
    </div>
<?php
}

if (isset($_POST['attr']) and $_POST['attr'] == 'edit_save_user') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    if (!empty($_POST['pass_user'])) {
        $hashed_pass = password_hash($_POST['pass_user'], PASSWORD_DEFAULT);
        $stmt = $koneksi->prepare("UPDATE tb_user SET nama_user=?, username=?, password=?, id_role=?, lastupdated=? WHERE id_user=?");
        $stmt->bind_param("sssisi", $_POST['nama_user'], $_POST['username_user'], $hashed_pass, $_POST['hakakses'], $lastupdated, $_POST['id_user']);
    } else {
        $stmt = $koneksi->prepare("UPDATE tb_user SET nama_user=?, username=?, id_role=?, lastupdated=? WHERE id_user=?");
        $stmt->bind_param("ssisi", $_POST['nama_user'], $_POST['username_user'], $_POST['hakakses'], $lastupdated, $_POST['id_user']);
    }
    $ubah = $stmt->execute();
    if ($ubah) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DIUBAH</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="?page=dataadmin" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL UBAH DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

if (isset($_POST['attr']) and $_POST['attr'] == 'hapus_user_ok') {
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $stmt = $koneksi->prepare("DELETE FROM tb_user WHERE id_user=?");
    $stmt->bind_param("i", $_POST['idusr']);
    $hapus = $stmt->execute();
    if ($hapus) {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-check-circle fa-5x" style="color: #2ecc71;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">BERHASIL DIHAPUS</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <a href="index.php?page=dataadmin" type="button" class="btn btn-primary btn-lg" style="border-radius: 50px; padding: 10px 40px;">OK</a>
        </div>';
    } else {
        echo '
        <div class="modal-body text-center">
            <div style="margin-bottom: 15px;">
                <i class="fa fa-times-circle fa-5x" style="color: #e74c3c;"></i>
            </div>
            <h2 style="font-weight: bold; margin-bottom: 10px; color: #333;">GAGAL HAPUS DATA</h2>
        </div>
        <div class="modal-footer" style="text-align: center; border-top: none;">
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal" style="border-radius: 50px; padding: 10px 40px;">Close</button>
        </div>';
    }
}

?>