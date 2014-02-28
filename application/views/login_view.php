<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
          <title>AENDICUS</title>
<noscript>
          <meta http-equiv="refresh" content="0; url=http://oltrap.pchrd.dost.gov.ph/index.php/administrator/javascript/" />
</noscript>
          <link href="<?php echo base_url(); ?>assets/css/style.css" media="screen" rel="stylesheet" type="text/css">
</head>
<table border="1" width="80%" cellpadding="10" cellspacing="0" class="table border-less">
          <tr align="center">
                    
                    <td class="header td_left" colspan="2"><img src="<?php echo base_url();?>assets/images/aendicus.jpg" width="100%" height="100%"></td>
          </tr>
          <tr>
                    <td colspan="2" class="td_top" style="background-color:#FFF5EE; font-family: sans-serif;font-size: 12px;font-weight:bold;">&nbsp;</td>
          </tr>
          <tr>
                    <td colspan="2" class="td_top td_bottom" align="center">Welcome to AENDICUS Database. Please login to proceed. </td>
          </tr>
          <tr align="center">
                    <td colspan="2" class="td_top">
                              <?php echo validation_errors('<p style="background-color:#faadad; width:58%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="../assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;">', '</span></font></p>'); ?>
<body class="body">
<?php echo form_open('verifylogin'); ?>
<table width="60%" cellpadding="1" cellspacing="0" class="border-less">
          <tr>
                    <td class="td_top td_bottom td_left td_right" align="right" style="border: 1px solid dodgerblue;">Username :</td>
                    <td style="border: 1px solid dodgerblue; border-left:hidden;"><input type="text" name="username" size="30">
          </tr>
          <tr>
                    <td class="td_top td_bottom td_left td_right" align="right" style="border: 1px solid dodgerblue;border-top:hidden;">Password :</td>
                    <td style="border: 1px solid dodgerblue; border-left:hidden;border-top:hidden;"><input type="password" size="30" name="password">
          </tr>
          <tr>
                    <td class="td_top td_bottom td_left td_right" align="right" style="border: 1px solid dodgerblue;border-top:hidden;">&nbsp;</td>
                    <td style="border: 1px solid dodgerblue; border-left:hidden;border-top:hidden;"><input type="submit" name="login" value="LOGIN">
          </tr>
</table>
<br><br>
</td>
</tr>
          <tr>
                    <td class="border-less"><b>USER UPDATE as of</b> <b style="color: #069;"><?php echo date('m-d-Y'); ?></b></td>
          </tr>
          <tr>
                    <td class="border-less">OTHER INFORMATION</td>
          </tr>
          <tr>
                    <td class="border-less">FOR DELIVERY</td>
          </tr>
          <tr>
                    <td class="border-less">PROCEDURE</td>
          </tr>
          <tr>
                    <td class="border-less">SEPARATED NEEDLE GUAGE AND ANESTHESIA</td>
          </tr>
          <tr>
                    <td class="border-less">VALIDATION POP UP OF EVERY UPDATE</td>
          </tr>
          <tr>
                    <td class="border-less">ADDED "NONE" CHECKBOX OF CRITICAL EVENTS</td>
          </tr>
<tr>
<td colspan="2" align="center" style="border-top:hidden;" class="border-less"><br><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</table>
</form>
</body>
</html>