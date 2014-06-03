<?php foreach ($patient_information as $data): endforeach;
?>

<div align="center">
	<form method="post" id="anesth_form" autocomplete="off"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_diagnosis_information">
	<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
	<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
	<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
	<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
		<tr>
			<td class="border-less header" align="center" colspan="4">DIAGNOSIS INFORMATION</td>
		</tr>
		 <tr>
                    <td colspan="2" align="center" class="border-less"><?php if($this->session->flashdata("failed") !== FALSE){ echo $this->session->flashdata("failed"); }?></td>
          </tr>
		<tr>
			<td class="border-less question">DIAGNOSIS</td>
			<td class="border-less answer"><textarea name="diagnosis" cols="35" row="7" class="required"><?php echo $data->diagnosis; ?></textarea></td>
		</tr>
		<tr>
			<td class="border-less question">CO-MORBID DISEASES</b></td>
			<td class="border-less answer"><textarea name="comorbid_diseases" class="required" cols="35"><?php echo $data->comorbid_diseases; ?></textarea></td>
		</tr>
		<tr>
			<td class="border-less question">SERVICE</td>
			<td class="border-less answer">
				<select name="service" style="width: 700px;">
				<?php
				foreach($anesth_services_data as $ser):
				echo "<option value='".$ser->id."'";
				if ($ser->id == $data->service)
				{
					echo "selected='selected'";
					}
					echo ">".$ser->name."</option>";
				endforeach;
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="border-less question">ANESTHETIC TECHNIQUE</td>
			<td class="border-less answer">
				<select name="anesthetic_technique" style="width: 360px;" id="anesthetic_technique">
			<?php
			foreach($anesth_technique_data as $and):
			echo "<option value='".$and->id."'";
			if ($and->id == $data->anesthetic_technique)
			{
				echo "selected='selected'";
			}
			echo ">".$and->name."</option>";
			endforeach;
			?>
				</select>
			</td>
		</tr>
		<?php if ($data->anesthetic_technique == "9")
		{
			$display = 'display:table-row;';
		}
		else
		{
			$display = 'display:none;';
		}
		if ($data->anesthetic_technique == "3")
		{
			$critical_events = 'display:table-row;';
			$required = 'required';
		?>
		<?php
		}
		else
		{
			$critical_events = 'display:none;';
			$required = 'valid';
		}
		?>
		<tr id="peripheral_data" style="<?php echo $display; ?>">
		<td class="border-less answer"></td>
		<td class="border-less answer">
			<select name="peripheral" class="peripheral_valid" style="width:370px;">
				<option value="">Select Peripheral Nerve Blocks and Pain Techniques</option>
				<?php
				foreach($apnbapt_data as $apnbapt)
				{
					echo "<option value='".$apnbapt->id."'";
					if ($apnbapt->id == $data->peripheral)
					{
						echo "selected='selected'";
						}
						echo ">".$apnbapt->name."</option>";
						}
				?>
			</select>
		</td>
		</tr>
		<tr>
			<td class="border-less question">AIRWAY</td>
			<td class="border-less answer">
				<select name="airway" class="required" id="airway">
				<?php
				$not_in_database = true;
				foreach($anesth_airway_data as $aad):
				if($aad->name == $data->airway)
				{
					$not_in_database = false;
				break;
				}
				endforeach;
				foreach($anesth_airway_data as $aad):
				echo "<option value='".$aad->name."'";
				if ($aad->name == $data->airway )
				{
					echo "selected='selected'";
				}
				if($not_in_database == true and $aad->name == "Others (pls specify):")
				{
					echo "selected='selected'";
				}
				echo ">".$aad->name."</option>";
				endforeach;
				?>
				</select>
			</td>
		</tr>
		<?php if ($not_in_database == "Others (pls specify):")
		{
			$airway_display = 'display:table-row;';
		}
		else
		{
			$airway_display = 'display:none;';
		}
		?>
		<tr style="<?php echo $airway_display; ?>" id="other_airway">
			<td class="border-less question" width=25%>OTHER AIRWAY</td>
			<td class="border-less answer"><input type="text" size="20" name="other_airway" class="airway_valid" value="<?php if($not_in_database == true)echo $data->airway; ?>"></td>
		</tr>
		<tr id="critical_events_yes" style="<?php echo $critical_events; ?>">
                    <td class="border-less question">CRITICAL EVENTS</td>
                    <td class="border-less answer">YES</td>
		</tr>
          <tr id='critical_level_airway_title' style="<?php echo $critical_events; ?>">
            <td class="border-less question" colspan=2>AIRWAY</td>
          </tr>
          <tr id="airway_validation">
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_airway[]' class="critical_level_airway_<?php echo $required; ?>"></td>
          </tr>
          <?php
	  $a = 0;
		foreach($critical_events_airway_data as $ced):
		echo "<tr id='airway$a' style='$critical_events'><td class='border-less answer' colspan=2><input type='checkbox' value='".$ced->id."' name='critical_level_airway[]' class='critical_level_airway_$required'";
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
          <tr id="cardiovascular_title" style="<?php echo $critical_events; ?>">
            <td class="border-less question" colspan="2">CARDIOVASCULAR</td>
          </tr>
          <tr id="cardiovascular_validation">
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='cardiovascular[]' class="cardiovascular_<?php echo $required; ?>"></td>
          </tr>
          <?php
		$b=0;
		foreach($critical_events_cardiovacular_data as $cecd):
		echo "<tr id='cardiovascular$b' style='$critical_events'><td class='border-less answer' colspan=2><input type='checkbox' value='".$cecd->id."' name='cardiovascular[]'";
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
          <tr id="discharge_planning_title" style="<?php echo $critical_events; ?>">
            <td class="border-less question" colspan="2">DISCHARGE PLANNING</td>
          </tr>
          <tr id="discharge_planning_validation">
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='discharge_planning[]' class="discharge_planning_<?php echo $required; ?>"></td>
          </tr>
          <?php
		$c=0;
		foreach($critical_events_discharge_planning_data as $cedpd):
		echo "<tr id='discharge_planning$c' style='$critical_events'><td class='border-less answer' colspan=2><input type='checkbox' value='".$cedpd->id."' name='discharge_planning[]'";
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
          <tr id="miscellaneous_title" style="<?php echo $critical_events; ?>">
            <td class="border-less question" colspan="2">MISCELLANEOUS</td>
          </tr>
          <tr id="miscellaneous_validation">
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='miscellaneous[]' class="miscellaneous_<?php echo $required; ?>"></td>
          </tr>
          <?php
		$d=0;
		foreach($critical_events_miscellaneous_data as $cemd):
		echo "<tr id='miscellaneous$d' style='$critical_events'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' class='".$cemd->id."' value='".$cemd->id."' name='miscellaneous[]'";
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
          <tr id="neurological_title" style="<?php echo $critical_events; ?>">
            <td class="border-less question" colspan=2>NEUROLOGICAL</td>
          </tr>
          <tr id="neurological_validation">
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='neurological[]' class="neurological_<?php echo $required; ?>"></td>
          </tr>
          <?php
		$e=0;
		foreach($critical_events_neurological_data as $clnd):
		echo "<tr id='neurological$e' style='$critical_events'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$clnd->id."' name='neurological[]'";
		foreach($critical_events_neurological_details as $cln_details)
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
          <tr id="respiratory_title" style="<?php echo $critical_events; ?>">
            <td class="border-less question" colspan=2>RESPIRATORY</td>
          </tr>
          <tr id="respiratory_validation" style="<?php echo $critical_events; ?>">
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='respiratory[]' class="respiratory_<?php echo $required; ?>"></td>
          </tr>
          <?php
		$f=0;
		foreach($critical_events_respiratory_data as $clrd):
		echo "<tr id='respiratory$f' style='$critical_events'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$clrd->id."' name='respiratory[]'";
		foreach($critical_events_respiratory_details as $clr_details)
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
          <tr id="regional_anesthesia_title" style="<?php echo $critical_events; ?>">
            <td class="border-less question" colspan=2>REGIONAL ANESTHESIA</td>
          </tr>
          <tr id="regional_anesthesia_validation">
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='regional_anesthesia[]' class="regional_anesthesia_<?php echo $required; ?>"></td>
          </tr>
          <?php
		$g=0;
		foreach($critical_events_regional_anesthesia_data as $clrad):
		echo "<tr id='regional_anesthesia$g' style='$critical_events'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$clrad->id."' name='regional_anesthesia[]'";
		foreach($critical_events_regional_anesthesia_details as $clra_details)
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
          <tr id="preop_title" style="<?php echo $critical_events; ?>">
            <td class="border-less question" colspan=2>PREOP</td>
          </tr>
	  <tr id="preop_validation">
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='preop[]' class="preop_<?php echo $required; ?>"></td>
          </tr>
          <?php
		$h=0;
		foreach($critical_events_preop_data as $clpd):
		echo "<tr id='preop$h' style='$critical_events'><td bgcolor='FAFAD2' colspan=2><input type='checkbox' value='".$clpd->id."' name='preop[]'";
		foreach($critical_events_preop_details as $clp_details)
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
 <td class="border-less"></td>
 <td class="border-less"><input type="submit" name="save" value="Save Information"></td>
 </tr>
 <tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
<script>
 $('#anesthetic_technique').change(function() {
    var selected = $(this).val();
    if(selected == '3'){
      $('#critical_events_yes').show();
      $('#critical_events_no').hide();
      $('.critical_event_required').attr('class','critical_event_valid');
      //CRITICAL LEVEL AIRWAY
       $('#critical_level_airway_title').show();
       $('#airway_validation').show();
      <?php for($c = 0;$c<$a;$c++){ ?>
      $('#airway<?php echo $c; ?>').show();
      <?php } ?>
      $('.critical_level_airway_valid').attr('class','critical_level_airway_required');
      //CRITICAL LEVEL CARDIOVASCULAR
       $('#cardiovascular_title').show();
       $('#cardiovascular_validation').show();
      <?php for($car = 0;$car<=$b;$car++){ ?>
      $('#cardiovascular<?php echo $car; ?>').show();
      <?php } ?>
      $('.cardiovascular_valid').attr('class','cardiovascular_required');
      //CRITICAL LEVEL DISCHARGE PLANNING
       $('#discharge_planning_title').show();
       $('#discharge_planning_validation').show();
      <?php for($dis = 0;$dis<=$c;$dis++){ ?>
      $('#discharge_planning<?php echo $dis; ?>').show();
      <?php } ?>
      $('.discharge_planning_valid').attr('class','discharge_planning_required');
       //CRITICAL LEVEL MISCELLANEOUS
      $('#miscellaneous_title').show();
       $('#miscellaneous_validation').show();
      <?php for($misc = 0;$misc<=$d;$misc++){ ?>
      $('#miscellaneous<?php echo $misc; ?>').show();
      <?php } ?>

      $('.9').prop('checked',true);
      $('.9').click(false);
      $('.miscellaneous_valid').attr('class','miscellaneous_required');
      //CRITICAL LEVEL NEUROLOGICAL
      $('#neurological_title').show();
       $('#neurological_validation').show();
      <?php for($neuro = 0;$neuro<=$e;$neuro++){ ?>
      $('#neurological<?php echo $neuro; ?>').show();
      <?php } ?>
      $('.neurological_valid').attr('class','neurological_required');
      //CRITICAL LEVEL RESPIRATORY
      $('#respiratory_title').show();
      $('#respiratory_validation').show();
      <?php for($respiratory = 0;$respiratory<=$f;$respiratory++){ ?>
      $('#respiratory<?php echo $respiratory; ?>').show();
      <?php } ?>
      $('.respiratory_valid').attr('class','respiratory_required');
      //REGIONAL ANESTHESIA
      $('#regional_anesthesia_title').show();
      $('#regional_anesthesia_validation').show();
      <?php for($regional_anesthesia = 0;$regional_anesthesia<=$g;$regional_anesthesia++){ ?>
      $('#regional_anesthesia<?php echo $regional_anesthesia; ?>').show();
      <?php } ?>
      $('.regional_anesthesia_valid').attr('class','regional_anesthesia_required');
      //CRITICAL LEVEL PREOP
      $('#preop_title').show();
      $('#preop_validation').show();
      <?php for($preop = 0;$preop<=$h;$preop++){ ?>
      $('#preop<?php echo $preop; ?>').show();
      <?php } ?>
      $('.preop_valid').attr('class','preop_required');
    }
    else
    {
      $('#critical_events_yes').hide();
      $('#critical_events_no').show();
      $('.critical_event_valid').attr('class','critical_event_required');
      //CRITICAL LEVEL AIRWAY
       $('#critical_level_airway_title').hide();
       $('#airway_validation').hide();
      <?php for($c = 0;$c<=$a;$c++){ ?>
      $('#airway<?php echo $c; ?>').hide();
      <?php } ?>
      $('.critical_level_airway_required').attr('class','critical_level_airway_valid');
      //CRITICAL LEVEL CARDIOVASCULAR
       $('#cardiovascular_title').hide();
       $('#cardiovascular_validation').hide();
      <?php for($car = 0;$car<=$b;$car++){ ?>
      $('#cardiovascular<?php echo $car; ?>').hide();
      <?php } ?>
      $('.cardiovascular_required').attr('class','cardiovascular_valid');
      //CRITICAL LEVEL DISCHARGE PLANNING
       $('#discharge_planning_title').hide();
       $('#discharge_planning_validation').hide();
      <?php for($dis =0;$dis<=$c;$dis++){ ?>
      $('#discharge_planning<?php echo $dis; ?>').hide();
      <?php } ?>
      $('.discharge_planning_required').attr('class','discharge_planning_valid');
      //CRITICAL LEVEL MISCELLANEOUS
      $('#miscellaneous_title').hide();
      $('#miscellaneous_validation').hide();
      <?php for($misc = 0;$misc<=$d;$misc++){ ?>
      $('#miscellaneous<?php echo $misc; ?>').hide();
      <?php } ?>
       $('.9').prop('disabled',false);
      $('.9').prop('checked',false);
      $('.miscellaneous_required').attr('class','miscellaneous_valid');
      //CRITICAL LEVEL NEUROLOGICAL
      $('#neurological_title').hide();
      $('#neurological_validation').hide();
      <?php for($neuro = 0;$neuro<=$e;$neuro++){ ?>
      $('#neurological<?php echo $neuro; ?>').hide();
      <?php } ?>
      $('.neurological_required').attr('class','neurological_valid');
      //CRITICAL LEVEL RESPIRATORY
      $('#respiratory_title').hide();
      $('#respiratory_validation').hide();
      <?php for($respiratory = 0;$respiratory<=$f;$respiratory++){ ?>
      $('#respiratory<?php echo $respiratory; ?>').hide();
      <?php } ?>
      $('.respiratory_required').attr('class','respiratory_valid');
      //CRITICAL LEVEL REGIONAL ANESTHESIA
      $('#regional_anesthesia_title').hide();
      $('#regional_anesthesia_validation').hide();
      <?php for($regional_anesthesia = 0;$regional_anesthesia<=$g;$regional_anesthesia++){ ?>
      $('#regional_anesthesia<?php echo $regional_anesthesia; ?>').hide();
      <?php } ?>
      $('.regional_anesthesia_required').attr('class','regional_anesthesia_valid');
      //CRITICAL LEVEL PREOP
      $('#preop_title').hide();
      $('#preop_validation').hide();
      <?php for($preop = 0;$preop<=$h;$preop++){ ?>
      $('#preop<?php echo $preop; ?>').hide();
      <?php } ?>
      $('.preop_required').attr('class','preop_valid');
    }
    if (selected == '9')
    {
        $('#peripheral_data').show();
        $('.peripheral_valid').attr('class','peripheral_required');
    }
    else
    {
        $('#peripheral_data').hide();
        $('.peripheral_required').attr('class','peripheral_valid');
    }
});
 $('#airway').change(function() {
    var selected = $(this).val();
    if(selected == 'Others (pls specify):'){
      $('#other_airway').show();
      $('.airway_valid').attr('class','airway_required');
    }
    else{
      $('#other_airway').hide();
      $('.airway_required').attr('class','airway_valid');
    }
});
 <?php if ($data->anesthetic_technique == "3")
 {
?>
      $('.9').prop('checked',true);
      $('.9').click(false);
<?php
 }
 ?>
</script>