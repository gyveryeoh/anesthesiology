<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
          <title>AENDICUS</title>
          <style>
                    .blink_me {
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
    
    -moz-animation-name: blinker;
    -moz-animation-duration: 1s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: infinite;
    
    animation-name: blinker;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    font-size: 20PX;
    color: RED;
}

@-moz-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}
          </style>
<noscript>
          <meta http-equiv="refresh" content="0; url=http://oltrap.pchrd.dost.gov.ph/index.php/administrator/javascript/" />
</noscript>
          <link href="<?php echo base_url(); ?>assets/css/style.css" media="screen" rel="stylesheet" type="text/css">
</head>
<table border="1" width="90%" cellpadding="10" cellspacing="0" class="table border-less">
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
                    <td class="td_top td_bottom td_left td_right question" align="right" style="border: 1px solid dodgerblue;">USERNAME</td>
                    <td style="border: 1px solid dodgerblue; border-left:hidden;" class="answer"><input type="text" name="username" size="30">
          </tr>
          <tr>
                    <td class="td_top td_bottom td_left td_right question" align="right" style="border: 1px solid dodgerblue;border-top:hidden;">PASSWORD</td>
                    <td style="border: 1px solid dodgerblue; border-left:hidden;border-top:hidden;" class="answer"><input type="password" size="30" name="password">
          </tr>
          <tr>
                    <td class="td_top td_bottom td_left td_right answer" align="right" style="border: 1px solid dodgerblue;border-top:hidden;">&nbsp;</td>
                    <td style="border: 1px solid dodgerblue; border-left:hidden;border-top:hidden;" class=answer><input type="submit" name="login" value="LOGIN">
          </tr>
          <tr>
                    <td colspan=2 class="header">AENDICUS II UPDATE AS OF JUNE 04, 2014</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* FIXED ERROR OF MAIN AGENTS, SUPPLEMENTARY AGENTS, AND POST OP AGENTS UPDATE MODULE.</td>
          </tr>
          <tr>
                    <td colspan=2 class="header">AENDICUS II UPDATE AS OF MAY 28, 2014</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* SERVICE MONTHLY AND ANNUAL REPORT</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* ANESTHETIC TECHNIQUE MONTHLY REPORT</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* ANESTHESIOLOGY MONTHLY REPORT</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* CASELOG SEARCH MODULE</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* ADDED LEGEND IN USER'S LIST</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* UPDATE/EDIT USER'S PASSWORD AND PROFILE</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* BLOOD PRODUCT USED</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* ADDED FELLOW ROLE</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* ADDED CASELOG SEARCH IN PBA USERS</td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">* ADDED TOTAL RESULT FOUND IN CASELOG SEARCH</td>
          </tr>
                    <td class="answer" colspan="2">* FIXED CHANGE PASSWORD ERROR</td>
          </tr>
          <tr>
                    <td class="answer blink_me" colspan="2"><b>REMINDER for TRAINING OFFICERS</b></td>
          </tr>
          <tr>
                    <td class="answer" colspan="2">please update the year level of the residents for future reports. Found in "SUBMITTED FORM > PROFILE > EDIT USER</td>
          </tr>
<br><br>
</td>
</tr>
<tr>
<td colspan="2" align="center" style="border-top:hidden;" class="border-less"><br><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology </td>
</tr>
</table>
</table>
</form>
</body>
</html>