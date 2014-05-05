<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/users_controller/change_password">
<table width="90%" cellpadding="1" cellspacing="0">
	<tr>
		<td  class="border-less header" align="center" colspan="2">Change Password</td>
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
		<td class="border-less" align="right" width="40%">Old Password:</td>
		<td class="border-less"><input type="password" name="old_password" maxlength="25" value="<?php echo $this->input->post('old_password'); ?>" class="required"></td>
	</tr>	<tr>
		<td class="border-less" align="right" width="40%">New Password:</td>
		<td class="border-less"><input type="password" name="new_password" maxlength="25" value="<?php echo $this->input->post('new_password'); ?>" class="required"></td>
	</tr>	<tr>
		<td class="border-less" align="right" width="40%">Confirm Password:</td>
		<td class="border-less"><input type="password" name="confirm_password" maxlength="25" value="<?php echo $this->input->post('confirm_password'); ?>" class="required"></td>
	</tr>
	<tr>
		<td class="border-less" align="right">&nbsp;</td>
		<td class="border-less"><input type="submit" name="login" value="SAVE">
	</tr>
</table>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>