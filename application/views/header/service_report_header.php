<table border="1" width=90%" cellpadding="0" cellspacing="0" class="table">
        <tr>
                <td align="right" class="border-less" style="background-color:#FFF5EE; font-family: sans-serif;font-size: 10px;font-weight:bold;">
               <?php /* 
                <?php if ($user_information['role_id'] == "1") { ?>
                <a href="<?php echo base_url();?>index.php/reports_controller/institution_view">INSTITUTION SUMMARY REPORT</a>-
                <?php }  */?>
                <?php if ($user_information['role_id'] == "3" || $user_information['role_id'] == "2"){?> 
                <?php } ?>
                <a href="<?php echo base_url();?>index.php/reports_controller/anesth_services">MONTHLY SERVICE REPORT</a> -
                <a href="<?php echo base_url();?>index.php/reports_controller/annual_service_report">ANNUAL SERVICE REPORT</a>
        </tr>
</table>