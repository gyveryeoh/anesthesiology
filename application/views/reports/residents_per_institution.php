<<<<<<< HEAD
=======
<?php
if($year == NULL)
{$year = "";}
?>
>>>>>>> 575644a97648a98611dacf788f5c641d6057fd39

<table width="80%" cellpadding="1" cellspacing="0">
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
			</td>
			<tr>
			      <td>
				</br>
<<<<<<< HEAD
				Resident Name : <select id="matapelajaran_id" name="municipality_id" class="index_input" style="width: 200px;">
				<option value="">Resident Name</option>
=======
				Resident Name : <select id="sub_category"  name="sub_category" style="width: 250px;">
				<option value="">Select Resident</option>
>>>>>>> 575644a97648a98611dacf788f5c641d6057fd39
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
<<<<<<< HEAD
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
=======
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
>>>>>>> 575644a97648a98611dacf788f5c641d6057fd39
</script>