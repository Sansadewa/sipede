<div class="form-group">
  <label>Nama</label>
  <?php
  echo '<select class="form-control select2" id="nama" name="nama" style="width: 100%;" required="required">';
  $i=0;
  echo "<option value='0'/>-Pilih Pegawai-</option>";
  foreach ($opsi_pegawai as $var) {
    echo "<option value='" . $var->nip . "'/>"  .$var->nama. "</option>";
    $i++;
  }
  echo '</select>';
  ?>
</div>
<div class="form-group">
  <label>Kegiatan</label>

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
<div class="form-group">
  <label>Jangka Waktu:</label>

  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="fa fa-calendar"></i>
      </span>
    </div>
    <input type="text" class="form-control float-right periode_waktu_awal" id="periode_waktu_awal" name="periode_waktu_awal" placeholder="periode_waktu_awal" autocomplete="off">
  </div>
  <div class="input-group">
    <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="fa fa-calendar"></i>
      </span>
    </div>
    <input type="text" class="form-control float-right periode_waktu_akhir" id="periode_waktu_akhir" name="periode_waktu_akhir" placeholder="periode_waktu_akhir" autocomplete="off">
  </div>

  <script type="text/javascript">
      function generate_kegiatan(sel){
        type = sel;
            var post_data ={}
            post_data['type']=$('#type_edit').val()
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
                $("#kegiatan_edit").val([]);
                $("#kegiatan_edit").html(html);
              }
            });

      }
  </script>