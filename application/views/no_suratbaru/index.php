<?php include_once(VIEWPATH.'template/head.php'); ?> 
<?php
defined('BASEPATH') or exit('No direct script access allowed');
$bulan = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
    );
$waktu = explode('-', date("Y-m-d"));
?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php  include_once(VIEWPATH.'template/navbar.php'); ?> 
<?php  include_once(VIEWPATH.'template/sidebar.php'); ?> 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="max-width:95%; margin:auto">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Master Nomor Surat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Nomor Surat</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?php
          // Check if flashdata message exists
          $success = $this->session->flashdata('success');
          $danger = $this->session->flashdata('danger');
          $warning = $this->session->flashdata('warning');
          if ($success) {
            // Display flashdata message
            echo '<div class="row"><div class="alert alert-success">' . $success . '</div></div>';
          }
          if ($danger) {
            // Display flashdata message
            echo '<div class="row"><div class="alert alert-danger">' . $danger . '</div></div>';
          }

          if ($warning) {
            // Display flashdata message
            echo '<div class="row"><div class="alert alert-danger">' . $warning . '</div></div>';
        } ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary" style="max-width:95%; margin:auto">
              <div class="card-header">
                <h4 class="card-title"> Filter Nomor Surat </h4>
                <div class="card-tools">
                  <!-- <a href="<?= base_url('/kelolanomorsurat/add_form') ?>" class="btn btn-warning btn-md" title="Tambah No Surat"> <i class="fa fa-plus"></i> Surat Baru</a> -->
                   <!--  <button type="button" class="btn btn-warning btn-md"
                            data-toggle="modal"
                            data-target="#modal-default"
                            title="Tambah Pegawai">
                      <i class="fa fa-plus"></i>
                    </button> -->
                </div>
              </div>
              <div class="card-body">                
                <div class="row">
                  <div class="form-group col-md-2 col-sm-2">
                  <select id="kodeorg" name="kodeorg" class="form-control">
                      <?php foreach ($kodeorg as $kodeorg):?><option value="<?php echo $kodeorg->kode_organisasi;?>"<?php echo ('1' == '1' ? ' selected="selected"' : '');?>><?php echo $kodeorg->kode_organisasi;?></option><?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-md-4 col-sm-4">
                  <select id="jenis" name="jenis" class="form-control">
                    <option value="all" selected="selected">Semua Surat</option>
                      <?php foreach ($jenis as $jenis):?><option value="<?php echo $jenis->id;?>" ><?php echo $jenis->nama_jenis;?></option><?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-2 col-sm-2">
                    <select id="bulan" name="bulan" class="form-control">
                      <?php foreach ($bulan as $bln_no=>$bln_nama):?><option value="<?php echo $bln_no;?>"<?php echo ($waktu[1] == $bln_no ? ' selected="selected"' : '');?>><?php echo $bln_nama;?></option><?php endforeach;?> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-2 col-sm-2">
                    <select id="tahun" name="tahun" class="form-control">
                      <option value="<?= date('Y') ?>" <?php echo ($waktu[0] == date('Y') ? ' selected="selected"' : '');?>><?php echo date('Y');?></option>
                      <option value="<?= (date('Y')-1) ?>" <?php echo ($waktu[0] == (date('Y') - 1) ? ' selected="selected"' : '');?>><?php echo date('Y') - 1;?></option> 
                    </select> 
                  </div>
                  <div class="form-group col-lg-2 col-sm-2">
                    <button type="button" onClick="form_load()"class="btn btn-primary">Tampilkan</button>
                  </div>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary" style="max-width:95%; margin:auto">
              <div class="card-header">
                <h4 class="card-title devv"> Daftar Nomor Surat </h4>
                <div class="card-tools">
                  <a href="<?= base_url('/kelolanomorsurat/add_form') ?>" class="btn btn-success btn-md" title="Tambah No Surat"> <i class="fa fa-plus"></i> Surat Baru</a>
                   <!--  <button type="button" class="btn btn-warning btn-md"
                            data-toggle="modal"
                            data-target="#modal-default"
                            title="Tambah Pegawai">
                      <i class="fa fa-plus"></i>
                    </button> -->
                </div>
              </div>
              <div class="card-body">
                <div class="container-fluid">
                  <table id="table_nomor" class="table table-striped">
                    <thead> 
                      <th>Nomor</th>
                      <th>Kode Organisasi</th>
                      <!-- <th>Jenis</th> -->
                      <th>Nomor Surat</th>
                      <th>Tim Kerja</th>
                      <th>Jenis Surat</th>
                      <th>Tujuan</th>
                      <th>Perihal</th>
                      <th>Tanggal</th>
                      <th>Catatan</th>
                      <th>Sifat</th>
                      <th>Nomor</th>
                      <th>Kode</th>
                      <th>Kategori 1</th>
                      <th>Kategori 2</th>
                      <th>Kategori 3</th>
                      <th>Kategori 4</th>
                      <th>Aksi</th>
                      
                    </thead>
                </table>
                </div>
              </div>
            </div>  
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <!-- Modal edit -->
    <form class="form" action="<?= base_url('kelolanomorsurat/edit')?>" method="POST" id="edit_nomor">
      <div class="modal fade" id="modal-edit">
      <input type="hidden" name="id" id="id">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Nomor Surat</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                <input type="text" name="id_edit" class="form-control" id="id_edit" style="visibility:hidden">
                  <label>Nomor Surat</label>
                  <input type="text" name="full_kode_edit" class="form-control" id="full_kode_edit" disabled readonly>
                </div>
                <!-- <div class="form-group">
                  <label>Kode Organisasi</label>
                  <select name="kode_organisasi_edit" id="kode_organisasi_edit" class="form-control select2">
                    <option value="63510">63510 - Umum</option>
                    <option value="63000">63000 - Satuan kerja</option>
                  </select>
                </div> -->
                <div class="form-group">
                  <label>Tim Kerja</label>
                  <input type="text" name="tim_kerja_edit" class="form-control" id="tim_kerja_edit">
                </div>
                <div class="form-group">
                  <label>Tujuan Surat</label>
                  <input type="text" name="tujuan_edit" class="form-control" id="tujuan_edit">
                </div>
                <!-- <div class="form-group">
                  <label>Tanggal</label>
                  <input type="text" name="tanggal_edit" class="form-control tanggal" required="required" id="tanggal_edit">
                </div> -->
               <div class="row">
                 
                 <div class="col-sm-12">
                    <div class="form-group">
                    <label>Perihal</label>
                    <textarea name="perihal_edit" class="form-control" required="required" id="perihal_edit"></textarea>
                  </div>
                 </div>
               </div>
               <div class="form-group">
                  <label>Catatan Surat</label>
                  <textarea type="text" name="catatan_edit" class="form-control" id="catatan_edit"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="button" onclick="form_edit()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </form>

        <!-- Konfirmasi hapus -->
    <div class="modal modal-danger fade" id="modal-konfirmasi" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Hapus Nomor</h5>
              </div>
              <div class="modal-body" id="pesan_konfirmasi">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <a href="javascript:;" class="btn btn-danger" id="hapus-true-data">Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>

<script type="text/javascript">

  var d = new Date(),
      n = d.getMonth()+1;
      n ='0'+n; 
    z = $('#kodeorg').val();
      y = d.getFullYear();


  function form_load(){
    n = $('#bulan').val(); 
    y = $('#tahun').val();
    x = $('#jenis').val();
    z = $('#kodeorg').val();
    console.log('ini z'+z)
    load_table(n,x,y,z);  
  }

  function current_number(){
    $.ajaxSetup({
            type:"POST",
            url: "<?php echo base_url('kelolanomorsurat/get_current_nomor') ?>",
            dataType:'json',
            cache: false,
      });
      $.ajax({
        data:{jenis:$('#jenis').val()},
        success: function(respond){
          if(respond.status == 'ok'){
            $('#nomor').val(respond.nomor)
          }else{
            alert(respond.status);
          }
        }
      });
   }

 $('#modal-default').on('hidden.bs.modal', function (e) {
  $(this)
  .find("input,textarea")
  .val('')
  .end()
  .find("select")
  .val(0).change()
  .end()
  .find("input[type=checkbox], input[type=radio]")
  .prop("checked", "")
  .end();
})
 
  function form_submit() {
    document.getElementById("add_nomor").submit();
   }  

  function form_edit() {
    document.getElementById("edit_nomor").submit();
   }   


  function load_table(n,x,y,z){
    $('#table_nomor').dataTable().fnDestroy();
    oTable = $('#table_nomor').DataTable({
                "rowReorder":{
                selector: 'td:nth-child(2)'
                },
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                dom: 'Bfrtlp',
                "responsive":true,
                "iDisplayLength": 10,
                "processing": true,
                "order": [[ 7, "desc" ]],
                "ajax": {
                  url: '<?= base_url('/kelolanomorsurat/get_all')?>',
                  type: 'POST',
                  data: {bulan:n,tahun:y,kodeorg:z, jenis:x},
                  error: function (xhr, error, thrown) {  // Add the error callback here
                    console.log("Error occurred:");
                    console.log(xhr.responseText); // Response as text
                    console.log(error);           // Error type
                    console.log(thrown);          // Exception thrown
                }
                },
                "columns": [
                    {data: 'nomor', name: 'nomor'},
                    // {data: 'nama_jenis', name: 'nama_jenis'},
                    {data: 'kode_organisasi', name: 'kode_organisasi'},
                    {data: 'full_kode', name: 'full_kode'},
                    {data: 'tim_kerja', name: 'tim_kerja'},
                    {data: 'nama_jenis', name: 'nama_jenis'},
                    {data: 'tujuan', name: 'tujuan'},
                    {data: 'perihal', name: 'perihal'},
                    {data: 'tanggal_surat', name: 'tanggal_surat'},
                    {data: 'catatan', name: 'catatan'},

                    //ada, tapi di hidden
                    {data: 'id', name: 'id',visible: false,},
                    {data: 'sifat', name: 'sifat',visible: false,},
                    {data: 'kode', name: 'kode',visible: false,},
                    {data: 'kategori1', name: 'kategori1',visible: false,},
                    {data: 'kategori2', name: 'kategori2',visible: false,},
                    {data: 'kategori3', name: 'kategori3',visible: false,},
                    {data: 'kategori4', name: 'kategori4',visible: false,},

                    {data: 'aksi', name:'aksi'}
                ],
                lengthMenu: [
                    [10, 25, 50, 100, 500, 1000, -1],
                    [10, 25, 50, 100, 500, 1000, 'All'],
                ],
            });
  }

 $(document).ready(function() {
    $('.devv').click(function(){
      
    });
    $('.tanggal').datepicker({ dateFormat: 'dd-mm-yy' }).val();
    // load_table(n,x,y,z)
    form_load();
    $('select').select2({
      width: '100%'
    });

    //DELETION MODAL
    $('#modal-konfirmasi').on('show.bs.modal', function (event) {
      var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
      
      // Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
      var id = div.data('id')
      var fullkode = div.data('fullkode')

      
      var modal = $(this)
      
      // Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
      modal.find('#hapus-true-data').attr("href","<?= base_url('kelolanomorsurat/delete?id=')?>"+id);
      modal.find('#pesan_konfirmasi').html("Apakah anda yakin ingin menghapus "+fullkode+" ?");
    });

    //EDIT MODAL
    $('#modal-edit').on('show.bs.modal', function (event) {
      var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

      // Untuk mengambil nilai dari data-xx="" ke variabel js
      var id = div.data('id')
      var full_kode = div.data('fullkode')
      var kode_organisasi = div.data('org')
      var tim_kerja = div.data('tim')
      var perihal = div.data('perihal')
      var tujuan = div.data('tujuan')
      var tanggal_surat = div.data('tanggal')
      var catatan = div.data('catatan')
      
      var modal = $(this)
      
      //prepopulate modal ketika tekan tombol edit
      modal.find('#id').val(id);
      $('#kode_organisasi_edit').val(kode_organisasi).change();
      modal.find('#full_kode_edit').val(full_kode);
      modal.find('#tim_kerja_edit').val(tim_kerja);
      modal.find('#perihal_edit').val(perihal);
      modal.find('#tujuan_edit').val(tujuan);
      modal.find('#tanggal_edit').val(tanggal_surat);
      modal.find('#catatan_edit').val(catatan);
    });
  });

</script>

</body>
</html>
