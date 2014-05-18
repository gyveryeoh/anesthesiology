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
                <td style='color: red;font-size: 30px;font-weight: bold;' colspan="4" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td>
        </tr>
        <tr>
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
                </td>
                </tr>
</table>
<table id="patient_type_matrix-tbl" border="1">
    <thead>
        <tr class="question">
            <th>Patient Type</th>
            <th colspan="2">Charity</th>
            <th colspan="2">Pay</th>
            <th>Total</th>
        </tr>
        <tr class="question">
            <th>&nbsp;</th>
            <th>Primary</th>
            <th>Assist</th>
            <th>Primary</th>
            <th>Assist</th>
            <th></th>
        </tr>
    </thead>
    
    <tbody>
        <tr class="answer">
            <td class="question">Elective</td>
            <td><?php echo $patient_type_matrix->charity_primary_elective ?></td>
            <td><?php echo $patient_type_matrix->charity_assist_elective ?></td>
            <td><?php echo $patient_type_matrix->pay_primary_elective ?></td>
            <td><?php echo $patient_type_matrix->pay_assist_elective ?></td>
            <td><?php echo $patient_type_matrix->total_elective ?></td>
        </tr>
        <tr class="answer">
            <td class="question">Emergency</td>
            <td colspan="2"><?php echo $patient_type_matrix->charity_emergency ?></td>
            <td colspan="2"><?php echo $patient_type_matrix->pay_emergency ?></td>
            <td><?php echo $patient_type_matrix->total_emergency ?></td>
        </tr>
        <tr>
            <td>Total</td>
            <td colspan="2"><?php echo $patient_type_matrix->total_charity ?></td>
            <td colspan="2"><?php echo $patient_type_matrix->total_pay ?></td>>
            <td><?php echo $patient_type_matrix->total_overall ?></td>
        </tr>
    </tbody>
</table>

<hr/>

<table id="services_grid-tbl" border="1">
    <thead>
        <tr>
            <th>Service</th>
            <th>Total</th>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($services_grid as $service): ?>
            <tr>
                <td><?php echo $service->service_name ?></td>
                <td><?php echo $service->total ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<hr/>

<table id="services_techniques_grid-tbl" border="1">
    <thead>
        <tr>
            <?php foreach ($services_techniques_grid_headers as $header): ?>
                <th><?php echo $header; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach($services_techniques_grid as $row): ?>
            <tr>
                <?php foreach($services_techniques_grid_headers as $col): ?>
                    <td><?php echo empty($row->$col) ? 0 : $row->$col; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
