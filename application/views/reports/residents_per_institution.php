
<table width="80%" cellpadding="1" cellspacing="0">
          <form method="get" action="<?php echo base_url(); ?>index.php/reports_controller/get_resident_per_institution">
          <tr>				
			<td colspan="2" align="center">
				Institution : <select name="institution" size="1" style="width: 300px;" id="category">
				<?php
					foreach($anesth_institutions as $ai):
						echo "<option value='".$ai->id."'>".$ai->name."</option>";
					endforeach
				?>
				</select>
			</td>
			<tr>
			      <td>
				</br>
				Resident Name : <select id="matapelajaran_id" name="municipality_id" class="index_input" style="width: 200px;">
				<option value="">Resident Name</option>
				</select>
			</td>
			</tr>
			<tr>
				</br>
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
</tr>
			<input type="submit" name="submit" value="submit">
			</th>
			
		  </tr>
		  </form>
</table>
<script>
    $(document).ready(function(){
        $("#category").change(function(){
            var insti_id = $("#category").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>index.php/reports_controller/get_resident_per_institution",
               data : "institution_id=" + insti_id,
               success: function(data){
                   $("#matapelajaran_id").html(data);
               }
            });
        });
    });
</script>