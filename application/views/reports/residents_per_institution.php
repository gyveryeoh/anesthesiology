<?php
if($year == NULL)
{$year = "";}
echo "paul";
?>

<table width="80%" cellpadding="1" cellspacing="0">
          <form method="post" action="#">
          <tr>				
			<th colspan="2" align="center">
				Institution : <select name="institution" size="1" style="width: 300px;" id="category">
				<?php
					foreach($anesth_institutions as $ai):
						echo "<option value='".$ai->id."'>".$ai->name."</option>";
					endforeach
				?>
				</select>
				</br>
				Resident Name : <select id="sub_category" name="municipality_id" class="index_input" style="width: 200px;">
				<option value="">Resident Name</option>
				</select>
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
			</br>
			<input type="submit" name="submit" value="submit">
			</th>
			
		  </tr>
		  </form>
		  <tr>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery.js"></script>
<script>
	//Datepicker Format
	//Province and Municipality Dropdown
	$("select#category").change(function(){
			// Post string
			var inst_id = $(this).val();
			alert(inst_id);
			
			var option = "";
			$.ajax({
				type: "POST", 
				data: inst_id, 
				dataType: "json", 
				cache: true,
				
				url: '<?php echo base_url();?>index.php/reports_controller/get_resident_per_institution',  
				timeout: 1000, 
				error: function()
				{
					alert("Failed to submit");
				},
				success: function(data)
				{  
			        $.each(data, function(i,j){ 
		                var row = "<option value=\"" + j.value + "\">" + j.text + "</option>"; 
				option += row;
				});
				$("#sub_category").html(option);
				}
				});
			});
</script>