<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#insti_id").change(function(){
            var insti_id = $("#insti_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>index.php/reports_controller/get_resident_per_institution",
               data : "insti_id=" + insti_id,
               success: function(data){
                   $("#users_info").html(data);
               }
            });
        });
    });
</script>
<form method="get" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_controller/searchcaselog">
<table width="90%" cellpadding="0" cellspacing="0">
        <tr>
                <td class="border-less header" align="center" colspan="11">CASELOG SEARCH</td>
        </tr>
        <tr>
                <td style='color: red;font-size: 30px;font-weight: bold;' colspan="4" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td></tr>
        <tr>
                <td class="border-less question" align="right" width="20%" colspan=2>CASE NUMBER</td>
                <td class="border-less answer" colspan="9"><input type="text" name="case_number" size="30"></td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan=2>SERVICE</td>
                <td class="border-less answer" colspan="9">
                        <select name="service" style="width: auto;">
                              <option value="0">ALL</option>
                              <?php
                              foreach($service as $service_list)
                              {
                               echo "<option value='".$service_list->id."'>".$service_list->name."</option>";
                              }
                              ?>
                        </select>
                </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2">ANESTHETIC TECHNIQUE</td>
                <td class="border-less answer" colspan="9">
                        <select name="technique" style="width: auto;">
                              <option value="0">ALL</option>
                              <?php
                              foreach($technique as $technique_list)
                              {
                               echo "<option value='".$technique_list->id."'>".$technique_list->name."</option>";
                              }
                              ?>
                        </select>
                </td>
        </tr>
        <tr <?php if ($user_information['role_id'] != 3) {echo 'style=display:none'; }?>>
                <td class="border-less question" align="right" colspan="2">HOSPITAL </td>
                <td class="border-less answer" colspan="9">
                        <select name="hospital_id" id="insti_id" style="width:600px;">
                                <option value="0">ALL</option>
                                <?php
                                foreach ($institution_list as $ai):
                                ?>
                                <option value="<?php echo $ai->id; ?>"  <?php if ($ai->id == $user_information['institution_id']) { echo 'selected=selected'; }?>><?php echo $ai->name; ?></option>
                                <?php
                                endforeach;
                                ?>
                        </select>
                </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2">RESIDENT NAME</td>
                <td class="border-less answer" colspan="9">
                        <select name="user_id" style="width: auto;" id="users_info">
                              <option value="0">ALL</option>
                              <?php
                              foreach($users_list as $list)
                              {
                               echo "<option value='".$list->id."'>".$list->lastname.", ".$list->firstname." ".$list->middle_initials.".</option>";
                              }
                              ?>
                        </select>
                </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2">OPERATION DATE</td>
                <td class="border-less answer" colspan="9"><input type="checkbox" name="include_date" value="1">Include cases from date : <input type="text" id="datepicker-example11" name="start_date" size="10" value="<?php echo date('Y-m-d'); ?>"> to date : <input type="text" id="datepicker-example12" name="end_date" size="10" value="<?php echo date('Y-m-d'); ?>"></td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2">STATUS</td>
                <td class="border-less answer" colspan="9">
                        <select name="status_id" style="width: auto;">
                              <option value="0">ALL</option>
                              <option value="8">Open</option>
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
                                    <option value='".$list_id[4]."'>".$list_name[4]."d</option>";
                              ?>
                        </select>
                </td>
        </tr>
        <tr>
                <td class="border-less" align="right" colspan="2">&nbsp;</td>
                <td class="border-less"><br><input type="submit" name="submit" value="SEARCH"><br><br>
        </tr>
        <?php
        if (!empty($caselog_information))
        {
                if($this->session->flashdata("success") !== FALSE)
        {
                echo "<tr><td colspan=11 align=center>".$this->session->flashdata("success")."</td></tr>";
        }
        ?>
        <tr bgcolor=skyblue>
                <th width="10%">CASE NUMBER</th>
                <th>RESIDENT NAME</th>
                <th>INITIALS</th>
                <th>BIRTHDATE</th>
                <th>AGE</th>
                <th>WEIGHT</th>
                <th>GENDER</th>
                <th>STATUS</th>
                <th>DATE OF OPERATION</th>
                <th>DATE ENCODED</th>
                <th>DATE UPDATED</th>
        </tr>
        <?php
        foreach($caselog_information as $row):
        $date1 = new DateTime($row->patient_info_birthdate);
        $date2 = new DateTime(date('Y-m-d'));
        $diff = $date1->diff($date2);
        $age = $diff->y . "Y".$diff->m."M".$diff->d."D";
        if ($row->anesth_name == "Disapprove"){$row->anesth_name = "Disapproved";}
        if ($row->anesth_name == "Approve"){$row->anesth_name = "Approved";}
        ?>
        <tr class="answer"><td><a href="<?php echo base_url(); ?>index.php/caselog_controller/index/<?php echo $row->p_id; ?>/<?php echo $row->patient_form_id; ?>?&case_number=<?php echo $this->input->get('case_number'); ?>&service=<?php echo $this->input->get('service'); ?>&technique=<?php echo $this->input->get('technique'); ?>&hospital_id=<?php echo $this->input->get('hospital_id'); ?>&user_id=<?php echo $this->input->get('user_id'); ?>&start_date=<?php echo $this->input->get('start_date'); ?>&end_date=<?php echo $this->input->get('end_date'); ?>&status_id=<?php echo $this->input->get('status_id'); ?>"><?php echo $row->patient_info_case_number; ?></a></td>
        <?php
        echo "<td>".$row->lastname.", ".$row->firstname." ".$row->middle_initials.".</td>
        <td>".$row->patient_info_lastname."-".$row->patient_info_firstname."-".$row->patient_info_middle_initials."</td>
        <td>".$row->patient_info_birthdate."</td>
        <td>".$age."</td>
        <td>".$row->patient_info_weight." KG</td>
        <td>".$row->gender."</td>
        <td>".$row->anesth_name."</td>
        <td>".$row->operation_date."</td>
        <td>".$row->pf_date_created."</td>
        <td>".$row->pf_date_updated."</td>
        </tr>";
        endforeach;
        }
        ?>
        <tr>
                <td colspan="8" style="border: hidden;"><?php echo $this->pagination->create_links(); ?><br><br></td>
        </tr>
        <?php if (!empty($total))
        {
                ?>
                <tr>
                        <td colspan='3' class="border-less"><b>TOTAL RESULT FOUND : <?php echo $total; ?></b></td>
                </tr>
                <?php
                }
                ?>
                <tr>
                        <td colspan="11" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
                </tr>
</table>
</form>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>