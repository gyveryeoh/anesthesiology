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
<?php echo form_open('reports_controller/annual_report', array(
    'id' => 'annual_report-form',
    'autocomplete' => 'off',
)); ?>
<table width="90%" cellpadding="0" cellspacing="0">
        <tr>
                <td class="border-less header" align="center" colspan="11">Resident Trainee's Annual Anesthetic Service Summary</td>
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
                <td class="border-less question" align="right" colspan="2"><?php echo form_label('YEAR', 'annual_report-year-sel'); ?></td>
                <td class="border-less answer" colspan="9">
                <?php
                echo form_dropdown('Report[year]', $years, intval($year), 'id="annual_report-year-sel" style="width:150px"'); ?>
                </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2">&nbsp;</td>
                <td class="border-less answer" colspan="9"> <?php
                echo form_submit(array(
                    'type' => 'submit',
                    'name' => 'submit',
                    'value' => 'SEARCH',
                    'content' => 'Get Summary',
                ));
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

<?php if (!empty($annual_service_summary_grid)): ?>
    <table id="services_grid-tbl" border="0" cellspacing="2" cellpadding="0" width="45%">
        <thead>
            <tr>
                <th class="question border-less">SERVICE</th>
                <?php foreach ($month_labels as $month): ?>
                    <th class="question border-less"><?php echo $month; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            
        <?php foreach ($annual_service_summary_grid as $data): ?>
        <tr>
            <th align="left" class="answer"><?php echo $data->service_name; ?></th>
            <?php foreach ($month_labels as $month): ?>
                <td class="answer <?php echo ((strtoupper($month) == 'TOTAL' or strtoupper($data->service_name) == 'TOTAL') ? 'total-cell' : ''); ?>"><?php echo empty($data->$month) ? '-' : $data->$month; ?></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
