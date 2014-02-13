<?php 
foreach ($patient_information as $data):
endforeach;
?>
<div align="center">
<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_diagnosis_information">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<table border="0" cellpadding="0" width="80%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
<tr>
 <td class="border-less header" align="center" colspan="4">PATIENT DIAGNOSIS INFORMATION</td>
</tr>
<tr>
 <td class="border-less" bgcolor="SkyBlue">DIAGNOSIS</td>
 <td class="border-less" align="left" colspan="2" bgcolor="FAFAD2"><textarea name="diagnosis" cols="35" row="7" class="required"><?php echo $data->diagnosis; ?></textarea></td>
</tr>
<tr>
 <td class="border-less" bgcolor="SkyBlue">CO-MORBID DISEASES</b></td>
 <td class="border-less" align="left" colspan="2" bgcolor="FAFAD2"><textarea name="comorbid_diseases" class="required" cols="35"><?php echo $data->comorbid_diseases; ?></textarea></td>
</tr>
<tr>
 <td class="border-less" bgcolor="SkyBlue">SERVICE</td>
 <td class="border-less" colspan="2" bgcolor="FAFAD2">
  <select name="service" style="width: 700px;">
   <?php
   foreach($anesth_services_data as $ser)
   {
    echo "<option value='".$ser->id."'";
    if ($ser->id == $data->service)
    {
     echo "selected='selected'";
     }
     echo ">".$ser->name."</option>";
   }
   ?>
 </select>
  </td>
 </tr>
<tr>
 <td class="border-less" bgcolor="SkyBlue">ANESTHETIC TECHNIQUE</b></td>
 <td class="border-less" colspan="2" bgcolor="FAFAD2"><select name="anesthetic_technique" style="width: 360px;" id="anesthetic_technique">
 <?php
 foreach($anesth_technique_data as $and)
 {
  echo "<option value='".$and->id."'";
  if ($and->id == $data->anesthetic_technique)
  {
   echo "selected='selected'";
   }
   echo ">".$and->name."</option>";
   }
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
?>
<tr id="peripheral_data" style="<?php echo $display; ?>" >
 <td class="border-less" bgcolor="FAFAD2"></td>
 <td class="border-less"bgcolor="FAFAD2">
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
 <td class="border-less" bgcolor="SKYBLUE">AIRWAY</td>
 <td class="border-less" colspan="2" bgcolor="FAFAD2"><select name="airway" class="required" id="airway">
 <?php
 $not_in_database = true;
 foreach($anesth_airway_data as $aad)
 {
  if($aad->name == $data->airway)
  {
   $not_in_database = false;
   break;
  }
  }
  foreach($anesth_airway_data as $aad)
  {
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
     }
     ?>
 </select>
  </td>
 </tr>
<?php if ($not_in_database == "Others (pls specify):")
{
 $airway_display = 'display:block;';
}
else
{
 $airway_display = 'display:none;';
}
?>
<tr style="<?php echo $airway_display; ?>" id="other_airway">
 <td class="border-less" bgcolor="SKYBLUE">OTHER AIRWAY</td>
 <td class="border-less" bgcolor="FAFAD2"><input type="text" size="20" name="other_airway" class="airway_valid" value="<?php if($not_in_database == true)echo $data->airway; ?>"></td>
</tr>
<tr>
<tr id="critical_events_yes" style="display: none;">
                    <td class="border-less"><b>Critical Events :</b></td>
                    <td class="border-less"><b>YES</b></td>
          </tr>
          <tr id='critical_level_airway_title' style="display: none;">
            <td class="border-less"><b>AIRWAY :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_airway[]' class="critical_level_airway_valid"></td>
          </tr>
          <?php
          $x=1;
          foreach($critical_level_airway as $cla)
          {
            echo "<tr id='critical_level_airway_data$x' style='display:none;'><td class='border-less' colspan='3'><input type='checkbox' name='critical_level_airway[]' value='".$cla->id."'>&nbsp;&nbsp;&nbsp;".$cla->code."&nbsp;&nbsp;&nbsp;".$cla->name."</td></tr>";
          $x++;
          }
          ?>
          <tr id="cardiovascular_title" style="display: none;">
            <td class="border-less"><b>CARDIOVASCULAR :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_cardiovascular[]' class="cardiovascular_valid"></td>
          </tr>
          <?php
          $x=1;
          foreach($critical_level_cardiovascular as $clc)
          {
            echo "<tr id='cardiovascular_data$x' style='display:none;'><td class='border-less' colspan='3'><input type='checkbox' name='critical_level_cardiovascular[]' value='".$clc->id."'>&nbsp;&nbsp;&nbsp;".$clc->code."&nbsp;&nbsp;&nbsp;".$clc->name."</td></tr>";
          $x++;
          }
          ?>
          <tr id="discharge_planning_title" style="display: none;">
            <td class="border-less"><b>DISCHARGE PLANNING :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_discharge_planning[]' class="discharge_planning_valid"></td>
          </tr>
          <?php
          $x=1;
          foreach($critical_level_discharge_planning as $cldp)
          {
            echo "<tr id='discharge_planning_data$x' style='display:none;'><td class='border-less' colspan='3'><input type='checkbox' name='critical_level_discharge_planning[]' value='".$cldp->id."'>&nbsp;&nbsp;&nbsp;".$cldp->code."&nbsp;&nbsp;&nbsp;".$cldp->name."</td></tr>";
          $x++;
          }
          ?>
          <tr id="miscellaneous_title" style="display: none;">
            <td class="border-less"><b>MISCELLANEOUS :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_miscellaneous[]' class="miscellaneous_valid"></td>
          </tr>
          <?php
          $cm=1;
          $x=1;
          foreach($critical_level_miscellaneous as $clm)
          {
            if ($cm=="9")
            {
                $cm="checked";
            }
            echo "<tr id='miscellaneous_data$x' style='display:none;'><td class='border-less' colspan='3'><input type='checkbox' class='$x' name='critical_level_miscellaneous[]' value='".$clm->id."'>&nbsp;&nbsp;&nbsp;".$clm->code."&nbsp;&nbsp;&nbsp;".$clm->name."</td></tr>";
          $cm++;
          $x++;
          }
          ?>
          <tr id="neurological_title" style="display: none;">
            <td class="border-less"><b>NEUROLOGICAL :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_neurological[]' class="neurological_valid"></td>
          </tr>
          <?php
          $n=1;
          foreach($critical_level_neurogical as $cln)
          {
            echo "<tr id='neurological_data$n' style='display:none;'><td class='border-less' colspan='3'><input type='checkbox' name='critical_level_neurological[]' value='".$cln->id."'>&nbsp;&nbsp;&nbsp;".$cln->code."&nbsp;&nbsp;&nbsp;".$cln->name."</td></tr>";
          $n++;
          }
          ?>
          <tr id="respiratory_title" style="display: none;">
            <td class="border-less"><b>RESPIRATORY :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_respiratory[]' class="respiratory_valid"></td>
          </tr>
          <?php
          $res=1;
          foreach($critical_level_respiratory as $clr)
          {
            echo "<tr id='respiratory_data$res' style='display:none;'><td class='border-less' colspan='3'><input type='checkbox' name='critical_level_respiratory[]' value='".$clr->id."'>&nbsp;&nbsp;&nbsp;".$clr->code."&nbsp;&nbsp;&nbsp;".$clr->name."</td></tr>";
          $res++;
          }
          ?>
          <tr id="regional_anesthesia_title" style="display: none;">
            <td class="border-less"><b>REGIONAL ANESTHESIA :</b></td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_regional_anesthesia[]' class="regional_anesthesia_valid"></td>
          </tr>
          <?php
          $r=1;
          foreach($critical_level_regional_anesthesia as $clra)
          {
            echo "<tr id='regional_anesthesia_data$r' style='display: none;'><td class='border-less' colspan='3'><input type='checkbox' name='critical_level_regional_anesthesia[]' value='".$clra->id."'>&nbsp;&nbsp;&nbsp;".$clra->code."&nbsp;&nbsp;&nbsp;".$clra->name."</td></tr>";
          $r++;
          }
          ?>
          <tr id="preop_title" style="display: none;">
            <td class="border-less"><b>PREOP :</b></td>
          </tr>
          <?php
          $x=1;
          foreach($critical_level_preop as $clp)
          {
            echo "<tr id='preop_data$x' style='display:none;'><td class='border-less' colspan='3'><input type='checkbox' name='critical_level_preop[]' value='".$clp->id."' class='preop_valid'>&nbsp;&nbsp;&nbsp;".$clp->code."&nbsp;&nbsp;&nbsp;".$clp->name."</td></tr>";
         $x++;
          }
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
</script>