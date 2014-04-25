<?php 
foreach ($patient_information as $data): endforeach; 
foreach($institution_details as $name): endforeach;
$date1 = new DateTime($data->birthdate);
?>
<div align="center">
<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_patient_information">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="80%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 10px;">
    <tr>
		<td class="border-less header" align="center" colspan="2"><h3>PATIENT INFORMATION</h3></td>
    </tr>
    <tr>
        <td width="20%" class="border-less question">DATE CREATED</td>
        <td class="border-less answer"><?php echo $data->date_created; ?></td>
    </tr>
    <tr>
        <td width="20%" class="border-less question">RESIDENT NAME</td>
        <td class="border-less answer"><?php echo ucwords(strtolower($data->lastname)).", ".ucwords($data->firstname)." ".ucwords($data->middle_initials)."."; ?></td>
    </tr>
    <tr>
        <td class="border-less question">TRAINING INSTITUTION</td>
        <td class="border-less answer"><?php echo  $name->name; ?></td>
    </tr>
    <tr>
        <td class="border-less question">HOSPITAL ROTATION</td>
        <td class="border-less answer"><?php echo  $data->hospital_rotation_name; ?></td>
    </tr>
    <tr>
        <td class="border-less question">OPERATION DATE</td>
        <td class="border-less answer" align="left" colspan="2"><input type="text" id="datepicker-example11" name="operation_date" size="10" class="required" value="<?php echo $data->operation_date; ?>"></td>
          
    </tr>
    <tr>
        <td class="border-less question">LEVEL OF INVOLVEMENT</td>
        <td class="border-less answer" colspan="2"><select name="level_of_involvement" style="width: 210px;">
	   <option value="P" <?php if ($data->level_of_involvement =="P") { echo 'selected="selected"';}?>>Primary Anesthesiology</option>
	   <option value="A" <?php if ($data->level_of_involvement =="A") { echo 'selected="selected"';}?>>Assist</option>
	    </select>
	</td>
    </tr>
    <tr>
        <td class="border-less question">TYPE OF PATIENT</td>
        <td class="border-less answer">
		<select name="type_of_patient" style="width: 150px;">
		<option value="C" <?php if ($data->type_of_patient == 'C') { echo  'selected' ; } ?>>Charity</option>
	        <option value="P" <?php if ($data->type_of_patient == 'P') { echo  'selected' ; } ?>>Pay</option>
		</select>
		</td>
    </tr>
    <tr>
	<td class="border-less question">ASA</td>
        <td class="border-less answer">
			<select name="asa" style="width: 90px;">
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
	<td class="border-less question">EMERGENCY</td>
	<td class="border-less answer">		
		<select name="for_emergency" style="width: 90px;">
		<option value="N" <?php if ($data->for_emergency == 'N') { echo  'selected' ; } ?>> NO</option>
	        <option value="Y" <?php if ($data->for_emergency == 'Y') { echo  'selected' ; } ?>> YES</option>
		</select>
		</td>
    </tr>
    <tr>
        <td class="border-less question">CASE NUMBER</td>
        <td class="border-less answer"><?php echo $data->case_number; ?></td>
    </tr>
    <tr>
        <td class="border-less question">LASTNAME</td>
	<td class="border-less answer"><input type="text" name="lastname" value="<?php echo ucwords($data->patient_information_lastname[0])?>" size="5" class="required"/></td>
    </tr>
    <tr>
        <td class="border-less question">FIRSTNAME</td>
	<td class="border-less answer"><input type="text" name="firstname" value="<?php echo ucwords($data->patient_information_firstname[0])?>" size="5" class="required"/></td>
    </tr>
    <tr>
        <td class="border-less question">MIDDLE INITIALS</td>
	<td class="border-less answer"><input type="text" name="middlename" value="<?php echo ucwords($data->patient_information_middle_initials[0])?>" size="5" class="required"/></td>
    </tr>
    <tr>
        <td class="border-less question">BIRTHDATE</td>
        <td class="border-less answer">
		MONTH<select name="a_month" style="width:80px;">
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
			DATE<select name="a_day"  style="width: 50px;">
			<?php
		    for ($i = 01; $i <= 31; $i++)
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
            YEAR<select name="a_year" size="1" style="width: 60px;">
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
    <tr>
        <td class="border-less question">GENDER</td>
        <td class="border-less answer">
		<select name="gender" style="width:90px;">
	   <option value="M" <?php if ($data->gender == 'M') { echo  'selected' ; } ?>>Male</option>
	   <option value="F" <?php if ($data->gender == 'F') { echo  'selected' ; } ?>>Female</option>
	    
		</select>
		</td>
    </tr>
    <tr>
        <td class="border-less question">WEIGHT</td>
        <td class="border-less answer"><input name="weight" value='<?php echo $data->weight; ?>' size=4 class="required"> KG</td>
    </tr>
    <tr>
	<td class="border-less"></td><td class="border-less "><BR><input type="submit" name="Save Information" value="UPDATE"></td>
    </tr>
    <tr>
	<td colspan="2" align="center" class="border-less"><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
    </tr>
</table>
</div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>