<?php 
foreach ($patient_information as $data):
endforeach;
?>
<div align="center">
<form method="post" id="anesth_form" autocomplete="off"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_epidural">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="80%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
<tr>
    <td class="border-less header" align="center" colspan="4">NEEDLE INFORMATION</td>
</tr>
    <tr>
    <td rowspan="2" class="border-less" bgcolor="SkyBlue" width="20%">NEEDLE</td>
    <td class="border-less" bgcolor="SkyBlue" width=20%">SPINAL NEEDLE TYPE</td>
    <td bgcolor="FAFAD2" class="border-less">
    <select name="spinal_needle" id="needle" style="width: 200px;">
    <?php
    $not_in_database = true;
    foreach($anesth_needle_type as $an)
    {
    if($an->name == $data->spinal_needle)
    {
	$not_in_database = false;
	break;
    }
    }
    foreach($anesth_needle_type as $an)
    {
	echo "<option value='".$an->name."'";
	if ($an->name == $data->spinal_needle )
	{
	    echo "selected='selected'";
	}
	if($not_in_database == true and $an->name == "Others (pls specify):")
	{
	    echo "selected='selected'";
	}
	    echo ">".$an->name."</option>";
	}
if ($not_in_database == "Others (pls specify):")
{
 $other_needle_display = 'display:block;';
}
else
{
 $other_needle_display = 'display:none;';
}
?>
    </select>
    </td>
    <td bgcolor="FAFAD2" class="border-less" id="other_needle" style="<?php echo $other_needle_display; ?>">
	<input type="text" size="20" name="other_spinal_needle" class="needle_valid" value="<?php if($not_in_database == true)echo $data->spinal_needle; ?>"></td>
    </tr>
  <tr>
    <td class="border-less" bgcolor="SkyBlue">EPIDURAL NEEDLE TYPE</td>
    <td bgcolor="FAFAD2" class="border-less">
    <select name="epidural_needle" class="required" id="epidural_needle" style="width:200px;">
    <?php
    $not_in_database = true;
    $array = array('Touhy','Others (pls specify):','None');
	foreach ($array as $arr):
    {
	if($arr == $data->epidural_needle)
	{
	    $not_in_database = false;
	    break;
	}
	}
	endforeach;
	$array = array('Touhy','Others (pls specify):','None');
	foreach ($array as $arr):
	{
	    echo "<option value='".$arr."'";
	    if ($arr == $data->epidural_needle )
	    {
		echo "selected='selected'";
		}
		if($not_in_database == true and $arr == "Others (pls specify):")
		{
		    echo "selected='selected'";
		    }
		    echo ">".$arr."</option>";
        }
	endforeach;
	if ($not_in_database == "Others (pls specify):")
{
 $other_epidural_display = 'display:block;';
}
else
{
 $other_epidural_display = 'display:none;';
}
 ?>
    </select>
    </td>
     <td bgcolor="FAFAD2" class="border-less" id="other_epidural_needle" style="<?php echo $other_epidural_display; ?>">
	<input type="text" size="20" value="<?php if($not_in_database == true)echo $data->epidural_needle; ?>" name="other_epidural_needle" class="other_epidural_needle_valid">
     </td>
  </tr>
   <tr>
    <td rowspan="2" class="border-less" bgcolor="SkyBlue">NEEDLE GAUGE</td>
    <td class="border-less" bgcolor="SkyBlue">SPINAL NEEDLE GAUGE</td>
    <td bgcolor="FAFAD2" class="border-less">
    <select name="spinal_needle_gauge" id="spinal_needle_gauge" style="width: 100px;">
	<?php
	foreach($anesth_needle_gauge as $ang)
	{
	    echo "<option value='".$ang->id."'";
	    if ($ang->id == $data->spinal_needle_gauge)
	    {
		echo "selected='selected'";
		}
		echo ">".$ang->name."</option>";
        }
	?>
    </select>
    </td>
  </tr>
  <tr>
    <td class="border-less" bgcolor="SkyBlue">EPIDURAL NEEDLE GAUGE</td>
    <td bgcolor="FAFAD2" class="border-less">
    <select name="epidural_needle_gauge" class="required" id="epidural_needle_gauge" style="width:100px;">
    <?php
    foreach($anesth_needle_gauge as $ang)
    {
	echo "<option value='".$ang->id."'";
	if ($ang->id == $data->epidural_needle_gauge)
	{
	    echo "selected='selected'";
	    }
	    echo ">".$ang->name."</option>";
    }
    ?>
    </select></td>
  </tr>
  	<tr>
	    <td class="border-less"></td>
	    <td class="border-less">
		<input type="submit" name="submit" value="Save Information">
	</td>
	</tr>
	 <tr>
<td colspan="6" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
<script>
$('#needle').change(function() {
    var selected = $(this).val();
    if(selected == 'Others (pls specify):'){
      $('#other_needle').show();
      $('.needle_valid').attr('class','needle_required');
    }
    else{
      $('#other_needle').hide();
      $('.needle_required').attr('class','needle_valid');
    }
});
$('#epidural_needle').change(function() {
    var selected = $(this).val();
    if(selected == 'Others (pls specify):'){
      $('#other_epidural_needle').show();
      $('.other_epidural_needle_valid').attr('class','other_epidural_needle_required');
    }
    else{
      $('#other_epidural_needle').hide();
      $('.other_epidural_needle_required').attr('class','other_epidural_needle_valid');
    }
});
</script>