<form method="post" id="myform" autocomplete="off" action="<?php echo base_url(); ?>index.php/users_controller/change_password">
<table width="90%" cellpadding="0" cellspacing="2">
	<tr>
		<td  class="border-less header" align="center" colspan="2">CHANGE PASSWORD</td>
	</tr>
	<?php
		if($error_1 == 1)
		{
	echo '<tr>
	<td colspan="2" align="center"style="background-color:#fafad2; width:90%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:red; font-family:tahoma;font-size: 16px"><b>INVALID OLD PASSWORD</b></td></tr>';
		}
		if($error_2 == 1)
		{
	echo '<tr>
	<td colspan="2" align="center"style="background-color:#fafad2; width:90%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:red; font-family:tahoma;font-size: 16px"><b>PASSWORD DO NOT MATCH</b></td>
	</tr>';
		}
		if($success == 1)
		{
	echo '<tr>
		<td colspan="2" align="center"style="background-color:#fafad2; width:90%; text-align:center; border: green 1px solid; padding:10px 10px 10px 20px; color:green; font-family:tahoma;font-size: 16px"><b>SUCCESSFULLY UPDATED YOUR PASSWORD</b></td>
	</tr>';		
		}
	?>
	
	<tr>
		<td class="border-less question" width="20%">OLD PASSWORD</td>
		<td class="border-less answer"><input type="password" name="old_password" value="<?php echo $this->input->post('old_password'); ?>" class="required"></td>
	</tr>	<tr>
		<td class="border-less question">NEW PASSWORD</td>
		<td class="border-less answer"><input type="password" name="new_password" value="<?php echo $this->input->post('new_password'); ?>" class='required'></td>
	</tr>	<tr>
		<td class="border-less question">CONFIRM PASSWORD</td>
		<td class="border-less answer"><input type="password" name="confirm_password" value="<?php echo $this->input->post('confirm_password'); ?>" class="required"></td>
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