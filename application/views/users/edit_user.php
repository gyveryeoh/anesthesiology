<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/users_controller/edit_user">
<?php foreach($user_info as $row)?>
<input type="hidden" name="user_id" value="<?php echo $row->id;?>"/>
<table width="90%" cellpadding="0" cellspacing="2">
	<?php if($this->session->flashdata("success") !== FALSE){ ?>
	<tr>
                    <?php echo $this->session->flashdata("success");?>
	</tr>
	<?php } ?>
	<tr>
		<td class="border-less header" align="center" colspan="2">EDIT PASSWORD</td>
	</tr>
	<tr><td colspan=2 style="font-weight: bold; color: red;" class="border-less">ATTENTION : USERNAME OF RESIDENT IS PERMANENT</td></tr>
	<tr>
		<td class="border-less question">PASSWORD</td>
		<td class="border-less answer"><input type="password" size="20" name="password" class="required"  value="<?php echo $row->password; ?>">
	</tr>
	<tr>
                <td class="border-less question">CONFIRM PASSWORD</td>
                <td class="border-less answer"><input type="password" size="20" name="confirm_password" class="required" value="<?php echo $row->password; ?>">
        </tr>
	<tr>
		<td class="border-less" align="right">&nbsp;</td>
                <td class="border-less"><br><input type="submit" name="update_password" value="UPDATE">
        </tr>
	<tr>
		<td class="border-less header" align="center" colspan="2">EDIT USER</td>
	</tr>
	<tr <?php if ($user_information['role_id'] != "3") { echo "style=display:none"; } ?>>
		<td class="border-less question">INSTITUTION</td>
		<td class="border-less answer" colspan="2">
			<select name="institution_id" class="required" style="width:auto;">
			<?php
			foreach($hospital_list as $hospital_details)
			{
				echo "<option value='".$hospital_details->id."'";
				if($hospital_details->id == $row->institution_id)
					{
						echo "selected='selected'";
					}
						echo ">".$hospital_details->name."</option>";
			}
                        ?>
		</select>
		</td>
	</tr>
        <tr>
		<td class="border-less question">USERNAME</td>
                <td class="border-less answer"><?php echo $row->username; ?>
	</tr>
	<tr>
		<td class="border-less question" width="20%">LASTNAME</td>
		<td class="border-less answer"><input type="text" name="lastname" size="20" class="required" value="<?php echo $row->lastname; ?>">
        </tr>
        <tr>
	        <td class="border-less question">FIRSTNAME</td>
                <td class="border-less answer"><input type="text" name="firstname" size="20" class="required" value="<?php echo $row->firstname; ?>">
        </tr>
        <tr>
		<td class="border-less question">MIDDLE INITIALS</td>
		<td class="border-less answer"><input type="text" size="20" name="middle_initials" value="<?php echo $row->middle_initials; ?>">
        </tr>
	<tr>
		<td class="border-less question">USER ROLE</td>
		<td class="border-less answer" colspan="2">
			<select name="role_id" class="required" style="width:auto;">
			<?php
			foreach($user_role as $datas)
			{
				echo "<option value='".$datas->id."'";
				if($datas->id == $row->role_id)
					{
						echo "selected='selected'";
					}
						echo ">".$datas->name."</option>";
			}
                        ?>
		</select>
		</td>
	</tr>
	<tr>
		<td class="border-less question">YEAR LEVEL</td>
		<td class="border-less answer" colspan="2">
			<select name="year_level" class="required" style="width:auto;">
			<option value="0" <?php if ($row->year_lvl == "0"){ echo 'selected=SELECTED';} ?></option>NONE</option>
			<option value="1" <?php if ($row->year_lvl == "1"){ echo 'selected=SELECTED';} ?></option>1</option>
			<option value="2" <?php if ($row->year_lvl == "2"){ echo 'selected=SELECTED';} ?></option>2</option>
			<option value="3" <?php if ($row->year_lvl == "3"){ echo 'selected=SELECTED';} ?></option>3</option>
			<option value="4" <?php if ($row->year_lvl == "4"){ echo 'selected=SELECTED';} ?></option>4</option>
			<option value="5" <?php if ($row->year_lvl == "5"){ echo 'selected=SELECTED';} ?></option>5</option>
			<option value="6" <?php if ($row->year_lvl == "6"){ echo 'selected=SELECTED';} ?></option>GRADUATE</option>
		</select>
		</td>
	</tr>
	<tr>
		<td class="border-less question">STATUS</td>
		<td class="border-less answer" colspan="2">
			<select name="status" style="width:auto;">
			<option value="0" <?php if ($row->status == "0"){ echo 'selected=SELECTED';} ?></option>ACTIVE</option>
			<option value="1" <?php if ($row->status == "1"){ echo 'selected=SELECTED';} ?></option>DEACTIVATE</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="border-less" align="right">&nbsp;</td>
                <td class="border-less"><br><input type="submit" name="submit" value="UPDATE">
        </tr>
	<tr>
		<td colspan="2" align="center" class="border-less"><br>Copyright 2013 PBA - Philippine Board of Anestthesiology</td>
	</tr>
</table>
</form>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>   