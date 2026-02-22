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
                      <div class="form-group col-md-4">
                       <?php
                        echo '<select class="form-control select2" id="nip" name="nip" onchange="getval(this)" required="required"> autocomplete="off"';
                        $i=0;
                        echo "<option value='0'/>-Pilih Pegawai-</option>";
                        foreach ($opsi_pegawai as $var) {
                          echo "<option value='" . $var->nip . "'/>"  .$var->nama. "</option>";
                          $i++;
                        }
                        echo '</select>';
                        ?>
                      </div>
                      <!-- <div class="form-group col-md-4">
                        <select class="form-control" name="type" id="type" onchange="generate_kegiatan(this)">
                          <option value="0">-Pilih Jenis-</option>
                          <option value="1">Dengan SPD</option>
                          <option value="2">Hanya Surat Tugas</option>
                          <option value="3">Kegiatan Lain (Cuti,Ijin,dll)</option>
                        </select> 
                      </div>
                      <div class="form-group col-md-4">
                        <select class="form-control select2" id="kegiatan" name="kegiatan" onchange="getval(this)" style="width: 100%;" required="required" autocomplete="off">
                      <option value="">--Pilih Kegiatan--</option>
                         </select>
                      
                      </div> -->
                      <div class="form-group col-md-4">
                        <select class="form-control" name="type" id="type" onchange="generate_kegiatan(this)">
                          <option value="0">-Pilih Jenis-</option>
                          <option value="1">Dengan SPD</option>
                          <option value="2">Hanya Surat Tugas</option>
                          <option value="3">Kegiatan Lain (Cuti,Ijin,dll)</option>
                        </select> 
                      </div>
                      
                    </div>
                    <div class="row">
                      <div class="form-group col-md-4">
                     <input type="text" class="form-control daterange" name="daterange" id="daterange" value="" placeholder="Tanggal Urut" autocomplete="off" required="required">
                   </div>
                      <div class="form-group col-md-4">
                        <select class="form-control select2" id="kegiatan" name="kegiatan" onchange="getval(this)" style="width: 100%;" required="required" autocomplete="off">
                      <option value="">--Pilih Kegiatan--</option>
                         </select>
                      
                      </div>

                       <!-- <div class="form-group col-md-4 ">
                        <input type="text" class="form-control daterange" name="daterange" id="daterange" value="" placeholder="Tanggal Urut" autocomplete="off">
                      </div>
                      <div class="form-group col-md-4">
                        <input type="text" class="form-control date" name="periode_terus" id="periode_terus" onchange="getval2(this)" placeholder="Tanggal Loncat" height="80px" autocomplete="off">
                      </div> -->
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


  var kegiatan,daterange,periode_terus,type;

 $(document).ready(function() {
  $('.select2').select2({
    width: '100%' });
  $('.daterange').daterangepicker({
    "drops": "up",
    autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
    });
   $('.date').datepicker({
      multidate: true,
      format: 'dd-mm-yyyy'
    });

     $('.daterange').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      daterange = this;
      var id = daterange.getAttribute('id').match(/\d+/); // 123456
      validasi_tanggal(id)

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
      daterange = this;
      var id = daterange.getAttribute('id').match(/\d+/); // 123456
      validasi_tanggal(id)
  });

  $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

    }
 }

function generate_kegiatan(sel){
  type = sel;
  var id = type.getAttribute('id').match(/\d+/); // 123456
      var post_data ={}
      post_data['type']=$('#type'+id).val()
      $.ajax({
        url : "<?php echo base_url('matriks_kegiatan/get_kegiatan');?>",
        method : "POST",
        data : post_data,
        async : false,
        dataType : 'json',
        success: function(data){
          var html = '<option value="" selected>--Pilih Kegiatan--</option>';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].id+'"">'+data[i].nama+'</option>';
          }
          $("#kegiatan"+id).val([]);
          $("#kegiatan"+id).html(html);
        }
      });

}

function getval(sel)
{
  kegiatan = sel;
  var id = kegiatan.getAttribute('id').match(/\d+/); // 123456

  validasi_tanggal(id)
}

function getval2(sel)
{
 periode_terus = sel;
 var id = periode_terus.getAttribute('id').match(/\d+/); // 123456
 validasi_tanggal(id)
}

function validasi_tanggal(id){
  var daterange_value,periode_terus_value;

  nip = $('#nip'+id).val();
  kegiatan =  $('#kegiatan'+id).val();
  daterange =  $('#daterange'+id).val();
  periode_terus =  $('#periode_terus'+id).val();

  if(periode_terus == '' && daterange == ''){
    return;
  }

  if(daterange == ''){
    daterange = '';
  }

  if(periode_terus == ''){
    periode_terus = '';
  }

  if(nip == null){
    alert('Pilih Pegawai Dahulu')
    return
  }else{
    if(nip == "0"){
      alert('Pilih Pegawai Dahulu')
      return;
    }
  }

  if(kegiatan == 0){
    if(nip != 0){
      return;
    }
     alert('Pilih Kegiatan Dahulu')
    return;
  }

  $.ajaxSetup({
          type:"POST",
          url: "<?php echo base_url('matriks_kegiatan/validasi_tanggal') ?>",
          dataType:'json',
          cache: false,
    });
  $.ajax({
      data:{nip:nip,kegiatan:kegiatan,daterange:daterange,periode_terus:periode_terus},
      success: function(respond){
        if(respond.status == 'failed'){
          alert(respond.message);
          
          $('#daterange'+id).val('');
          $('#periode_terus'+id).val('');

        }
      }
    });
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
