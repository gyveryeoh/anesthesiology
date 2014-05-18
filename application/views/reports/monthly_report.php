<?php
    echo form_open('reports_controller/monthly_report', array(
        'id' => 'monthly_report-form',
    ));
        echo form_fieldset();
            echo form_label('Name of hospital: ', 'monthly_report-institution_id-sel');
            echo form_dropdown('MonthlyReport[institution_id]', $institutions, $institution_id, 'id="monthly_report-institution_id-sel"');
            echo '<br/>';
            echo form_label('Date: ', 'monthly_report-month-sel');
            echo form_dropdown('MonthlyReport[month]', $months, intval($month), 'id="monthly_report-month-sel" style="width:100px"');
            echo form_dropdown('MonthlyReport[year]', $years, intval($year), 'id="monthly_report-year-sel" style="width:100px"');
        echo form_fieldset_close();
        
        echo form_fieldset();
            echo form_button(array(
                'type' => 'submit',
                'content' => 'Generate Report',
            ));
            echo form_button(array(
                'type' => 'reset',
                'content' => 'Clear',
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
