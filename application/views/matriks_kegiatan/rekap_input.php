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
            <h1 class="m-0 text-dark">Master Matriks </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Master Matriks </li>
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
                <h4 class="card-title"> Input Matriks kegiatan </h4>
              </div>
              <div class="card-body">
                 <?php echo form_open(base_url('/matriks_kegiatan/add_form'));  ?>
                 <div class="form-group" id="dynamic_form" onclick="reset(event)">
                    <div class="row">
                      <div class="form-group col-md-5">
                       <?php
                        echo '<select class="form-control select2" id="nip" name="nip" required="required">';
                        $i=0;
                        echo "<option value='0'/>-Pilih Pegawai-</option>";
                        foreach ($opsi_pegawai as $var) {
                          echo "<option value='" . $var->nip . "'/>"  .$var->nama. "</option>";
                          $i++;
                        }
                        echo '</select>';
                        ?>
                      </div>
                      <div class="form-group col-md-5">
                       <?php
                        echo '<select class="form-control select2" id="kegiatan" name="kegiatan" style="width: 100%;" required="required">';
                        $i=0;
                        echo "<option value='0'/>-Pilih Kegiatan-</option>";
                        foreach ($opsi_kegiatan as $var) {
                          echo "<option value='" . $var->id . "'/>"  .$var->nama. "</option>";
                          $i++;
                        }
                        echo '</select>';
                        ?> 
                      </div>
                     
                    </div>
                    <div class="row">
                       <div class="form-group col-md-5 ">
                        <input type="text" class="form-control daterange" name="daterange" id="daterange" value="" placeholder="Tanggal Lansung">
                      </div>
                      <div class="form-group col-md-5">
                        <input type="text" class="form-control date" name="periode_terus" id="periode_terus" placeholder="Tanggal Loncat" height="80px">
                      </div>
                      <div class="button-group">
                        <a href="javascript:void(0)" class="btn btn-primary" id="plus">Tambah</a>
                        <a href="javascript:void(0)" class="btn btn-danger" id="minus">Hapus</a>
                      </div>
                    </div>
                  </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  <?php echo form_close( ); ?>
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

<script src="<?php echo base_url('assets/template') ?>/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url() ?>public/plugins/dynamic-form/dynamic-form.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script type="text/javascript">

 $(document).ready(function() {
  $('.select2').select2({
    width: '100%' });
  $('.daterange').daterangepicker({
    "drops": "up",
    autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }});
   $('.date').datepicker({
      multidate: true,
      format: 'dd-mm-yyyy'
    });

     $('.daterange').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});

 function reset(e){
    if(e.target.id == 'plus'){
      $('.select2').select2({
    width: '100%' });
      $('.daterange').daterangepicker({
        "drops": "up",
        autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }});

      $('.date').datepicker({
      multidate: true,
      format: 'dd-mm-yyyy'
    });

           $('.daterange').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

    }
 }

var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus", "#minus", {

    // the maximum number of form fields
    limit: 50,

    formPrefix: 'matriks' ,
    // normalize all fields
    // ideal for server side dulication
    normalizeFullForm: false,

    // color effects
  //  createColor: '',
   // removeColorï¼ '',
    duration: 3000,

    // JSON data which will prefill the form
    data: {}

});

</script>

</body>
</html>
