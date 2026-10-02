 <center>
 <h3>Tambah Data Penduduk </h3>
<div class="panel panel-default" style="max-width:600px;">
    <form method="post" id="form-add">
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
                <tr >
                    <td><label>No. KK</label></td>
                    <td align="center">:</td>
                    <td style="padding-bottom: 10px;padding-top: 10px;">
                        <input class="form-control" name="nokk" id="nokk" type="text" required>
                    </td>
                </tr>
                <tr >
                    <td><label>Nama Lengkap</label></td>
                    <td align="center">:</td>
                    <td style="padding-bottom: 10px;padding-top: 10px;">
                        <input class="form-control" name="nama" id="nama" type="text" required>
                    </td>
                </tr>
                <tr >
                    <td><label>Alamat KK/KTP</label></td>
                    <td align="center">:</td>
                    <td style="padding-bottom: 10px;padding-top: 10px;" >
                        <textarea class="form-control" name="alamatktp" id="alamatktp" rows="2" style="resize: none;" required></textarea>
                    </td>
                </tr>
                <tr >
                    <td><label>No. Telp</label></td>
                    <td align="center">:</td>
                    <td style="padding-bottom: 10px;padding-top: 10px;">
                        <input class="form-control" name="telp" id="telp" type="number">
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
            $("#form-add").submit(function(event){
                event.preventDefault();
                var tambahpenduduk = {
                    'attr'              :'tambahpenduduk',
                    'nokk'              : $('input[name=nokk]').val(),
                    'nama'              : $('input[name=nama]').val(),
                    'alamatktp'         : $('textarea[name=alamatktp]').val(),
                    'telp'              : $('input[name=telp]').val()
                };
                //console.log(tambahpenduduk);
                $.ajax({
                    url: "function.php",
                    method: "POST",
                    data: tambahpenduduk,
                    success: function(data){
                        $(".notifContent").html(data);
                        $(".modalNotif").modal('show')
                    }
                });
            });
        })
    </script>
