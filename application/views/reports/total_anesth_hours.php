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
<?php echo form_open('reports_controller/total_anesth_hours', array(
    'id' => 'total_anesth_hours-form',
    'autocomplete' => 'off',
)); ?>
<table width="90%" cellpadding="0" cellspacing="0">
    <tr>
            <td class="border-less header" align="center" colspan="11">Total Anesthesia Hours</td>
    </tr>
    <tr <?php echo ($user_information['role_id'] != 3) ? 'style="display:none"' : ''?>>
        <td class="border-less question" align="right" colspan="2"><?php echo form_label('TRAINING INSTITUTION', 'insti_id'); ?></td>
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
        <td class="border-less question" align="right" colspan="2"><?php echo form_label('YEAR LEVEL', 'total_anesth_hours-year_level-sel'); ?></td>
        <td class="border-less answer" colspan="9">
        <?php
        echo form_dropdown('Report[year_level]', $year_levels, intval($year_level), 'id="total_anesth_hours-year_level-sel" style="width:150px"'); ?>
        </td>
    </tr>
    <tr>
        <td class="border-less question" align="right" colspan="2"><?php echo form_label('YEAR', 'total_anesth_hours-year-sel'); ?></td>
        <td class="border-less answer" colspan="9">
        <?php
        echo form_dropdown('Report[year]', $years, intval($year), 'id="total_anesth_hours-year-sel" style="width:150px"'); ?>
        </td>
    </tr>
    <tr>
        <td class="border-less question" align="right" colspan="2">&nbsp;</td>
        <td class="border-less answer" colspan="9"> <?php
        echo form_submit(array(
            'type' => 'submit',
            'name' => 'submit',
            'value' => 'SEARCH',
            'content' => 'Get Hours',
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

<?php if (!empty($total_anesth_hours)): ?>
    <table id="services_grid-tbl" border="0" cellspacing="2" cellpadding="0" width="45%">
        <thead>
            
        </thead>
        <tbody>
            
        <?php foreach ($total_anesth_hours as $data): ?>
        <tr>
            
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
