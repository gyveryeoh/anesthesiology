<<<<<<< HEAD

=======
>>>>>>> 1af75949f27cd9cfd0d3a6ea8cd4534b74c494d4
<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<form method="post" action="<?php echo base_url(); ?>index.php/reports_controller/anesthesia_hours">
<table width="90%" cellpadding="0" cellspacing="2">
        <tr>
<<<<<<< HEAD
                <td class="border-less header" align="center" colspan="3">Total Anesthesia Hours</td>
        </tr>
        <tr>
                <td style='color: red;font-size: 30px;font-weight: bold;' colspan="3" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td>
	</tr>
        <tr <?php if ($user_information['role_id']!=3) {echo "style=display:none;"; } ?>>
                <td class="border-less question" align="right" colspan="2" width="40%">Training Institution</td>
                <td class="border-less answer" colspan="3">
                        <select name="institution_id" style="width: auto;" id="users_info">
							<option value="0">ALL</option>
                              <?php
								foreach($anesth_institutions as $ai):
							  ?>
							  <option value="<?php echo $ai->id?>" <?php if ($ai->id == $institution_id) { echo 'selected="selected"'; }?>><?php echo $ai->name?></option>
							  <?php
							  endforeach;
							  ?>
                        </select>
                </td>
        </tr>
		<tr>
                <td class="border-less question" align="right" colspan="2" width="40%">Year Level</td>
                <td class="border-less answer" colspan="3">
                        <select name="year_level" style="width: auto;" id="users_info">
						<option value="0">All</option>
						<?php for($number = 1; $number <= 5; $number++){
						
							echo "<option value='". $number ."'";
							if($year_level == $number)
							{
								echo 'selected="selected"';
							}
							echo ">".$number."</option>";
						
						}?>
                        </select>
                </td>			
		</tr>
	<tr>
	  <td class="border-less question" align="right" colspan="2">Year</td>
	<td>
<select name="year" size="1"	 style="width: 60px;">
				<option value="0">All</option>
				<?php for($number = date('Y'); $number>=2010; $number--){
						
							echo "<option value='". $number ."'";
							if($year == $number)
							{
								echo 'selected="selected"';
							}
							echo ">".$number."</option>";
						
				}?>
			</select>
	  </td>
	</tr>
	<tr>
	
    </tr>
	<tr>
	  <td colspan=2 class="border-less"></td>
	  <td class="border-less"><input type="submit" name="submit" value="submit"></td>
	</tr>
</table>
</form>

<?php
	echo "<table  width='90%' cellpadding='0' cellspacing='2'>";
	echo "<tr>
				<td align='center'>NAME</td>
				<td align='center'>YEAR LEVEL</td>
				<td align='center'>ANES. HOURS</td>
				<td align='center'>SUBMITTED</td>
				<td align='center'>REVISED</td>
				<td align='center'>FOR REVISION</td>
				<td align='center'>APPROVED</td>
				<td align='center'>DISAPPROVED</td>
				<td align='center'>Revised</td>
				<td align='center'>Open</td>
		</tr>";
	echo $table;
	echo "</table>";
?>
=======
                <td class="border-less header" align="center" colspan="3">TOTAL ANESTHESIA HOURS</td>
        </tr>
        <tr>
                <td style='color: red;font-size: 30px;font-weight: bold;' colspan="3" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td>
</tr>
        <tr <?php if ($user_information['role_id']!=3) {echo "style=display:none;"; } ?>>
        <td class="border-less question" align="right" colspan="2" width="40%">Training Institution</td>
        <td class="border-less answer" colspan="3">
                <select name="institution_id" style="width: auto;" id="users_info">
                        <option value="0">ALL</option>
                        <?php
                        foreach($anesth_institutions as $ai):
                        ?>
                        <option value="<?php echo $ai->id; ?>" <?php if ($ai->id == $this->input->post('institution_id')) { echo 'selected=selected'; }?>><?php echo $ai->name; ?></option>
                        <?php endforeach; ?>
                </select>
        </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2" width="40%">Year Level</td>
                <td class="border-less answer" colspan="3">
                        <select name="year_level" style="width: auto;" id="users_info">
                                <option value="0" <?php if ($this->input->post('year_level') == "0") { echo  "selected=selected"; } ?>">ALL</option>
                                <option value="1" <?php if ($this->input->post('year_level') == "1") { echo  "selected=selected"; } ?>>1</option>
                                <option value="2" <?php if ($this->input->post('year_level') == "2") { echo  "selected=selected"; } ?>>2</option>
                                <option value="3" <?php if ($this->input->post('year_level') == "3") { echo  "selected=selected"; } ?>>3</option>
                                <option value="4" <?php if ($this->input->post('year_level') == "4") { echo  "selected=selected"; } ?>>4</option>
                                <option value="5" <?php if ($this->input->post('year_level') == "5") { echo  "selected=selected"; } ?>>5</option>
                        </select>
                </td>
        </tr>
        <tr>
                <td class="border-less question" align="right" colspan="2">Year</td>
                <td>
                        <select name="year" size="1" style="width: 60px;">
                                <option value="0">ALL</option>
				<?php
				for($x=date('Y');$x>=2010;$x--)
				{
					echo "<option value=".$x."";
					
						if($this->input->post('year') == $x)
						{
							echo "selected = selected";
						}
					
					echo ">".$x."</option>";  
				}
				?>
			</select>
</td>
</tr>
<tr>
</tr>
<tr>
<td colspan=2 class="border-less"></td>
<td class="border-less"><input type="submit" name="submit" value="submit"></td>
</tr>
</table>
</form>
<?php
if (!empty($table)) { ?>
        <table width='90%' cellpadding='0' cellspacing='2' class="border-less">
        <tr>
                <td colspan=9 class="header border-less">RESULT</td>
        </tr>
        <tr class="border-less question">
                <td>RESIDENT NAME</td>
                <td>YEAR LEVEL</td>
                <td>ANESTH. HOURS</td>
                <td>OPEN</td>
                <td>SUBMITTED</td>
                <td>REVISED</td>
                <td>FOR REVISION</td>
                <td>APPROVED</td>
                <td>DISAPPROVED</td>
        </tr>
        <?php echo $table; ?>
        </table>
<?php } ?>
>>>>>>> 1af75949f27cd9cfd0d3a6ea8cd4534b74c494d4
