<div class="row">
    <div class="col-md-12">
        <h3 style="font-weight: 600;">Laporan Data Penerima Obat</h3>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Filter Berdasarkan Tanggal
            </div>
            <div class="panel-body">
                <form method="post" target="_blank" action="tampil_laporan.php">
                    <div class="form-group">
                        <label>Tanggal Mulai</label>
                        <input type="text" id="tglmulai" name="tglmulai" class="form-control datepicker" required placeholder="Pilih tanggal mulai">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Akhir</label>
                        <input type="text" id="tglakhir" name="tglakhir" class="form-control datepicker" required placeholder="Pilih tanggal akhir">
                    </div>
                    <button class="btn btn-primary" name="filter_tgl" type="submit"><i class="fa fa-print"></i> Tampilkan Laporan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Filter Berdasarkan Kata Kunci
            </div>
            <div class="panel-body">
                <form method="post" target="_blank" action="tampil_laporan.php">
                    <div class="form-group">
                        <label>Kata Kunci</label>
                        <input type="text" class="form-control" id="carilaporan" name="carilaporan" placeholder="Cari No. KK, Nama, Alamat, dll...">
                    </div>
                    <button class="btn btn-primary" name="filter_keyword"><i class="fa fa-print"></i> Tampilkan Laporan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>

<script>
    $(document).ready(function () {
        document.getElementById("btn_laporan").classList.add('active-menu');
        $(".datepicker").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    $(".form-laporann").submit(function(event){
        event.preventDefault();
        window.open('tampil_laporan.php','_blank');
        var filter1 = {
            attr        : 'filter_tgl',
            tglawal     : $('input[name=tglmulai]').val(),
            tglakhir    : $('input[name=tglakhir]').val()
        };
        $.ajax({
            method: "POST",
            url : "tampil_laporan.php",
            data: filter1,
            success: function(data){
                
            }
        })
    });
</script>