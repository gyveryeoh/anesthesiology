<?php foreach ($patient_information as $data): endforeach; ?>
<div align="center">		   
<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_critical_events_information">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<table border="0" cellpadding="0" width="90%" cellspacing="0" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
	<tr>
		<td class="border-less header" align="center" colspan="4"><h3>CRITICAL EVENTS DETAILS</h3></td>
	</tr>
	<tr>
        <td valign="middle" bgcolor=SkyBlue width="20%">CRITICAL EVENTS</td>
	<?php
	if ($data->technique_name != "Intraoperative Shift of Anesthetic Technique")
		{
	?>
	<td bgcolor=FAFAD>
		<input type="radio" name="critical_events" id="show" value="YES" <?php if($data->critical_events == "YES"){ echo "checked";}?>> YES
		<input type="radio" name="critical_events" id="hide" value="NO" <?php if($data->critical_events == "NO"){ echo "checked";}?>> NO REPORTABLE REPORTS WITHIN 48 HOURS</td>
	</tr>
	<?php
		}
		else
		{
			?>
			<td bgcolor=FAFAD><?php echo $data->critical_events; ?></tr>
			<?php
		}
	?>
	<?php
	if ($data->critical_events == "YES")
	{
		$required = "required";
		$show = "table-row";
	}
	else
	{
		$required = "valid";
		$show = "display:none";
	}
	?>
	<tr id=airway_title style='<?php echo $show; ?>'>
		<td class="border-less" bgcolor="skyblue" colspan="2">AIRWAY</td>
	</tr>
	<tr id='airway_validation'>
            <td class="border-less answer" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_airway[]' class='critical_level_airway_<?php echo $required; ?>'></td>
          </tr>
	<?php
	$a = 0;
		foreach($critical_events_airway_data as $ced):
		echo "<tr id='airway$a' style='$show'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$ced->id."' name='critical_level_airway[]' class='critical_level_airway_$required'";
		foreach($critical_events_airway_details as $cead):
			if($cead->critical_level_airway_id == $ced->id)
			{
				echo "checked";
				break;
			}
		endforeach;
		echo ">".$ced->code.' '.$ced->name."</td></tr>";
		$a++;
		endforeach;
		?>
	<tr id=cardiovascular_title style='<?php echo $show; ?>'>
		<td class="border-less" bgcolor="skyblue" colspan="2">CARDIOVASCULAR</td>
	</tr>
	<tr id='cardiovascular_validation'>
		<td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='cardiovascular[]' class='cardiovascular_<?php echo $required; ?>'></td>
		<?php
		$b=0;
		foreach($critical_events_cardiovacular_data as $cecd):
		echo "<tr id='cardiovascular$b' style='$show'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' class='cardiovascular_$required' value='".$cecd->id."' name='cardiovascular[]'";
		foreach($critical_events_cardiovascular_details as $cec_details)
		{
			if($cec_details->critical_level_cardiovascular_id == $cecd->id)
			{
				echo "checked";
				break;
			}
		}
		echo ">".$cecd->code.' '.$cecd->name."</td></tr>";
		$b++;
		endforeach;
		?>
	<tr>
	<tr id=discharge_planning_title style='<?php echo $show; ?>'>
		<td class="border-less" bgcolor="skyblue" colspan="2">DISCHARGE PLANNING</td>
	</tr>
	<tr id='discharge_planning_validation'>
		<td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='discharge_planning[]' class='discharge_planning_<?php echo $required; ?>'></td>
		<?php
		$c=0;
		foreach($critical_events_discharge_planning_data as $cedpd):
		echo "<tr id='discharge_planning$c' style='$show'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$cedpd->id."' name='discharge_planning[]'";
		foreach($critical_events_discharge_planning_details as $cedp_details)
		{
			if($cedp_details->critical_level_discharge_planning_id == $cedpd->id)
			{
				echo "checked";
				break;
			}
		}
		echo ">".$cedpd->code.' '.$cedpd->name."</td></tr>";
		$c++;
		endforeach;
		?>
	<tr id=miscellaneous_title style='<?php echo $show; ?>'>
		<td class="border-less" bgcolor="skyblue" colspan="2">MISCELLANEOUS</td>
	</tr>
	<tr id=miscellaneous_validation>
		<td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='micellaneous[]' class='miscellaneous_<?php echo $required; ?>'></td>
	</tr>
		<?php
		$d=0;
		foreach($critical_events_miscellaneous_data as $cemd):
		echo "<tr id='miscellaneous$d' style='$show'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' class='".$cemd->id."' value='".$cemd->id."' name='micellaneous[]'";
		foreach($critical_events_miscellaneous_details as $cem_details)
		{
			if($cem_details->critical_level_miscellaneous_id == $cemd->id)
			{
				echo "checked";
				break;
			}
		}
		echo ">".$cemd->code.' '.$cemd->name."</td></tr>";
		$d++;
		endforeach;
		?>
	<tr id=neurological_title style='<?php echo $show; ?>'>
		<td class="border-less" bgcolor="skyblue" colspan="2">NEUROLOGICAL</td>
	</tr>
	<tr id=neurological_validation>
		<td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='neurological[]' class='neurological_<?php echo $required; ?>'></td>
		<?php
		$e=0;
		foreach($critical_level_neurological_data as $clnd):
		echo "<tr id='neurological$e' style='$show'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$clnd->id."' name='neurological[]'";
		foreach($critical_level_neurological_details as $cln_details)
		{
			if($cln_details->critical_level_neurological_id == $clnd->id)
			{
				echo "checked";
				break;
			}
		}
		echo ">".$clnd->code.' '.$clnd->name."</td></tr>";
		$e++;
		endforeach;
		?>
	<tr id=respiratory_title style='<?php echo $show; ?>'>
		<td class="border-less" bgcolor="skyblue" colspan="2">RESPIRATORY</td>
	</tr>
	<tr id=respiratory_validation>
		<td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='respiratory[]' class='respiratory_<?php echo $required; ?>'></td>
		<?php
		$f=0;
		foreach($critical_level_respiratory_data as $clrd):
		echo "<tr id='respiratory$f' style='$show'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$clrd->id."' name='respiratory[]'";
		foreach($critical_level_respiratory_details as $clr_details)
		{
			if($clr_details->critical_level_respiratory_id == $clrd->id)
			{
				echo "checked";
				break;
			}
		}
		echo ">".$clrd->code.' '.$clrd->name."</td></tr>";
		$f++;
		endforeach;
		?>
	<tr id='regional_anesthesia_title'  style='<?php echo $show; ?>'>
		<td class="border-less" bgcolor="skyblue" colspan="2">REGIONAL ANESTHESIA</td>
	</tr>
	<tr id=regional_anesthesia_validation>
		<td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='regional_anesthesia[]' class='regional_anesthesia_<?php echo $required; ?>'></td>
		<?php
		$g=0;
		foreach($critical_level_regional_anesthesia_data as $clrad):
		echo "<tr id='regional_anesthesia$g' style='$show'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$clrad->id."' name='regional_anesthesia[]'";
		foreach($critical_level_regional_anesthesia_details as $clra_details)
		{
			if($clra_details->critical_level_regional_anesthesia_id == $clrad->id)
			{
				echo "checked";
				break;
			}
		}
		echo ">".$clrad->code.' '.$clrad->name."</td></tr>";
		$g++;
		endforeach;
		?>
	<tr id='preop_title'  style='<?php echo $show; ?>'>
		<td class="border-less" bgcolor="skyblue" colspan="2">PREOP</td>
	</tr>
	<tr id='preop_validation'>
		<td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='preop[]' class='preop_<?php echo $required; ?>'></td>
		<?php
		$h=0;
		foreach($critical_level_preop_data as $clpd):
		echo "<tr id='preop$h' style='$show'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$clpd->id."' name='preop[]'";
		foreach($critical_level_preop_details as $clp_details)
		{
			if($clp_details->critical_level_preop_id == $clpd->id)
			{
				echo "checked";
				break;
			}
		}
		echo ">".$clpd->code.' '.$clpd->name."</td></tr>";
		$h++;
		endforeach;
		?>
	
	<tr>
		<td class="border-less"><br><br><input type="submit" name="submit" value="UPDATE INFORMATION"></td>
	</tr>
	<tr>
		<td colspan="3" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
	</tr>
</table>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
<script>
$('#hide').click(function() {
       var selected = $(this).val();
       if(selected == 'NO')
       {
      //CRITICAL LEVEL AIRWAY
       $('#airway_title').hide();
       $('#airway_validation').hide();
      <?php for($a = 0;$a<=9;$a++){ ?>
      $('#airway<?php echo $a; ?>').hide();
      <?php } ?>
      $('.critical_level_airway_required').attr('class','critical_level_airway_valid');
      //CRITICAL LEVEL CARDIOVASCULAR
       $('#cardiovascular_title').hide();
       $('#cardiovascular_validation').hide();
      <?php for($b = 0;$b<=9;$b++){ ?>
      $('#cardiovascular<?php echo $b; ?>').hide();
      <?php } ?>
      $('.cardiovascular_required').attr('class','cardiovascular_valid');
      //CRITICAL LEVEL DISCHARGE PLANNING
       $('#discharge_planning_title').hide();
       $('#discharge_planning_validation').hide();
      <?php for($c = 0;$c<=7;$c++){ ?>
      $('#discharge_planning<?php echo $c; ?>').hide();
      <?php } ?>
      $('.discharge_planning_required').attr('class','discharge_planning_valid');
       //CRITICAL LEVEL MISCELLANEOUS
      $('#miscellaneous_title').hide();
      $('#miscellaneous_validation').hide();
      <?php for($d = 0;$d<=12;$d++){ ?>
      $('#miscellaneous<?php echo $d; ?>').hide();
      <?php } ?>    
      $('.miscellaneous_required').attr('class','miscellaneous_valid');
      //CRITICAL LEVEL NEUROLOGICAL
      $('#neurological_title').hide();
      $('#neurological_validation').hide();
      <?php for($e = 0;$e<=5;$e++){ ?>
      $('#neurological<?php echo $e; ?>').hide();
      <?php } ?>
      $('.neurological_required').attr('class','neurological_valid');
      //CRITICAL LEVEL RESPIRATORY
      $('#respiratory_title').hide();
      $('#respiratory_validation').hide();
      <?php for($f = 0;$f<=12;$f++){ ?>
      $('#respiratory<?php echo $f; ?>').hide();
      <?php } ?>
      $('.respiratory_required').attr('class','respiratory_valid');
      //REGIONAL ANESTHESIA
      $('#regional_anesthesia_title').hide();
      $('#regional_anesthesia_validation').hide();
      <?php for($g = 0;$g<=12;$g++){ ?>
      $('#regional_anesthesia<?php echo $g; ?>').hide();
      <?php } ?>
      $('.regional_anesthesia_required').attr('class','regional_anesthesia_valid');
      //CRITICAL LEVEL PREOP
      $('#preop_title').hide();
      $('#preop_validation').hide();
      <?php for($h = 0;$h<=12;$h++){ ?>
      $('#preop<?php echo $h; ?>').hide();
      <?php } ?>
      $('.preop_required').attr('class','preop_valid');
       }
});
$('#show').click(function() {
       var selected = $(this).val();
       if(selected == 'YES')
       {
      //CRITICAL LEVEL AIRWAY
       $('#airway_title').show();
       $('#airway_validation').show();
      <?php for($a = 0;$a<=9;$a++){ ?>
      $('#airway<?php echo $a; ?>').show();
      <?php } ?>
      $('.critical_level_airway_valid').attr('class','critical_level_airway_required');
      //CRITICAL LEVEL CARDIOVASCULAR
       $('#cardiovascular_title').show();
       $('#cardiovascular_validation').show();
      <?php for($b= 0;$b<=9;$b++){ ?>
      $('#cardiovascular<?php echo $b; ?>').show();
      <?php } ?>
      $('.cardiovascular_valid').attr('class','cardiovascular_required');
      //CRITICAL LEVEL DISCHARGE PLANNING
       $('#discharge_planning_title').show();
       $('#discharge_planning_validation').show();
      <?php for($c = 0;$c<=7;$c++){ ?>
      $('#discharge_planning<?php echo $c; ?>').show();
      <?php } ?>
      $('.discharge_planning_valid').attr('class','discharge_planning_required');
       //CRITICAL LEVEL MISCELLANEOUS
      $('#miscellaneous_title').show();
      $('#miscellaneous_validation').show();
      <?php for($d = 0;$d<=12;$d++){ ?>
      $('#miscellaneous<?php echo $d; ?>').show();
      <?php } ?>    
      $('.miscellaneous_valid').attr('class','miscellaneous_required');
      //CRITICAL LEVEL NEUROLOGICAL
      $('#neurological_title').show();
      $('#neurological_validation').show();
      <?php for($e = 0;$e<=5;$e++){ ?>
      $('#neurological<?php echo $e; ?>').show();
      <?php } ?>
      $('.neurological_valid').attr('class','neurological_required');
      //CRITICAL LEVEL RESPIRATORY
      $('#respiratory_title').show();
      $('#respiratory_validation').show();
      <?php for($f = 0;$f<=12;$f++){ ?>
      $('#respiratory<?php echo $f; ?>').show();
      <?php } ?>
      $('.respiratory_valid').attr('class','respiratory_required');
      //REGIONAL ANESTHESIA
      $('#regional_anesthesia_title').show();
      $('#regional_anesthesia_validation').show();
      <?php for($g = 0;$g<=12;$g++){ ?>
      $('#regional_anesthesia<?php echo $g; ?>').show();
      <?php } ?>
      $('.regional_anesthesia_valid').attr('class','regional_anesthesia_required');
      //CRITICAL LEVEL PREOP
      $('#preop_title').show();
      $('#preop_validation').show();
      <?php for($h = 0;$h<=12;$h++){ ?>
      $('#preop<?php echo $h; ?>').show();
      <?php } ?>
      $('.preop_valid').attr('class','preop_required');
       }
});
<?php
if ($data->technique_name == "Intraoperative Shift of Anesthetic Technique")
{
?>
$('.9').prop('checked',true);
$('.9').click(false);
<?php
}
else
{
?>
$('.9').prop('checked',false);
$('.9').click(false);	
<?php
}
?>
</script>