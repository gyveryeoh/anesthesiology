<form method="get" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_controller/searchcaselog_details">
 <table width="90%" cellpadding="1" cellspacing="0">
  <tr>
                    <td colspan="6" align="center"><?php if($this->session->flashdata("success") !== FALSE){ echo $this->session->flashdata("success"); }?></td>
          </tr>
  <?php
  $x=0;
  foreach($status_list as $list):
  $list_id[$x] = $list->id;
  $x++;
  endforeach;
  ?>
  <tr>
   <td align="left" class="border-less" style="background-color:white; font-family: sans-serif;font-size: 15px;font-weight:bold;">
    <a href="<?php echo base_url();?>index.php/users_controller/users_caselog?status=0">TOTAL : <?php echo $count_all; ?></a> |
    <?php echo '<a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[6].'">OPEN : '.$count_open.'</a> | <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[0].'">SUBMITTED : '.$count_submitted.'</a> | <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[2].'">FOR REVISION : '.$count_forRevision.'</a> |  <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[5].'">REVISED : '.$count_revised.'</a> | <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[3].'">APPROVED : '.$count_approved.'</a> | <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[4].'">DISAPPROVED : '.$count_disapproved.'</a>'; ?>
   </td>
   </tr>
 </table>
  <table width="90%" cellpadding="1" cellspacing="0">
          <tr>
           <th class='border-less question' width="15%">CASE NUMBER</th>
           <th class='border-less question'>INITIALS</th>
           <th class='border-less question'>BIRTHDATE</th>
           <th class='border-less question'>AGE</th>
           <th class='border-less question'>WEIGHT</th>
           <th class='border-less question'>GENDER</th>
           <th class='border-less question'>STATUS</th>
          </tr>
          <?php
	  $date_today = date('Y-m-d g:i A');
	  foreach($caselog_information as $row):
	  $anesth_end_date = $row->anesthesia_end." ".$row->anesthesia_end_time;
	  $anesth_diff  = strtotime($date_today) - strtotime($anesth_end_date);
	  $status = floor($anesth_diff/3600).'.'.floor(($anesth_diff%3600)/60);
           $date1 = new DateTime($row->patient_info_birthdate);
           $date2 = new DateTime(date('Y-m-d'));
           $diff = $date1->diff($date2);
           $age = $diff->y . "Y".$diff->m."M".$diff->d."D";
	   if ($row->anesth_name == "Approve") {$row->anesth_name = "Approved";}
	   if ($row->anesth_name == "Disapprove") {$row->anesth_name = "Disapproved";}
          if ($status >= "48" && $row->anesth_status_id == 8)
	  {
	   $color = "background-color:lime;animation:blink;";
	  }
	  else
	  {
	   $color = "background-color:#fafad2";
	  }
	  ?>
	  
	  <tr class='border-less' style='<?php echo $color; ?>'>
          <td><a href="<?php echo base_url(); ?>index.php/caselog_controller/index/<?php echo $row->p_id; ?>/<?php echo $row->patient_form_id; ?>/<?php echo $this->input->get('status'); ?>"><?php echo $row->patient_info_case_number; ?></a></td>
         <?php
          echo "<td>".$row->patient_info_lastname."-".$row->patient_info_firstname."-".$row->patient_info_middle_initials."</td>
          <td>".$row->patient_info_birthdate."</td>
          <td>".$age."</td>
          <td>".$row->patient_info_weight." KG</td>
          <td>".$row->gender."</td>
          <td>".$row->anesth_name."</td>
          </tr>";
          endforeach;
          ?>
           <tr>
                <td colspan="7" class=border-less><?php echo $this->pagination->create_links(); ?></td>
          </tr>
           <tr>
            <td colspan="7" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
           </tr>
</table>
 </form>