<?php foreach ($patient_information as $data): endforeach; ?>
<div align="center">		   
<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_post_op_pain_management_information">
<input type=hidden name=patient_form_id value="<?php echo $patient_form_id; ?>">
<input type=hidden name=patient_information_id value="<?php echo $patient_information_id; ?>">
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="80%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
     <tr>
                <td class="border-less" bgcolor=skyblue colspan=3>POST OP PAIN MANAGEMENT</td>
          </tr>
            <?php
          foreach($anesth_post_op_pain_management_data as $apopmd)
          {
          $apopmd_id[]=$apopmd->id;
          $apopmd_name[]=$apopmd->name;
          }
          foreach($anesth_post_op_pain_management_data_1 as $apopmd1)
          {
          $apopmd_name1[]=$apopmd1->name;
          }
          $apopmd_1 = new ArrayIterator($apopmd_id);
          $apopmd_2= new ArrayIterator($apopmd_name);
          $apopmd_2_2= new ArrayIterator($apopmd_name1);

	$multiIterator = new MultipleIterator();
	$multiIterator->attachIterator($apopmd_1);
	$multiIterator->attachIterator($apopmd_2);
	$multiIterator->attachIterator($apopmd_2_2);

foreach($multiIterator as $combinedArray)
{
          echo "<td width=25% bgcolor=fafad2><input type='checkbox' value='".$combinedArray[0]."' name='post_op_pain_management[]' class='required'";
			foreach($patient_form_post_op_pain_management_details as $pfpopmd)
			{
				if($pfpopmd->apopm_name == $combinedArray[1])
				{
					echo "checked";
				}
			}
		  echo ">".$combinedArray[1]."</td>";
		  echo "<td bgcolor=fafad2><input type='checkbox' value='".$combinedArray[0]."' name='post_op_pain_management_1[]' class='required'";
			foreach($patient_form_post_op_pain_management_details_1 as $pfpopmd1)
			{
				if($pfpopmd1->apopm1_name == $combinedArray[2])
				{
					echo "checked";
				}
			}          
          echo ">".$combinedArray[2]."</td>";
          echo "<tr>";
             }
           ?>
     <tr><td class="border-less"></td></tr>
	   <tr>
	    <td class="border-less"></td>
	    <td class="border-less"><input type="submit" name="submit" value="Save Information"></td>
	   </tr>
	   <tr>
<td colspan="3" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</form>	
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>