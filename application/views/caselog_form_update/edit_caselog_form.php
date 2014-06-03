<?php foreach ($patient_information as $data){}
$time_1 = strtotime($data->anesthesia_start_time);
$getHour_start = date('h', $time_1);
$getMinute_start = date('i', $time_1);
$pm_am_start = date('A', $time_1);

$time_2 = strtotime($data->anesthesia_end_time);
$getHour_end = date('h', $time_2);
$getMinute_end = date('i', $time_2);
$pm_am_end = date('A', $time_2);

if($data->other_main_agent == NULL or $data->other_main_agent == "NULL" ){$oma = '';} else {$oma = $data->other_main_agent;}
if($data->other_supplementary_agent == NULL or $data->other_supplementary_agent == "NULL" ){$osa = '';} else {$osa = $data->other_supplementary_agent;}
if($data->other_post_op_pain_agent == NULL or $data->other_post_op_pain_agent == "NULL" ){$opopa = '';} else {$opopa = $data->other_post_op_pain_agent;}
if($data->other_monitors_used == NULL or $data->other_monitors_used == "NULL" ){$omu = '';} else {$omu = $data->other_monitors_used;}
?>
 <script type="text/javascript">
      $(document).ready(function() {
      $("#anesth_form").validate()({
      });
   });
    </script>
<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_patient_form">
<table width="90%" cellpadding="1" cellspacing="0" border=1 style="border-top:hidden;">
 <input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>">
 <input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>">

</table>
         
	  <tr>
            <td class="border-less"><b>Supplementary Agent :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='supplementary_agent[]' class='supplementary_agent_required'></td>
          </tr>
          <?php
          $num_cols = 3;
          $current_col = 0;
          $x = 0;
          $sa = "sa_";
          foreach($anesth_agent_data as $aad):
          if($current_col == "0")echo "<tr><td></td>";
		  echo "<td><input type='checkbox' value='".$aad->id."' id='".$x."' name='supplementary_agent[]'";
		  foreach($patient_form_supplementary_agent_details as $pfsad)
		  {
			if($pfsad->aa_name == $aad->name)
			{
				
				echo "checked";
				break;
			}
		  }
		   echo ">".$aad->name."</td>";
		  
          if($current_col == $num_cols-1)
          {
            echo "</tr>";
            $current_col = 0;
            }
            else
            {
                $current_col++;
            }
            $x++;
            endforeach;
           ?>
          <tr>
            <td class="border-less"></td><td><input type="checkbox" name="other_supplementary_agent" id="sa_81" value="other_supplementary_agent_checkbox" <?php if($osa != ''){echo "checked";}?>>Others Please Specify : </td>
            <td class="border-less"  id="other_supplementary_agent" style="display:none;"><input type="text" size="20" name="other_supplementary_agent_data" class="other_supplementary_agent_valid" value="<?php echo $osa;?>"></td>
          </tr>
		  <tr>
                <td class="border-less"><b>Post-OP Pain Agents :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='post_op_pain_agent[]' class='post_op_pain_agent_required'></td>
          </tr>
          <?php
          $num_cols = 3;
          $current_col = 0;
          $x = 0;
          $sa = "post_";
          foreach($anesth_agent_data as $aad):
          if($current_col == "0")echo "<tr><td></td>";
		  
		  echo "<td><input type='checkbox' value='".$aad->id."' id='"."post_".$x."' name='post_op_pain_agent[]'";
		  
		  
		  foreach($patient_form_post_op_pain_agent_details as $pfpopad)
		  {
			if($pfpopad->aa_name == $aad->name)
			{
				
				echo "checked";
				break;
			}
		  }		  
          echo ">".$aad->name."</td>";
          
		  
		  if($current_col == $num_cols-1)
          {
            echo "</tr>";
            $current_col = 0;
            }
            else
            {
                $current_col++;
            }
            $x++;
            endforeach;
           ?>
          <tr>
            <td></td><td><input type="checkbox" name="other_post_op_pain_agent" id="post_81" value="other_post_op_pain_agent_checkbox" <?php if($opopa != ''){echo "checked";}?>>Others Please Specify : </td>
            <td class="border-less"  id="other_post_op_pain_agent" style="display:none;"><input type="text" size="20" name="other_post_op_pain_agent_data" class="other_post_op_pain_agent_valid" value="<?php echo $opopa;?>"></td>
          </tr>
          <tr>
                <td class="border-less"><b>Post-OP Pain Management :</b></td>
          </tr>
            <?php
          foreach($anesth_post_op_pain_management_data as $apopmd)
          {
          $apopmd_id[]=$apopmd->id;
          $apopmd_name[]=$apopmd->name;
          }
          foreach($anesth_post_op_pain_management_data_1 as $apopmd1)
          {
          $apopmd_name1[]=$apopmd1->name;
          }
          $apopmd_1 = new ArrayIterator($apopmd_id);
          $apopmd_2= new ArrayIterator($apopmd_name);
          $apopmd_2_2= new ArrayIterator($apopmd_name1);

	$multiIterator = new MultipleIterator();
	$multiIterator->attachIterator($apopmd_1);
	$multiIterator->attachIterator($apopmd_2);
	$multiIterator->attachIterator($apopmd_2_2);

foreach($multiIterator as $combinedArray)
{
     echo "<tr><td></td>";
          
		  
          echo "<td><input type='checkbox' value='".$combinedArray[0]."' name='post_op_pain_management[]' class='required'";
			foreach($patient_form_post_op_pain_management_details as $pfpopmd)
			{
				if($pfpopmd->apopm_name == $combinedArray[1])
				{
					echo "checked";
				}
			}

		  echo ">(".$combinedArray[0].") ".$combinedArray[1]."</td>";
		  
		  
		  echo "<td><input type='checkbox' value='".$combinedArray[0]."' name='post_op_pain_management_1[]' class='required'";
			foreach($patient_form_post_op_pain_management_details_1 as $pfpopmd1)
			{
				if($pfpopmd1->apopm1_name == $combinedArray[2])
				{
					echo "checked";
				}
			}          
          echo ">".$combinedArray[2]."</td>";
          echo "<tr>";
             }
           ?>          <tr>
          <td class="border-less"><b>Monitors Used :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='monitors_used[]' class="monitors_used_required"></td>
          </tr>
          <?php
          foreach($anesth_monitor_data as $amd)
          {
            echo "<tr><td class='border-less'><input type='checkbox' name='monitors_used[]' value='".$amd->id."'";
			foreach($patient_form_monitors_used_details as $pfmu)
			{
				if($pfmu->name == $amd->name)
				{
					echo "checked";
				}
			}
			echo ">".$amd->name."</td></tr>";
          }
          ?>
          <tr>
            <td class="border-less"><input type="checkbox" name="other_monitors_used" id="monitors_used" value="other_monitors_used_checkbox" <?php if($omu != ''){echo "checked";}?>>Others Please Specify : </td>
            <td class="border-less" id="other_monitors_used" style="display:none;"><input type="text" size="20" name="other_monitors_used_data" class="other_monitors_used_valid" value="<?php echo $omu;?>"></td>
          </tr>
           <tr>
                    <td class="border-less header" align="center" colspan="4"><h3>PROCEDURES</h3></td>
          </tr>
			<tr>
                    <td class="border-less"><b>Procedure Done :</b></td>
                    <td class="border-less" align="left" colspan="2">
					<textarea name="procedure_done" cols="35" class="required"><?php echo $data->procedure_done;?></textarea>
					</td>
          </tr>
          <tr>
                    <td class="border-less"><b>Other Procedure :</b></td>
                    <td class="border-less" align="left" colspan="2">
					<textarea name="other_procedure" cols="35" class="required"><?php echo $data->other_procedure;?></textarea>
					</td>
          </tr>
          <tr>
                    <td class="border-less" width="25%"><b>Muscle Relaxant Reversal Done :</b></td>
                    <td class="border-less" colspan="2">
					<input type="radio" name="muscle_relaxant_reversal_done" value="YES" class="required" <?php if($data->muscle_relaxant_reversal_done=="YES"){ echo "checked";}?>> Yes 
					<input type="radio" name="muscle_relaxant_reversal_done" value="NO" <?php if($data->muscle_relaxant_reversal_done=="NO"){ echo "checked";}?>> No 
					<input type="radio" name="muscle_relaxant_reversal_done" value="N/A" class="required" <?php if($data->muscle_relaxant_reversal_done=="N/A"){ echo "checked";}?>> N/A
					</td>
          </tr>
          <tr>
                    <td class="border-less" width="25%"><b>If Delivery :</b></td>
                    <td class="border-less" colspan="2">
					<input type="radio" name="if_delivery" id="show" value="YES" class="required" <?php if($data->if_delivery=="YES"){ echo "checked";}?>/> Yes 
					<input type="radio" name="if_delivery" id="hide" value="NO" <?php if($data->if_delivery=="NO"){ echo "checked";}?>/> No
					</td>
          </tr>
		  
          <tr>
                    <td class="border-less"><b>Post-Operative Diagnosis :</b></td>
                    <td class="border-less" align="left" colspan="2"><textarea name="post_operative_diagnosis" cols="35" class="required"><?php echo $data->post_operative_diagnosis?></textarea>
					</td>
          </tr>
          <tr>
                    <td class="border-less"><b>Discharge Notes :</b></td>
                    <td class="border-less" align="left" colspan="2"><textarea name="discharged_notes" cols="35" class="required"><?php echo $data->discharge_notes?></textarea>
					</td>
          </tr>
          <tr>
                    <td class="border-less"><b>Other Notes :</b></td>
                    <td class="border-less" align="left" colspan="2"><textarea name="other_notes" cols="35" class="required"><?php echo $data->other_notes?></textarea>
					</td>
          </tr>
          <tr id="critical_events_no">
                    <td class="border-less"><b>Critical Events :</b></td>
                    <td class="border-less" colspan="2">
					<input type="radio" name="critical_events" id="critical_events_show" value="YES" class="critical_event_required"> Yes 
					<input type="radio" name="critical_events" id="critical_events_hide" value="NO"> No
					</td>
          </tr>
		  <tr>
				<td colspan="8" align="center" class="border-less">
					<input type="submit" name="login" value="SAVE"/>
				</td>
		  </tr>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
<script>
if($($('input[id="monitors_used"]')).is(':checked'))
{
      $('#other_monitors_used').show('slow');
      $('.other_monitors_used_valid').attr('class','other_monitors_used_required');
      $('.monitors_used_required').attr('class','monitors_used_valid');
}

$('input[id="monitors_used"]').change(function(){
    var pClass = '.'+$(this).val();
    if ($(this).is(':checked')){
        
      $('#other_monitors_used').show('slow');
      $('.other_monitors_used_valid').attr('class','other_monitors_used_required');
      $('.monitors_used_required').attr('class','monitors_used_valid');
    }
    else{
      $('#other_monitors_used').hide();
      $('.other_monitors_used_required').attr('class','other_monitors_used_valid');
      $('.monitors__used_valid').attr('class','monitors_used_required');
    }
});

//kapag ka wala sa database yung nilagay na airway, lalabas agad yung textbox para sa others
if($('#airway').val() == 'Others (pls specify):')
{
      $('#other_airway').show();
      $('.airway_valid').attr('class','airway_required')
}

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

if($('#needle').val() == 'Others (pls specify):')
{
      $('#other_needle').show();
      $('.needle_valid').attr('class','needle_required');
}

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

if($('#epidural_needle').val() == 'Others (pls specify):')
{
      $('#other_epidural_needle').show();
      $('.other_epidural_needle_required').attr('class','needle_required');
}

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

if($($('input[id="81"]')).is(':checked'))
{
      $('#other_main_agent').show('slow');
      $('.other_main_agent_valid').attr('class','other_main_agent_required');
      $('.main_agent_required').attr('class','main_agent_valid');
}

$('input[id="81"]').change(function(){
    var pClass = '.'+$(this).val();
    if ($(this).is(':checked')){
        
      $('#other_main_agent').show('slow');
      $('.other_main_agent_valid').attr('class','other_main_agent_required');
      $('.main_agent_required').attr('class','main_agent_valid');
    }
    else{
      $('#other_main_agent').hide();
      $('.other_main_agent_required').attr('class','other_main_agent_valid');
      $('.main_agent_valid').attr('class','main_agent_required');
    }
});

if($($('input[id="sa_81"]')).is(':checked'))
{
      $('#other_supplementary_agent').show('slow');
      $('.other_supplementary_agent_valid').attr('class','other_supplementary_agent_required');
      $('.supplementary_agent_required').attr('class','supplementary_agent_valid');
}

$('input[id="sa_81"]').change(function(){
    var pClass = '.'+$(this).val();
    if ($(this).is(':checked')){
        
      $('#other_supplementary_agent').show('slow');
      $('.other_supplementary_agent_valid').attr('class','other_supplementary_agent_required');
      $('.supplementary_agent_required').attr('class','supplementary_agent_valid');
    }
    else{
      $('#other_supplementary_agent').hide();
      $('.other_supplementary_agent_required').attr('class','other_supplementary_agent_valid');
      $('.supplementary_agent_valid').attr('class','supplementary_agent_required');
    }
});

if($($('input[id="post_81"]')).is(':checked'))
{
      $('#other_post_op_pain_agent').show('slow');
      $('.other_post_op_pain_agent_valid').attr('class','other_post_op_pain_agent_required');
      $('.post_op_pain_agent_required').attr('class','post_op_pain_agent_valid');	
}

$('input[id="post_81"]').change(function(){
    var pClass = '.'+$(this).val();
    if ($(this).is(':checked')){
        
      $('#other_post_op_pain_agent').show('slow');
      $('.other_post_op_pain_agent_valid').attr('class','other_post_op_pain_agent_required');
      $('.post_op_pain_agent_required').attr('class','post_op_pain_agent_valid');
    }
    else{
      $('#other_post_op_pain_agent').hide();
      $('.other_post_op_pain_agent_required').attr('class','other_post_op_pain_agent_valid');
      $('.post_op_pain_agent_valid').attr('class','post_op_pain_agent_required');
    }
});

if($('#colloids_used_hide').is(':checked'))
{
        $('#colloids_used_info').hide();
        $('.colloids_used_info_required').attr('class','colloids_used_info_valid');
		$('#other_colloids_used').hide();
        $('.colloids_used_required').attr('class','colloids_used_valid');
}

if($('#colloids_used_show').is(':checked'))
{
        $('#colloids_used_info').show();
        $('.colloids_used_info_valid').attr('class','colloids_used_info_required');
}



if($('#colloids_used').val() == 'Others')
{
      $('#other_colloids_used').show();
      $('.colloids_used_valid').attr('class','colloids_used_required');
	  
}

$('#colloids_used').change(function() {
    var selected = $(this).val();
    if(selected == 'Others'){
      $('#other_colloids_used').show();
      $('.colloids_used_valid').attr('class','colloids_used_required');
    }
    else{
      $('#other_colloids_used').hide();
      $('.colloids_used_required').attr('class','colloids_used_valid');
    }
});
$('#show').on('click',function() {
       var selected = $(this).val();
       if(selected == 'YES')
       {
        $('#agpar_score_1m').show();
        $('#agpar_score_5m').show();
        $('#agpar_score_10m').show();
        $('#add_apgar').show();
        $('.agpar_score_valid').attr('class','agpar_score_required');
       }
});
    $('#hide').on('click',function() {
       var selected = $(this).val();
       if(selected == 'NO')
       {
        $('#agpar_score_1m').hide();
        $('#agpar_score_5m').hide();
        $('#agpar_score_10m').hide();
        $('#add_apgar').hide();
        $(".sub_add_extra").remove();
        $('.agpar_score_required').attr('class','agpar_score_valid');
       }
});
$('#anesthetic_technique').change(function() {
    var selected = $(this).val();
    if(selected == '3'){
      $('#critical_events_yes').show();
      $('#critical_events_no').hide();
      $('.critical_event_required').attr('class','critical_event_valid');
      //CRITICAL LEVEL AIRWAY
       $('#critical_level_airway_title').show();
      <?php for($c = 1;$c<=8;$c++){ ?>
      $('#critical_level_airway_data<?php echo $c; ?>').show();
      <?php } ?>
      $('.critical_level_airway_valid').attr('class','critical_level_airway_required');
      //CRITICAL LEVEL CARDIOVASCULAR
       $('#cardiovascular_title').show();
      <?php for($car = 1;$car<=9;$car++){ ?>
      $('#cardiovascular_data<?php echo $car; ?>').show();
      <?php } ?>
      $('.cardiovascular_valid').attr('class','cardiovascular_required');
      //CRITICAL LEVEL DISCHARGE PLANNING
       $('#discharge_planning_title').show();
      <?php for($dis = 1;$dis<=7;$dis++){ ?>
      $('#discharge_planning_data<?php echo $dis; ?>').show();
      <?php } ?>
      $('.discharge_planning_valid').attr('class','discharge_planning_required');
       //CRITICAL LEVEL MISCELLANEOUS
      $('#miscellaneous_title').show();
      <?php for($misc = 1;$misc<=12;$misc++){ ?>
      $('#miscellaneous_data<?php echo $misc; ?>').show();
      <?php } ?>
      $('.9').prop('checked',true);
      $('.9').click(false);
      
      $('.miscellaneous_valid').attr('class','miscellaneous_required');
      //CRITICAL LEVEL NEUROLOGICAL
      $('#neurological_title').show();
      <?php for($neuro = 1;$neuro<=5;$neuro++){ ?>
      $('#neurological_data<?php echo $neuro; ?>').show();
      <?php } ?>
      $('.neurological_valid').attr('class','neurological_required');
      //CRITICAL LEVEL RESPIRATORY
      $('#respiratory_title').show();
      <?php for($respiratory = 1;$respiratory<=12;$respiratory++){ ?>
      $('#respiratory_data<?php echo $respiratory; ?>').show();
      <?php } ?>
      $('.respiratory_valid').attr('class','respiratory_required');
      //REGIONAL ANESTHESIA
      $('#regional_anesthesia_title').show();
      <?php for($regional_anesthesia = 1;$regional_anesthesia<=12;$regional_anesthesia++){ ?>
      $('#regional_anesthesia_data<?php echo $regional_anesthesia; ?>').show();
      <?php } ?>
      $('.regional_anesthesia_valid').attr('class','regional_anesthesia_required');
      //CRITICAL LEVEL PREOP
      $('#preop_title').show();
      <?php for($preop = 1;$preop<=12;$preop++){ ?>
      $('#preop_data<?php echo $preop; ?>').show();
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
      <?php for($c = 1;$c<=8;$c++){ ?>
      $('#critical_level_airway_data<?php echo $c; ?>').hide();
      <?php } ?>
      $('.critical_level_airway_required').attr('class','critical_level_airway_valid');
      
      //CRITICAL LEVEL CARDIOVASCULAR
       $('#cardiovascular_title').hide();
      <?php for($car = 1;$car<=9;$car++){ ?>
      $('#cardiovascular_data<?php echo $car; ?>').hide();
      <?php } ?>
      $('.cardiovascular_required').attr('class','cardiovascular_valid');
      //CRITICAL LEVEL DISCHARGE PLANNING
       $('#discharge_planning_title').hide();
      <?php for($dis = 1;$dis<=7;$dis++){ ?>
      $('#discharge_planning_data<?php echo $dis; ?>').hide();
      <?php } ?>
      $('.discharge_planning_required').attr('class','discharge_planning_valid');
      //CRITICAL LEVEL MISCELLANEOUS
      $('#miscellaneous_title').hide();
      <?php for($misc = 1;$misc<=12;$misc++){ ?>
      $('#miscellaneous_data<?php echo $misc; ?>').hide();
      <?php } ?>
       $('.9').prop('disabled',false);
      $('.9').prop('checked',false);
      $('.miscellaneous_required').attr('class','miscellaneous_valid');
      //CRITICAL LEVEL NEUROLOGICAL
      $('#neurological_title').hide();
      <?php for($neuro = 1;$neuro<=5;$neuro++){ ?>
      $('#neurological_data<?php echo $neuro; ?>').hide();
      <?php } ?>
      $('.neurological_required').attr('class','neurological_valid');
      //CRITICAL LEVEL RESPIRATORY
      $('#respiratory_title').hide();
      <?php for($respiratory = 1;$respiratory<=12;$respiratory++){ ?>
      $('#respiratory_data<?php echo $respiratory; ?>').hide();
      <?php } ?>
      $('.respiratory_required').attr('class','respiratory_valid');
      //CRITICAL LEVEL REGIONAL ANESTHESIA
      $('#regional_anesthesia_title').hide();
      <?php for($regional_anesthesia = 1;$regional_anesthesia<=12;$regional_anesthesia++){ ?>
      $('#regional_anesthesia_data<?php echo $regional_anesthesia; ?>').hide();
      <?php } ?>
      $('.regional_anesthesia_required').attr('class','regional_anesthesia_valid');
      //CRITICAL LEVEL PREOP
      $('#preop_title').hide();
      <?php for($preop = 1;$preop<=12;$preop++){ ?>
      $('#preop_data<?php echo $preop; ?>').hide();
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
</script>