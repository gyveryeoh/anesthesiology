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
                        <td><?php echo $results->charity_primary_elective ?></td>
                        <td><?php echo $results->charity_assist_elective ?></td>
                        <td><?php echo $results->pay_primary_elective ?></td>
                        <td><?php echo $results->pay_assist_elective ?></td>
                        <td><?php echo $results->total_elective ?></td>
                </tr>
                <tr>
                        <td>Emergency</td>
                        <td colspan="2"><?php echo $results->charity_emergency ?></td>
                        <td colspan="2"><?php echo $results->pay_emergency ?></td>
                        <td><?php echo $results->total_emergency ?></td>
                </tr>
                <tr>
                        <td>Total</td>
                        <td colspan="2"><?php echo $results->total_charity ?></td>
                        <td colspan="2"><?php echo $results->total_pay ?></td>>
                        <td><?php echo $results->total_overall ?></td>
                </tr>
        </tbody>
</table>