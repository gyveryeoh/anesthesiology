<table id="patient_type_matrix-tbl" border="1">
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
            <th></th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td>Elective</td>
            <td><?php echo $patient_type_matrix->charity_primary_elective ?></td>
            <td><?php echo $patient_type_matrix->charity_assist_elective ?></td>
            <td><?php echo $patient_type_matrix->pay_primary_elective ?></td>
            <td><?php echo $patient_type_matrix->pay_assist_elective ?></td>
            <td><?php echo $patient_type_matrix->total_elective ?></td>
        </tr>
        <tr>
            <td>Emergency</td>
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
