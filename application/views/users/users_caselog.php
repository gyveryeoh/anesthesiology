<form method="get" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_controller/searchcaselog_details">
 <table width="80%" cellpadding="1" cellspacing="0">
  <?php
  $x=0;
  foreach($status_list as $list):
  $list_id[$x] = $list->id;
  $x++;
  endforeach;
  ?>
  <tr>
   <td align="left" class="border-less" style="background-color:white; font-family: sans-serif;font-size: 10px;font-weight:bold;">
    <a href="<?php echo base_url();?>index.php/users_controller/users_caselog?status=0">ALL</a> |
    <?php echo '<a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[0].'">Submitted</a> | <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[2].'">For Revision</a> |  | <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[5].'">Revised</a> | <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[3].'">Approved</a> | <a href="'.base_url().'index.php/users_controller/users_caselog?status='.$list_id[4].'">Disapproved</a>'; ?>
   </td>
   </tr>
  <tr>
   <td  align="left" class="border-less" style="background-color:white; font-family: sans-serif;font-size: 10px;font-weight:bold;"><?php echo "All : ".$count_all." | Submitted : ".$count_submitted." | For Revision : ".$count_forRevision." | Approved : ".$count_approved." | Disapproved : ".$count_disapproved." | Deleted : ".$count_deleted.""?></td>
  </tr>
 </table>
  <table width="80%" cellpadding="1" cellspacing="0">
          <tr>
           <th width="20%">CASE NUMBER</th>
           <th>INITIALS</th>
           <th>BIRTHDATE</th>
           <th>AGE</th>
           <th>WEIGHT</th>
           <th>GENDER</th>
           <th>STATUS</th>
          </tr>
          <?php
	  foreach($caselog_information as $row){
           $date1 = new DateTime($row->patient_info_birthdate);
           $date2 = new DateTime(date('Y-m-d'));
           $diff = $date1->diff($date2);
           $age = $diff->y . "Y".$diff->m."M".$diff->d."D";
          ?>
          <td><a href="<?php echo base_url(); ?>index.php/caselog_controller/index/<?php echo $row->p_id; ?>/<?php echo $row->patient_form_id; ?>"><?php echo $row->patient_info_case_number; ?></a></td>
         <?php
          echo "
          <td>".$row->patient_info_lastname."-".$row->patient_info_firstname."-".$row->patient_info_middle_initials."</td>
          <td>".$row->patient_info_birthdate."</td>
          <td>".$age."</td>
          <td>".$row->patient_info_weight." KG</td>
          <td>".$row->gender."</td>
          <td>".$row->anesth_name."</td>
          </tr>";
          }
          ?>
           <tr>
                <td colspan="7"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
           <tr>
            <td colspan="6" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
           </tr>
</table>
 </form>