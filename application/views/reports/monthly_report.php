<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#insti_id").change(function(){
            var insti_id = $("#insti_id").val();
            $.ajax({
               type : "POST",
               url : "<?php echo base_url(); ?>index.php/reports_controller/get_resident_per_institution",
               data : "insti_id=" + insti_id,
               success: function(data){
                   $("#users_info").html(data);
               }
            });
        });
    });
</script>
<?php echo form_open('reports_controller/monthly_report', array(
    'id' => 'monthly_report-form',
    'autocomplete' => 'off',
)); ?>
<table width="90%" cellpadding="0" cellspacing="0">
        <tr>
                <td class="border-less header" align="center" colspan="11">ANESTHESIOLOGY MONTHLY REPORT</td>
        </tr>
        <tr <?php echo ($user_information['role_id'] != 3) ? 'style="display:none"' : ''?>>
                <td class="border-less question" align="right" colspan="2"><?php echo form_label('HOSPITAL', 'insti_id'); ?></td>
                <td class="border-less answer" colspan="9">
                        <select name="Report[institution_id]" id="insti_id" style="width:auto;">
                                <option value="-111">ALL</option>
                                <?php foreach ($institution_list as $ai): ?>
                                <option value="<?php echo $ai->id; ?>" <?php if ($ai->id == $institution_id) { echo 'selected="selected"'; }?>><?php echo $ai->name; ?></option>
                                <?php endforeach; ?>
                        </select>
                </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2"><?php echo form_label('RESIDENT NAME', 'users_info'); ?></td>
                <td class="border-less answer" colspan="9">
                        <select name="Report[user_id]" style="width: auto;" id="users_info">
                                <option value="-111">ALL</option>
                                <?php
                                foreach($users_list as $list):
                                echo "<option value='".$list->id."' " . ($user_id == $list->id ? 'selected="selected"' : '') . ">".$list->lastname.", ".$list->firstname." ".$list->middle_initials.".</option>";
                                endforeach;
                                ?>
                        </select>
                </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2"><?php echo form_label('DATE', 'monthly_report-month-sel'); ?></td>
                <td class="border-less answer" colspan="9">
                <?php
                echo form_dropdown('Report[month]', $months, intval($month), 'id="monthly_report-month-sel" style="width:150px"');
                ?> -
                <?php
                echo form_dropdown('Report[year]', $years, intval($year), 'id="monthly_report-year-sel" style="width:150px"'); ?>
                </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2"><?php echo form_label('STATUS', 'monthly_report-status-sel'); ?></td>
                <td class="border-less answer" colspan="9">
                        <select name="Report[anesth_status_id]" id="monthly_report-status-sel" style="width: auto;">
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
                <td class="border-less question" align="right" colspan="2">&nbsp;</td>
                <td class="border-less answer" colspan="9"> <?php
                echo form_submit(array(
                    'type' => 'submit',
                    'name' => 'submit',
                    'value' => 'SEARCH',
                    'content' => 'Generate Report',
                ));
                ?> &nbsp;&nbsp;<?php
                echo form_submit(array(
                    'type' => 'submit',
                    'name' => 'clear',
                    'value' => 'CLEAR',
                    'onclick' => <<<EOD
                    $('select', $(this).closest('form')).val('');
EOD
                )); ?>
                </td>
        </tr>
</table>
<br>
<?php
echo form_close(); ?>
<?php if (!empty($patient_type_grid->charity_primary_elective)) { ?>
<table border=0 cellpadding=0 cellspacing=0 width=90% class=border-less>
        <tr>
                <td colspan=9 class="header border-less">RESULT</td>
        </tr>
</table>
<table border="0" cellpadding=0 cellspacing=2 width=40%>
        <thead>
                <tr>
                        <th class="border-less question" rowspan=2>PATIENT TYPE</th>
                        <th colspan="2" class="border-less question">CHARITY</th>
                        <th colspan="2" class="border-less question">PAY</th>
                        <th class="border-less question" rowspan=2>TOTAL</th>
                </tr>
                <tr>
                        <th>PRIMARY</th>
                        <th>ASSIST</th>
                        <th>PRIMARY</th>
                        <th>ASSIST</th>
                </tr>
                <tr>
                        <th>ELECTIVE</th>
                        <td class="answer"><?php echo $patient_type_grid->charity_primary_elective; ?></td>
                        <td class="answer"><?php echo $patient_type_grid->charity_assist_elective; ?></td>
                        <td class="answer"><?php echo $patient_type_grid->pay_primary_elective; ?></td>
                        <td class="answer"><?php echo $patient_type_grid->pay_assist_elective; ?></td>
                        <td class="answer total-cell"><?php echo $patient_type_grid->total_elective; ?></td>
                </tr>
                <tr>
                        <th>EMERGENCY</th>
                        <td colspan="2" class="answer"><?php echo $patient_type_grid->charity_emergency; ?></td>
                        <td colspan="2" class="answer"><?php echo $patient_type_grid->pay_emergency; ?></td>
                        <td class="answer total-cell"><?php echo $patient_type_grid->total_emergency; ?></td>
                </tr>
                <tr>
                        <th>TOTAL</th>
                        <td colspan="2" class="answer total-cell"><?php echo $patient_type_grid->total_charity; ?></td>
                        <td colspan="2" class="answer total-cell"><?php echo $patient_type_grid->total_pay; ?></td>
                        <td class="answer total-cell"><?php echo $patient_type_grid->total_overall; ?></td>
                </tr>
</table>
<br>
<table border=0 cellpadding=0 cellspacing=0 width=90% class=border-less>
        <tr>
                <td colspan=9 class="header border-less">SERVICE RESULT</td>
        </tr>
</table>
<table id="services_grid-tbl" border="0" cellspacing="2" cellpadding="0" width="45%">
        <thead>
                <tr>
                        <th class="question border-less">SERVICE</th>
                        <th class="question border-less">TOTAL</th>
                </tr>
        </thead>
        <tbody>
        <?php foreach ($services_grid as $service): ?>
        <tr>
                <th align="left" class="answer"><?php echo $service->service_name ?></th>
                <th class="answer"><?php echo empty($service->total) ? '-' : $service->total; ?></th>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>
<br>
<table border=0 cellpadding=0 cellspacing=0 width=90% class=border-less>
        <tr>
                <td colspan=9 class="header border-less">SERVICE AND TECHNIQUE COMBINATION RESULT</td>
        </tr>
</table>
<!--<table id="services_techniques_grid-tbl" border="0" cellpadding="0" cellspacing="2">
        <thead>
                <tr>
                <?php foreach ($services_techniques_grid_headers as $header): ?>
                <th class="border-less question" style="width:auto;"><?php echo $header; ?></th>
                <?php endforeach; ?>
                </tr>
        </thead>
        <tbody>
        <?php
        $endRow = count($services_techniques_grid) - 1;
        foreach($services_techniques_grid as $i => $row): ?>
        <tr>
        <?php
        foreach($services_techniques_grid_headers as $j => $col): ?>
        <?php if ($row->$col == "ZTOTAL") {$row->$col="TOTAL";} ?>
        <td class="border-less answer <?php echo ($i == $endRow ? 'total-cell' : ''); ?> bold"><?php echo empty($row->$col) ? '-' : $row->$col; ?></td>
        
        <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
</table>-->

<table id="services_techniques_grid-tbl" border="0" cellpadding="0" cellspacing="2">
    <thead>
        <tr>
            <th class="border-less question" style="width:auto;">Service - Technique</th>
            <?php foreach ($services_techniques_grid_headers as $header): ?>
                <th class="border-less question" style="width:auto;"><?php echo $header; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach($services_techniques_grid as $i => $row): ?>
            <tr>
                <td class="border-less answer bold"><?php echo $i; ?></td>
                <?php foreach($services_techniques_grid_headers as $j => $col): ?>
                    <td class="border-less answer <?php echo ($i == 'TOTAL' ? 'total-cell' : ''); ?> bold"><?php echo empty($row[$col]->total) ? '-' : $row[$col]->total; ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br>
<table border=0 cellpadding=0 cellspacing=0 width=90% class=border-less>
        <tr>
                <td colspan=9 class="header border-less">CRITICAL EVENT RESULT RESULT</td>
        </tr>
</table>
<table id="critical_events_grid-tbl" border="0" cellpadding='0' cellspacing="2">
        <thead>
                <tr>
                        <th colspan="2" class="border-less question">CRITICAL EVENTS</th>
                </tr>
        </thead>
        <tbody>
                <tr class="border-less answer">
                        <th>YES</th>
                        <td><?php echo $critical_events_grid->yes; ?></td>
                </tr>
                <tr class="border-less answer">
                        <th>NO</th>
                        <td><?php echo $critical_events_grid->no; ?></td>
                </tr>
                <tr class="border-less answer">
                        <th><b>TOTAL</b></th>
                        <td class="total-cell"><?php echo $critical_events_grid->total; ?></td>
                </tr>
        </tbody>
</table>
<br>
<?php foreach ($critical_levels_grid as $name => $level): ?>
    <table id="critical_levels_<?php echo $name; ?>_grid-tbl" border="0" cellpadding="0" cellspacing="2">
        <thead>
            <tr class="border-less question">
                <th colspan="3"><?php echo strtoupper(str_replace('_', ' ', $name)); ?></th>
            </tr>
            <tr>
                <th>CODE</th>
                <th>NAME</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($level as $l): ?>
            <tr class="border-less answer">
                <td><?php echo $l->code; ?></td>
                <td><?php echo $l->name; ?></td>
                <td class="bold"><?php echo empty($l->total) ? '-' : $l->total; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br>
<?php endforeach; ?>
<?php } ?>