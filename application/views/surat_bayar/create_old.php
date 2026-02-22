<?php include_once(VIEWPATH.'template/head.php'); ?> 
<style>
    .ui-datepicker{ z-index:1151 !important; }
</style>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php  include_once(VIEWPATH.'template/navbar.php'); ?> 
<?php  include_once(VIEWPATH.'template/sidebar.php'); ?> 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kelola SPD</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Kelola SPD</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title"> Input Rincian Surat Bayar (<?= $matriks_kegiatan->nama.' kegiatan '.$matriks_kegiatan->kegiatan?>)</h4>
                <div class="card-tools">
                   
                </div>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                <form action="<?= base_url('surat_bayar/add') ?>" method="POST">
                  <input type="hidden" name="id_matriks" value="<?= $matriks_kegiatan->id ?>">
                  <input type="hidden" name="id_kegiatan" value="<?= $matriks_kegiatan->keg_id ?>">
                  <input type="hidden" name="nip" value="<?= $matriks_kegiatan->nip ?>">
                  <input type="hidden" name="id_st" value="<?= $id_st?>">
                  <input type="hidden" name="id_sby" id="id_sby" value="<?= $id_sby ?>">
                  <input type="hidden" name="id_spd" value="<?= $id_spd ?>">
                 <div class="row">
                      <div class="col-md-4 col-sm-4">
                        <div class="form-group">
                          <div class="col-xs-12">
                            <label class="control-label"> Nomor SPPD</label>
                            <input class="form-control" type="text" name="no_surat" id="no_surat" value="<?= $no_sppd ?>" readonly="true" />
                          </div>
                        </div>
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="pegawai.nama" class="form-control" id="pegawai.nama" value="<?= $matriks_kegiatan->nama ?>" readonly>
                      </div>
                       <div class="form-group">
                        <label>No Surat</label>
                        <?php 
                          echo "<select class='form-control select2' name='no_sby' id='no_sby' required>";
                          echo "<option value=''>--Pilih No Surat--</option>";
                          echo "<option value='0'>Kosongan</option>";
                          foreach ($no_sby as $key) {
                            if($no_sby_selected == $key->id){
                              echo "<option selected value='".$key->id."'>".'['.$key->nomor.']'.$key->perihal."</option>";
                            }else{
                              echo "<option value='".$key->id."'>".'['.$key->nomor.']'.$key->perihal."</option>";
                            }
                          }
                          echo "</select>";
                        ?>
                      </div> 
                      <div class="form-group">
                        <label>Tanggal dibuat</label>
                        <input type="text" name="tanggal_dibuat" class="form-control tanggal_dibuat" maxlength="18" id="tanggal_akhir" value="<?= $tanggal_dibuat ?>">
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                      <div class="form-group row">
                            <div class="col-sm-6">
                              <label class="control-label"> Lama Uang harian</label>
                              <input class="form-control" type="number" name="waktu_harian" id="waktu_harian" value="<?= $waktu_harian ?>" />
                            </div>
                            <div class="col-sm-6">
                              <label class="control-label"> Uang Harian</label>
                              <input class="form-control" type="number" name="uang_harian" id="uang_harian" value="<?= $uang_harian ?>" />
                            </div>
                      </div>
                      <div class="form-group row">
                            <div class="col-sm-6">
                              <label class="control-label"> Lama Uang Fullboard</label>
                              <input class="form-control" type="number" name="waktu_fullboard" id="waktu_fullboard" value="<?= $waktu_fullboard ?>" />
                            </div>
                            <div class="col-sm-6">
                              <label class="control-label"> Uang Harian Fullboard</label>
                              <input class="form-control" type="number" name="uang_harian_fullboard" id="uang_harian_fullboard" value="<?= $uang_harian_fullboard ?>" />
                            </div>
                      </div>
                     <div class="form-group">
                          <label class="control-label"> Uang Transport</label>
                          <input class="form-control" type="number" name="uang_transport" id="uang_transport" value="<?= $uang_transport ?>" />
                      </div>
                      <div class="form-group">
                          <label class="control-label"> Biaya Representatif</label>
                          <input class="form-control" type="number" name="uang_representatif" id="uang_representatif" value="<?= $uang_representatif?>" />
                      </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="form-group row">
                            <div class="col-sm-6">
                              <label class="control-label"> Lama Penginapan</label>
                              <input class="form-control" type="number" name="waktu_penginapan" id="waktu_penginapan" value="<?= $waktu_penginapan ?>" />
                            </div>
                            <div class="col-sm-6">
                              <label class="control-label"> Uang Penginapan</label>
                              <input class="form-control" type="number" name="uang_penginapan" id="uang_penginapan" value="<?= $uang_penginapan?>" />
                            </div>
                      </div>
                      <div class="form-group row">
                            <div class="col-sm-6">
                              <label class="control-label"> Lama Penginapan Kwitansi</label>
                              <input class="form-control" type="number" name="waktu_penginapan_kwitansi" id="waktu_penginapan_kwitansi" value="<?= $waktu_penginapan ?>" />
                            </div>
                            <div class="col-sm-6">
                              <label class="control-label"> Uang Penginapan Kwitansi</label>
                          <input class="form-control" type="number" name="uang_penginapan_kwitansi" id="uang_penginapan_kwitansi" value="<?= $uang_penginapan_kwitansi?>" />
                            </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label"> Pembayaran dengan kartu kredit</label>
                          <select class="form-control" name="opsi_cc" id="opsi_cc">
                            <option value="0" <?= ($opsi_cc == 0)?'selected':'' ?>>Tanpa Kartu Kredit</option>
                            <option value="1" <?= ($opsi_cc == 1)?'selected':'' ?>>Transport dan Penginapan</option>
                            <option value="2" <?= ($opsi_cc == 2)?'selected':'' ?>>Transport</option>
                            <option value="3" <?= ($opsi_cc == 3)?'selected':'' ?>>Penginapan</option>

                          </select>
                      </div>
                      <div class="form-group">
                            <label>Sertakan Pernyataan Tidak Menginap?</label>
                            <input type="checkbox" name="is_pernyataan_tdk_menginap" id="is_pernyataan_tdk_menginap" <?=
                            $is_pernyataan_tdk_menginap == 0?'':'checked' ?>>
                          </div>
                    </div>
                    <div class="row">
                      <div class="float-lg-right">
                        <button type="submit" class="btn btn-primary"> Simpan</button>
                        <button type="button" data-toggle="modal" data-target="#modal_add" class="btn btn-success"> Tambah Rincian Transport</button>
                      </div>
                    </div>
                 </div>
                <div class="row">
                  <div class="col-sm-12">
                    <table class="table" id="table_rincian">
                      <thead>
                          <th>Id</th>
                          <th>Rincian</th>
                          <th>Total</th>
                          <th>Hapus</th>
                      </thead>
                      <tbody>
                            
                      </tbody>
                    </table>
                  </div>
                </div>
               </form>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


      <div class="modal fade" id="modal_add" style="overflow:hidden;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Rincian Transport</h5>
              </div>
              <div class="modal-body">
                <form class="form" id="form_rincian">
                  <input type="hidden" name="id_surat_bayar" id="id_surat_bayar" value="<?= $id_sby ?>">
                  <div class="form-group">
                 <label>Rincian</label>
                 <input type="text" name="rincian" id="rincian" autocomplete="false">
                </div>
                <div class="form-group">
                 <label>Biaya</label>
                 <input type="number" name="biaya_tambahan" id="biaya_tambahan">
                </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_submit_tambahan()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


    </div>
  </div>

<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>

<script type="text/javascript">
  function form_print() {
    alert(div.data('id'));
  }   
$(document).ready(function(){
  $('select').select2({
    width: '100%'
  });
$('.tanggal_dibuat').datepicker({ dateFormat: 'dd-mm-yy' }).val();
  load_table($('#id_sby').val());

  $('#modal_add').on('show.bs.modal', function (event) {

 });


});


function form_submit_tambahan(){
  var post_data ={};
     post_data['form'] = $('#form_rincian').serializeObject();
      $.ajax({
          type: "POST",
          url: "<?= base_url('surat_bayar/add_tambahan') ?>",
          data: post_data,
          success: function (response) {
            $('#modal_add').modal('hide');
            load_table($('#id_sby').val());
          },
          error: function() {
            alert("Terjadi kesalahan!");
          }
        });
}

function delete_tambahan(id){
  var post_data ={};
   post_data['id'] =id;
  $.ajax({
            url: "<?= base_url('surat_bayar/delete_tambahan') ?>",
            type: "POST",
            data: post_data,
            dataType: "JSON",
            success: function(response)
            {
              alert('data berhasil dihapus');
                load_table($('#id_sby').val());
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });
}

 function load_table(id){
   var post_data ={};
   post_data['id'] =id;
    $.ajax({
            url: "<?= base_url('surat_bayar/get_table_tambahan') ?>",
            type: "POST",
            data: post_data,
            dataType: "JSON",
            success: function(response)
            {
                table_data = response.data;
                reload_table(response.data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });
   }

   function reload_table(data){

      $('#table_rincian').DataTable( {
        "rowReorder":{
            selector: 'td:nth-child(2)'
        },
        "responsive":true,
        "destroy": true,
        "data":data,
        "columns": [
            { "data": "id_uraian_bayar" },
            { "data": "rincian" },
            { "data": "biaya_tambahan" },
            { "data": "aksi" },
        ]
    } );
    }

 $.fn.serializeObject = function() {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
</script>
</body>
</html>
