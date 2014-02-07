<?php
foreach ($patient_information as $data): endforeach;
foreach($institution_details as $name): endforeach;
$date1 = new DateTime($data->birthdate);
$date2 = new DateTime(date('Y-m-d'));
$diff = $date1->diff($date2);
$age = $diff->y . "Y".$diff->m."M".$diff->d."D";
//HOurs Computation
$day1 = strtotime($data->anesthesia_start." ".$data->anesthesia_start_time);
$day2 = strtotime($data->anesthesia_end." ".$data->anesthesia_end_time);
$diffHours = round(($day2 - $day1) / 3600);
if ($data->gender == "M") { $data->gender = "Male"; } else { $data->gender = "Female"; }
if ($data->level_of_involvement == "P") { $data->level_of_involvement = "Primary"; } else { $data->level_of_involvement = "Assist"; }
if ($data->type_of_patient == "C") { $data->type_of_patient = "Charity"; } else { $data->type_of_patient = "Pay"; }
if ($data->for_emergency == "N") { $data->for_emergency = " "; } else { $data->for_emergency = "Emergency"; }
?>
<div align="center">
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;">
    <tr>
        <td width="15%" class="border-less" bgcolor="SkyBlue">RESIDENT NAME</td>
        <td width="20%" colspan="7" class="border-less" bgcolor="FAFAD2"><?php echo ucwords(strtolower($data->lastname)).", ".ucwords($data->firstname)." ".ucwords($data->middle_initials)."."; ?></td>
    </tr>
    <tr>
        <td colspan="4" class="border-less" bgcolor="FAFAD2"></td>
        <td class="border-less" bgcolor="SkyBlue">OPERATION DATE</td>
        <td colspan="3" class="border-less" bgcolor="FAFAD2"> <?php echo $data->operation_date; ?></td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">TRAINING INSTITUTION</td>
        <td colspan="3" bgcolor="FAFAD2" class="border-less"><?php echo $name->name; ?></td>
        <td bgcolor="SkyBlue" class="border-less">LEVEL OF INVOLVEMENT</td>
        <td bgcolor="FAFAD2" colspan="3" class="border-less"><?php echo $data->level_of_involvement; ?></td>
    </tr>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">HOSPITAL ROTATION</td>
        <td bgcolor="FAFAD2" colspan="3" class="border-less"></td>
    
        <td bgcolor="SkyBlue" class="border-less">WEIGHT</td>
        <td colspan="3" bgcolor="FAFAD2" class="border-less"><?php echo $data->weight; ?> KG</td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">CASE NUMBER</td>
        <td bgcolor="FAFAD2" class="border-less"><?php echo $data->case_number; ?></td>
        <td width="5%" class="border-less" bgcolor="SkyBlue">AGE</td>
        <td width="10%" bgcolor="FAFAD2" class="border-less"><?php echo $age; ?></td>
        <td width="20%" class="border-less" bgcolor="SkyBlue">GENDER</td>
        <td bgcolor="FAFAD2" class="border-less"><?php echo $data->gender; ?></td>
        <td width="15%" class="border-less" bgcolor="SkyBlue">TYPE OF PATIENT</td>
        <td bgcolor="FAFAD2" class="border-less"><?php echo $data->type_of_patient; ?></td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">PATIENT INITIALS</td>
        <td bgcolor="FAFAD2" class="border-less"><?php echo ucwords($data->patient_information_lastname[0])."-".ucwords($data->patient_information_firstname[0])."-".ucwords($data->patient_information_middle_initials[0]); ?></td>
        <td class="border-less" bgcolor="SkyBlue">ASA</td>
        <td class="border-less" bgcolor="FAFAD2"><?php echo $data->asa; ?></td>
        <td class="border-less" bgcolor="FAFAD2" colspan="4"><?php echo $data->for_emergency; ?></td>
    </tr>
     <?php
      if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7)
      {
        if($role_id == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/index/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td width="20%" class="border-less" bgcolor="SkyBlue">DIAGNOSIS</td>
        <td colspan="6" bgcolor="FAFAD2" class="border-less"><?php echo $data->diagnosis; ?></td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">CO - MORBID DISEASES</td>
        <td colspan="6" bgcolor="FAFAD2" class="border-less"><?php echo $data->comorbid_diseases; ?></td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">SERVICE</td>
        <td colspan="6" bgcolor="FAFAD2" class="border-less"><?php echo $data->service_name; ?></td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">ANESTHETIC TECHNIQUE</td>
        <td colspan="6" bgcolor="FAFAD2" class="border-less"><?php echo $data->technique_name; ?></td>
    </tr>
    <?php
    if ($data->anesthetic_technique == "9")
    {
    echo "<tr>
        <td align=center class=border-less bgcolor=SkyBlue>PERIPHERAL NERVE BLOCKS AND PAIN TECHNIQUE</td>
        <td colspan=6 bgcolor=FAFAD2 class=border-less>".$data->apnbapt."</td></tr>";
    }
    ?>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">AIRWAY</td>
        <td colspan="6" bgcolor="FAFAD2" class="border-less"><?php echo $data->airway; ?></td>
    </tr>
    <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7)
      {
        if($role_id == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_diagnosis_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
 <tr>
    <td rowspan="2" class="border-less" bgcolor="SkyBlue" width="20%">NEEDLE</td>
    <td class="border-less" bgcolor="SkyBlue" width="20%">SPINAL NEEDLE TYPE</td>
    <td bgcolor="FAFAD2" class="border-less"><?php echo $data->spinal_needle; ?></td>
  </tr>
  <tr>
    <td class="border-less" bgcolor="SkyBlue">EPIDURAL NEEDLE TYPE</td>
    <td bgcolor="FAFAD2" class="border-less"><?php echo $data->epidural_needle; ?></td>
  </tr>
   <tr>
    <td rowspan="2" class="border-less" bgcolor="SkyBlue" width="20%">NEEDLE GAUGE</td>
    <td class="border-less" bgcolor="SkyBlue" width="20%">SPINAL NEEDLE GAUGE</td>
    <td bgcolor="FAFAD2" class="border-less"><?php echo $data->p1; ?></td>
  </tr>
  <tr>
    <td class="border-less" bgcolor="SkyBlue">EPIDURAL NEEDLE GAUGE</td>
    <td bgcolor="FAFAD2" class="border-less"><?php echo $data->p2; ?></td>
  </tr>
  <tr>
        <td class="border-less" bgcolor="SkyBlue">ANESTHESIA START</td>
        <td bgcolor="FAFAD2" class="border-less" colspan="2"><?php echo $data->anesthesia_start." ".$data->anesthesia_start_time; ?></td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">ANESTHESIA END</td>
        <td bgcolor="FAFAD2" class="border-less" colspan="2"><?php echo $data->anesthesia_end." ".$data->anesthesia_end_time; ?></td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">TOTAL ANESTHESIA HOUR/S</td>
        <td bgcolor="FAFAD2" class="border-less" colspan="2"><?php echo $diffHours.".".round(($day2 - $day1)/60,2); ?></td>
    </tr>
    <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7)
      {
        if($role_id == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_anesthesia_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td class="border-less" bgcolor="SkyBlue" colspan="5">MAIN AGENTS</td>
    </tr>
    <?php
          foreach($main_agent as $m_agent):
            echo "<tr><td bgcolor=FAFAD2 class=border-less width=20%>".$m_agent->name."</td><td bgcolor=FAFAD2 class=border-less></td>";
         endforeach;
           ?>
    <?php if ($data->other_main_agent != "NULL")
    {
    echo "<tr>
        <td class=border-less bgcolor=SkyBlue>OTHERS</td>
        <td bgcolor=FAFAD2 class=border-less>".$data->other_main_agent."</td>
    </tr>";
    }
    ?>
     <?php if($role_id == 1) { ?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_main_agents_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
        <?php
     }
     ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td class="border-less" colspan="2" bgcolor="SkyBlue">SUPPLEMENTARY AGENTS</td>
    </tr>
    <?php
          foreach($supplementary_agent as $s_agent):
          echo "<tr><td bgcolor=FAFAD2 class=border-less width=20%>".$s_agent->name."</td><td bgcolor=FAFAD2 class=border-less width=20%></td></tr>";
            endforeach;
           ?>
    <?php if ($data->other_supplementary_agent != "NULL")
    {
    echo "<tr>
        <td width='20%' bgcolor=FAFAD2 class=border-less>OTHERS</td>
        <td bgcolor=FAFAD2 class=border-less>".$data->other_supplementary_agent."</td>
        
    </tr>";
    }
    ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td class=border-less bgcolor="SkyBlue" width=20%>POST OP PAIN AGENTS</td>
    </tr>
    <?php
          foreach($post_op_pain_agent as $po_agent):
          echo "<tr><td bgcolor=FAFAD2 class=border-less width=20%>".$po_agent->name."</td></tr>";
            endforeach;
           ?>
    <?php if ($data->other_post_op_pain_agent != "NULL")
    {
    echo "<tr>
        <td>Others</td>
        <td>: ".$data->other_post_op_pain_agent."</td>
    </tr>";
    }
    ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td class="border-less" colspan="2" bgcolor="SkyBlue">POST OP PAIN MANAGEMENT</td>
    </tr>
            <?php
          foreach($post_op_pain_management as $apopmd)
          {
          $apopmd_id[]=$apopmd->id;
          $apopmd_name[]=$apopmd->name;
            }
          foreach($post_op_pain_management_1 as $apopmd1)
          {
          $apopmd_name1[]=$apopmd1->name;
          }
          for ($t=0;$t<count($apopmd_id+$apopmd_name1);$t++)
          {
            error_reporting(E_ALL ^ E_NOTICE);
            echo "<tr><td width=20% class=border-less bgcolor=FAFAD2> ".$apopmd_name1[$t]."</td><td class=border-less  bgcolor=FAFAD2>(".$apopmd_id[$t].")".$apopmd_name[$t]."</td></tr>";
          }          
?>
    <table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    
    <tr>
        <td class="border-less" colspan="2" bgcolor="SkyBlue">MONITORS USED</td>
    </tr>
    <?php
          foreach($monitors_used as $m_used):
          echo "<tr><td class=border-less  bgcolor=FAFAD2>".$m_used->name."</td></tr>";
            endforeach;
           ?>
    <?php if ($data->other_monitors_used != "NULL")
    {
    echo "<tr>
        <td>Others</td>
        <td>: ".$data->other_monitors_used."</td>
    </tr>";
    }
    ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
     <tr>
                    <td class="border-less header" align="center" colspan="5">REPLACEMENT</td>
          </tr>
    <tr>
        <td width="20%" bgcolor="SkyBlue">BLOOD LOSS</td>
        <td colspan="4" class=border-less  bgcolor=FAFAD><?php echo $data->blood_loss_name; ?></td>
    </tr>
    <tr>
        <td bgcolor="SkyBlue">CRYSTALLOIDS</td>
        <td class=border-less bgcolor=FAFAD colspan="4"><?php echo $data->crystalloids; ?></td>
    </tr>
    <tr>
        <td bgcolor="SkyBlue">COLLOIDS</td>
        <td bgcolor=FAFAD colspan="4"><?php echo $data->colloids; ?></td>
    </tr>
    <?php
    if ($data->colloids == "YES")
    {
        echo "<tr>
        <td bgcolor=SkyBlue>COLLOIDS USED</td>
        <td bgcolor=FAFAD colspan=4>".$data->colloids_used."</td>";
    }
    ?>
    <tr>
        <td bgcolor=SkyBlue>BLOOD PRODUCT USED</td>
        <td bgcolor=FAFAD colspan="4"><?php echo $data->blood_products_used; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue>FRESH WHOLE BLOOD</td>
        <td bgcolor=FAFAD><?php echo $data->fresh_whole_blood; ?></td>
        <td bgcolor=SkyBlue width=20%>FRESH FROZEN PLASMA</td>
        <td bgcolor=FAFAD><?php echo $data->fresh_frozen_plasma; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue>CYROPRECIPITATE</td>
        <td bgcolor=FAFAD><?php echo $data->cyroprecipitate; ?></td>
        <td bgcolor=SkyBlue>PACKED RBC</td>
        <td bgcolor=FAFAD><?php echo $data->packed_rbc; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue>PLATELETS</td>
        <td bgcolor=FAFAD><?php echo $data->platelets; ?></td>
        <td bgcolor=SkyBlue>OTHERS</td>
        <td bgcolor=FAFAD><?php echo $data->others; ?></td>
    </tr>
</table>

<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
 <tr>
    <td class="border-less header" align="center" colspan="2">PROCEDURE</td>
 </tr>   
    <tr>
        <td width="25%" bgcolor=SkyBlue>PROCEDURE DONE</td>
        <td bgcolor=FAFAD><?php echo $data->procedure_done; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue>OTHER PROCEDURE</td>
        <td bgcolor=FAFAD><?php echo $data->other_procedure; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue>MUSCLE RELAXANT REVERSAL DONE</td>
        <td bgcolor=FAFAD><?php echo $data->muscle_relaxant_reversal_done; ?></td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
  <tr>
    <td class="border-less header" align="center" colspan="2">FOR DELIVERY</td>
 </tr>   
    <tr>
        <td valign="top" width="20%" bgcolor=SkyBlue>IF DELIVERY</td>
        <td bgcolor=FAFAD><?php echo $data->if_delivery; ?></td>
    </tr>
        <?php
        if ($data->if_delivery=="YES")
        {
            foreach ($apgar_information as $apgar_data):
            
        echo "<tr><td valign='top' bgcolor=SkyBlue>APGAR SCORE</td>
        <td bgcolor=FAFAD>".$apgar_data->apgar_score_1m." at 1min.</td>
    </tr>
    <tr>
        <td bgcolor=FAFAD></td><td bgcolor=FAFAD>".$apgar_data->apgar_score_5m." at 5mins.</td>
    </tr>
    <tr>
        <td bgcolor=FAFAD></td><td bgcolor=FAFAD>".$apgar_data->apgar_score_10m." at 10mins.</td>
    </tr>
    <tr><td bgcolor=FAFAD colspan=2><br></td></tr>";
    endforeach;
    }
    ?>        
    <tr>
        <td valign="top" bgcolor=SkyBlue>POST-OPERATIVE DIAGNOSIS</td>
        <td bgcolor=FAFAD><?php echo $data->post_operative_diagnosis; ?></td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
  <tr>
    <td class="border-less header" align="center" colspan="2">OTHER INFORMATION</td>
 </tr>   
    <tr>
        <td valign="top" bgcolor=SkyBlue width="20%">DISCHARGE NOTES</td>
        <td bgcolor=FAFAD><?php echo $data->discharge_notes; ?></td>
    </tr>   
    <tr>
        <td valign="top" bgcolor=SkyBlue>OTHER NOTES</td>
        <td bgcolor=FAFAD><?php echo $data->other_notes; ?></td>
    </tr>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
    <td class="border-less header" align="center" colspan="2">CRITICAL EVENTS INFORMATION</td>
 </tr>
    <tr>
        <td valign="top" bgcolor=SkyBlue width="20%">CRITICAL EVENTS</td>
        <td bgcolor=FAFAD><?php echo $data->critical_events; ?></td>
    </tr>
    <?php
        if ($data->critical_events=="YES")
        {
            foreach ($critical_events_information as $critical_events_data){}
        echo "<tr><td valign='top'>Anesthetic Complications (Intra-OP)</td>
        <td>: ".$critical_events_data->anesthetic_complications_intra_op."</td>
    </tr>
    <tr>
        <td valign='top'>Place of Occurence (Intra-Op)</td>
        <td>: ".$critical_events_data->place_of_occurence_intra_op."</td>
    </tr>
    <tr>
        <td valign='top'>Anesthetic Complications (Post-Op)</td>
        <td>: ".$critical_events_data->anesthetic_complications_post_op."</td>
    </tr>
    <tr>
        <td valign='top'>Place of Occurence (Post-Op)</td>
        <td>: ".$critical_events_data->place_of_occurence_post_op."</td>
    </tr>
    <tr>
        <td valign='top'>Describe the Incident</td>
        <td>: ".$critical_events_data->describe_the_incident."</td>
    </tr>
    <tr>
        <td valign='top'>Describe the management of the situation (optional)</td>
        <td>: ".$critical_events_data->describe_the_management_of_the_situation."</td>
    </tr>
    <tr>
        <td valign='top'>Did the event change your clinical practice for future events like this? (optional)</td>
        <td>: ".$critical_events_data->did_the_event_change_your_clinical_practice_for_future_events."</td>
    </tr>
    <tr>
        <td valign='top'>What led to the detection of the incident?</td>
        <td>: ".$critical_events_data->what."</td>
    </tr>";
    }
    ?>
</table>
<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/caselog_controller/update_caselog">
<table border="0" cellpadding="0" width="80%" cellspacing="5" style="font-family: sans-serif; border: solid 1px; font-size: 16px;">
   <input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>">
   <input type="hidden" name="status_id" value="<?php echo $this->input->get('status_id'); ?>">
   <input type="hidden" name="user_id" value="<?php echo $this->input->get('user_id'); ?>">
   <input type="hidden" name="institution_id" value="<?php echo $this->input->get('institution_id'); ?>">
    <tr>
        <td width="15%">STATUS</td>
         <td>
        <select name="anesth_status_id" class="index_input" style="width: 200px;">
        <?php
        $x=0;
        foreach ($status_list as $status):
        $status_name[$x] = $status->name;
        $status_id[$x] = $status->id;
        $x++;
        endforeach;
        if ($data->anesth_id == "5")
        {$status_name[4] = "Disapproved";}
        elseif ($data->anesth_id == "4")
        {$status_name[3] = "Approved";}
        ?>
         <option value="<?php echo $status_id[0]; ?>" <?php if ($status_id[0] == $data->anesth_id) { echo 'selected';}?>><?php echo $status_name[0]; ?></option>
         <option value="<?php echo $status_id[1]; ?>" <?php if ($status_id[1] == $data->anesth_id) { echo 'selected';}?>><?php echo $status_name[1]; ?></option>
         <?php if ($data->anesth_id == "7")
         {
           echo '<option selected=selected>Revised</option>';
         }
         ?>
         <?php if ($data->anesth_id == "3")
         {
           echo '<option selected=selected>For Revision</option>';
         }
         ?>
         <option value="<?php echo $status_id[3]; ?>" <?php if ($status_id[3] == $data->anesth_id) { echo 'selected';}?>><?php echo $status_name[3]; ?></option>
         
         <option value="<?php echo $status_id[4]; ?>" <?php if ($status_id[4] == $data->anesth_id) { echo 'selected';}?>><?php echo $status_name[4]; ?></option>        
        </select>
        </td>
    </tr>
    <tr>
        <td>NOTES</td>
        <td><textarea name="notes" cols="50" class="required"><?php echo $data->notes; ?></textarea></td>
    </tr>
    <?php
    if ($role_id == "2")
    {
     if ($data->anesth_id == "1" || $data->anesth_id == "7")
    {
    ?>
        <tr>
        <td class='border-less' align='right'>&nbsp;</td>
        <td class='border-less'><input type='submit' name='update' value='UPDATE'></td>
    </tr>
        <?php } } ?>
    <tr>
        <td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
    </tr>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
</form>
</div>