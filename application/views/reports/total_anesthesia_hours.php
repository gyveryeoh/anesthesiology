
<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<form method="post" action="<?php echo base_url(); ?>index.php/reports_controller/anesthesia_hours">
<table width="90%" cellpadding="0" cellspacing="2">
        <tr>
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