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
    [disabled] {
    cursor: not-allowed;  
    cursor: -moz-not-allowed;
    cursor: -webkit-not-allowed;
    pointer-events: all !important;
    }

    [class*="disabled"]  {
    cursor: not-allowed;  
    cursor: -moz-not-allowed;
    cursor: -webkit-not-allowed;
    pointer-events: all !important;
    }

    [class*="select2-container--disabled"]  {
    cursor: not-allowed;  
    cursor: -moz-not-allowed;
    cursor: -webkit-not-allowed;
    pointer-events: all !important;
    }
    .ui-datepicker{ 
      z-index:1151 !important; 
    }

    label{
      margin-bottom: 0.2rem;
    }

    input:placeholder-shown {
      font-style: italic;
    }
    .validinput{
      border: 2px solid #28a745;
    }
    .validinput:focus{
      box-shadow:inset 0 0 0 transparent, 0 0 0 0.2rem #28a745;
    }
    .errorinput {
      box-shadow:inset 0 0 0 transparent, 0 0 0 0.2rem rgb(255 3 3);
    }
    .errorinput:focus {
      box-shadow:inset 0 0 0 transparent, 0 0 0 0.2rem rgb(255 3 3) !important;
    }

</style>
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
            <h1 class="m-0 text-dark">Kelola Nomor Surat </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item active">Kelola Nomor Surat </li>
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
            <div class="card card-primary" style="max-width:95%; margin:auto">
              <div class="card-header">
                <h3 class="card-title"> <b>Input Nomor Surat Baru</b> </h3>
              </div>
              <div class="card-body" style="padding-left: 3rem; padding-right:3rem">
                 <?php
                      // Check if flashdata message exists
                      $success = $this->session->flashdata('success');
                      $danger = $this->session->flashdata('danger');
                      $warning = $this->session->flashdata('warning');
                      if ($success) {
                        // Display flashdata message
                        echo '<div class="alert alert-success" style="color: #155724!important; background-color: #d4edda!important;">' . $success . '</div>';
                      }
                      if ($danger) {
                        // Display flashdata message
                        echo '<div class="alert alert-danger">' . $danger . '</div>';
                      }

                      if ($warning) {
                        // Display flashdata message
                        echo '<div class="alert alert-danger">' . $warning . '</div>';
                      }
                      $data = array( 'id' => "formsurat");
                      echo form_open(base_url('/kelolanomorsurat/tambah'),$data);  ?>
                 
                 <div class="form-group" id="dynamic_form">
                  <hr>
                  <div class="row identsurat">
                    <div class="col-md-4 col-sm-12 mb-sm-3">
                      <h4 class="text-secondary mt-1"><b>&nbsp;Identifikasi Surat</b></h4>
                    </div>
                    <div class="col-md-8 col-sm-12">
                      <div class="row"></div>
                      <div class="row d-none">
                        <div class="form-group col-12" >
                          <label>Jenis Surat<span style="color: red;">*</span></label>
                          <select name="jenis" id="jenis" class="form-control select2" onchange="jenis_changed(this)"  >
                          <option value="" hidden disabled >-Pilih Jenis Surat-</option>
                            <option value="Rutin" selected>Surat Rutin</option>
                            <option value="ST">Surat Tugas Saja</option>
                            <option value="STSD">Surat Tugas & SPD</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="form-group col-lg-4 col-md-12">
                          <label>Sifat Surat<span style="color: red;">*</span></label>
                          <select name="sifat" id="sifat" class="form-control select2">
                            <option value="Biasa" selected>Biasa</option>
                            <option value="Rahasia">Rahasia</option>
                          </select>
                        </div>
                      <input type="text" name="jenissurat" class="d-none" id="jenissurat" value="1" required hidden>

                        <div class="form-group col-lg-4 col-md-12">
                          <label>Kode Organisasi<span style="color: red;">*</span></label>
                          <select name="kode_organisasi" id="kode_organisasi" class="form-control select2" onchange="paramnomor_changed(this)">
                          <option value="" hidden disabled selected>-Pilih kode organisasi-</option>
                            <?php 
                            print_r($satker);
                            foreach($satker as $val=>$desc){
                              echo "<option value='".$val."' >".$val." - ".$desc."</option>";
                            }
                            ?>
                          </select>
                        </div>

                        <div class="form-group col-lg-4 col-md-12">
                          <label>Tanggal Surat<span style="color: red;">*</span></label>
                          <input type="text" name="tanggal" onchange="paramnomor_changed(this)" class="form-control date" required="required" id="tanggal" placeholder="Tanggal" autocomplete="off">
                        </div>
                      </div>
                    </div> 
                  </div>
                  
                  <br><hr class="katsurat">
                  <div class="row katsurat">
                    <div class="col-md-4 col-sm-12 mb-sm-3">
                    <h4 class="text-secondary"><b>&nbsp;Kategori Surat</b></h4>
                    <ul class="m-0">
                    <li><small id="kathelp2" class="form-text text-muted">Kategori surat digunakan untuk membantu menentukan klasifikasi surat</small></li>
                    <li><small id="kathelp" class="form-text text-muted">Minimal menentukan sampai Kategori ke-2</small></li>
                    <li><small id="kathelp" class="form-text text-muted">Untuk Klasifikasi dengan akhiran 00, silahkan isi sampai Kategori ke-2 saja</small></li>
                    </ul>
                    </div>
                    <div class="col-md-8 col-sm-12">
                      <div class="row">
                        <div class="form-group col-lg-6 col-md-12">
                          <label>Kategori 1<span style="color: red;">*</span></label>
                          <?php
                          echo '<select class="form-control select2" onchange="kat1_changed(this)" id="kategori1" name="kategori1" style="width: 100%;" required="required">';
                          $i=0;
                          echo "<option value='0'/>-Pilih Kategori-</option>";
                          foreach ($kategori1 as $var) {
                            echo "<option value='" . $var->kategori1 . "'/>".substr($var->kode,0,3).' | '.$var->kategori1 ."</option>";
                            $i++;
                          }
                          echo '</select>';
                          ?> 
                        </div>

                        <div class="form-group col-lg-6 col-md-12 ">
                          <label>Kategori 2<span style="color: red;">*</span></label>
                          <?php
                            echo '<select class="form-control select2" onchange="kat2_changed(this)" id="kategori2" name="kategori2" style="width: 100%;" required="required">';
                            $i=0;
                            echo "<option value='0'/>-Pilih Kategori-</option>";
                            // foreach ($kategori2 as $var) {
                            //   echo "<option value='" . $var->id . "'/>"  .$var->nama. "</option>";
                            //   $i++;
                            // }
                            echo '</select>';
                            ?> 
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="form-group col-lg-6 col-md-12">
                          <label>Kategori 3<small> (opsional)</small></label>
                        <?php
                          echo '<select class="form-control select2" onchange="kat3_changed(this)" id="kategori3" name="kategori3" style="width: 100%;" required="required">';
                          $i=0;
                          echo "<option value='0'/>-Pilih Kategori-</option>";
                          // foreach ($kategori3 as $var) {
                          //   echo "<option value='" . $var->id . "'/>"  .$var->nama.' '.$var->kegiatan ."</option>";
                          //   $i++;
                          // }
                          echo '</select>';
                          ?> 
                        </div>

                        <div class="form-group col-lg-6 col-md-12 ">
                        <label>Kategori 4<small> (opsional)</small></label>
                        <?php
                            echo '<select class="form-control select2" onchange="kat4_changed(this)" id="kategori4" name="kategori4" style="width: 100%;" required="required">';
                            $i=0;
                            echo "<option value='0'/>-Pilih Kategori-</option>";
                            // foreach ($kategori4 as $var) {
                            //   echo "<option value='" . $var->id . "'/>"  .$var->nama. "</option>";
                            //   $i++;
                            // }
                            echo '</select>';
                            ?> 
                        </div>
                      </div>
                    </div>
                  </div>

                  <br><hr>
                  <div class="row kodesur">
                    <div class="col-md-4 col-sm-12 mb-sm-3">
                      <h4 class="text-secondary"><b>&nbsp;Kode Surat</b></h4>
                      <small id="kodehelp" class="form-text text-muted">Kode klasifikasi dihasilkan dari pilihan kategori surat</small>
                      <small id="nomorhelp" class="form-text text-muted">Nomor surat dihasilkan dari pilihan tanggal surat dan kode organisasi</small>
                    </div>
                    <div class="col-md-8 col-sm-12">
                      <div class="row">
                        <div class="form-group col-lg-6 col-md-12 ">
                          <label>Kode Klasifikasi Surat<span style="color: red;">*</span></label>
                          <input type="text" name="kode" class="form-control" id="kode" placeholder="Dianjurkan diisi sesuai rekomendasi sistem" required>
                          <p id="kode2alert" class="form-text text-danger"><b>Kode Minimal 6 Karakter</b></p>
                          <p id="kode2help" class="form-text text-primary">Klasifikasi yang direkomendasikan sistem: <b><span id="rekomenkode">{Silahkan isi kategori}</span></b>&nbsp; <span id="recommend-button" class="" style="display:none; border-radius:7rem;"><a class="btn btn-sm btn-info text-white"><i class="nav-icon fa fa-hand-point-up fa-fw"></i> Gunakan!</a></span></p>
                        </div>
                        <div class="form-group col-lg-6 col-md-12 ">
                          <label>Nomor Surat<span style="color: red;">*</span></label>
                          <input type="text" name="nomor" class="form-control" id="nomor" oninput="validateNomor(this)" placeholder="Dianjurkan diisi sesuai rekomendasi sistem" required>
                          <p id="nomor2alert" class="form-text text-danger"><b>Nomor Minimal 4 Digit Sebelum Titik</b></p>
                          <p id="nomor2help" class="form-text text-primary">Nomor yang direkomendasikan sistem: <b><span id="rekomennomor">{Silahkan pilih kode organisasi}</span></b>&nbsp; <span id="recommendnomor-button" class="" style="display:none; border-radius:7rem;"><a class="btn btn-sm btn-info text-white"><i class="nav-icon fa fa-hand-point-up fa-fw"></i> Gunakan!</a></span></p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <br><hr>
                  <div class="row keterangansur">
                    <div class="col-md-4 col-sm-12 mb-sm-3">
                      <h4 class="text-secondary"><b>&nbsp;Keterangan Surat</b></h4>
                    </div>
                    <div class="col-md-8 col-sm-12">
                      <div class="form-group row">
                        <label>Tim Kerja<span style="color: red;">*</span></label>
                        <input type="text" name="timkerja" class="form-control" required="required" id="timkerja" placeholder="Diisi '-' bila belum ada" autocomplete="off" required>
                      </div>

                      <div class="form-group row ">
                       <label>Tujuan Surat<span style="color: red;">*</span></label>
                         <input type="text" name="tujuan" class="form-control" id="tujuan" placeholder="Yang melaksanakan, Orang, Dinas, atau instansi" required>
                      </div>
                      <div class="form-group row">
                        <label>Perihal Surat<span style="color: red;">*</span></label>
                        <input class="form-control" name="perihal" id="perihal" placeholder="Perihal" required>
                      </div>

                      <div class="form-group row ">
                       <label>Catatan</label>
                         <textarea type="textarea" name="catatan" class="form-control" id="catatan" placeholder="Catatan"></textarea>
                      </div>
                    </div>
                  </div>

                      
                        

                        


 

                    <div class="row">
                      <div class="form-group col-md-4 d-flex justify-content-center align-items-center">
                        <div class="button-group justify-content-center align-items-center mt-4">
                          <!-- <a href="javascript:void(0)" class="btn btn-primary align-items-center mt-1" id="plus">Tambah Nomor Surat</a> &nbsp; <br>
                          <a href="javascript:void(0)" class="btn btn-danger align-items-center mt-1" id="minus">Hapus Nomor Surat</a> -->
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <hr>
                    
                  <div class="row justify-content-center"><div class="col-3 float-sm-right justify-content-center"><button type="button" onclick="cekform()" class="btn btn-success">Submit Data</button></div></div>
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


  var kegiatan,daterange,periode_terus;

 $(document).ready(function() {
  $('#nomor2alert').hide();
  $('#kode2alert').hide();

  $('.select2').select2({
    width: '100%' });

  $('.date').datepicker({
    multidate: false,
    format: 'dd-mm-yyyy',
    onSelect: function(dateText) {paramnomor_changed()}

  });

  $('.date').datepicker("setDate", new Date());
  $('#nomor').val('');

  $('#nomor').on("blur", function() {
    var nomornya = $(this).val();
    var dot_position = nomornya.indexOf(".");

    if (dot_position !== -1) {
      nomornya = nomornya.substring(0, dot_position);
    }
    if (nomornya.length >= 4) {
      this.classList.remove('errorinput');
      this.classList.add('validinput');
      $('#nomor2alert').hide();
      console.log('valid number.')
    } else {
      console.log('invalid number.');
      $('#nomor2alert').show();
      this.classList.remove('validinput');
      this.classList.add('errorinput');

    }
  });

  $('#kode').on("blur", function() {
    if ($(this).val().length >= 6) {
      this.classList.remove('errorinput');
      this.classList.add('validinput');
      $('#kode2alert').hide();
      console.log('valid kode.')
    } else {
      console.log('invalid kode.');
      $('#kode2alert').show();
      this.classList.remove('validinput');
      this.classList.add('errorinput');

    }
  });


  $("#recommend-button").on("click", function() {
    var rekomenkodeValue = $("#rekomenkode").text();
    $("#kode").val(rekomenkodeValue);
    $("#kode").focus();
  });


  $("#rekomenkode").on("change",function() {
    // Show the recommend button when rekomenkode changes
    $("#recommend-button").show();
  });

  $("#recommendnomor-button").on("click", function() {
    var rekomenomorValue = $("#rekomennomor").text();
    $("#nomor").val(rekomenomorValue);
    $("#nomor").focus();
  });


  $("#rekomennomor").on("change",function() {
    // Show the recommend button when rekomenkode changes
    $("#recommendnomor-button").show();
  });
});

function cekform() {
  //iya, sebaiknya pake jquery validate. Tapi terlanjur e.
  
  let requiredinputs = $("#formsurat").find("input[required]")
  let requiredselects = $("#formsurat").find("select[required]")
  let formIsValid = true;
  let errorField = $("body").find(".errorinput");
  
  // if(!$("#jenis").value){
  //   $("#jenis").focus();
  //   formIsValid = false;
  // }

  // if(!$("#kode_organisasi").value){
  //   $("#kode_organisasi").focus();
  //   $("#kode_organisasi").select2('open')
  //   formIsValid = false;
  // }

  requiredinputs.each(function() {
    if ($(this).val() === "") {
      this.focus();
      formIsValid = false;
      return false;
    }
  });

  requiredselects.each(function() {
    if ($(this).val() === "") {
      this.focus();
      formIsValid = false;
      return false;
    }
  });

  if (errorField.length) {
    errorField.focus();
    formIsValid = false;
    return false;
  } 

  if (formIsValid) { {
    document.getElementById("formsurat").submit();
    return true;
  }

  };
}

function validateNomor(input) {
    // Regular expression to check for a number and a dot
    const regex = /^[0-9.]+$/;

    //kalo kosong, gausah di cek
    if(input.value=='') {return true}

    if (!regex.test(input.value)) {
      // Show the error message if the input is invalid
      alert('Hanya boleh angka dan titik')
      input.classList.add('errorinput');
      console.log('invalid char.');

      // Prevent the invalid character from being entered
      input.value = input.value.slice(0, -1);
    } else {
      input.classList.remove('errorinput');
      // Hide the error message if the input is valid
    }
  }

//  function reset(e){
//    if(e.target.id == 'plus'){
//   $('.select2').select2({
//     width: '100%' });

//    $('.date').datepicker({
//       multidate: false,
//       format: 'dd-mm-yyyy',
//       onSelect: function(dateText) {paramnomor_changed()}
//     });

//   }
//  }

 //APABILA KATEGORI 1 ADA PERUBAHAN
function kat1_changed(kategori1){
  $.ajaxSetup({
      //AMBIL DATA KATEGORI 2
      type:"POST",
      url: "<?php echo base_url('kelolanomorsurat/get_kat2') ?>",
      dataType:'json',
      cache: false,
  });
  $.ajax({
    data:{kat1:kategori1.value},
    success: function(response){

      //KALAU AMBIL DATA BERHASIL, KOSONGKAN KATEGORI 2-4, DAN FIELD KODE
      $("#kategori4").empty();
      $("#kategori3").empty();           
      $("#kategori2").empty();
      $("#kategori2").append(new Option("Pilih Opsi", "Kosong", false, false));
      $("#kategori3").append(new Option("Pilih Opsi", "Kosong", false, false));
      $("#kategori4").append(new Option("Pilih Opsi", "Kosong", false, false));
      $("#kode").val('')

        var options = "";
        for (var i = 0; i < response.length; i++) {
          //gabisa pake append html karena ada select2
          // options += "<option>" + response[i].kategori2 + "</option>";

          //OBJECT PREPARATION UNTUK KIRIM KE SELECT2
          var newOption = new Option(response[i].kode.substring(0,4)+" | "+response[i].kategori2, response[i].kategori2, false, false)
          
          //MINTA SELECT2 UNTUK TAMBAH BUTIR
          $("#kategori2").append(newOption);
        }
        $("#kategori2").trigger("change");
        $("#kategori2").select2({  // Re-initialize the Select2 plugin
        width:'100%'
        });
      
    }
  });
} 

function kat2_changed(kategori2){
  
 
  
  var kategori1 = document.getElementById("kategori1").value;
  console.log(kategori1)
  $.ajaxSetup({
        type:"POST",
        url: "<?php echo base_url('kelolanomorsurat/get_kat3') ?>",
        dataType:'json',
        cache: false,
  });
  $.ajax({
    data:{kat2:kategori2.value,
          kat1:kategori1
        },
    success: function(response){
      $("#kategori3").empty();
      $("#kategori4").empty();
      $("#kategori3").append(new Option("Pilih Opsi", "Kosong", false, false));
      $("#kategori4").append(new Option("Pilih Opsi", "Kosong", false, false));
      $("#kode").val('');
        var options = "";
        for (var i = 0; i < response.length; i++) {
          //gabisa pake append html karena ada select2
          // options += "<option>" + response[i].kategori2 + "</option>";
          
          var newOption = new Option( response[i].kode.substring(0,5)+" | "+response[i].kategori3, response[i].kategori3, false, false)
          $("#kategori3").append(newOption);
          // console.log(newOption)
        }

        $("#kategori3").trigger("change");
        $("#kategori3").select2({  // Re-initialize the Select2 plugin
        width:'100%'
        });
    }
  });

  //trigger get kode surat
  const surat = {kat1:$("#kategori1").val(),kat2:$("#kategori2").val(),kat3:$("#kategori3").val(),kat4:$("#kategori4").val()};
  console.log(surat)
  get_kode_surat(surat).then(kode => {
    // $("#kode").val(kode);
    $("#rekomenkode").text(kode).trigger("change");
  }).catch(error => {
      console.log(  error)
    // error: handle the error here
  });

} 

function kat3_changed(kategori3){
  var kategori1 = document.getElementById("kategori1").value;
  var kategori2 = document.getElementById("kategori2").value;
  $.ajaxSetup({
        type:"POST",
        url: "<?php echo base_url('kelolanomorsurat/get_kat4') ?>",
        dataType:'json',
        cache: false,
  });
  $.ajax({
    data:{kat3:kategori3.value,
          kat2:kategori2,
          kat1:kategori1
        },
    success: function(response){

      // console.log(typeof  response)
      // console.log(  response)
      // console.log( response.length)
      
      $("#kategori4").empty();
      $("#kode").val('');

      $("#kategori4").append(new Option("Pilih Opsi", "Kosong", false, false));
        var options = "";
        for (var i = 0; i < response.length; i++) {
          //gabisa pake append html karena ada select2
          // options += "<option>" + response[i].kategori2 + "</option>";
          
          var newOption = new Option(response[i].kode.substring(0,6)+" | "+response[i].kategori4, response[i].kategori4, false, false)
          $("#kategori4").append(newOption);  
          console.log(newOption)
        }

        $("#kategori4").trigger("change");
        $("#kategori4").select2({  // Re-initialize the Select2 plugin
        width:'100%'
        });
    }
  });

  //trigger get kode surat
  const surat = {kat1:$("#kategori1").val(),kat2:$("#kategori2").val(),kat3:$("#kategori3").val(),kat4:$("#kategori4").val()};
  get_kode_surat(surat).then(kode => {
      console.log(  'a')
    // $("#kode").val(kode);
    $("#rekomenkode").text(kode).trigger("change");
  }).catch(error => {
      console.log(  error)
    // error: handle the error here
  });
}

function kat4_changed(kategori4){
  
  const surat = {kat1:$("#kategori1").val(),kat2:$("#kategori2").val(),kat3:$("#kategori3").val(),kat4:$("#kategori4").val()};
  console.log('bujang'+JSON.stringify(surat))
  get_kode_surat(surat).then(kode => {
    // $("#kode").val(kode);
    $("#rekomenkode").text(kode).trigger("change");
      console.log(  'c')
  }).catch(error => {
    // error: handle the error here
  });
}


function jenis_changed(jenis){
  if(jenis.value == "ST" || jenis.value == "STSD"){
    //assign kode org jadi 6300
    $('#kode_organisasi').val('63000').trigger("change");
    document.getElementById("kode_organisasi").disabled = true;

    //assign kategori jadi KP.650
    $("#rekomenkode").text("KP.650");
    $("#kode").val("KP.650");
    document.getElementById("kode").disabled = true;
    //harusnya dibikin sequential, tapi saya nyerah wkwkwk
    //assign di backend aja wkwk
    // $("#kategori1").val("KEPEGAWAIAN").trigger("change")
    // $("#kategori2").append(new Option("Prepopulate", "ADMINISTRASI PEGAWAI", false, false)).trigger("change");
    // $("#kategori3").append(new Option("Prepopulate", "Surat Perintah Dinas/Surat Tugas", false, false)).trigger("change");
    // $("#kategori4").append(new Option("Prepopulate", "Surat Perintah Dinas/Surat Tugas", false, false)).trigger("change");
    $(".katsurat").hide();

    //ambil nomor surat baru

    //disable tim kerja
    // document.getElementById("timkerja").disabled = true;
    // $(".timkerja").hide();
    // $("#timkerja").val("-");

    //isi perihal jadi Surat Tugas
    $("#perihal").val("Surat Tugas");


  } else {
    //kalau yang dipilih surat rutin
    //deselect kode org
    document.getElementById("kode_organisasi").disabled = false;
    $('#kode_organisasi').val(null).trigger('change');

    //destroy kode surat
    document.getElementById("kode").disabled = false;
    $("#kode").val("");


    // destroy semua kategori
    $("#rekomenkode").text("{Silahkan isi}");
    $("#kategori1").val(0).trigger("change");
    $("#kategori2").empty();
    $("#kategori3").empty();
    $("#kategori4").empty();
    $(".katsurat").show();

    //destroy nomor surat
    $("#rekomennomor").text("{Silahkan pilih kode organisasi}");
    
    //enable tim kerja
    document.getElementById("timkerja").disabled = false;
    $("#timkerja").val("");
    $(".timkerja").show();

    //perihal dikosongin lagi
    $("#perihal").val("");

  }
}

function paramnomor_changed(){
  var kodeorgan = document.getElementById("kode_organisasi").value;
  var jenis = document.getElementById("jenissurat").value;
  var tanggalnya = $("#tanggal").datepicker('getDate')
  tanggalnya = tanggalnya.getFullYear()
  $("#nomor").val("");
  // console.log( JSON.stringify( jenis, tanggalnya))
  if(kodeorgan!=""){
    get_nomor_surat(tanggalnya, kodeorgan, jenis).then(nomor => {
      // $("#nomor").val(nomor);
      $("#rekomennomor").text(nomor).trigger("change");
      
      // console.log('bro'+nomor)
    }).catch(error => {
      // error: handle the error here
    });
  }
}

function get_kode_surat(surat){
  return new Promise((resolve, reject) => {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('kelolanomorsurat/get_kode_surat') ?>",
      dataType: 'json',
      cache: false,
      data: {
        kat4: surat['kat4'],
        kat3: surat['kat3'],
        kat2: surat['kat2'],
        kat1: surat['kat1']
      },
      success: function(response) {
        resolve(response.kode);
      },
      error: function(error) {
        reject(error);
      }
    });
  });
}

function get_nomor_surat(tahunnya,kodeorgan,jenisnya){
  return new Promise((resolve, reject) => {
    $.ajax({
      type: "POST",
      url: "<?php echo base_url('kelolanomorsurat/get_nomor_surat') ?>",
      dataType: 'json',
      cache: false,
      data: {
        tahun: tahunnya,
        kodeorg: kodeorgan,
        jenis:jenisnya
      },
      success: function(response) {
        resolve(response.nomor);
        console.log('laha'+response)
        console.log('laha'+jenisnya)
      },
      error: function(error) {
        reject(error);
        console.log('Error bro, '+JSON.stringify(error))

      }
    });
  });
}



 function set_edit(check){
    if (check.checked) {
      $("#nomor").prop("readonly", false);
    }else{
      $("#nomor").prop("readonly", true);
    }
 }


// var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus", "#minus", {

//     // the maximum number of form fields
//     limit: 50,

//     formPrefix: 'num' ,
//     // normalize all fields
//     // ideal for server side dulication
//     normalizeFullForm: false,

//     // color effects
//   //  createColor: '',
//    // removeColorï¼ '',
//     duration: 3000,

//     // JSON data which will prefill the form
//     data: {}

// });

</script>

</body>
</html>
