 <script type="text/javascript">
      $(document).ready(function() {
      $("#patient_form").validate();
      });
    </script>
<form method="post" id="patient_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/users_controller/save_user">
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
                    <td class="border-less" align="right" width="40%">Lastname :</td>
                    <td class="border-less"><input type="text" name="lastname" size="20" class="required" value="<?php echo $this->input->post('lastname'); ?>">
          </tr>
          <tr>
                    <td class="border-less" align="right">Firstname :</td>
                    <td class="border-less"><input type="text" name="firstname" size="20" class="required" value="<?php echo $this->input->post('firstname'); ?>">
          </tr>
          <tr>
                    <td class="border-less" align="right">Middle Initials :</td>
                    <td class="border-less"><input type="text" size="20" name="middle_initials" class="required" value="<?php echo $this->input->post('middle_initials'); ?>">
          </tr>
          <tr>
                    <td class="border-less" align="right">Username :</td>
                    <td class="border-less"><input type="text" size="20" name="username" class="required"  value="<?php echo $this->input->post('username'); ?>">
          </tr>
          <tr>
                    <td class="border-less" align="right">Password :</td>
                    <td class="border-less"><input type="password" size="20" name="password" class="required"  value="<?php echo $this->input->post('password'); ?>">
          </tr>
          <tr>
                    <td class="border-less" align="right">Confirm Password :</td>
                    <td class="border-less"><input type="password" size="20" name="confirm_password" class="required" value="<?php echo $this->input->post('confirm_password'); ?>">
          </tr>
          <tr>
                    <td class="border-less" align="right">Institution :</td>
                    <td class="border-less">UP - PGH</td>
          </tr>
	  <tr>
                    <td class="border-less" align="right">User Role :</td>
                    <td class="border-less" colspan="2">
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
                    <td class="border-less"><input type="submit" name="login" value="SAVE">
          </tr>  <tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</form>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
       