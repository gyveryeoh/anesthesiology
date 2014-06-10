<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery.js"></script>
<script>
$(document).ready(function() {
$('#selectall').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    }
	else{
		$(':checkbox').each(function() { //loop through each checkbox
			this.checked = false; //deselect all checkboxes with class "checkbox1"                       
		});         
	}
});
});
</script>
<form method="post" action="<?php echo base_url(); ?>index.php/reports_controller/anesth_hospital_and_service"/>
<table>
<tr>
<td align="center">
<input type="submit" name="submit" value="submit"/>
<select name="institution_id">
<option value = 0> ALL </option>
  <?php
	foreach($anesth_institutions as $ai):
  ?>
  <option value="<?php echo $ai->id?>" <?php if ($ai->id == $institution_id) { echo 'selected="selected"'; }?>><?php echo $ai->name?></option>
  <?php
  endforeach;
  ?>
</select>
</td>
</tr>
<tr>
<td>
<input type="checkbox" id="selectall">Select All
<?php
	echo "</br>";
	foreach($anesth_services as $as)
	{	
		echo '<input type="checkbox" name="service_id[]" value = "'.$as->id.'"';
		if($services != NULL)
		{
			foreach($services as $key=>$value)
			{
				if($as->id == $value)
				{
					echo "checked";
				}
			}
		}
		echo ">".$as->name."</br>";
	}
?>
</td>
</tr>
</table>
</form>
<?php
if (isset($_POST['submit'])){

	$count = 1;
	foreach($anesth_institutions as $ai)
	{
		if($institution_id != 0)
		{
			if($institution_id == $ai->id)
			{
				echo "Hospital $count : Total Services = " . $per_institution[$institution_id]."</br>";
				break;
			}
		}
		else
		{
			echo "Hospital $count : Total Services = "  . $per_institution[$ai->id]."</br>";
		}
		$count++;
	}
}

?>