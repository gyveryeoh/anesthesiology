<?php foreach ($patient_information as $data){}
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
<table border="0" cellpadding="0" width="80%" cellspacing="5" style="font-family: sans-serif; border: solid 1px; font-size: 10px;">
    <tr>
        <td width="15%">Resident Name</td>
        <td width="20%">: <?php echo ucwords(strtolower($data->lastname)).", ".ucwords($data->firstname)." ".ucwords($data->middle_initials)."."; ?></td>
    </tr>
    <tr>
        <td colspan="4"></td>
        <td align="right">Operation Date</td>
        <td colspan="2">: <?php echo $data->operation_date; ?></td>
    </tr>
    <tr>
        <td>Training Institution</td>
        <td>: UPCM-PGH Medical Center</td>
        <td colspan="2"></td>
        <td align="right">Level of Involvement</td>
        <td>: <?php echo $data->level_of_involvement; ?></td>
    </tr>
    </tr>
    <tr>
        <td colspan="3">Hospital Rotation</td>
        <td></td>
        <td align="right">Weight</td>
        <td align="left"> : <?php echo $data->weight; ?> KG</td>
    </tr>
    <tr>
        <td>Case Number</td>
        <td>: <?php echo $data->case_number; ?></td>
        <td width="5%" align="right">Age</ted>
        <td width="15%">: <?php echo $age; ?></td>
        <td width="15%" align="right">Sex</td>
        <td>: <?php echo $data->gender; ?></td>
        <td width="15%" align="right">Type of Patient</td>
        <td>: <?php echo $data->type_of_patient; ?></td>
    </tr>
    <tr>
        <td>Patient's Name/Initials</td>
        <td>: <?php echo ucwords($data->patient_information_lastname[0])."".ucwords($data->patient_information_firstname[0])."".ucwords($data->patient_information_middle_initials[0]); ?></td>
        <td colspan="3" align="right">ASA</td>
        <td>: <?php echo $data->asa; ?></td>
        <td><?php echo $data->for_emergency; ?></td>
    </tr>
</table>
</div>
<div align="center">
<table border="0" cellpadding="0" width="80%" cellspacing="5" style="font-family: sans-serif; border: solid 1px; font-size: 12px; border-top: hidden;">
    <tr>
        <td width="20%">Diagnosis</td>
        <td colspan="6">: <?php echo $data->diagnosis; ?></td>
    </tr>
    <tr>
        <td>Co-Morbid Diseases</td>
        <td colspan="6">: <?php echo $data->comorbid_diseases; ?></td>
    </tr>
    <tr>
        <td valign="top">Service</td>
        <td colspan="6">: <?php echo $data->service_name; ?></td>
    </tr>
    <tr>
        <td>Anesthetic Technique</td>
        <td colspan="6">: <?php echo $data->technique_name; ?></td>
    </tr>
    
    <?php
    if ($data->anesthetic_technique == "9")
    {
    echo "<tr>
        <td></td>
        <td colspan=6>: ".$data->apnbapt."</td></tr>";
    }
    ?>
    <tr>
        <td>Airway</td>
        <td colspan="6">: <?php echo $data->airway; ?></td>
    </tr>
    <tr>
        <td colspan="1">Needle</td>
        <td width="20%" align="left">Spinal Needle Type</td>
        <td>: <?php echo $data->spinal_needle; ?></td>
    </tr>
    <tr>
        <td></td>
        <td align="left">Epidural Needle Type</td>
        <td>: <?php echo $data->epidural_needle; ?></td>
    </tr>
    <tr>
        <td colspan="1">Needle Guage</td>
        <td align="left">Spinal Needle Guage</td>
        <td>: <?php echo $data->p1; ?></td>
    </tr>
    <tr>
        <td></td>
        <td align="left">Epidural Needle Guage</td>
        <td>: <?php echo $data->p2; ?></td>
    </tr>
    
    <tr>
        <td>Anesthesia Start</td>
        <td>: <?php echo $data->anesthesia_start." ".$data->anesthesia_start_time; ?></td>
    </tr>
    <tr>
        <td>Anesthesia End</td>
        <td>: <?php echo $data->anesthesia_end." ".$data->anesthesia_end_time; ?></td>
    </tr>
    <tr>
        <td>Total Anesthesia Hour/s</td>
        <td>: <?php echo $diffHours.".".round(($day2 - $day1)/60,2); ?></td>
    </tr>
    <tr>
        <td class="border-less" colspan="4"><b>Main Agents :</b></td>
    </tr>
    <?php
          $num_cols = 5;
          $current_col = 0;
          foreach($main_agent as $m_agent){
          if($current_col == "0")echo "<tr><td></td>";
          echo "<td>".$m_agent->name."</td>";
          if($current_col == $num_cols-1)
          {
            echo "</tr>";
            $current_col = 0;
            }
            else
            {
                $current_col++;
            }
          }
           ?>
    <?php if ($data->other_main_agent != "NULL")
    {
    echo "<tr>
        <td>Others</td>
        <td>: ".$data->other_main_agent."</td>
    </tr>";
    }
    ?>
    <tr>
        <td class="border-less" align="left" colspan="4"><b>Supplementary Agents :</b></td>
    </tr>
    <?php
          $num_col = 5;
          $current_co = 0;
          foreach($supplementary_agent as $s_agent):
          if($current_co == "0")echo "<tr><td></td>";
          echo "<td>".$s_agent->name."</td>";
          if($current_co == $num_col-1)
          {
            echo "</tr>";
            $current_co = 0;
            }
            else
            {
                $current_co++;
            }
            endforeach;
           ?>
    <?php if ($data->other_supplementary_agent != "NULL")
    {
    echo "<tr>
        <td>Others</td>
        <td>: ".$data->other_supplementary_agent."</td>
        
    </tr>";
    }
    ?>
    <tr>
        <td class="border-less" align="left" colspan="4"><b>Post-Op Pain Agents :</b></td>
    </tr>
    <?php
          $num_col = 5;
          $current_co = 0;
          foreach($post_op_pain_agent as $po_agent):
          if($current_co == "0")echo "<tr><td></td>";
          echo "<td>".$po_agent->name."</td>";
          if($current_co == $num_col-1)
          {
            echo "</tr>";
            $current_co = 0;
            }
            else
            {
                $current_co++;
            }
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
    <tr>
                <td class="border-less" colspan="2"><b>Post-OP Pain Management :</b></td>
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
            echo "<tr><td></td><td>".$apopmd_name1[$t]."</td><td>".$apopmd_id[$t]."".$apopmd_name[$t]."</td></tr>";
          }
           ?>
    <tr>
        <td class="border-less" align="left" colspan="4"><b>Monitors Used :</b></td>
    </tr>
    <?php
          $num_col = 4;
          $current_co = 0;
          foreach($monitors_used as $m_used):
          if($current_co == "0")echo "<tr><td></td>";
          echo "<td>".$m_used->name."</td>";
          if($current_co == $num_col-1)
          {
            echo "</tr>";
            $current_co = 0;
            }
            else
            {
                $current_co++;
            }
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
</div>
    <div align="center">
<table border="0" cellpadding="0" width="80%" cellspacing="3" style="font-family: sans-serif; border: solid 1px; font-size: 12px;border-top: hidden;">
    <tr>
                    <td class="border-less header" align="center" colspan="4"><H3>REPLACEMENT</H3></td>
          </tr>
    <tr>
        <td width="30%">Blood loss</td>
        <td colspan="6">: <?php echo $data->blood_loss_name; ?></td>
    </tr>
    <tr>
        <td>Crystalloids</td>
        <td>: <?php echo $data->crystalloids; ?></td>
    </tr>
    <tr>
        <td>Colloids</td>
        <td>: <?php echo $data->colloids; ?></td>
    </tr>
    <?php
    if ($data->colloids == "YES")
    {
        echo "<tr>
        <td>Colloid Used</td>
        <td>: ".$data->colloids_used."</td>";
    }
    ?>
    <tr>
        <td>Blood Product Used</td>
        <td>: <?php echo $data->blood_products_used; ?></td>
    </tr>
    <tr>
        <td>Fresh Whole Blood</td>
        <td>: <?php echo $data->fresh_whole_blood; ?></td>
        <td colspan="2">Fresh Frozen Plasma</td>
        <td>: <?php echo $data->fresh_frozen_plasma; ?></td>
    </tr>
    <tr>
        <td>Cyroprecipitate</td>
        <td>: <?php echo $data->cyroprecipitate; ?></td>
        <td colspan="2">Packed RBC</td>
        <td>: <?php echo $data->packed_rbc; ?></td>
    </tr>
    <tr>
        <td>Platelets</td>
        <td>: <?php echo $data->platelets; ?></td>
        <td valign="top" colspan="2">Others</td>
        <td>: <?php echo $data->others; ?></td>
    </tr>
    <tr>
        <td valign="top">Procedure Done</td>
        <td colspan="6">: <?php echo $data->procedure_done; ?></td>
    </tr>
    <tr>
        <td valign="top">Other Procedures</td>
        <td colspan="6">: <?php echo $data->other_procedure; ?></td>
    </tr>
    <tr>
        <td valign="top">Muscle Relaxant Reversal Done</td>
        <td>: <?php echo $data->muscle_relaxant_reversal_done; ?></td>
    </tr>
    <tr>
        <td valign="top">If Delivery</td>
        <td>: <?php echo $data->if_delivery; ?></td>
    </tr>
        <?php
        if ($data->if_delivery=="YES")
        {
            foreach ($apgar_information as $apgar_data):
            
        echo "<tr><td valign='top'>Apgar Score</td>
        <td>: ".$apgar_data->apgar_score_1m." at 1min.</td>
    </tr>
    <tr>
        <td></td><td>: ".$apgar_data->apgar_score_5m." at 5mins.</td>
    </tr>
    <tr>
        <td></td><td>: ".$apgar_data->apgar_score_10m." at 10mins.</td>
    </tr>
    <tr><td><br></td></tr>";
    endforeach;
    }
    ?>        
    <tr>
        <td valign="top">Post-Operative Diagnosis</td>
        <td colspan="6">: <?php echo $data->post_operative_diagnosis; ?></td>
    </tr>    
    <tr>
        <td valign="top">Discharge Notes</td>
        <td colspan="6">: <?php echo $data->discharge_notes; ?></td>
    </tr>   
    <tr>
        <td valign="top">Other Notes</td>
        <td colspan="6">: <?php echo $data->other_notes; ?></td>
    </tr>  
    <tr>
        <td valign="top">Critical Events</td>
        <td>: <?php echo $data->critical_events; ?></td>
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
 <script type="text/javascript">
      $(document).ready(function() {
      $("#caselog_form").validate();
      });
    </script>
<form method="post" id="caselog_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/caselog_controller/update_caselog">
<table border="0" cellpadding="0" width="80%" cellspacing="5" style="font-family: sans-serif; border: solid 1px; font-size: 16px;">
   <input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>">
   <input type="hidden" name="status_id" value="<?php echo $this->input->get('status_id'); ?>">
   <input type="hidden" name="user_id" value="<?php echo $this->input->get('user_id'); ?>">
   <input type="hidden" name="institution_id" value="<?php echo $this->input->get('institution_id'); ?>">
    <tr>
        <td width="15%"><b>STATUS</b></td>
         <td>
        <select name="anesth_status_id" class="index_input" style="width: 200px;">
        <?php
        $x=0;
        foreach ($status_list as $status):
        $status_name[$x] = $status->name;
        if ($data->anesth_id == "3"){$status_name[2] = "Approved";}
        if ($data->anesth_id == "4"){$status_name[3] = "Disapproved";}
        ?>
        <option value="<?php echo $status->id; ?>" <?php if ($status->id == $data->anesth_id) { echo 'selected';}?>><?php echo $status_name[$x-1]; ?></option>
        <?php
        $x++;
        endforeach; ?>
        <?php if ($data->anesth_id == "5")
        {
        echo "<option value='5' selected=selected>For Revision</option>";
        }
        ?>
        </select>
        
        </td>
    </tr>
    <tr>
        <td><b>NOTES</b></td>
        <td><textarea name="notes" cols="50" class="required"><?php echo $data->notes; ?></textarea></td>
    </tr>
    
    <?php if ($data->anesth_id == "1" || $status_name == "Revised")
    {
    echo '<tr>
        <td class="border-less" align="right">&nbsp;</td>
        <td class="border-less"><input type="submit" name="update" value="UPDATE"></td>
    </tr>';
    } 
    ?>
    <tr>
        <td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
    </tr>
</table>
</form>
</div>