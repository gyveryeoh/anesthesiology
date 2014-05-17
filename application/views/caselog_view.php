<?php
foreach ($patient_information as $data): endforeach;
foreach($institution_details as $name): endforeach;
foreach($hospital_rotation_details as $hospital_name): endforeach;
$date1 = new DateTime($data->birthdate);
$date2 = new DateTime(date('Y-m-d'));
$diff = $date1->diff($date2);
$age = $diff->y . "Y-".$diff->m."M-".$diff->d."D";
//HOurs Computation
$date_today = date('Y-m-d g:i A');
$day1 = $data->anesthesia_start." ".$data->anesthesia_start_time;
$day2 = $data->anesthesia_end." ".$data->anesthesia_end_time;
$diff_seconds  = strtotime($day2) - strtotime($day1);
$sumit_seconds  = strtotime($date_today) - strtotime($day2);
$anesth_diff = floor($diff_seconds/3600).'.'.floor(($diff_seconds%3600)/60);
$submit_diff = floor($sumit_seconds/3600).'.'.floor(($sumit_seconds%3600)/60);
if ($data->gender == "M") { $data->gender = "Male"; } else { $data->gender = "Female"; }
if ($data->level_of_involvement == "P") { $data->level_of_involvement = "Primary"; } else { $data->level_of_involvement = "Assist"; }
if ($data->type_of_patient == "C") { $data->type_of_patient = "Charity"; } else { $data->type_of_patient = "Pay"; }
if ($data->for_emergency == "N") { $data->for_emergency = " "; } else { $data->for_emergency = "Emergency"; }
if ($data->operation_date == "0000-00-00") { $operation_date = "bgcolor=red"; } else { $operation_date = "bgcolor=fafad2"; }
if ($data->anesthesia_start == "0000-00-00") { $anesth_start = "bgcolor=red"; } else { $anesth_start = "bgcolor=fafad2"; }
if ($data->anesthesia_end == "0000-00-00") { $anesth_end = "bgcolor=red"; } else { $anesth_end = "bgcolor=fafad2"; }
if ($data->birthdate == "0000-00-00") { $birth_date = "bgcolor=red"; } else { $birth_date = "bgcolor=fafad2"; }

if ($data->anesthesia_end == "0000-00-00" || $data->anesthesia_start == "0000-00-00" || $data->operation_date == "0000-00-00" || $data->birthdate == "0000-00-00")
{
    $msg_error = "PLEASE FIX ERROR";
}
else
{
    $msg_error = "";
}
?>
<div align="center">
    <style>
        td{border: hidden;}
    </style>
    <form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/caselog_controller/index">
    <input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>">
    <table border="0" cellpadding="0" cellspacing="0" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;">
    <tr>
                    <td colspan="9" align="center"><b><?php if($this->session->flashdata("success") !== FALSE){ echo $this->session->flashdata("success"); } ?> <b style="color: red;font-size: 30px;"><?php echo $msg_error; ?></b></td>
    </tr>
    <tr>
        <td class="border-less header" align="center" colspan="7">PATIENT INFORMATION</td>
    </tr> 
    <tr>
        <td width="15%" class="border-less" bgcolor="SkyBlue">DATE CREATED</td>
        <td colspan="7" class="border-less" bgcolor="FAFAD2"><?php echo $data->pf_date_created; ?></td>
    </tr>
    <tr>
        <td width="15%" class="border-less" bgcolor="SkyBlue">RESIDENT NAME</td>
        <td width="20%" colspan="7" class="border-less" bgcolor="FAFAD2"><?php echo ucwords(strtolower($data->lastname)).", ".ucwords($data->firstname)." ".ucwords($data->middle_initials)."."; ?></td>
    </tr>
    <tr>
        <td colspan="4" class="border-less answer"></td>
        <td class="border-less question">OPERATION DATE</td>
        <td colspan="3" class="border-less" <?php echo $operation_date; ?>> <?php echo $data->operation_date; ?></td>
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
        <td bgcolor="FAFAD2" colspan="3" class="border-less"><?php echo $hospital_name->name; ?></td>
    
        <td bgcolor="SkyBlue" class="border-less">TYPE OF PATIENT</td>
        <td colspan="3" bgcolor="FAFAD2" class="border-less"><?php echo $data->type_of_patient; ?></td>
    </tr>
    <tr>
        <td class="border-less question">CASE NUMBER</td>
        <td class="border-less answer" width=20%><?php echo $data->case_number; ?></td>
        <td width="5%" class="border-less question">AGE</td>
        <td width="10%" class="border-less" <?php echo $birth_date; ?>><?php echo $age; ?></td>
        <td width="20%" class="border-less" bgcolor="SkyBlue">GENDER</td>
        <td class="border-lesss answer"><?php echo $data->gender; ?></td>
        <td width="15%" class="border-less" bgcolor="SkyBlue">WEIGHT</td>
        <td bgcolor="FAFAD2" class="border-less"><?php echo $data->weight; ?> KG</td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">PATIENT INITIALS</td>
        <td bgcolor="FAFAD2" class="border-less"><?php echo ucwords($data->patient_information_lastname[0])."-".ucwords($data->patient_information_firstname[0])."-".ucwords($data->patient_information_middle_initials[0]); ?></td>
        <td class="border-less" bgcolor="SkyBlue">ASA</td>
        <td class="border-less" bgcolor="FAFAD2"><?php echo $data->asa; ?></td>
        <td class="border-less" bgcolor="FAFAD2" colspan="4"><?php echo $data->for_emergency; ?></td>
    </tr>
     <?php
      if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/index/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td class="border-less header" align="center" colspan="7">DIAGNOSIS INFORMATION</td>
    </tr> 
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
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7  || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_diagnosis_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
  <tr>
    <td class="border-less header" align="center" colspan="2">ANESTHESIA</td>
 </tr>   
  <tr>
        <td class="border-less question" width="20%">ANESTHESIA START</td>
        <td <?php echo $anesth_start; ?> class="border-less" colspan="2"><?php echo $data->anesthesia_start."&nbsp;&nbsp;&nbsp;&nbsp;".DATE("H:i", STRTOTIME("$data->anesthesia_start_time")); ?></td>
    </tr>
    <tr>
        <td class="border-less question">ANESTHESIA END</td>
        <td <?php echo $anesth_start; ?> class="border-less" colspan="2"><?php echo $data->anesthesia_end."&nbsp;&nbsp;&nbsp;&nbsp;".DATE("H:i", STRTOTIME("$data->anesthesia_end_time")); ?></td>
    </tr>
    <tr>
        <td class="border-less" bgcolor="SkyBlue">TOTAL ANESTHESIA HOUR/S</td>
    <?php
    if ($anesth_diff >="0" )
    {
        $color = "bgcolor=FAFAD2";
    }
    if ($anesth_diff <= "0" && $anesth_diff <= "48")
    {
        $color = "bgcolor=red";
    }
    if ($anesth_diff >= "49")
    {
        $color = "bgcolor=red";
    }
    ?>
        <td class="border-less" <?php echo $color; ?> colspan="2"><?php echo $anesth_diff; ?></td>
    </tr>
    <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_anesthesia_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
<tr>
        <td class="border-less header" align="center" colspan="6">NEEDLE FORM</td>
    </tr>
          <tr>
                    <td class="border-less question" width=7% rowspan="2">NEEDLE</td>
                    <td class="border-less question" width=18%>SPINAL NEEDLE TYPE</td>
                    <td class="border-less answer" width=15%><?php echo $data->spinal_needle; ?></td>
                    </td>
                    <td class="border-less question" width=20% rowspan=2>NEEDLE GAUGE</td>
                    <td class="border-less question" width=20%>SPINAL NEEDLE GAUGE</td>
                    <td class="border-less answer"><?php echo $data->p1; ?></td>
          </tr>
          <tr>
                    <td class="border-less question">EPIDURAL NEEDLE TYPE</td>
                    <td class="border-less answer"><?php echo $data->epidural_needle; ?></td>
                    <td class="border-less question">EPIDURAL NEEDLE GAUGE</td>
                    <td class="border-less answer"><?php echo $data->p2; ?></td>
                    </td>
          </tr>
   <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_epidural/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td class="border-less" bgcolor="SkyBlue" colspan="5">MAIN AGENTS</td>
    </tr>
    <?php
          foreach($main_agent as $m_agent):
            echo "<tr><td bgcolor=FAFAD2 class=border-less width=20%>".$m_agent->name."</td><td bgcolor=FAFAD2 class=border-less></td>";
         endforeach;
         if ($data->other_main_agent != "NULL")
         {
            echo "<tr>
            <td class=border-less bgcolor=SkyBlue width=20%>OTHERS</td>
            <td bgcolor=FAFAD2 class=border-less>".$data->other_main_agent."</td>
            </tr>";
            }
             if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
            if($user_information['role_id'] == 1) { ?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_main_agents_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
        <?php
     }
     }
     ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td class="border-less" colspan="2" bgcolor="SkyBlue">SUPPLEMENTARY AGENTS</td>
    </tr>
    <?php
          foreach($supplementary_agent as $s_agent):
          echo "<tr><td bgcolor=FAFAD2 class=border-less width=20%>".$s_agent->name."</td>
          <td bgcolor=FAFAD2 class=border-less></td></tr>";
            endforeach;
           ?>
    <?php if ($data->other_supplementary_agent != "NULL")
    {
    echo "<tr>
        <td bgcolor=skyblue class=border-less width=20%>OTHERS</td>
        <td bgcolor=FAFAD2 class=border-less>".$data->other_supplementary_agent."</td>
        </tr>";
    }
     if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
    if($user_information['role_id'] == 1) { ?>
	<tr>
	<td bgcolor="FAFAD2" colspan="2" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_supp_agents_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
        <?php
     }
      }
    ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
        <td class=border-less bgcolor="SkyBlue" width=20% colspan="2">POST OP PAIN AGENTS</td>
    </tr>
    <?php
          foreach($post_op_pain_agent as $po_agent):
          echo "<tr><td bgcolor=FAFAD2 class=border-less width=20%>".$po_agent->name."</td><td bgcolor=FAFAD2 class=border-less></td></tr>";
            endforeach;
           ?>
    <?php if ($data->other_post_op_pain_agent != "NULL")
    {
    echo "<tr>
        <td bgcolor=skyblue class=border-less width=20%>OTHERS</td>
        <td bgcolor=fafad2 class=border-less>".$data->other_post_op_pain_agent."</td>
    </tr>";
    }
     if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
    if($user_information['role_id'] == 1) { ?>
	<tr>
	<td bgcolor="FAFAD2" colspan="2" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_post_op_agents_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
        <?php
     }
      }
    ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
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
            echo "<tr><td width=20% class=border-less bgcolor=FAFAD2>".$apopmd_name[$t]."</td><td class=border-less  bgcolor=FAFAD2>".$apopmd_name1[$t]."</td></tr>";
          }
           if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
    if($user_information['role_id'] == 1) { ?>
	<tr>
	<td bgcolor="FAFAD2" colspan="2" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_post_op_pain_management_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
        <?php
     }
      }
?>
    <table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    
    <tr>
        <td class="border-less" colspan="2" bgcolor="SkyBlue">MONITORS USED</td>
    </tr>
    <?php
          foreach($monitors_used as $m_used):
          echo "<tr><td class=border-less  bgcolor=FAFAD2 colspan=2>".$m_used->name."</td></tr>";
            endforeach;
           ?>
    <?php if ($data->other_monitors_used != "NULL")
    {
    echo "<tr>
        <td bgcolor=SkyBlue width=15% class=border-less>OTHERS</td>
        <td bgcolor=FAFAD2 class=border-less>".$data->other_monitors_used."</td>
    </tr>";
    }
      if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_monitors_used_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
    <table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
 <tr>
    <td class="border-less header" align="center" colspan="2">PROCEDURE</td>
 </tr>   
    <tr>
        <td width="25%" bgcolor=SkyBlue class="border-less">PROCEDURE DONE</td>
        <td bgcolor=FAFAD class="border-less"><?php echo $data->procedure_done; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue class="border-less">OTHER PROCEDURE</td>
        <td bgcolor=FAFAD class="border-less"><?php echo $data->other_procedure; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue class="border-less">MUSCLE RELAXANT REVERSAL DONE</td>
        <td bgcolor=FAFAD class="border-less"><?php echo $data->muscle_relaxant_reversal_done; ?></td>
    </tr>
     <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_procedure/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
     <tr>
                    <td class="border-less header" align="center" colspan="5">REPLACEMENT</td>
          </tr>
    <tr>
        <td width="20%" bgcolor="SkyBlue"class=border-less>BLOOD LOSS</td>
        <td colspan="4" class=border-less  bgcolor=FAFAD><?php echo $data->blood_loss_name; ?></td>
    </tr>
    <tr>
        <td bgcolor="SkyBlue"class=border-less>CRYSTALLOIDS</td>
        <td class=border-less bgcolor=FAFAD colspan="4"><?php echo $data->crystalloids; ?></td>
    </tr>
    <tr>
        <td bgcolor="SkyBlue" class=border-less>COLLOIDS</td>
        <td bgcolor=FAFAD colspan="4" class=border-less><?php echo $data->colloids; ?></td>
    </tr>
    <?php
    if ($data->colloids == "YES")
    {
        echo "<tr>
        <td bgcolor=SkyBlue class=border-less>COLLOIDS USED</td>
        <td bgcolor=FAFAD colspan=4 class=border-less>".$data->colloids_used."</td>";
    }
    ?>
    <tr>
        <td bgcolor=SkyBlue class=border-less>BLOOD PRODUCT USED</td>
        <td bgcolor=FAFAD colspan="4" class=border-less><?php echo $data->blood_products_used; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue class=border-less>FRESH WHOLE BLOOD</td>
        <td bgcolor=FAFAD class=border-less><?php echo $data->fresh_whole_blood; ?></td>
        <td bgcolor=SkyBlue width=20% class=border-less>FRESH FROZEN PLASMA</td>
        <td bgcolor=FAFAD class=border-less><?php echo $data->fresh_frozen_plasma; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue class=border-less>CYROPRECIPITATE</td>
        <td bgcolor=FAFAD class=border-less><?php echo $data->cyroprecipitate; ?></td>
        <td bgcolor=SkyBlue class=border-less>PACKED RBC</td>
        <td bgcolor=FAFAD class=border-less><?php echo $data->packed_rbc; ?></td>
    </tr>
    <tr>
        <td bgcolor=SkyBlue class=border-less>PLATELETS</td>
        <td bgcolor=FAFAD class=border-less><?php echo $data->platelets; ?></td>
        <td bgcolor=SkyBlue class=border-less>OTHERS</td>
        <td bgcolor=FAFAD class=border-less><?php echo $data->others; ?></td>
    </tr>
    <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_replacement/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
  <tr>
    <td class="border-less header" align="center" colspan="2">FOR DELIVERY</td>
 </tr>   
    <tr>
        <td valign="top" width="20%" bgcolor=SkyBlue>DELIVERY</td>
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
     <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_delivery/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
  <tr>
    <td class="border-less header" align="center" colspan="2">OTHER INFORMATION</td>
 </tr>
    <tr>
        <td valign="top" bgcolor=SkyBlue>POST-OPERATIVE DIAGNOSIS</td>
        <td bgcolor=FAFAD><?php echo $data->post_operative_diagnosis; ?></td>
    </tr>
    <tr>
        <td valign="top" bgcolor=SkyBlue width="20%">DISCHARGE NOTES</td>
        <td bgcolor=FAFAD><?php echo $data->discharge_notes; ?></td>
    </tr>   
    <tr>
        <td valign="top" bgcolor=SkyBlue>OTHER NOTES</td>
        <td bgcolor=FAFAD><?php echo $data->other_notes; ?></td>
    </tr>
    <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_other_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
	<?php }} ?>
</table>
<table border="0" cellpadding="0" cellspacing="2" width="90%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
    <td class="border-less header" align="center" colspan="2">CRITICAL EVENTS INFORMATION</td>
 </tr>
    <tr>
        <td valign="top" bgcolor=SkyBlue width="20%">CRITICAL EVENTS</td>
        <td bgcolor=FAFAD><?php if ($data->critical_events == "NO") { echo $data->critical_events = "NO REPORTABLE REPORTS WITHIN 48 HOURS";} else { echo $data->critical_events = "YES"; } ?></td>
    </tr>
    <?php
        if ($data->critical_events=="YES")
        {
            echo "<tr><td bgcolor=skyblue colspan=2>AIRWAY</td></tr>";
            foreach ($patient_form_critical_level_airway_details as $airway_data):
            echo "<tr><td bgcolor=fafad2 colspan=2>".$airway_data->code.' '.$airway_data->name."</td>
            </tr>";
            endforeach;
            echo "<tr><td bgcolor=skyblue colspan=2>CARDIOVASCULAR</td></tr>";
            foreach ($patient_form_critical_level_cardiovascular_details as $cardiovascular_data):
            echo "<tr><td bgcolor=fafad2 colspan=2>".$cardiovascular_data->code.' '.$cardiovascular_data->name."</td>
            </tr>";
            endforeach;
            echo "<tr><td bgcolor=skyblue colspan=2>DISCHARGE PLANNING</td></tr>";
            foreach ($patient_form_critical_level_discharge_planning_details as $discharge_planning_data):
            echo "<tr><td bgcolor=fafad2 colspan=2>".$discharge_planning_data->code.' '.$discharge_planning_data->name."</td>
            </tr>";
            endforeach;
            echo "<tr><td bgcolor=skyblue colspan=2>MISCELLANEOUS</td></tr>";
            foreach ($patient_form_critical_level_miscellaneous_details as $miscellaneous_data):
            echo "<tr><td bgcolor=fafad2 colspan=2>".$miscellaneous_data->code.' '.$miscellaneous_data->name."</td>
            </tr>";
            endforeach;
            echo "<tr><td bgcolor=skyblue colspan=2>NEUROLOGICAL</td></tr>";
            foreach ($patient_form_critical_level_neurological_details as $neurological_data):
            echo "<tr><td bgcolor=fafad2 colspan=2>".$neurological_data->code.' '.$neurological_data->name."</td>
            </tr>";
            endforeach;
            echo "<tr><td bgcolor=skyblue colspan=2>RESPIRATORY</td></tr>";
            foreach ($patient_form_critical_level_respiratory_details as $respiratory_data):
            echo "<tr><td bgcolor=fafad2 colspan=2>".$respiratory_data->code.' '.$respiratory_data->name."</td>
            </tr>";
            endforeach;
            echo "<tr><td bgcolor=skyblue colspan=2>REGIONAL ANESTHESIA</td></tr>";
            foreach ($patient_form_critical_level_regional_anesthesia_details as $regional_anesthesia_data):
            echo "<tr><td bgcolor=fafad2 colspan=2>".$regional_anesthesia_data->code.' '.$regional_anesthesia_data->name."</td>
            </tr>";
            endforeach;
             
            echo "<tr><td bgcolor=skyblue colspan=2>PREOP</td></tr>";
            foreach ($patient_form_critical_level_preop_details as $preop_data):
            echo "<tr><td bgcolor=fafad2 colspan=2>".$preop_data->code.' '.$preop_data->name."</td>
            </tr>";
            endforeach;
            }
    ?>
    <?php
    if ($data->anesth_status_id == 3 || $data->anesth_status_id == 7 || $data->anesth_status_id == 8)
      {
        if($user_information['role_id'] == 1)
	{
	?>
	<tr>
	<td bgcolor="FAFAD2" colspan="8" align="center" class="border-less" style="font-family: sans-serif;font-size: 14px;font-weight:bold;">
		<a href="<?php echo base_url();?>index.php/edit_caselog_controller/edit_critical_events_information/<?php echo $data->patient_information_id?>/<?php echo $data->patient_form_id; ?>">UPDATE</a>
	</td>
	</tr>
    <?php }}
    if ($submit_diff >= "48" && $data->anesth_status_id == 8 && $user_information['role_id'] == "1" && $data->anesthesia_end != "0000-00-00" && $data->anesthesia_start != "0000-00-00" && $data->operation_date != "0000-00-00" && $data->birthdate != "0000-00-00")
    {
    ?>
          <tr>
                    <td class="border-less answer">&nbsp;</td>
                    <td class="border-less answer"><br><input type="submit" name="submit" value="SAVE CASELOG AS SUBMITTED"></td>
          </tr>
          <?php } ?>
</table>
</form>
<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/caselog_controller/update_caselog">
<table border="0" cellpadding="0" width="90%" cellspacing="5" style="font-family: sans-serif; border: solid 1px; font-size: 16px;">
   <input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>">
   <input type="hidden" name="case_number" value="<?php echo $this->input->get('case_number'); ?>">
   <input type="hidden" name="service" value="<?php echo $this->input->get('service'); ?>">
   <input type="hidden" name="technique" value="<?php echo $this->input->get('technique'); ?>">
   <input type="hidden" name="hospital_id" value="<?php echo $this->input->get('hospital_id'); ?>">
   <input type="hidden" name="user_id" value="<?php echo $this->input->get('user_id'); ?>">
   <input type="hidden" name="start_date" value="<?php echo $this->input->get('start_date'); ?>">
   <input type="hidden" name="end_date" value="<?php echo $this->input->get('end_date'); ?>">
   <input type="hidden" name="resident_id" value="<?php echo $this->input->get('resident_id'); ?>">
   <input type="hidden" name="status_id" value="<?php echo $this->input->get('status_id'); ?>">
   
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
        <option value="8" <?php if ($status_id[0] == $data->anesth_id) { echo 'selected';}?>>Open</option> 
         <option value="<?php echo $status_id[0]; ?>" <?php if ($status_id[0] == $data->anesth_id) { echo 'selected';}?>><?php echo $status_name[0]; ?></option>
         <option value="<?php echo $status_id[1]; ?>" <?php if ($status_id[1] == $data->anesth_id) { echo 'selected';}?>><?php echo $status_name[1]; ?></option>
         <?php if ($data->anesth_id == "7")
         {
           echo '<option selected=selected value=7>Revised</option>';
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
    if ($user_information['role_id'] == "2")
    {
     if ($data->anesth_id == "1" || $data->anesth_id == "7")
    {
    ?>
        <tr>
        <td class='border-less' align='right'>&nbsp;</td>
        <td class='border-less'><input type='submit' name='update' value='UPDATE'></td>
    </tr>
        <?php } } ?>
    <tr>
        <td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology </td>
    </tr>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
</form>
</div>