<<<<<<< HEAD
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
=======

<table border="1" width=90%" cellpadding="0" cellspacing="0" class="table">
        <tr>
                <td align="right" class="border-less" style="background-color:#FFF5EE; font-family: sans-serif;font-size: 10px;font-weight:bold;">
               <?php /* 
                <?php if ($user_information['role_id'] == "1") { ?>
                <a href="<?php echo base_url();?>index.php/reports_controller/institution_view">INSTITUTION SUMMARY REPORT</a>-
                <?php }  */?>
                <?php if ($user_information['role_id'] == "3" || $user_information['role_id'] == "2"){?> 
                <a href="<?php echo base_url();?>index.php/reports_controller/monthly_report">ANESTHESIOLOGY MONTHLY REPORT</a> -
                <?php } ?>
                <a href="<?php echo base_url();?>index.php/reports_controller/anesth_services">SERVICE REPORT</a> -
                <a href="<?php echo base_url();?>index.php/reports_controller/">ANESTHETIC REPORT</a>
                <?php if ($user_information['role_id'] != "3" && $user_information['role_id'] != "2"){?> -
                <a href="<?php echo base_url();?>index.php/users_controller/users_caselog">ENCODED SUMMARY</a></td>
                <?php } ?>
        </tr>
>>>>>>> c681a62e424c6cff72b88ef083ae55b1b2f35f61
</table>