<div align="center">
	<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/users_controller/update_profile">
	<table border="0" cellpadding="0" width="90%" cellspacing="2" autocomplete="off">
		<tr>
			<td class="border-less header" align="center" colspan="2">PROFILE</td>
		</tr>
		<?php
		 if(isset($message))
		 {
			echo "<tr>
			<td colspan=2 align='center' class='border-less'><p style='background-color:#fafad2; width:80%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;'><font size='3' color='green'><span style='padding-top:10px;'><b>".$message."</b></span></font></p></td></tr>";
		 }
		?>
		<tr>
			<td class="border-less question" width=20%>FIRSTNAME</td>
			<td class="border-less answer" align="left" colspan="2"><input type="text" name="firstname" value="<?php echo $user_information['firstname']; ?>" class="required" size="25"></td>
		</tr>
		<tr>
			<td class="border-less question">LASTNAME</td>
			<td class="border-less answer" align="left" colspan="2"><input type="text" name="lastname" value="<?php echo $user_information['lastname']; ?>" class="required" size="25"></td>
		</tr>
		<tr>
			<td class="border-less question">MIDDLE INITIALS</td>
			<td class="border-less answer" align="left" colspan="2"><input type="text" name="middle_initials" value="<?php echo $user_information['middle_initials']; ?>" class="required" size="25" maxlength="4"></td>
		</tr>
		<tr>
			<td class="border-less question">PRC NUMBER</td>
			<td class="border-less answer" align="left" colspan="2"><input type="text" name="prc_number" value="<?php echo $user_information['prc_number']; ?>" class="required" size="25"></td>
		</tr>
		<tr>
			<td class="border-less"></td>
			<td class="border-less"><input type="submit" name="update" value="Save Information"></td>
		</tr>
		<tr>
			<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
		</tr>
	</table>
	</form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>