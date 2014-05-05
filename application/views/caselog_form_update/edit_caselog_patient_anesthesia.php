<?php 
foreach ($patient_information as $data):
$start  = DATE("H:i", STRTOTIME("$data->anesthesia_start_time"));
$end  = DATE("H:i", STRTOTIME("$data->anesthesia_end_time"));
endforeach;
$hour_start = $start[0].$start[1];
$min_start = $start[3].$start[4];
$hour_end = $end[0].$end[1];
$min_end = $end[3].$end[4];

?>
<div align="center">
<form method="post" id="anesth_form" autocomplete="off"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_anesthesia_information">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
<tr>
    <td class="border-less header" align="center" colspan="4">ANESTHESIA INFORMATION</td>
</tr>
  <tr>
    <td class="border-less" bgcolor="SkyBlue">ANESTHESIA START</td>
    <td class="border-less" align="left" colspan="6" bgcolor="FAFAD2"><input type="text" name="anesthesia_start" id="datepicker-example14" class="required" size="10" value="<?php echo $data->anesthesia_start; ?>">
                      <select name="anesthesia_start_hour"style="width:60px;">
	    <option value="" class="required">HOUR</option>
				<?php
				for ($i = 01; $i <= 24; $i++)
				{
					$value = strlen($i);
					if($value==1)
					{
						$k = "0".$i;
					}
					else
					{
						$k=$i;
					}
					echo "<option value='$k'";
					if ($hour_start == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select> : 
			<select name="anesthesia_start_min" class="required" style="width: 50px;">
				<?php
				for ($i = 00; $i <= 59; $i++)
				{
					$value = strlen($i);
					if($value==1)
					{
						$k = "0".$i;
					}
					else
					{
						$k=$i;
					}
					echo "<option value='$k'";
					if ($min_start == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
                    </td>
          </tr>
          <tr>
		  <td class="border-less"  bgcolor="SkyBlue">ANESTHESIA END</td>
                      <td class="border-less" align="left" colspan="6" bgcolor="FAFAD2"><input type="text" name="anesthesia_end" id="datepicker-example13" class="required" size="10" value="<?php echo $data->anesthesia_end?>">
                      <select name="anesthesia_end_hour" class="required" style="width:60px;">
	    <option value="">HOUR</option>	
				<?php
				for ($i = 01; $i <= 24; $i++)
				{
					$value = strlen($i);
					if($value==1)
					{
						$k = "0".$i;
					}
					else
					{
						$k=$i;
					}
					echo "<option value='$k'";
					if($hour_end == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select> :
			<select name="anesthesia_end_min" class="required" style="width: 50px;">
			<option value="">MIN</option>
				<?php
				for ($i = 00; $i <= 59; $i++)
				{
					$value = strlen($i);
					if($value==1)
					{
						$k = "0".$i;
					}
					else
					{
						$k=$i;
					}
					echo "<option value='$k'";
					if ($min_end == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
                      </td>
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