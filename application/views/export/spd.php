<?php include_once(VIEWPATH.'template/head.php'); ?> 
<?php
defined('BASEPATH') or exit('No direct script access allowed');
$bulan = array(
    '00' => 'Seluruh Bulan',
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
            <h1 class="m-0 text-dark">Ekspor Data </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Ekspor Data </li>
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
                <h4 class="card-title"> Ekspor Data </h4>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">

                <div class="table-responsive">
                  <table id="table_matriks" class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0">
                    <thead>
                      <th>No</th>
                      <th>Nama File</th>
                      <th>Aksi</th>
                    </thead>
                </table>
                </div>
              </div>
            </div>  
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <!-- Modal edit -->
    <div class="modal fade" id="myModalCetak" role="dialog" aria-labelledby="myModal-label" aria-hidden="true" tabindex="-1" style="overflow:hidden;">

      <div class="modal-dialog">

        <div class="modal-content">

           <div class="modal-body" id="pesan_konfirmasi_kategori">
                            Masukkan tahun anggaran
                            <input type="hidden" id="url_donwload">
              <select id="tahun" name="tahun" class="form-control">
                      <option value="<?= (date('Y')-1) ?>" <?php echo ($tahun == (date('Y') - 1) ? ' selected="selected"' : '');?>><?php echo date('Y') - 1;?></option> 
                      <option value="<?= (date('Y')) ?>" <?php echo ($tahun == (date('Y')) ? ' selected="selected"' : '');?>><?php echo date('Y');?></option> 
                    </select>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" onClick="form_cetak()"class="btn btn-primary">Cetak</button>
              </div>

          <div class="margin-bottom margin-top text-center">

          </div>

        </div>

      </div>

    </div>

<?php include_once(VIEWPATH.'template/footer.php'); ?> 
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> -->
<?php include_once(VIEWPATH.'template/datatables_script.php'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    var d = new Date(),
        n = d.getMonth()+1;
        n='0'+n; 
        y = d.getFullYear();

    function form_cetak(){
      var url = $('#url_donwload').val()+'?tahun='+$('#tahun').val();
      window.open(url,"_self");
   }

      $(document.body).on("show.bs.modal", function(event) {
    var div = $(event.relatedTarget)
      var formData = $(this).serialize();
      if(div.data('link') != '#'){
         $.ajax({
          type: "POST",
          url: div.data('link'),
          data: CsrfSecret,
          beforeSend: function(){
                swal.fire({
                    html: '<h5>Loading...</h5>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    onRender: function() {
                         // there will only ever be one sweet alert open.
                         $('.swal2-content').prepend(sweet_loader);
                    }
                });
            },
          success: function (data) {
             swal.close()
            $(".modal").removeData("bs.modal");
            $(".modal-content").html(data);
          },
          error: function() {
            alert("Terjadi kesalahan!");
          }
        });
      }else{
         $('#url_donwload').val(div.data('url'));
          $('#myModalCetak').on('show.bs.modal', function (event) {
             
        });
          }
    });


  function form_load(){
    n = $('#bulan').val(); 
    y=$('#tahun').val();
    load_table(n,y);  
  }
 
 $(document).ready(function() {

    load_table(n,y);
})

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


 function load_table(n,y){
 $('#table_matriks').dataTable().fnDestroy();
  oTable = $('#table_matriks').DataTable({
        "bFilter": false,
        "responsive": true,
        "paging":   false,
        "order":[[ 0, "asc" ]],
        "iDisplayLength": 10,
        "processing": true,
        "ajax": {
          url: '<?= base_url('/export/list_export_spd')?>',
          type: 'POST',
          data: {bulan:n,tahun:y} 
        },
          "columns": [
            {data:'id',name:'id'},
            {data: 'nama', name: 'nama'},
            {data: 'aksi', name:'aksi'},
        ]
    });
 }

</script>

</body>
</html>
