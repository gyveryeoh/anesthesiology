<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
          <meta charset="UTF-8">
                    <link REL="SHORTCUT ICON" HREF="<?php echo base_url(); ?>assets/images/icon.png">
          <title>AENDICUS II</title>
<noscript>
          <meta http-equiv="refresh" content="0; url=http://oltrap.pchrd.dost.gov.ph/index.php/administrator/javascript/" />
</noscript>
          <link href="<?php echo base_url(); ?>assets/css/style.css" media="screen" rel="stylesheet" type="text/css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker/style.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker/default.css">
          <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker/style_date.css">
          <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/datepicker/shCoreDefault.css">
          <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/XRegExp.js"></script>
          <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/shCore.js"></script>
          <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/shLegacy.js"></script>
          <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/shBrushJScript.js"></script>
          <script type="text/javascript">
            //Datepicker
	    SyntaxHighlighter.defaults['toolbar'] = false;
            SyntaxHighlighter.all();     
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery.js"></script>
        <script>
	//Datepicker Format
	$(document).ready(function(){
	$('#datepicker-example11').Zebra_DatePicker({
          direction: false,
        format: 'Y-m-d'
	});
	$('#datepicker-example14').Zebra_DatePicker({
           direction: false,
        format: 'Y-m-d'
	});
	$('#datepicker-example13').Zebra_DatePicker({
          direction: false,
        format: 'Y-m-d'
	});
	$('#datepicker-example12').Zebra_DatePicker({
        view: 'years'
	});
        });
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery.validate.min.js"></script>
<script type="text/javascript">
      $(document).ready(function() {
      $('form').each(function(){
          $(this).validate({
rules: {
new_password: {
required: true,
rangelength: [6, 32]
}
}
});
   });
   });
    </script>
</head>
<table border="1" width="90%" cellpadding="0" cellspacing="0" class="table">
          <tr align="center">
                    <td class="header td_left" colspan="2"><img src="<?php echo base_url();?>assets/images/aendicus.jpg" width="100%" height="100%"></td>
</tr>
          <tr>
                    <td class="border-less" style="background-color:#FFF5EE; font-family: sans-serif;font-size: 16px;font-weight:bold;" colspan=>&nbsp; You are logged in as : <?php echo ucwords($user_information['lastname']).", ".ucwords($user_information['firstname'])." ".ucwords($user_information['middle_initials'])."."; ?></td>
                    <td align="right" class="border-less" style="background-color:#FFF5EE; font-family: sans-serif;font-size: 10px;font-weight:bold;">
                    <a href="<?php echo base_url();?>index.php/reports_controller/anesth_services">REPORTS</a> |
                     
                    <?php
                    if ($user_information['role_id'] == "1" || $user_information['role_id'] == "4")
                    {
                    ?>
                              <a href="<?php echo base_url();?>index.php/home/">HOME</a> |
                     <?php } ?>
                     <?php
                    if ($user_information['role_id'] == "3")
                    {
                    ?>
                              <a href="<?php echo base_url();?>index.php/users_controller/hospital_list">INSTITUTIONS LIST</a> |
                     <?php } ?>
                              <a href="<?php echo base_url(); ?>index.php/users_controller/change_password">USERS</a> |
                    <?php
                    if ($user_information['role_id'] == "2" || $user_information['role_id'] == "3")
                    {
                              echo '<a href="'.base_url().'index.php/search_controller/searchcaselog">FIND CASELOG</a> |';
                    }
                    if ($user_information['role_id'] == "2")
                    {
                    echo ' <a href="'.base_url().'index.php/home/resident_lists">SUBMITTED FORM</a> |';
                    }
                    ?>
                    <a href="<?php echo base_url();?>index.php/home/logout">LOGOUT</a> 
                    </td>
          </tr>
</table>