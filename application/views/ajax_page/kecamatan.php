<label>Pilih Kecamatan</label>
   	<?php
    	echo form_dropdown("kecamatan_id",$opsi_kecamatan,'',"id='kecamatan_id' class='form-control'");
    ?>



    <script type="text/javascript">
    	
	    $("#kecamatan_id").change(function(){
	    		var selectValues = $("#kecamatan_id").val();
	    		if (selectValues == 0){
	    			var msg = "Kecamatan :<br><select name=\"variable_id\" disabled><option value=\"Pilih variabel\">Pilih Kecamatan Dahulu</option></select>";
	    			$('#variable').html(msg);
	    		}else{
	    			var kecamatan_id = {kecamatan_id:$("#kecamatan_id").val()};
	    			$('#variabel_id').attr("disabled",true);
	    			$.ajax({
							type: "POST",
							url : "<?php echo site_url('main/select_variable')?>",
							data: kecamatan_id,
							success: function(msg){
								$('#variable').html(msg);
							}
				  	});
	    		}
	    });
    </script>