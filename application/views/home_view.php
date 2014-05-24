<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/home/add_patient">
<table width="90%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="5">PATIENTS REGISTRATION</td>
          </tr>
          <tr>
                    <td class="border-less question" width="20%">CASE NUMBER</td>
                    <td class="border-less answer" colspan=4><input type="text" name="case_number" size="20" class="required" value="<?php echo $this->input->post('case_number'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">LASTNAME INITIAL</td>
                    <td class="border-less answer" colspan=4><input type="text" name="lastname" size="20" class="required" maxlength="1" value="<?php echo $this->input->post('lastname'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">FIRSTNAME INITIAL</td>
                    <td class="border-less answer" colspan=4><input type="text" size="20" name="firstname" class="required" maxlength="1" value="<?php echo $this->input->post('firstname'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">MIDDLE INITIAL</td>
                    <td class="border-less answer" colspan=4><input type="text" size="5" name="middle_initials" class="required" maxlength="4" value="<?php echo $this->input->post('middle_initials'); ?>">
          </tr>
          <tr>
                    <td class="border-less question">GENDER</td>
                    <td class="border-less answer" colspan=4><select name="gender" class="required" style="width: auto;">
                              <option value="">Select Gender</option>
                              <option value="M" <?php if ($this->input->post('gender') == 'M') echo "selected"; ?>>Male</option>
                              <option value="F" <?php if ($this->input->post('gender') == 'F') echo "selected"; ?>>Female</option>
                    </select>
          </tr>
          
          <tr>
                    <td class="border-less question">BIRTHDATE</td>
                    <td class="border-less answer" colspan=4>
                    <select name="month" class="required" style="width:auto;">
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
			<select name="day" class="required" style="width: auto;">
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
                        <select name="year" size="1" style="width:auto;" class="required">
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
                    <td class="border-less answer" colspan=4><input type="text" size="5" name="weight" class="required" maxlength="5" value="<?php echo $this->input->post('weight'); ?>"> KG</td>
          </tr>
          <tr>
                    <td class="border-less" align="right">&nbsp;</td>
                    <td class="border-less"><br><input type="submit" name="login" value="SAVE INFORMATION">
          </tr>
          <?php if (isset($message)){?>
          <tr>
                <td class="border-less" align="center" colspan="5" style="color: red;"><h1>RESULT</h1></td>
        </tr>
        <tr bgcolor=skyblue>
                <th>CASE NUMBER</th>
                <th>INITIALS</th>
                <th>GENDER</th>
                <th>BIRTHDATE</th>
                <th>WEIGHT</th>
        </tr>
          <?php foreach($case_number as $row)
          {
          echo "<tr align='center' bgcolor=fafad2>
          <td><h2><a href='".base_url()."index.php/home/anesthesiology_form/".$row->id."'>".$row->case_number."</a></h2></td>
          <td><h2>".$row->lastname."-".$row->firstname."-".$row->middle_initials."</h2></td>
          <td><h2>".$row->gender."</h2></td>
          <td><h2>".$row->birthdate."</h2></td>
          <td><h2>".$row->weight." KG</h2></td>
          </tr>";
          }
          ?>
          <tr>
                    <?php
          }
                    ?>
          <tr>
                    <td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
          </tr>
</table>
</form>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>      