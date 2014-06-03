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
<form method="get" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_controller/admin_search_caselog">
<table width="90%" cellpadding="1" cellspacing="0">
        <tr>
                <td class="border-less header" align="center" colspan="11">CASELOG SEARCH</td>
        </tr>
        <tr>
                <td style='color: red;font-size: 30px;font-weight: bold;' colspan="2" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td>
        </tr>
        <tr>
                <td class="border-less question" colspan=2>HOSPITAL</td>
                <td class="border-less answer" colspan="10"><select name="institution_id" id="insti_id" style="width:600px;">
                <option value="0">ALL</option>
                <?php
			foreach ($institution_list as $ai):
			echo "<option value='".$ai->id."'>".$ai->name."</option>";	
			endforeach;
		?>
                </select></td>
        </tr>
        <tr>
                <td class="border-less question" colspan=2>RESIDENT NAME</td>
                <td class="border-less answer" colspan=10><select name="users_id" id="users_info" style="width:300px;">
        	<option value="0">ALL</option>        	
            </select></td>
        </tr>
        <tr>
                <td class="border-less question" colspan=2>STATUS</td>
                <td class="border-less answer" colspan="10"><select name="status_id" style="width:200px;">
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
                </select></td>
        </tr>
        <tr>
                <td class="border-less" align="right" colspan=2>&nbsp;</td>
                <td class="border-less"><input type="submit" name="submit" value="SEARCH">
        </tr>
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
          if (!empty($caselog_information)) 
          foreach($caselog_information as $row):
           $date1 = new DateTime($row->patient_info_birthdate);
           $date2 = new DateTime(date('Y-m-d'));
           $diff = $date1->diff($date2);
           $age = $diff->y . "Y".$diff->m."M".$diff->d."D";
           if ($row->anesth_name == "Disapprove"){$row->anesth_name = "Disapproved";}
           if ($row->anesth_name == "Approve"){$row->anesth_name = "Approved";}
          ?>
          <tr bgcolor=fafad2><td><a href="<?php echo base_url(); ?>index.php/caselog_controller/index/<?php echo $row->p_id; ?>/<?php echo $row->patient_form_id; ?>"><?php echo $row->patient_info_case_number; ?></a></td>
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
          ?>
           <tr>
                <td colspan="8" style="border: hidden;"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
        <tr>
                <td colspan="11" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
        </tr>
</table>
</form>
</body>
</html>