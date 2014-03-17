<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#insti_id").change(function(){
            var insti_id = $("#insti_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>index.php/reports_controller/get_resident_per_institution",
               data : "insti_id=" + insti_id,
               success: function(data){
                   $("#users_info").html(data);
               }
            });
        });
    });
</script>
<table>
	<tr>
    	<td>HOSPITAL</td>
        <td><select name="insti_id" id="insti_id" style="width:200px;">
        	<option value="">SELECT HOSPITAL</option>
        	<?php
			foreach ($anesth_institutions as $ai){
				echo "<option value='".$ai->id."'>".$ai->name."</option>";	
			}			
			?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>RESIDENT NAME</td>
        <td><select name="users_id" id="users_info" style="width:300px;">
        	<option value="">SELECT RESIDENT</option>        	
            </select>
        </td>
    </tr>
</table>
