<table border="1" width=80%" cellpadding="0" cellspacing="0" class="table">
    <tr>
        <td align="right" class="border-less" style="background-color:#FFF5EE; font-family: sans-serif;font-size: 10px;font-weight:bold;">
        <a href="<?php echo base_url();?>index.php/reports_controller/anesth_services">ANESTHETIC SERVICES REPORT</a> - 
		<?php if ($user_information['role_id'] == "3")
		{
		?>
        <a href="<?php echo base_url();?>index.php/reports_controller/institution_view">INSTITUTION SUMMARY REPORT</a>-
        <a href="<?php echo base_url();?>index.php/reports_controller/caselog_view_superuser">CASELOG SUMMARY REPORT</a>-
        <a href="<?php echo base_url();?>index.php/users_controller/hospital_list">HOSPITAL LIST</a>-
		<?php 
		}
		?>
        <a href="<?php echo base_url();?>index.php/reports_controller/">ANESTHETIC SUMMARY REPORT</a> - 
        <a href="<?php echo base_url();?>index.php/reports_controller/monthly_report">MONTHLY REPORT</a> - 
        <a href="<?php echo base_url();?>index.php/users_controller/users_caselog">ENCODED SUMMARY</a>
        </td>
    </tr>
</table>