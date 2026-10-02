<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Jenis Obat
                <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modalTambahBantuan" style="margin-top: -5px;">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables_jenis" id="dataTables_jenis">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Nama Obat</th>
                                <th>Jenis Obat</th>
                                <th>Jumlah Stok</th>
                                <th>Satuan</th>
                                <th>Keterangan</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nomor=1;
                                $ambil=$koneksi->query("SELECT * FROM tb_jenisbantuan ORDER BY lastupdated DESC");
                                while($pecah=$ambil->fetch_assoc()){
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $nomor;?></td>
                                <td><?php echo $pecah['nama_jenisbantuan'];?></td>
                                <td><?php echo $pecah['jenis'];?></td>
                                <td class="text-center"><?php echo $pecah['jumlah_bantuan'];?></td>
                                <td><?php echo $pecah['satuan'];?></td>
                                <td><?php echo $pecah['keterangan'];?></td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm edit_jenis" data-id="<?php echo $pecah['id_jenisbantuan'];?>" title="Edit"><i class="fa fa-edit"></i></button >
                                    <button class="btn btn-danger btn-sm hapus_jenis" data-id="<?php echo $pecah['id_jenisbantuan'];?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php 
                                $nomor++;}
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Pengguna Sistem
                <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modalTambahuser" style="margin-top: -5px;">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables_user" id="dataTables_user">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Hak Akses</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nomor=1;
                                $ambil=$koneksi->query("SELECT * FROM tb_user usr JOIN tb_role rl ON usr.id_role=rl.id_role ORDER BY usr.lastupdated DESC");
                                while($pecah=$ambil->fetch_assoc()){
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $nomor;?></td>
                                <td><?php echo $pecah['nama_user'];?></td>
                                <td><?php echo $pecah['username'];?></td>
                                <td><?php echo ucwords($pecah['nama_role']);?></td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm edit_user" data-id="<?php echo $pecah['id_user'];?>" title="Edit"><i class="fa fa-edit"></i></button >
                                    <button class="btn btn-danger btn-sm hapus_user" data-id="<?php echo $pecah['id_user'];?>" title="Hapus"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php 
                                $nomor++;}
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahBantuan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="form-add-bantuan">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Jenis Obat</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <input class="form-control" name="nama_bantuan" id="nama_bantuan" type="text" required placeholder="Masukkan nama obat">
                </div>
                <div class="form-group">
                    <label>Jenis Obat</label>
                    <select class="form-control" name="jenis_bantuan" id="jenis_bantuan" required>
                        <option value="" disabled selected>--Pilih Jenis--</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Sirup">Sirup</option>
                        <option value="Alat Kesehatan">Alat Kesehatan</option>
                        <option value="Injeksi">Injeksi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Jumlah Stok</label>
                    <input class="form-control" name="jml_bantuan" id="jml_bantuan" type="number" required placeholder="Masukkan jumlah stok obat">
                </div>
                <div class="form-group">
                    <label>Satuan</label>
                    <input class="form-control" name="satuan" id="satuan" type="text" placeholder="Contoh: Strip, Botol, Pcs">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="ket_bantuan" id="ket_bantuan" rows="2" style="resize: none;" placeholder="Keterangan tambahan (opsional)"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-jenis" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="simpan_jenis" id="simpan_jenis"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditjenis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-width: auto;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <form method="post" class="form-editjenis">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Data Jenis Obat</h4>
            </div>
            <div class="modal-body">
                <div class="tableview_editadmin"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modaleditjenis" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapusjenis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-width: auto;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <form method="post" class="form-hapusjenis">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Yakin Hapus Data ini ?</h4>
            </div>
            <div class="modal-body data_hapusjenis">
                <!-- Content from AJAX -->
            </div>
            <div class="modal-footer">
                <button style="float:left;" class="btn btn-default close-modalhapusjenis" data-dismiss="modal">Tidak</button>
                <button style="float:right;" class="btn btn-danger hapus_jenis_ok"><i class="fa fa-trash"></i> Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DATA PENGGUNA -->
<div class="modal fade" id="modalTambahuser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="form-add-user">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Pengguna</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control" name="nama_user" id="nama_user" type="text" required placeholder="Masukkan nama lengkap">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" name="username_user" id="username_user" type="text" required placeholder="Masukkan username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="pass_user" id="pass_user" type="password" required placeholder="Masukkan password">
                </div>
                <div class="form-group">
                    <label>Hak Akses</label>
                    <select class="form-control" name="hakakses" id="hakakses" required>
                        <option value="" disabled selected>--Pilih Hak Akses--</option>
                        <?php
                        $ambil=$koneksi->query("SELECT * FROM tb_role ORDER BY nama_role ASC");
                        while($pecah=$ambil->fetch_assoc()) { ?>
                        <option value="<?php echo $pecah["id_role"]; ?>"><?php echo ucwords($pecah['nama_role']); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-user" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="simpan_user" id="simpan_user"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdituser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-width: auto;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <form method="post" class="form-edituser">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Data User</h4>
            </div>
            <div class="modal-body">
                <div class="tableview_edituser"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-modaledituser" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapususer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-width: auto;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Yakin Hapus Data ini ?</h4>
            </div>
            <div class="modal-body data_hapususer">
                <p class="text-center">Anda akan menghapus data pengguna. Tindakan ini tidak dapat diurungkan.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button class="btn btn-danger hapus_user_ok" id="hapus_user_ok"><i class="fa fa-trash"></i> Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<script>
    $(document).ready(function () {
        document.getElementById("btn_admin").classList.add('active-menu');

        $("#form-add-bantuan").submit(function(event){
            var tambahbantuan = {
                'attr':'tambahbantuan',
                'nama_bantuan'  :$('input[name=nama_bantuan]').val(), 
                'jenis_bantuan' :$('select[name=jenis_bantuan]').val(),
                'jml_bantuan'   :$('input[name=jml_bantuan]').val(),
                'satuan'        :$('input[name=satuan]').val(),
                'ket_bantuan'   :$('textarea[name=ket_bantuan]').val()
            };
            $.ajax({
                url: "function.php",
                method: "POST",
                data: tambahbantuan,
                success: function(data){
                    $(".notifContent").html(data)
                    $(".modalNotif").modal('show')
                }
            });
            event.preventDefault();
            $('.close-jenis').click();
            $('#modalTambahBantuan form')[0].reset();
        })

        $('.edit_jenis').click(function(){
            var edit_view_jenis = {
                'attr'      : 'edit_view_jenis',
                'id_jenis'  : $(this).attr('data-id')
            };
            $.ajax({
                method: "POST",
                url : "function.php",
                data: edit_view_jenis,
                success: function(data){
                    $(".tableview_editadmin").html(data);
                    $("#modalEditjenis").modal('show')

                }
            });
        })

        $(".form-editjenis").submit(function(event){
            event.preventDefault();
            var editsavejenis = {
                'attr'          : "edit_save_jenis",
                'id_jenis'      : $('input[name=id_jenisedit]').val(),
                'nama_jenis'    : $('input[name=nama_bantuanedit]').val(),
                'jenis_bantuan' : $('select[name=jenis_bantuanedit]').val(),
                'jmlh_jenis'    : $('input[name=jml_bantuanedit]').val(),
                'satuan_jenis'  : $('input[name=satuanedit]').val(),
                'keterangan'    : $('textarea[name=ket_bantuanedit]').val()
            }; 
            $.ajax({
                method: "POST",
                url : "function.php",
                data: editsavejenis,
                success: function(data){
                    $(".notifContent").html(data)
                    $(".modalNotif").modal('show')
                }
            });
            $('.close-modaleditjenis').click();
        })

        $('.hapus_jenis').click(function(){
                var hapus_view_jenis = {
                    'attr'      : "hapus_view_jenis",
                    'id_jenisb' : $(this).attr('data-id')
                }; 
                $.ajax({
                    method: "POST",
                    url : "function.php",
                    data: hapus_view_jenis,
                    success: function(data){
                        $(".data_hapusjenis").html(data);
                        $("#modalHapusjenis").modal('show')
                    }
                })
            });

            $(".form-hapusjenis").submit(function(event){
                event.preventDefault();
                var data_id = document.getElementById("id_jenis_hps").value;
                var attr = "hapus_jenis_ok"; 
                $.ajax({
                    method: "POST",
                    url : "function.php",
                    data: {
                        attr:attr,data_id:data_id
                    },
                    success: function(data){
                        $(".notifContent").html(data)
                        $(".modalNotif").modal('show')
                    }
                })
                $('.close-modalhapusjenis').click();
            });

//DATA PENGGUNA
        $("#form-add-user").submit(function(event){
        var tambahuser = {
            'attr':'tambahuser',
            'nama_user'  :$('input[name=nama_user]').val(), 
            'username_user'   :$('input[name=username_user]').val(),
            'pass_user'        :$('input[name=pass_user]').val(),
            'id_role'   :$('select[name=hakakses]').val()
        };
        $.ajax({
            url: "function.php",
            method: "POST",
            data: tambahuser,
            success: function(data){
                $(".notifContent").html(data)
                $(".modalNotif").modal('show')
            }
        });
        event.preventDefault();
        $('.close-user').click();
        $('#modalTambahuser form')[0].reset();
    })

        $('.edit_user').click(function(){
            var edit_view_user = {
                'attr'      : 'edit_view_user',
                'id_user'  : $(this).attr('data-id')
            };
            $.ajax({
                method: "POST",
                url : "function.php",
                data: edit_view_user,
                success: function(data){
                    $(".tableview_edituser").html(data);
                    $("#modalEdituser").modal('show')

                }
            });
        })

        $(".form-edituser").submit(function(event){
            event.preventDefault();
            var editsavejenis = {
                'attr'          : "edit_save_user",
                'id_user'      : $('input[name=id_useredit]').val(),
                'nama_user'    : $('input[name=nama_useredit]').val(),
                'username_user'    : $('input[name=username_useredit]').val(),
                'pass_user'  : $('input[name=pass_useredit]').val(),
                'hakakses'    : $('select[name=hakakses_edit]').val()
            }; 
            $.ajax({
                method: "POST",
                url : "function.php",
                data: editsavejenis,
                success: function(data){
                    $(".notifContent").html(data)
                    $(".modalNotif").modal('show')
                }
            });
            $('.close-modaledituser').click();
        })

        $('.hapus_user').click(function(){
            var idusr = $(this).attr('data-id');
            $('#hapus_user_ok').attr('data-id', idusr);
            $("#modalHapususer").modal('show');
        });

        $('#hapus_user_ok').click(function() {
            var idusr = $(this).attr('data-id');
            var attr = "hapus_user_ok";
            $.ajax({
                method: "POST",
                url: "function.php",
                data: {
                    attr: attr,
                    idusr: idusr
                },
                success: function(data) {
                    $("#modalHapususer").modal('hide');
                    $(".notifContent").html(data);
                    $(".modalNotif").modal('show');
                }
            });
        });
    });
</script>
