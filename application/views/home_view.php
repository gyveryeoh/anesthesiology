<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/home/add_patient">
<table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="2">PATIENTS REGISTRATION</td>
          </tr>
          <tr><td style='color: red;font-size: 30px;font-weight: bold;' colspan="2" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td></tr>
          <tr>
                    <td class="border-less question" width="20%">CASE NUMBER</td>
                    <td class="border-less answer"><input type="text" name="case_number" size="20" class="required" value="<?php echo $this->input->post('case_number'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">LASTNAME INITIAL</td>
                    <td class="border-less answer"><input type="text" name="lastname" size="20" class="required" maxlength="1" value="<?php echo $this->input->post('lastname'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">FIRSTNAME INITIAL</td>
                    <td class="border-less answer"><input type="text" size="20" name="firstname" class="required" maxlength="1" value="<?php echo $this->input->post('firstname'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">MIDDLE INITIAL</td>
                    <td class="border-less answer"><input type="text" size="5" name="middle_initials" class="required" maxlength="4" value="<?php echo $this->input->post('middle_initials'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">GENDER</td>
                    <td class="border-less answer"><select name="gender" class="required" style="width: 120px;">
                              <option value="">Select Gender</option>
                              <option value="M" <?php if ($this->input->post('gender') == 'M') echo "selected"; ?>>Male</option>
                              <option value="F" <?php if ($this->input->post('gender') == 'F') echo "selected"; ?>>Female</option>
                    </select>
          </tr>
          
          <tr>
                    <td class="border-less question">BIRTHDATE</td>
                    <td class="border-less answer">
                    <select name="month" class="required" style="width:80px;">
	    <option value="">MONTH</option>
				<?php
				for ($i = 01; $i <= 12; $i++)
				{
					$value = strlen($i);
					if($value==1)
					{
						$k = "0".$i;
					}
					else
					{
						$k=$i;
					}
					echo "<option value='$k'";
					if ($this->input->post('month') == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
			<select name="day" class="required" style="width: 50px;">
			<option value="">DAY</option>
				<?php
				for ($i = 01; $i <= 59; $i++)
				{
					$value = strlen($i);
					if($value==1)
					{
						$k = "0".$i;
					}
					else
					{
						$k=$i;
					}
					echo "<option value='$k'";
					if ($this->input->post('day') == $i)
					{
						echo "selected='selected'";
					}
						echo ">$k</option>";
					}
				?>
			</select>
                        <select name="year" size="1" style="width: 60px;" class="required">
				<option value="">YEAR</option>
				<?php
			for($x=date('Y');$x>=1900;$x--)
			{
				echo "<option value=\"".$x."\"";
				if($this->input->post('year') == $x)
				echo 'selected';
				echo ">".$x."</option>";  
			}
				?>
			</select>
                    </td>
          </tr>
          <tr>
                    <td class="border-less question">WEIGHT</td>
                    <td class="border-less answer"><input type="text" size="5" name="weight" class="required" maxlength="5" value="<?php echo $this->input->post('weight'); ?>"> KG</td>
          </tr>
          <tr>
                    <td class="border-less" align="right">&nbsp;</td>
                    <td class="border-less"><input type="submit" name="login" value="SAVE INFORMATION">
          </tr>  <tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
</tr>
</table>
</form>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>      