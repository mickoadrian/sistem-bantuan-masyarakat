<?php
include 'koneksi';
print_r($_POST['idpenduduk']);
if (isset($_POST["idpenduduk"])) {
    $id_penduduk = $_POST["idpenduduk"];
    $ambil=$koneksi->query("SELECT * FROM tb_penduduk WHERE id_penduduk='$id_penduduk'");
    $data = $ambil->fetch_assoc();
}
?>

 <center>
 <h3>Edit Data Penduduk </h3>
<div class="panel panel-default" style="max-width:600px;">
    <form method="post" id="form-edit">
    <div class="panel-body">
        <table border="0" width="100%">
            <thead style="visible:false;">
                <tr>
                    <th style="width:auto;"></th>
                    <th style="width:25px;"></th>
                    <th style="width:70%;"></th>
                </tr>
            </thead>
            <tbody>
                
                <tr><td><input type="hidden" class="form-control" name="id_pen" id="id_pen" type="text" value="<?php echo $data['id_penduduk'];?>"></td></tr>
                <tr >
                    <td><label>No. KK</label></td>
                    <td align="center">:</td>
                    <td style="padding-bottom: 10px;padding-top: 10px;">
                        <input class="form-control" name="nokk_edit" id="nokk_edit" type="text" value="<?php echo $data['nokk'];?>">
                    </td>
                </tr>
                <tr >
                    <td><label>Nama Lengkap</label></td>
                    <td align="center">:</td>
                    <td style="padding-bottom: 10px;padding-top: 10px;">
                        <input class="form-control" name="nama_edit" id="nama_edit" type="text" value="<?php echo $data['nama_penduduk'];?>">
                    </td>
                </tr>
                <tr >
                    <td><label>Alamat KK/KTP</label></td>
                    <td align="center">:</td>
                    <td style="padding-bottom: 10px;padding-top: 10px;" >
                        <textarea class="form-control" name="alamatktp_edit" id="alamatktp_edit" rows="2" style="resize: none;"><?php echo $data['alamat_ktp'];?></textarea>
                    </td>
                </tr>
                <tr >
                    <td><label>No. Telp</label></td>
                    <td align="center">:</td>
                    <td style="padding-bottom: 10px;padding-top: 10px;">
                        <input class="form-control" name="telp_edit" id="telp_edit" type="text" value="<?php echo $data['telp'];?>">
                    </td>
                </tr>
            </tbody> 
        </table>
    </div>

    <div class="panel-footer">
        <a href="?page=datapenduduk" class="btn btn-default close-modal">Batal</a>
        <button type="submit" class="btn btn-primary" name="simpan_penduduk" id="simpan_penduduk"><i class="fa fa-save"></i> Simpan</button>
    </div>
    </form> 
</div>
</center>

<script src="assets/js/jquery-1.10.2.js"></script>
<script>
    document.getElementById("btn_penduduk").classList.add('active-menu');
    $(document).ready(function () {
        $("#form-edit").submit(function(event){
           event.preventDefault();
            var editpenduduk = {
                    'attr'                   :'edit_save_penduduk',
                    'idpenduduk'             : $('input[name=id_pen]').val(),
                    'nokk_edit'              : $('input[name=nokk_edit]').val(),
                    'nama_edit'              : $('input[name=nama_edit]').val(),
                    'alamatktp_edit'         : $('textarea[name=alamatktp_edit]').val(),
                    'telp_edit'              : $('input[name=telp_edit]').val()
                };
            $.ajax({
                url: "function.php",
                method: "POST",
                data: editpenduduk,
                success: function(data){
                    $(".notifContent").html(data);
                    $(".modalNotif").modal('show')
                }
            });
            $('.close-modaledit').click();
        });
    })
    </script>
