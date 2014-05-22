<form method="post" id="myform" autocomplete="off" action="<?php echo base_url(); ?>index.php/users_controller/change_password">
<table width="90%" cellpadding="0" cellspacing="2">
	<tr>
		<td  class="border-less header" align="center" colspan="2">CHANGE PASSWORD</td>
	</tr>
	<?php
		if($error_1 == 1)
		{
	echo '<tr>
		<td  class="border-less" style="color: red" align="center" colspan="2">Invalid Old Password</td>
	</tr>';
		}
		if($error_2 == 1)
		{
	echo '<tr>
		<td  class="border-less" style="color: red" align="center" colspan="2">Password Does Not Match</td>
	</tr>';
		}
		if($success == 1)
		{
	echo '<tr>
		<td  class="border-less" style="color: green" align="center" colspan="2">Password Changed!</td>
	</tr>';		
		}
	?>
	
	<tr>
		<td class="border-less question" width="20%">OLD PASSWORD</td>
		<td class="border-less answer"><input type="password" name="old_password" maxlength="25" value="<?php echo $this->input->post('old_password'); ?>" class="required"></td>
	</tr>	<tr>
		<td class="border-less question">NEW PASSWORD</td>
		<td class="border-less answer"><input type="password" name="password" value="<?php echo $this->input->post('new_password'); ?>" class='required'></td>
	</tr>	<tr>
		<td class="border-less question">CONFIRM PASSWORD</td>
		<td class="border-less answer"><input type="password" name="confirm_password" maxlength="25" value="<?php echo $this->input->post('confirm_password'); ?>" class="required"></td>
	</tr>
	<tr>
		<td class="border-less" align="right">&nbsp;</td>
		<td class="border-less"><input type="submit" name="login" value="SAVE">
	</tr>
</table>
</form>
<script>
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
</body>
</html>