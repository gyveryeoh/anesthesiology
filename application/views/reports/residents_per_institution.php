<?php
if($year == NULL)
{$year = "";}
?>
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
		
		$("#submit").click(function(){
            var insti_id = $("#insti_id").val();
			var users_info = $("#users_info").val();
			var year = $("#year").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>index.php/reports_controller/get_report_list",
               data : "insti_id=" + insti_id + "&users_info=" + users_info + "&year=" + year,
               success: function(data){
                   $("#table_output").html(data);
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
	<tr>
		<td>
				Filter Year
		</td>
		<td>
			<select name="year" id="year" size="1" style="width: 100px;">
			<option value="0"> Select Year </option>
				<?php
				for($x=date('Y');$x>=1991;$x--)
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
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="submit" id="submit">
			</td>
		</tr>
</table>
<table id="table_output">
	
</table>

