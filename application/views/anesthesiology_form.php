<?php foreach($institution_details as $name): endforeach; ?>
<head>
<script>
$(document).ready(function(){
    var count1 = 1;
    var count2 = 1;
    var count3 = 1;
$('.add_sub').click(function(e){
    e.preventDefault();
     if (confirm('Do you want to Add Another Apgar Details?'))
 {
    $('.extra_subject').append('<tr class="sub_add_extra1">'
                         +'<td class="border-less question">APGAR SCORE</td>'
 +'<td class="border-less answer" colspan=2><select name="agpar_score_1m['+(count1++)+']" class="agpar_score_required" style="width: 160px;">'
 +'<option value="">Select Apgar Score</option>'
 +'<option value="01">01</option>'
 +'<option value="02">02</option>'
 +'<option value="03">03</option>'
 +'<option value="04">04</option>'
 +'<option value="05">05</option>'
 +'<option value="06">06</option>'
 +'<option value="07">07</option>'
 +'<option value="08">08</option>'
 +'<option value="09">09</option>'
 +'<option value="10">10</option>'
 +'</select> at 1min.</td></tr>'
 +'<tr class="sub_add_extra2">'
 +'<td class="border-less question"></td>'
 +'<td class="border-less answer" colspan=2><select name="agpar_score_5m['+(count2++)+']" class="agpar_score_required" style="width: 160px;">'
 +'<option value="">Select Apgar Score<option>'
 +'<option value="01">01</option>'
 +'<option value="02">02</option>'
 +'<option value="03">03</option>'
 +'<option value="04">04</option>'
 +'<option value="05">05</option>'
 +'<option value="06">06</option>'
 +'<option value="07">07</option>'
 +'<option value="08">08</option>'
 +'<option value="09">09</option>'
 +'<option value="10">10</option>'
 +'</select> at 5mins.</td>'
 +'<tr class="sub_add_extra3">'
 +'<td class="border-less question"></td>'
 +'<td class="border-less answer" colspan=2><select name="agpar_score_10m['+(count3++)+']" class="agpar_score_required" style="width: 160px;">'
 +'<option value="">Select Apgar Score</option>'
 +'<option value="01">01</option>'
 +'<option value="02">02</option>'
 +'<option value="03">03</option>'
 +'<option value="04">04</option>'
 +'<option value="05">05</option>'
 +'<option value="06">06</option>'
 +'<option value="07">07</option>'
 +'<option value="08">08</option>'
 +'<option value="09">09</option>'
 +'<option value="10">10</option>'
 +'</select> at 10mins.</td></tr><tr>td><br></td></tr>');
 }
});
$('.rem_sub').click(function(e){
    e.preventDefault();
       if (confirm('Do you want to Remove this Apgar Details?'))
 {
    $('.sub_add_extra1').last().remove();
    $('.sub_add_extra2').last().remove();
    $('.sub_add_extra3').last().remove();
 }
});
});
</script>
</head>
 <?php
 foreach ($patient_information_data as $row): endforeach;
//Male or Female
if ($row->gender == "M"){ $row->gender = "Male"; } else { $row->gender = "Female"; }
//Age Calculation 
$date1 = new DateTime($row->birthdate);
$date2 = new DateTime(date('Y-m-d'));
$diff = $date1->diff($date2);
 ?>
<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/home/add_anesthesiology_information">
 <input type="hidden" name="patient_information_id" value="<?php echo $row->id; ?>">
   <style>
        td
        {
            border: hidden;
        } 
    </style>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd; border-top:hidden; font-size: 12px;">
    <tr>
                    <td class="border-less header" align="center" colspan="4">PATIENT INFORMATION</td>
          </tr>
          <tr>
                    <td class="border-less question" width=20%>RESIDENT NAME</td>
                    <td class="border-less answer" colspan="4"><?php echo ucwords($user_information['lastname']).", ".ucwords($user_information['firstname'])." ".ucwords($user_information['middle_initials'])."."; ?></td>
          </tr>
          <tr>
                    <td class="border-less question">TRAINING INSTITUTION</td>
                    <td class="border-less answer" colspan="4"><?php echo $name->name; ?></td>
          </tr>
          <tr>
                    <td class="border-less answer"></td>
                    <td class="border-less answer" width="40%"></td>
                    <td class="border-less question" width=10%>WEIGHT</td>
                    <td class="border-less answer"><?php echo $row->weight; ?> KG</td>
          </tr> 
          <tr>
                    <td class="border-less question">CASE NUMBER</td>
                    <td class="border-less answer"><?php echo $row->case_number; ?></td>
                    <td class="border-less question">AGE</td>
                    <td class="border-less answer"><?php echo $diff->y ."Y-". $diff->m."M-".$diff->d."D"; ?></td>
          
          </tr>
           <tr>
                    <td class="border-less question">PATIENT INITIALS</td>
                    <td class="border-less answer"><?php echo ucwords($row->lastname[0])."-".ucwords($row->firstname[0])."-".ucwords($row->middle_initials[0]); ?></td>
                    <td class="border-less question">GENDER</td>
                    <td class="border-less answer"><?php echo $row->gender; ?></td>
          
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
        <tr>
                    <td class="border-less header" align="center" colspan="2">HOSPITAL ROTATION INFORMATION</td>
        </tr>
          <tr>
            <td class="border-less question" width="20%">HOSPITAL</td>
            <td class="border-less answer">
                              <select name="hospital_rotation" style="width:300px;">
                                        <option value="0">NONE</option>
                                        <?php foreach ($hospital_details as $datas): ?>
                                        <option value="<?php echo $datas->id; ?>"><?php echo $datas->name; ?></option>
                                        <?php endforeach; ?>
                              </select>
                    </td>
          </tr>
        <tr>
                    <td class="border-less header" align="center" colspan="2">DIAGNOSIS INFORMATION</td>
        </tr>
          <tr>
                    <td class="border-less question" width="20%">OPERATION DATE</td>
                    <td class="border-less answer"><input id="datepicker-example11" name="operation_date" size="20" class="required" readonly="readonly"></td>
          </tr>
          <tr>
                    <td class="border-less question">TYPE OF PATIENT</td>
                    <td class="border-less answer"><select name="type_of_patient" class="required" style="width: 240px;">
                              <option value="">Select Patient Type</option>
                              <option value="C">Charity</option>
                              <option value="P">Pay</option>
                    </select>
                    </td>
          </tr>
          <tr>
                    <td class="border-less  question">LEVEL OF INVOLVEMENT</td>
                    <td class="border-less answer"><select name="level_of_involvement" class="required" style="width: 240px;">
                              <option value="">Select Level of Involvement</option>
                              <option value="P">Primary Anesthesiology</option>
                              <option value="A">Assist</option>
                    </select>
                    </td>
          </tr>
          <tr>
                    <td class="border-less question">ASA</td>
                    <td class="border-less answer"><select name="asa" class="required" style="width: 100px;">
                              <option value="">Select ASA</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                    </select>
                    </td>
          </tr>
          <tr>
                    <td class="border-less question">EMERGENCY</td>
                    <td class="border-less answer"><input type="radio" name="for_emergency" value="N" class="required"> NO <input type="radio" name="for_emergency" value="Y"> YES</td>
          </tr>
          <tr>
                    <td class="border-less question">DIAGNOSIS</td>
                    <td class="border-less answer"><textarea name="diagnosis" rows="4" cols="40" class="required"></textarea></td>
          </tr>
          <tr>
                    <td class="border-less question">CO-MORBID DISEASES</td>
                    <td class="border-less answer"><textarea name="comorbid_diseases" class="required" cols="40" rows="4"></textarea></td>
          </tr>
          <tr>
                    <td class="border-less question">SERVICE</td>
                    <td class="border-less answer">
                        <select name="service" class="required">
                              <option value="">Select Service</option>
                              <?php
                              foreach($anesth_services_data as $ser)
                              {
                               echo "<option value='".$ser->id."'>".$ser->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
          <tr>
                    <td class="border-less question">ANESTHETIC TECHNIQUE</td>
                    <td class="border-less answer"><select name="anesthetic_technique" class="required" style="width: 360px;" id="anesthetic_technique">
                               <option value="">Select Technique</option>
                              <?php
                              foreach($anesth_technique_data as $and)
                              {
                               echo "<option value='".$and->id."'>".$and->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
          <tr id="peripheral_data" style="display: none;">
                    <td class="border-less question"></td>
                    <td class="border-less answer"><select name="peripheral" class="peripheral_valid" style="width:380px;">
                              <option value="">Select Peripheral Nerve Blocks and Pain Techniques</option>
                              <option value="1">Ultrasound Guided</option>
                              <option value="2">Nerve Stimulator Guided</option>
                              <option value="3">Ultrasound + Nerve Stimulator Guided</option>
                              <option value="4">None</option>
                    </select>
                    </td>
          </tr>
          <tr>
                    <td class="border-less question">AIRWAY</td>
                    <td class="border-less answer"><select name="airway" class="required" id="airway">
                    <option value="">Select Airway</option>
                    <?php
                              foreach($anesth_airway_data as $air)
                              {
                               echo "<option value='".$air->name."'>".$air->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
          <tr id="other_airway" style="display:none;">
            <td class="border-less question"></td>
            <td class="border-less answer"><input type="text" size="20" name="other_airway" class="airway_valid"></td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
        <td class="border-less header" align="center" colspan="4">ANESTHESIA FORM</td>
    </tr>
          <tr>
                    <td class="border-less question" width="20%">ANESTHESIA START</td>
                      <td class="border-less answer">
                        <input name="anesthesia_start" id="datepicker-example14" class="required" size="20">
                      <select name="anesthesia_start_hour" class="required" style="width:80px;">
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
					if ($this->input->post('hour') == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select> :
			<select name="anesthesia_start_min" class="required" style="width: 70px;">
			<option value="">MIN</option>
			<option value="00">00</option>
				<?php
				for ($i = 01; $i <= 59; $i++)
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
					if ($this->input->post('min') == $i)
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
                    <td class="border-less question">ANESTHESIA END</td>
                      <td class="border-less answer"><input name="anesthesia_end" id="datepicker-example13" class="required" size="20">
                      <select name="anesthesia_end_hour" class="required" style="width:80px;">
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
					if ($this->input->post('hour') == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select> :
			<select name="anesthesia_end_min" class="required" style="width: 70px;">
			<option value="">MIN</option>
			<option value="00">00</option>
				<?php
				for ($i = 01; $i <= 59; $i++)
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
					if ($this->input->post('min') == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
                      </td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
        <td class="border-less header" align="center" colspan="6">NEEDLE FORM</td>
    </tr>
          <tr>
                    <td class="border-less question" width=7% rowspan="3">NEEDLE</td>
                    <td class="border-less question" width=18%>SPINAL NEEDLE TYPE</td>
                    <td class="border-less answer" width=10%><select name="spinal_needle" class="required" id="needle" style="width: 200px;">
                              <option value="">Select Spinal Needle Type</option>
                              <?php
                              foreach($anesth_needle_data as $aneed)
                              {
                               echo "<option value='".$aneed->name."'>".$aneed->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
                    <td class="border-less question" rowspan=3>NEEDLE GAUGE</td>
                     <td class="border-less question">SPINAL NEEDLE GAUGE</td>
                     <td class="border-less answer"><select name="spinal_needle_gauge" class="required" id="spinal_needle_gauge" style="width: 200px;">
                              <option value="">Select Spinal Needle Gauge</option>
                              <?php
                              foreach($anesth_needle_gauge_data as $aneegd)
                              {
                               echo "<option value='".$aneegd->id."'>".$aneegd->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
          <tr id="other_needle" style="display:none;">
            <td class="border-less question"></td>
            <td class="border-less answer"><input type="text" size="20" name="other_spinal_needle" class="needle_valid"></td>
          </tr>
          <tr>
                    <td class="border-less question">EPIDURAL NEEDLE TYPE</td>
                    <td class="border-less answer"><select name="epidural_needle" class="required" id="epidural_needle" style="width:220px;">
                              <option value="">Select Epidural Needle Type</option>
                              <option value="Touhy">Touhy</option>
                              <option value="Others">Others (pls specify):</option>
                              <option value="None">None</option>
                    </select>
                    </td>
                    <td class="border-less question">EPIDURAL NEEDLE GAUGE</td>
                     <td class="border-less answer"><select name="epidural_needle_gauge" class="required" id="epidural_needle_gauge" style="width:220px;">
                              <option value="">Select Epidural Needle Gauge</option>
                              <?php
                              foreach($anesth_needle_gauge_data as $aneegd)
                              {
                               echo "<option value='".$aneegd->id."'>".$aneegd->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
          <tr id="other_epidural_needle" style="display:none;">
            <td class="border-less question"></td><td class="border-less question"></td>
            <td class="border-less answer"><input type="text" size="20" name="other_epidural_needle" class="other_epidural_needle_valid"></td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
        <td class="border-less question" colspan="4">MAIN AGENTS</td>
    </tr>
          <tr>
            <td class="border-less answer" colspan=4><input type="checkbox" style="display: none;" name='main_agent[]' class='main_agent_required'></td>
          <?php
          $num_cols = 3;
          $current_col = 0;
          $x = 0;
          foreach($anesth_agent_data as $aad):
          if($current_col == "0")echo "<tr class=answer></td>";
          echo "<td><input type='checkbox' value='".$aad->id."' name='main_agent[]'>".$aad->name."</td>";
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
          <tr class="answer">
            <td class="answer"><input type="checkbox" name="other_main_agent" id="81" value="other_main_agent_checkbox">Others Please Specify : </td>
            <td class="border-less answer" colspan="2"  id="other_main_agent" style="display:none;"><input type="text" size="20" name="other_main_agent_data" class="other_main_agent_valid"></td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
          <tr>
            <td class="border-less question" colspan="4">SUPPLEMENTARY AGENT</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan="4"><input type="checkbox" style="display: none;" name='supplementary_agent[]' class='supplementary_agent_required'></td>
          </tr>
          <?php
          $num_cols = 3;
          $current_col = 0;
          $x = 0;
          $sa = "sa_";
          foreach($anesth_agent_data as $aad):
          if($current_col == "0")echo "<tr class=answer><td></td>";
          echo "<td><input type='checkbox' value='".$aad->id."' name='supplementary_agent[]'>".$aad->name."</td>";
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
          <tr class=answer>
            <td class="border-less"></td><td><input type="checkbox" name="other_supplementary_agent" id="sa_81" value="other_supplementary_agent_checkbox">Others Please Specify : </td>
            <td class="border-less" id="other_supplementary_agent" style="display:none;" colspan=2><input type="text" size="20" name="other_supplementary_agent_data" class="other_supplementary_agent_valid"></td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
        <td class="border-less question" colspan="4">POST-OP PAIN AGENTS</td>
    </tr>
            <tr>
            <td class="border-less answer" colspan="4"><input type="checkbox" style="display: none;" name='post_op_pain_agent[]' class='post_op_pain_agent_required'></td>
          </tr>
          <?php
          $num_cols = 3;
          $current_col = 0;
          $x = 0;
          $sa = "post_";
          foreach($anesth_agent_data as $aad):
          if($current_col == "0")echo "<tr class=answer><td></td>";
          echo "<td><input type='checkbox' value='".$aad->id."' name='post_op_pain_agent[]'>".$aad->name."</td>";
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
          <tr class=answer>
            <td></td><td><input type="checkbox" name="other_post_op_pain_agent" id="post_81" value="other_post_op_pain_agent_checkbox">Others Please Specify : </td>
            <td class="border-less" colspan=2 id="other_post_op_pain_agent" style="display:none;"><input type="text" size="20" name="other_post_op_pain_agent_data" class="other_post_op_pain_agent_valid"></td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
        <td class="border-less question" colspan=3>POST-OP PAIN MANAGEMENT</td>
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
     echo "<tr class=answer>";
          echo "<td width=25%><input type='checkbox' value='".$combinedArray[0]."' name='post_op_pain_management[]' class='required'>".$combinedArray[1]."</td>";
           echo "<td><input type='checkbox' value='".$combinedArray[0]."' name='post_op_pain_management_1[]' class='required'>".$combinedArray[2]."</td>";
          echo "</tr>";
             }
           ?>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
            <td class="border-less question" colspan="2">MONITORS USED</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan=2><input type="checkbox" style="display: none;" name='monitors_used[]' class="monitors_used_required"></td>
          </tr>
          <?php
          foreach($anesth_monitor_data as $amd)
          {
            echo "<tr class=answer><td class='border-less' colspan=2><input type='checkbox' name='monitors_used[]' value='".$amd->id."'>".$amd->name."</td></tr>";
          }
          ?>
          <tr>
            <td class="border-less answer" width=20%><input type="checkbox" name="other_monitors_used" id="monitors_used" value="other_monitors_used_checkbox">Others Please Specify : </td>
            <td class="border-less answer" id="other_monitors_used" style="display:none;"><input type="text" size="20" name="other_monitors_used_data" class="other_monitors_used_valid"></td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
        <td class="border-less header" align="center" colspan="2">PROCEDURE FORM</td>
    </tr>
          <tr>
                    <td class="border-less question" width=20%>PROCEDURE DONE</td>
                    <td class="border-less answer"><textarea name="procedure_done" cols="40" class="required"></textarea></td>
          </tr>
          <tr>
                    <td class="border-less question">OTHER PROCEDURE</td>
                    <td class="border-less answer"><textarea name="other_procedure" cols="40" class="required"></textarea></td>
          </tr>
          <tr>
                    <td class="border-less question">MUSCLE RELAXANT REVERSAL DONE</td>
                    <td class="border-less answer"><input type="radio" name="muscle_relaxant_reversal_done" value="YES" class="required"> YES <input type="radio" name="muscle_relaxant_reversal_done" value="NO"> NO <input type="radio" name="muscle_relaxant_reversal_done" value="N/A" class="required"> N/A</td>
          </tr>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
                    <td class="border-less header" align="center" colspan="4">REPLACEMENT</td>
          </tr>
          <tr>
                    <td class="border-less question" width="20%">BLOOD LOSS</td>
                    <td class="border-less answer" colspan="2"><select name="blood_loss" class="required" style="width: 150px;">
                              <option value="">Select Blood loss</option>
                               <?php
                              foreach($anesth_blood_loss as $abl)
                              {
                               echo "<option value='".$abl->id."'>".$abl->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
          <tr>
                    <td class="border-less question">CRYSTALLOOID</td>
                    <td class="border-less answer" colspan="2">
                        <input type="radio" name="crystalloids" value="YES" class="required"> YES
                        <input type="radio" name="crystalloids" value="NO"> NO
                        <input type="radio" name="crystalloids" value="N/A"> N/A</td>
          </tr>
         
          <tr>
                    <td class="border-less question">COLLOIDS</td>
                    <td class="border-less answer" colspan="2">
                        <input type="radio" name="colloids" value="YES" class="required" id="colloids_used_show"> YES
                        <input type="radio" name="colloids" value="NO" id="colloids_used_hide"> NO</td>
          </tr>
          <tr id="colloids_used_info" style="display: none;">
                    <td class="border-less question" width="20%">COLLOIDS USED</td>
                    <td class="border-less answer" colspan="2"><select name="colloids_used" id="colloids_used" class="colloids_used_info_valid">
                              <option value="">Select Colloids Used</option>
                               <?php
                              foreach($anesth_colloids_used as $acu)
                              {
                               echo "<option value='".$acu->name."'>".$acu->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
          <tr id="other_colloids_used" style="display:none;">
            <td class="border-less question"></td>
            <td class="border-less answer" colspan=2><input type="text" size="20" name="other_colloids_used" class="colloids_used_valid"></td>
          </tr>
          <tr>
                    <td class="border-less question">BLOOD PRODUCT USED</td>
                    <td class="border-less answer" colspan="2"><input type="radio" name="blood_products_used" value="YES" class="required"> YES <input type="radio" name="blood_products_used" value="NO" class="required"> NO <input type="radio" name="blood_products_used" value="N/A" class="required"> N/A</td>
          </tr>
          <tr>
                    <td class="border-less"></td><td class="border-less question" width="20%">FRESH WHOLE BLOOD</td><td class="border-less answer"><input type="radio" name="fresh_whole_blood" value="YES" class="required"> YES <input type="radio" name="fresh_whole_blood" value="NO"> NO</td>
          </tr>
          <tr>
                    <td class="border-less"></td><td class="border-less question">CYROPRECIPITATE</td><td class="border-less answer"><input type="radio" name="cyroprecipitate" value="YES" class="required"> YES <input type="radio" name="cyroprecipitate" value="NO"> NO</td>
          </tr>
          <tr>
                    <td class="border-less"></td><td class="border-less question">PLATELETS</td><td class="border-less answer"><input type="radio" name="platelets" value="YES" class="required"> YES <input type="radio" name="platelets" value="NO"> NO</td>
          </tr>
          <tr>
                    <td class="border-less"></td><td class="border-less question">FRESH FROZEN PLASMA</td><td class="border-less answer"><input type="radio" name="fresh_frozen_plasma" value="YES" class="required"> YES <input type="radio" name="fresh_frozen_plasma" value="NO"> NO</td>
          </tr>
          <tr>
                    <td class="border-less"></td><td class="border-less question">PACKED RBC</td><td class="border-less answer"><input type="radio" name="packed_rbc" value="YES" class="required"> YES <input type="radio" name="packed_rbc" value="NO"> NO</td>
          </tr>
          <tr>
                    <td class="border-less"></td><td class="border-less question">OTHERS</td><td class="border-less answer " colspan="2"><textarea name="others" cols="35" class="required"></textarea></td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
                    <td class="border-less header" align="center" colspan="4">FOR DELIVERY</td>
          </tr>
          <tr>
                    <td class="border-less question" width="20%">DELIVERY</td>
                    <td class="border-less answer" colspan="2"><input type="radio" name="if_delivery" id="show" value="YES" class="required" /> YES <input type="radio" name="if_delivery" id="hide" value="NO" /> NO</td>
          </tr>
          <tr id="agpar_score_1m" style="display:none">
            <td class="border-less question">APGAR SCORE</td>
            <td class="border-less answer" colspan="2"><select name="agpar_score_1m[]" class="agpar_score_valid" style="width: 160px;">
                              <option value="">Select Apgar Score</option>
                               <?php
                              foreach($anesth_agpar_score_data as $aasd)
                              {
                               echo "<option value='".$aasd->name."'>".$aasd->name."</option>";
                              }
                              ?>
                    </select> at 1min.</td>
          </tr>
          <tr id="agpar_score_5m" style="display:none">
            <td class="border-less question"></td>
            <td class="border-less answer" colspan="2"><select name="agpar_score_5m[]" class="agpar_score_valid" style="width: 160px;">
                              <option value="">Select Apgar Score</option>
                               <?php
                              foreach($anesth_agpar_score_data as $aasd)
                              {
                               echo "<option value='".$aasd->name."'>".$aasd->name."</option>";
                              }
                              ?>
                    </select> at 5mins.</td>
          </tr>
          <tr id="agpar_score_10m" style="display:none">
            <td class="border-less question"></td>
            <td class="border-less answer" colspan="2"><select name="agpar_score_10m[]" class="agpar_score_valid" style="width: 160px;">
                              <option value="">Select Apgar Score</option>
                               <?php
                              foreach($anesth_agpar_score_data as $aasd)
                              {
                               echo "<option value='".$aasd->name."'>".$aasd->name."</option>";
                              }
                              ?>
                    </select> at 10mins.</td>
          </tr>
              <tbody class="extra_subject"></tbody>

            <tr id="add_apgar" style="display:none;">
                <td class="border-less question"></td><td class="border-less">
                <input type="button" class="add_sub btn" value="Add Apgar"> | <input type="button" class="rem_sub btn" value="Remove"></td>
            </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
    <tr>
                    <td class="border-less header" align="center" colspan="2">OTHER INFORMATION</td>
          </tr>
          <tr>
                    <td class="border-less question" width=20%>POST-OPERATIVE DIAGNOSIS</td>
                    <td class="border-less answer"><textarea name="post_operative_diagnosis" cols="40" class="required"></textarea></td>
          </tr>
          <tr>
                    <td class="border-less question">DISCHARGE NOTES</td>
                    <td class="border-less answer"><textarea name="discharged_notes" cols="40" class="required"></textarea></td>
          </tr>
          <tr>
                    <td class="border-less question">OTHER NOTES</td>
                    <td class="border-less answer"><textarea name="other_notes" cols="40" class="required"></textarea></td>
          </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px #ddd;border-top:hidden; font-size: 12px;">
        <tr>
                    <td class="border-less header" align="center" colspan="2">CRITICAL EVENTS</td>
          </tr>
    <tr id="critical_events_no">
                    <td class="border-less question" width=20%>CRITICAL EVENTS</td>
                    <td class="border-less answer" colspan="2"> <input type="radio" name="critical_events" id="critical_events_show" value="YES" class="critical_event_required"> YES <input type="radio" name="critical_events" id="critical_events_hide" value="NO"> NO REPORTABLE REPORTS WITHIN 48 HOURS
          </tr>
          <tr id="critical_events_yes" style="display: none;">
                    <td class="border-less question">CRITICAL EVENTS</td>
                    <td class="border-less answer"><b>YES</b></td>
          </tr>
          <tr id='critical_level_airway_title' style="display: none;">
            <td class="border-less question" colspan=2>AIRWAY</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_airway[]' class="critical_level_airway_valid"></td>
          </tr>
          <?php
          $x=0;
          foreach($critical_level_airway as $cla)
          {
            echo "<tr id='critical_level_airway_data$x' style='display:none;'><td class='border-less answer' colspan='3'><input type='checkbox' name='critical_level_airway[]' value='".$cla->id."'>&nbsp;&nbsp;&nbsp;".$cla->code."&nbsp;&nbsp;&nbsp;".$cla->name."</td></tr>";
          $x++;
          }
          ?>
          <tr id="cardiovascular_title" style="display: none;">
            <td class="border-less question" colspan=2>CARDIOVASCULAR</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_cardiovascular[]' class="cardiovascular_valid"></td>
          </tr>
          <?php
          $x=0;
          foreach($critical_level_cardiovascular as $clc)
          {
            echo "<tr id='cardiovascular_data$x' style='display:none;'><td class='border-less answer' colspan='3'><input type='checkbox' name='critical_level_cardiovascular[]' value='".$clc->id."'>&nbsp;&nbsp;&nbsp;".$clc->code."&nbsp;&nbsp;&nbsp;".$clc->name."</td></tr>";
          $x++;
          }
          ?>
          <tr id="discharge_planning_title" style="display: none;">
            <td class="border-less question" colspan=2>DISCHARGE PLANNING</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_discharge_planning[]' class="discharge_planning_valid"></td>
          </tr>
          <?php
          $x=0;
          foreach($critical_level_discharge_planning as $cldp)
          {
            echo "<tr id='discharge_planning_data$x' style='display:none;'><td class='border-less answer' colspan='3'><input type='checkbox' name='critical_level_discharge_planning[]' value='".$cldp->id."'>&nbsp;&nbsp;&nbsp;".$cldp->code."&nbsp;&nbsp;&nbsp;".$cldp->name."</td></tr>";
          $x++;
          }
          ?>
          <tr id="miscellaneous_title" style="display: none;">
            <td class="border-less question" colspan=2>MISCELLANEOUS</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_miscellaneous[]' class="miscellaneous_valid"></td>
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
            echo "<tr id='miscellaneous_data$x' style='display:none;'><td class='border-less answer' colspan='3'><input type='checkbox' class='$x' name='critical_level_miscellaneous[]' value='".$clm->id."'>&nbsp;&nbsp;&nbsp;".$clm->code."&nbsp;&nbsp;&nbsp;".$clm->name."</td></tr>";
          $cm++;
          $x++;
          }
          ?>
          <tr id="neurological_title" style="display: none;">
            <td class="border-less question" colspan=2>NEUROLOGICAL</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_neurological[]' class="neurological_valid"></td>
          </tr>
          <?php
          $n=0;
          foreach($critical_level_neurogical as $cln)
          {
            echo "<tr id='neurological_data$n' style='display:none;'><td class='border-less answer' colspan='3'><input type='checkbox' name='critical_level_neurological[]' value='".$cln->id."'>&nbsp;&nbsp;&nbsp;".$cln->code."&nbsp;&nbsp;&nbsp;".$cln->name."</td></tr>";
          $n++;
          }
          ?>
          <tr id="respiratory_title" style="display: none;">
            <td class="border-less question" colspan=2>RESPIRATORY</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_respiratory[]' class="respiratory_valid"></td>
          </tr>
          <?php
          $res=1;
          foreach($critical_level_respiratory as $clr)
          {
            echo "<tr id='respiratory_data$res' style='display:none;'><td class='border-less answer' colspan='3'><input type='checkbox' name='critical_level_respiratory[]' value='".$clr->id."'>&nbsp;&nbsp;&nbsp;".$clr->code."&nbsp;&nbsp;&nbsp;".$clr->name."</td></tr>";
          $res++;
          }
          ?>
          <tr id="regional_anesthesia_title" style="display: none;">
            <td class="border-less question" colspan=2>REGIONAL ANESTHESIA</td>
          </tr>
          <tr>
            <td class="border-less answer" colspan="2"><input type="checkbox" style="display: none;" name='critical_level_regional_anesthesia[]' class="regional_anesthesia_valid"></td>
          </tr>
          <?php
          $r=0;
          foreach($critical_level_regional_anesthesia as $clra)
          {
            echo "<tr id='regional_anesthesia_data$r' style='display: none;'><td class='border-less answer' colspan='3'><input type='checkbox' name='critical_level_regional_anesthesia[]' value='".$clra->id."'>&nbsp;&nbsp;&nbsp;".$clra->code."&nbsp;&nbsp;&nbsp;".$clra->name."</td></tr>";
          $r++;
          }
          ?>
          <tr id="preop_title" style="display: none;">
            <td class="border-less question" colspan=2>PREOP</td>
          </tr>
          <?php
          $x=1;
          foreach($critical_level_preop as $clp)
          {
            echo "<tr id='preop_data$x' style='display:none;'><td class='border-less answer' colspan='3'><input type='checkbox' name='critical_level_preop[]' value='".$clp->id."' class='preop_valid'>&nbsp;&nbsp;&nbsp;".$clp->code."&nbsp;&nbsp;&nbsp;".$clp->name."</td></tr>";
         $x++;
          }
          ?>
          <tr>
                    <td class="border-less answer">&nbsp;</td>
                    <td class="border-less answer"><input type="submit" name="login" value="SAVE CASELOG AS OPEN"></td>
          </tr>
          <tr class=answer>
            <td colspan="4" align="center" class="border-less"><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology </td>
          </tr>
</table>
</form>  
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
<script>
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
      $('.monitors_used_valid').attr('class','monitors_used_required');
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
    if(selected == 'Others'){
      $('#other_epidural_needle').show();
      $('.other_epidural_needle_valid').attr('class','other_epidural_needle_required');
    }
    else{
      $('#other_epidural_needle').hide();
      $('.other_epidural_needle_required').attr('class','other_epidural_needle_valid');
    }
});
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
$('#critical_events_show').click(function() {
       var selected = $(this).val();
       if(selected == 'YES')
       {
      //CRITICAL LEVEL AIRWAY
       $('#critical_level_airway_title').show();
      <?php for ($c = 0;$c<=9;$c++){ ?>
      $('#critical_level_airway_data<?php echo $c; ?>').show();
      <?php } ?>
      $('.critical_level_airway_valid').attr('class','critical_level_airway_required');
      //CRITICAL LEVEL CARDIOVASCULAR
       $('#cardiovascular_title').show();
      <?php for($car = 0;$car<=9;$car++){ ?>
      $('#cardiovascular_data<?php echo $car; ?>').show();
      <?php } ?>
      $('.cardiovascular_valid').attr('class','cardiovascular_required');
      //CRITICAL LEVEL DISCHARGE PLANNING
       $('#discharge_planning_title').show();
      <?php for($dis = 0;$dis<=7;$dis++){ ?>
      $('#discharge_planning_data<?php echo $dis; ?>').show();
      <?php } ?>
      $('.discharge_planning_valid').attr('class','discharge_planning_required');
       //CRITICAL LEVEL MISCELLANEOUS
      $('#miscellaneous_title').show();
      <?php for($misc = 1;$misc<=13;$misc++){ ?>
      $('#miscellaneous_data<?php echo $misc; ?>').show();
      <?php } ?>    
      $('.miscellaneous_valid').attr('class','miscellaneous_required');
      //CRITICAL LEVEL NEUROLOGICAL
      $('#neurological_title').show();
      <?php for($neuro = 0;$neuro<=5;$neuro++){ ?>
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
      <?php for($regional_anesthesia = 0;$regional_anesthesia<=12;$regional_anesthesia++){ ?>
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
});
    $('#critical_events_hide').click(function() {
       var selected = $(this).val();
       if(selected == 'NO') 
       {
      //CRITICAL LEVEL AIRWAY
       $('#critical_level_airway_title').hide();
      <?php for($c = 0;$c<=10;$c++){ ?>
      $('#critical_level_airway_data<?php echo $c; ?>').hide();
      <?php } ?>
      $('.critical_level_airway_required').attr('class','critical_level_airway_valid');
      //CRITICAL LEVEL CARDIOVASCULAR
       $('#cardiovascular_title').hide();
      <?php for($car = 0;$car<=9;$car++){ ?>
      $('#cardiovascular_data<?php echo $car; ?>').hide();
      <?php } ?>
      $('.cardiovascular_required').attr('class','cardiovascular_valid');
      //CRITICAL LEVEL DISCHARGE PLANNING
       $('#discharge_planning_title').hide();
      <?php for($dis = 0;$dis<=7;$dis++){ ?>
      $('#discharge_planning_data<?php echo $dis; ?>').hide();
      <?php } ?>
      $('.discharge_planning_required').attr('class','discharge_planning_valid');
      //CRITICAL LEVEL MISCELLANEOUS
      $('#miscellaneous_title').hide();
      <?php for($misc = 1;$misc<=12;$misc++){ ?>
      $('#miscellaneous_data<?php echo $misc; ?>').hide();
      <?php } ?>
      $('.miscellaneous_required').attr('class','miscellaneous_valid');
      //CRITICAL LEVEL NEUROLOGICAL
      $('#neurological_title').hide();
      <?php for($neuro = 0;$neuro<=5;$neuro++){ ?>
      $('#neurological_data<?php echo $neuro; ?>').hide();
      <?php } ?>
      $('.neurological_required').attr('class','neurological_valid');
      //CRITICAL LEVEL RESPIRATORY
      $('#respiratory_title').hide();
      <?php for($respiratory = 0;$respiratory<=12;$respiratory++){ ?>
      $('#respiratory_data<?php echo $respiratory; ?>').hide();
      <?php } ?>
      $('.respiratory_required').attr('class','respiratory_valid');
      //CRITICAL LEVEL REGIONAL ANESTHESIA
      $('#regional_anesthesia_title').hide();
      <?php for($regional_anesthesia = 0;$regional_anesthesia<=12;$regional_anesthesia++){ ?>
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
});

$('#colloids_used_show').click(function() {
       var selected = $(this).val();
       if(selected == 'YES')
       {
        $('#colloids_used_info').show();
        $('.colloids_used_info_valid').attr('class','colloids_used_info_required');
       }
});
    $('#colloids_used_hide').click(function() {
       var selected = $(this).val();
       if(selected == 'NO')
       {
        $('#colloids_used_info').hide();
        $('.colloids_used_info_required').attr('class','colloids_used_info_valid');
       }
});
$('#anesthetic_technique').change(function() {
    var selected = $(this).val();
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
</html>