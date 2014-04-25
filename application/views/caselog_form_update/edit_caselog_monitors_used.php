<?php foreach ($patient_information as $data): endforeach; ?>
<div align="center">		   
<form method="post" id="anesth_form" autocomplete="off"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_monitors_used_information">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="80%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
 <tr>
  <td class="border-less" bgcolor="skyblue" colspan="4">MONITORS USED</td>
  </tr>
 <tr>
  <td class="border-less" colspan="2"  bgcolor=FAFAD2><input type="checkbox" style="display: none;" name='monitors_used[]' class='monitors_used_required'></td>
  <?php
          foreach($anesth_monitor_data as $amd)
          {
            echo "<tr><td class='border-less' width=20% bgcolor=FAFAD2><input type='checkbox' name='monitors_used[]' value='".$amd->id."'";
			foreach($patient_form_monitors_used_details as $pfmu)
			{
				if($pfmu->name == $amd->name)
				{
					echo "checked";
				}
			}
			echo ">".$amd->name."</td><td class=border-less bgcolor=FAFAD2></td></tr>";
          }
     //Other Monitors Used
     if($data->other_monitors_used == "NULL")
     {
      $display ='style=display:none;';
      }
      else
      {
       $display='style=display:block;';
       }
       ?>
       <tr>
	<td bgcolor='FAFAD2'><input type="checkbox" name="other_monitors_used" id="81" value="other_monitors_used_checkbox" <?php if($data->other_monitors_used != "NULL"){echo "checked=checked";}?>>Others Please Specify : </td>
	<td class="border-less"  id="other_monitors_used" <?php echo $display; ?>  bgcolor=FAFAD2><input type="text" size="20" name="other_monitors_used_data" class="other_monitors_used_valid" value="<?php if($data->other_monitors_used == "NULL") {echo "";} else { echo $data->other_monitors_used; }?>"></td>
 </tr>
       <tr>
	<td class="border-less"></td><td class="border-less"><input type="submit" name="submit" value="Save Information"></td>
	</tr>
       <tr>
	<td colspan="3" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
       </tr>
</table>
</form>	
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
<script>
$('input[id="81"]').change(function(){
    var pClass = '.'+$(this).val();
    if ($(this).is(':checked')){
        
      $('#other_monitors_used').show('slow');
      $('.other_monitors_used_valid').attr('class','other_monitors_used_required');
      $('.monitors_used_required').attr('class','monitors_used_valid');
    }
    else{
      $('#other_monitors_used').hide();
      $('.other_monitors_used_required').attr('class','other_monitors_used_valid');
      $('.monitors_used_valid').attr('class','monitors_used_required');
    }
});
</script>