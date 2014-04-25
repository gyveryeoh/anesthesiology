<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/users_controller/save_user">
 
 <table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="2">ADD NEW USER</td>
          </tr>
          <tr><td style='color: red;font-size: 30px;font-weight: bold;' colspan="2" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td></tr>
          <tr><td style='color: red;font-size: 30px;font-weight: bold;' colspan="2" class="border-less" align="center"><?php if (isset($user_message)){ echo $user_message; } ?></td></tr>
             <?PHP
	     if($this->session->flashdata("success") !== FALSE)
	     {
	       echo "<tr><td style='color: red;font-size: 30px;font-weight: bold;' colspan=2 class=border-less align=center>".$this->session->flashdata("success")."</td></tr>";
	       }
	  ?>
	  <tr>
                    <td class="border-less question" width=20%>INSTITUTION</td>
                    <td class="border-less answer" colspan="2">
                        <select name="institution_id" class="required" style="width:520px;">
                              <option value="">SELECT INSTITUTION</option>
                              <?php
                              foreach($institutions_list as $data)
                              {
                               echo "<option value='".$data->id."'>".$data->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
	  <tr>
                    <td class="border-less question">LASTNAME</td>
                    <td class="border-less answer"><input type="text" name="lastname" size="20" class="required" value="<?php echo $this->input->post('lastname'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">FIRSTNAME</td>
                    <td class="border-less answer"><input type="text" name="firstname" size="20" class="required" value="<?php echo $this->input->post('firstname'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">MIDDLE INITIALS</td>
                    <td class="border-less answer"><input type="text" size="20" name="middle_initials" class="required" value="<?php echo $this->input->post('middle_initials'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">USERNAME</td>
                    <td class="border-less answer"><input type="text" size="20" name="username" class="required"  value="<?php echo $this->input->post('username'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">PASSWORD</td>
                    <td class="border-less answer"><input type="password" size="20" name="password" class="required"  value="<?php echo $this->input->post('password'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">CONFIRM PASSWORD</td>
                    <td class="border-less answer"><input type="password" size="20" name="confirm_password" class="required" value="<?php echo $this->input->post('confirm_password'); ?>">
          </tr>
	  <tr>
                    <td class="border-less question">USER ROLE</td>
                    <td class="border-less answer" colspan="2">
                        <select name="role_id" class="required" style="width:220px;">
                              <option value="">Select Role</option>
                              <?php
                              foreach($user_role as $datas)
                              {
                               echo "<option value='".$datas->id."'>".$datas->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
          </tr>
          <tr>
                    <td class="border-less" align="right">&nbsp;</td>
                    <td class="border-less"><BR><input type="submit" name="login" value="SAVE">
          </tr>  <tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
</tr>
</table>
</form>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
       