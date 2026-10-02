<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                 Data Penerima Obat
                 <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#modalTambahPenerima" style="margin-top: -5px;">
                    <i class="fa fa-plus"></i> Tambah Data
                 </button>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables_penerimabantuan" id="dataTables_penerimabantuan">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>No. KK</th>
                                <th>Nama</th>
                                <th>Alamat KK/KTP</th>
                                <th>Nama Obat</th>
                                <th>Keterangan</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $nomor=1;
                                $ambil=$koneksi->query("SELECT pnb.id_penerimabantuan,pd.nokk,pd.nama_penduduk,pd.alamat_ktp,pd.alamat_domisili,jnb.nama_jenisbantuan,pnb.keterangan FROM tb_penduduk pd JOIN tb_penerimabantuan pnb ON pd.id_penduduk = pnb.id_penduduk JOIN tb_jenisbantuan jnb ON pnb.id_jenisbantuan = jnb.id_jenisbantuan ORDER BY pnb.lastupdated DESC");
                                while($pecah=$ambil->fetch_assoc()){
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $nomor;?></td>
                                <td><?php echo $pecah['nokk'];?></td>
                                <td><?php echo $pecah['nama_penduduk'];?></td>
                                <td><?php echo $pecah['alamat_ktp'];?></td>
                                <td><?php echo $pecah['nama_jenisbantuan'];?></td>
                                <td><?php echo $pecah['keterangan'];?></td>
                                <td class="text-center">
                                    <button class="btn btn-info btn-sm edit_penerima" data-id="<?php echo $pecah['id_penerimabantuan'];?>" title="Edit"><i class="fa fa-edit"></i></button >
                                    <button class="btn btn-danger btn-sm hapus_penerima" data-id="<?php echo $pecah['id_penerimabantuan'];?>" title="Hapus"><i class="fa fa-trash"></i></button>
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

<div class="modal fade" id="modalTambahPenerima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formaddpenduduk">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tambah Data Penerima Obat</h4>
            </div>
            <div class="modal-body">
                <label>Cari Penduduk</label>
                <div class="form-group input-group">
                    <input type="text" class="form-control" id="carinik" name="carinik" placeholder="Cari dan pilih data penduduk...">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn_caripenduduk_tambah" type="button" data-toggle="modal" data-target="#modalCari"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                <input class="form-control" id="id_penduduk_tampil" name="id_penduduk_tampil" type="hidden">
                <div class="form-group">
                    <label>No. KK</label>
                    <input class="form-control" id="nokk_tampil" name="nokk_tampil" type="text" disabled required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control" id="nama" name="nama" type="text" disabled required>
                </div>
                <div class="form-group">
                    <label>Alamat KK/KTP</label>
                    <textarea class="form-control" name="alamatktp" id="alamatktp" rows="2" style="resize: none;" disabled required></textarea>
                </div>
                <div class="form-group">
                    <label>Nama Obat</label>
                    <select class="form-control" name="id_jenisbantuan[]" id="id_jenisbantuan" multiple required style="height: 120px;">
                        <option value="" disabled>--Pilih jenis obat--</option>
                        <?php
                        $ambil=$koneksi->query("SELECT * FROM tb_jenisbantuan WHERE jumlah_bantuan > 0 ORDER BY lastupdated DESC");
                        while($pecah=$ambil->fetch_assoc()) { ?>
                        <option value="<?php echo $pecah["id_jenisbantuan"]; ?>"><?php echo $pecah['nama_jenisbantuan']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <input class="form-control" id="keterangan" name="keterangan" type="text" placeholder="Keterangan tambahan (opsional)">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-tambahpenerima" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="simpan_penerima" id="simpan_penerima"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditPenerima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-width: auto;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <form method="post" class="form-edit-penerima">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Edit Data Penerima Obat</h4>
            </div>
            <div class="modal-body">
                <div class="tableview_edit"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-penerimaedit" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCari" style="max-width: auto;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Pencarian Data Penduduk</h4>
                <input type="hidden" name="aksi" id="aksi" disabled="">
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables_caripenduduk" style="width:100%;" id="dataTables_caripenduduk" name="dataTables_caripenduduk">
                    <thead>
                        <tr>
                            <th style="width:auto;">No</th>
                            <th style="display:none;">Id_Penduduk</th>
                            <th style="width:auto;">No. KK</th>
                            <th style="width:auto;">Nama</th>
                            <th style="width:auto;">Alamat KK/KTP</th>
                            <th style="width:auto;">No. Telp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $nomor=1;
                            $ambil=$koneksi->query("SELECT * FROM tb_penduduk ORDER BY lastupdated DESC");
                            while($pecah=$ambil->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $nomor;?></td>
                            <td style="display:none;"><?php echo $pecah['id_penduduk'];?></td>
                            <td><?php echo $pecah['nokk'];?></td>
                            <td><?php echo $pecah['nama_penduduk'];?></td>
                            <td class="center"><?php echo $pecah['alamat_ktp'];?></td>
                            <td class="center"><?php echo $pecah['telp'];?></td>
                        </tr>
                        <?php 
                            $nomor++;}
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="modal-footer">
                <center><button type="button" class="btn btn-default close-modal" data-dismiss="modal">Batal</button></center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalHapuspenerima" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="max-width: auto;">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <form method="post" class="form-hapuspenerima">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Yakin Hapus Data ini ?</h4>
            </div>
            <div class="modal-body data_hapuspenerima">
                <!-- Content from AJAX -->
            </div>
            <div class="modal-footer">
                <button style="float:left;" class="btn btn-default close-modal" data-dismiss="modal">Tidak</button>
                <button style="float:right;" class="btn btn-danger hapus_penerima_ok"><i class="fa fa-trash"></i> Ya</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>

    <script>
        $(document).ready(function () {
            document.getElementById("btn_penerima").classList.add('active-menu');
            $(document).on("click", ".btn_caripenduduk_tambah", function () {
                var cari = document.getElementById("carinik").value;
                document.getElementById("aksi").value = "tambah";   
                 $("#dataTables_caripenduduk_filter input").val(cari).keyup();
                 //$('#modalCari').modal({show:true});
            });

            $(document).on("click", ".btn_caripenduduk_edit", function () {
                var cari = document.getElementById("carinik").value;
                document.getElementById("aksi").value = "edit";   
                 $("#dataTables_caripenduduk_filter input").val(cari).keyup();
            });

            $('#dataTables_caripenduduk tbody').on('dblclick', 'tr', function () {
                var aksi = document.getElementById("aksi").value;
                var checktbl = $(this).closest("tr")[0];
                if(aksi=="tambah"){
                    document.getElementById("id_penduduk_tampil").value = checktbl.cells[1].innerHTML
                    document.getElementById("nokk_tampil").value = checktbl.cells[2].innerHTML;
                    document.getElementById("nama").value = checktbl.cells[3].innerHTML; 
                    document.getElementById("alamatktp").value = checktbl.cells[4].innerHTML;
                    $('#modalCari').modal('hide');
                }else if(aksi=="edit"){
                    document.getElementById("id_penduduk_penerimaedit").value = checktbl.cells[1].innerHTML
                    document.getElementById("nokk_penerimaedit").value = checktbl.cells[2].innerHTML;
                    document.getElementById("nama_penerimaedit").value = checktbl.cells[3].innerHTML; 
                    document.getElementById("alamatktp_penerimaedit").value = checktbl.cells[4].innerHTML;
                    $('#modalCari').modal('hide');
                }
                   
            } );

            $("#formaddpenduduk").submit(function(event){
                event.preventDefault();
                if(document. getElementById("id_penduduk_tampil"). value. length > 0){
                    var tambahpenerima = {
                        'attr'                       :'tambahpenerima',
                        'id_penduduk_penerima'       : $('input[name=id_penduduk_tampil]').val(),
                        'id_jenisbantuan'            : $('select[name="id_jenisbantuan[]"]').val(),
                        'keterangan'                 : $('input[name=keterangan]').val()
                    }; 
                    console.log(tambahpenerima);
                    $.ajax({
                        url: "function.php",
                        method: "POST",
                        data: tambahpenerima,
                        success: function(data){
                            $(".notifContent").html(data);
                            $(".modalNotif").modal('show')
                        }
                    });
                    $('.close-tambahpenerima').click();
                    $('#modalTambahPenerima form')[0].reset();
                }
                
            })

            $('.edit_penerima').click(function(){
                var id_penerimabantuan = $(this).attr('data-id');
                //console.log(id_penerimabantuan);
                var attr = "edit_view_penerima"; 
                $.ajax({
                    method: "POST",
                    url : "function.php",
                    data: {
                        attr:attr,id_penerimabantuan:id_penerimabantuan
                    },
                    success: function(data){
                        $(".tableview_edit").html(data);
                        $("#modalEditPenerima").modal('show')

                    }
                })
            });

            $(".form-edit-penerima").submit(function(event){
                event.preventDefault();
                var editsavepenerima = {
                    'attr'                  : "edit_save_penerima",
                    'id_penerimabantuan'    : $('input[name=id_penerimaedit]').val(),
                    'id_penduduk'           : $('input[name=id_penduduk_penerimaedit]').val(),
                    'id_jenisbantuan'       : $('select[name=id_jenisbantuanedit]').val(),
                    'keterangan'            : $('input[name=keterangan_edit]').val()
                }; 
                $.ajax({
                    method: "POST",
                    url : "function.php",
                    data: editsavepenerima,
                    success: function(data){
                        $(".notifContent").html(data);
                        $(".modalNotif").modal('show')
                    }
                });
                $('.close-penerimaedit').click();
            })

            $('.hapus_penerima').click(function(){
                var data_id = $(this).attr('data-id');
                var attr = "hapus_view_penerima"; 
                $.ajax({
                    method: "POST",
                    url : "function.php",
                    data: {
                        attr:attr,data_id:data_id
                    },
                    success: function(data){
                        $(".data_hapuspenerima").html(data);
                        $("#modalHapuspenerima").modal('show')
                    }
                })
            });

            $(".form-hapuspenerima").submit(function(event){
                event.preventDefault();
                var data_id = document.getElementById("id_penerima_hps").value;
                var attr = "hapus_penerima"; 
                $.ajax({
                    method: "POST",
                    url : "function.php",
                    data: {
                        attr:attr,data_id:data_id
                    },
                    success: function(data){
                        $(".notifContent").html(data);
                        $('.close-modal').click();
                        $(".modalNotif").modal('show')
                    }
                })
            });
        });
    </script>
        