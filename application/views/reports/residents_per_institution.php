<<<<<<< HEAD
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery.js"></script>
<script type="text/javascript">
	//Datepicker Format
	//Province and Municipality Dropdown
	$(document).ready(function() {
		$("#category").change(function() {
			$.get('<?php echo base_url();?>index.php/reports_controller/get_resident_per_institution?inst_id=' + $(this).val(), function(data) {
				$("#sub_category").html(data);
			});	
		});
	});
</script>
<table width="80%" cellpadding="1" cellspacing="0" border = "0">
          <form method="get" action="<?php echo base_url(); ?>index.php/reports_controller/get_resident_per_institution">
          <tr>				
			<td colspan="2" align="center">
				Institution : <select name="institution" size="1" style="width: 300px;" id="category">
				<option ="">Select Institution</option>
				<?php
					foreach($anesth_institutions as $ai):
						echo "<option value='".$ai->id."'>".$ai->name."</option>";
					endforeach
				?>
				</select>

			

				Resident Name : <select id="sub_category"  name="sub_category" style="width: 250px;">
				<option value="">Select Resident</option>

				</select>


				Filter Year : <select name="year" size="1" style="width: 60px;">
				<?php
				for($x=date('Y');$x>=1900;$x--)
				{
					echo "<option value=".$x."";
					
						if($year == $x)
						{
							echo "selected = selected";
						}
					
					echo ">".$x."</option>";  
				}
				?>
			</select>
			</td>
			</tr>
			
			<tr>
			<td>
			<input type="submit" name="submit" value="submit">
			</td>
		  </tr>
		  </form>
</table>

=======
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
>>>>>>> f0cfd3c32bad6c4ca12290b41e950a88c1c15f72
