<?php foreach ($patient_information as $data): endforeach;
?>

<div align="center">
	<form method="post" id="anesth_form" autocomplete="off"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_diagnosis_information">
	<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
	<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
	<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
	<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
		<tr>
			<td class="border-less header" align="center" colspan="4">DIAGNOSIS INFORMATION</td>
		</tr>
		 <tr>
                    <td colspan="2" align="center" class="border-less"><?php if($this->session->flashdata("failed") !== FALSE){ echo $this->session->flashdata("failed"); }?></td>
          </tr>
		<tr>
			<td class="border-less question">DIAGNOSIS</td>
			<td class="border-less answer"><textarea name="diagnosis" cols="35" row="7" class="required"><?php echo $data->diagnosis; ?></textarea></td>
		</tr>
		<tr>
			<td class="border-less question">CO-MORBID DISEASES</b></td>
			<td class="border-less answer"><textarea name="comorbid_diseases" class="required" cols="35"><?php echo $data->comorbid_diseases; ?></textarea></td>
		</tr>
		<tr>
			<td class="border-less question">SERVICE</td>
			<td class="border-less answer">
				<select name="service" style="width: 700px;">
				<?php
				foreach($anesth_services_data as $ser):
				echo "<option value='".$ser->id."'";
				if ($ser->id == $data->service)
				{
					echo "selected='selected'";
					}
					echo ">".$ser->name."</option>";
				endforeach;
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="border-less question">ANESTHETIC TECHNIQUE</td>
			<td class="border-less answer">
				<select name="anesthetic_technique" style="width: 360px;" id="anesthetic_technique">
			<?php
			foreach($anesth_technique_data as $and):
			echo "<option value='".$and->id."'";
			if ($and->id == $data->anesthetic_technique)
			{
				echo "selected='selected'";
			}
			echo ">".$and->name."</option>";
			endforeach;
			?>
				</select>
			</td>
		</tr>
		<?php if ($data->anesthetic_technique == "9")
		{
			$display = 'display:table-row;';
		}
		else
		{
			$display = 'display:none;';
		}
		if ($data->anesthetic_technique == "3")
		{
			$critical_events = 'display:table-row;';
			$required = 'required';
		?>
		<?php
		}
		else
		{
			$critical_events = 'display:none;';
			$required = 'valid';
		}
		?>
		<tr id="peripheral_data" style="<?php echo $display; ?>">
		<td class="border-less answer"></td>
		<td class="border-less answer">
			<select name="peripheral" class="peripheral_valid" style="width:370px;">
				<option value="">Select Peripheral Nerve Blocks and Pain Techniques</option>
				<?php
				foreach($apnbapt_data as $apnbapt)
				{
					echo "<option value='".$apnbapt->id."'";
					if ($apnbapt->id == $data->peripheral)
					{
						echo "selected='selected'";
						}
						echo ">".$apnbapt->name."</option>";
						}
				?>
			</select>
		</td>
		</tr>
		<tr>
			<td class="border-less question">AIRWAY</td>
			<td class="border-less answer">
				<select name="airway" class="required" id="airway">
				<?php
				$not_in_database = true;
				foreach($anesth_airway_data as $aad):
				if($aad->name == $data->airway)
				{
					$not_in_database = false;
				break;
				}
				endforeach;
				foreach($anesth_airway_data as $aad):
				echo "<option value='".$aad->name."'";
				if ($aad->name == $data->airway )
				{
					echo "selected='selected'";
				}
				if($not_in_database == true and $aad->name == "Others (pls specify):")
				{
					echo "selected='selected'";
				}
				echo ">".$aad->name."</option>";
				endforeach;
				?>
				</select>
			</td>
		</tr>
		<?php if ($not_in_database == "Others (pls specify):")
		{
			$airway_display = 'display:table-row;';
		}
		else
		{
			$airway_display = 'display:none;';
		}
		?>
		<tr style="<?php echo $airway_display; ?>" id="other_airway">
			<td class="border-less question" width=25%>OTHER AIRWAY</td>
			<td class="border-less answer"><input type="text" size="20" name="other_airway" class="airway_valid" value="<?php if($not_in_database == true)echo $data->airway; ?>"></td>
		</tr>
          <tr>
 <td class="border-less"></td>
 <td class="border-less"><input type="submit" name="save" value="Save Information"></td>
 </tr>
 <tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>