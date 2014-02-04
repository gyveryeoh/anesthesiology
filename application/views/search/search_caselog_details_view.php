<form method="get" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_controller/searchcaselog_details">
 <table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="2">CASELOG SEARCH</td>
          </tr>
          <tr><td style='color: red;font-size: 30px;font-weight: bold;' colspan="2" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td></tr>
          <tr>
                    <td class="border-less" align="right" width="40%">Resident Name :</td>
                     <td class="border-less" colspan="2">
                        <select name="user_id">
                              <option value="0">All</option>
                              <?php
                              foreach($users_list as $list)
                              {
                               echo "<option value='".$list->id."'>".$list->lastname.", ".$list->firstname." ".$list->middle_initials.".</option>";
                              }
                              ?>
                    </select>
                    </td></tr>
          <tr>
          <tr>
                    <td class="border-less" align="right">Status :</td>
                     <td class="border-less" colspan="2">
                        <select name="status_id" class="required">
                              <option value="0">All</option>
                              <?php
                              $x=0;
                              foreach($status_list as $list):
                              $list_id[$x] = $list->id;
                              $list_name[$x] = $list->name;
                              $x++;
                              endforeach;
                              echo "<option value='".$list_id[0]."'>".$list_name[0]."</option>
                                   <option value='".$list_id[2]."'>".$list_name[2]."</option>
                                   <option value='".$list_id[5]."'>".$list_name[5]."</option>
                                   <option value='".$list_id[3]."'>".$list_name[3]."d</option>
                                   <option value='".$list_id[4]."'>".$list_name[4]."d</option>"
                              ;
                              ?>
                    </select>
                    </td></tr>
          <tr>
                    <td class="border-less" align="right">&nbsp;</td>
                    <td class="border-less"><input type="submit" name="Search" value="SEARCH"></td>
          </tr>
          <tr>
                    <td colspan="6" align="center"><?php if($this->session->flashdata("success") !== FALSE){ echo $this->session->flashdata("success"); }?></td>
          </tr>
 </table>
  <table width="80%" cellpadding="1" cellspacing="0">
          <tr>
           <th width="20%">CASE NUMBER</th>
           <th>RESIDENT NAME</th>
           <th>INITIALS</th>
           <th>BIRTHDATE</th>
           <th>AGE</th>
           <th>WEIGHT</th>
           <th>GENDER</th>
           <th>STATUS</th>
          </tr>
          <?php foreach($caselog_information as $row):
           $date1 = new DateTime($row->patient_info_birthdate);
           $date2 = new DateTime(date('Y-m-d'));
           $diff = $date1->diff($date2);
           $age = $diff->y . "Y".$diff->m."M".$diff->d."D";
           if ($row->anesth_name == "Disapprove"){$row->anesth_name = "Disapproved";}
           if ($row->anesth_name == "Approve"){$row->anesth_name = "Approved";}
          ?>
          <td><a href="<?php echo base_url(); ?>index.php/caselog_controller/index/<?php echo $row->p_id; ?>/<?php echo $row->patient_form_id; ?>?&institution_id=<?php echo $institution_id; ?>&user_id=<?php echo $user_id; ?>&status_id=<?php echo $status_id; ?>&status=<?php echo $row->anesth_status_id; ?>"><?php echo $row->patient_info_case_number; ?></a></td>
         <?php
          echo "<td>".$row->lastname.", ".$row->firstname." ".$row->middle_initials.".</td>
          <td>".$row->patient_info_lastname."-".$row->patient_info_firstname."-".$row->patient_info_middle_initials."</td>
          <td>".$row->patient_info_birthdate."</td>
          <td>".$age."</td>
          <td>".$row->patient_info_weight." KG</td>
          <td>".$row->gender."</td>
          <td>".$row->anesth_name."</td>
          </tr>";
          endforeach;
          ?>
           <tr>
                <td colspan="8"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
           <tr>
            <td colspan="8" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
           </tr>
</table>
</form>
</body>
</html>