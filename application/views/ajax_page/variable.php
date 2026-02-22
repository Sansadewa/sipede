<label>Pilih Kecamatan</label>
   	<?php
    	echo form_dropdown("variable_id",$opsi_variable,'',"id='variable_id' class='form-control'");
    ?>


    <script type="text/javascript">
	    $("#variable_id").change(function(){
	    	$('#btn_proses').show();
	    });
    </script>