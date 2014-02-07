<?php 
foreach ($patient_information as $data){}
$date1 = new DateTime($data->birthdate);
?>
<div align="center">
<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_patient_information">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<table border="0" cellpadding="0" width="80%" cellspacing="5" style="font-family: sans-serif; border: solid 1px; font-size: 10px;">
    <tr>
        <td width="15%">Resident Name</td>
        <td width="20%">: <?php echo ucwords(strtolower($data->lastname)).", ".ucwords($data->firstname)." ".ucwords($data->middle_initials)."."; ?></td>
    </tr>
    <tr>
        <td colspan="4" class="border-less"></td>
        <td align="right"  class="border-less" width="25%"><b>Operation Date :</b></td>
                    <td class="border-less" align="left" colspan="2"><input type="text" id="datepicker-example11" name="operation_date" size="10" class="required" value="<?php echo $data->operation_date; ?>"></td>
          
    </tr>
    <tr>
        <td class="border-less">Training Institution</td>
        <td class="border-less">: UPCM-PGH Medical Center</td>
        <td colspan="2" class="border-less"></td>
        <td align="right" class="border-less"><b>Level of Involvement :</b></td>
        <td width="15%" class="border-less" colspan="2"><select name="level_of_involvement" style="width: 210px;">
	   <option value="P" <?php if ($data->level_of_involvement =="P") { echo 'selected="selected"';}?>>Primary Anesthesiology</option>
	   <option value="A" <?php if ($data->level_of_involvement =="A") { echo 'selected="selected"';}?>>Assist</option>
	    </select>
	</td>
    </tr>
    </tr>
    <tr>
        <td colspan="3" class="border-less">Hospital Rotation</td>
        <td class="border-less"></td>
        <td align="right"  class="border-less"><b>Weight :</b></td>
        <td align="left" colspan="2" class="border-less"><input name="weight" value='<?php echo $data->weight; ?>' size=4 class="required"> KG</td>
    </tr>
    <tr>
        <td class="border-less" align="right"><b>Case Number :</b></td>
        <td class="border-less"><?php echo $data->case_number; ?></td>
    </tr>
    <tr>
        <td align="right" class="border-less"><b>Birthdate :</b></td>
        <td colspan="5" class="border-less">
		Month :<select name="a_month" style="width:80px;">
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
				if ($date1->format("m") == $i)
				{
				    echo "selected='selected'";
				    }
				    echo ">$k</option>";
		    }
				?>
			</select>
			Date :<select name="a_day"  style="width: 50px;">
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
				if ($date1->format("d") == $i)
				{
				    echo "selected='selected'";
				    }
				    echo ">$k</option>";
		    }
				?>
			</select>
            Year :<select name="a_year" size="1" style="width: 60px;">
				<?php
			for($x=date('Y');$x>=1900;$x--)
			{
				echo "<option value=\"".$x."\"";
				if($date1->format("Y") == $x)
				echo 'selected';
				echo ">".$x."</option>";  
			}
				?>
			</select>
		</td>
    </tr>
        <td width="7%" align="right" class="border-less"><b>Gender :</b></td>
        <td class="border-less">
		<select name="gender">
	   <option value="M" <?php if ($data->gender == 'M') { echo  'selected' ; } ?>>Male</option>
	   <option value="F" <?php if ($data->gender == 'F') { echo  'selected' ; } ?>>Female</option>
	    
		</select>
		</td>
        <td width="15%" align="right" class="border-less"><b>Type of Patient :</b></td>
        <td colspan=2 class="border-less">
		<select name="type_of_patient">
		<option value="C" <?php if ($data->type_of_patient == 'C') { echo  'selected' ; } ?>>Charity</option>
	        <option value="P" <?php if ($data->type_of_patient == 'P') { echo  'selected' ; } ?>>Pay</option>
		</select>
		</td>
    </tr>
    <tr>
        <td class="border-less" align="right"><b>Patient Lastname Initial :</b></td>
	<td class="border-less"><input type="text" name="lastname" value="<?php echo ucwords($data->patient_information_lastname[0])?>" size="5" class="required"/></td>
    </tr>
    <tr>
        <td class="border-less" align="right"><b>Patient Firstname Initial :</b></td>
	<td class="border-less"><input type="text" name="firstname" value="<?php echo ucwords($data->patient_information_firstname[0])?>" size="5" class="required"/></td>
    </tr>
    <tr>
        <td class="border-less" align="right"><b>Patient Middle Initial :</b></td>
	<td class="border-less"><input type="text" name="middlename" value="<?php echo ucwords($data->patient_information_middle_initials[0])?>" size="5" class="required"/></td>
    </tr>
    <tr>        <td align="right" class="border-less"><b>ASA :</b></td>
        <td class="border-less">
			<select name="asa">
			<?php
			for($x=1;$x<=6;$x++)
			{
				echo "<option value=\"".$x."\"";
				if($data->asa == $x)
				echo 'selected';
				echo ">".$x."</option>";  
			}
				?>
			</select>
		</td>
    </tr>
<tr>
    <td align="right" class="border-less"><b>Emegency:</b></td>
<td class="border-less">		
		<select name="for_emergency">
		<option value="N" <?php if ($data->for_emergency == 'N') { echo  'selected' ; } ?>>No</option>
	        <option value="Y" <?php if ($data->for_emergency == 'Y') { echo  'selected' ; } ?>>Yes</option>
		
		</select>
		</td>
    </tr>
	<tr>
	<td class="border-less header">
		<input type="submit" name="Save Information" value="Save Information">
	</td>
	</tr>
	 <tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>