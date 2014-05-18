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
                <td class="border-less header" align="center" colspan="11">MONTHLY REPORT</td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2">HOSPITAL </td>
                <td class="border-less answer" colspan="9">
                        <select name="hospital_id" id="insti_id" style="width:auto;">
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
<?php
    echo form_open('reports_controller/monthly_report', array(
        'id' => 'monthly_report-form',
    ));
        echo form_fieldset();
            echo form_label('Institution: ', 'monthly_report-institution_id-sel');
            echo form_dropdown('MonthlyReport[institution_id]', $institutions, $institution_id, 'id="monthly_report-institution_id-sel"');
            
            echo '<br/>';
            
            echo form_label('Resident Trainee: ', 'monthly_report-user_id-sel');
            echo form_dropdown('MonthlyReport[user_id]', $trainees, $user_id, 'id="monthly_report-user_id-sel"');
            
            echo '<br/>';
        
            echo form_label('Date: ', 'monthly_report-month-sel');
            echo form_dropdown('MonthlyReport[month]', $months, intval($month), 'id="monthly_report-month-sel" style="width:100px"');
            echo form_dropdown('MonthlyReport[year]', $years, intval($year), 'id="monthly_report-year-sel" style="width:100px"');
            
            echo '<br/>';
            
            echo form_label('Status: ', 'monthly_report-status-sel');
            echo form_dropdown('MonthlyReport[anesth_status_id]', $statuses, $anesth_status_id, 'id="monthly_report-status-sel" style="width:100px"');
        echo form_fieldset_close();
        
        echo form_fieldset();
            echo form_button(array(
                'type' => 'submit',
                'content' => 'Generate Report',
            ));
            echo form_button(array(
                'content' => 'Clear',
                'onclick' => <<<EOD
$('select', $(this).closest('form')).val('');
EOD
                    ,
            ));
        echo form_fieldset_close();
    echo form_close();
?>

<table id="patient_type_grid-tbl" border="1">
<thead>
<tr>
<th>Patient Type</th>
<th colspan="2">Charity</th>
<th colspan="2">Pay</th>
<th>Total</th>
</tr>
<tr>
<th>&nbsp;</th>
<th>Primary</th>
<th>Assist</th>
<th>Primary</th>
<th>Assist</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<tr>
<td>Elective</td>
<td><?php echo $patient_type_grid->charity_primary_elective; ?></td>
<td><?php echo $patient_type_grid->charity_assist_elective; ?></td>
<td><?php echo $patient_type_grid->pay_primary_elective; ?></td>
<td><?php echo $patient_type_grid->pay_assist_elective; ?></td>
<td><?php echo $patient_type_grid->total_elective; ?></td>
</tr>
<tr>
<td>Emergency</td>
<td colspan="2"><?php echo $patient_type_grid->charity_emergency; ?></td>
<td colspan="2"><?php echo $patient_type_grid->pay_emergency; ?></td>
<td><?php echo $patient_type_grid->total_emergency; ?></td>
</tr>
<tr>
<td>Total</td>
<td colspan="2"><?php echo $patient_type_grid->total_charity; ?></td>
<td colspan="2"><?php echo $patient_type_grid->total_pay; ?></td>
<td><?php echo $patient_type_grid->total_overall; ?></td>
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
<td><?php echo empty($service->total) ? 0 : $service->total; ?></td>
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

<hr/>

<table id="critical_events_grid-tbl" border="1">
<thead>
<tr>
<th colspan="2">Critical Events</th>
</tr>
</thead>
<tbody>
<tr>
<td>Yes</td>
<td><?php echo $critical_events_grid->{'Yes'}; ?></td>
</tr>
<tr>
<td>No</td>
<td><?php echo $critical_events_grid->{'No'}; ?></td>
</tr>
<tr>
<td><b>Total</b></td>
<td><?php echo $critical_events_grid->{'Total'}; ?></td>
</tr>
</tbody>
</table>