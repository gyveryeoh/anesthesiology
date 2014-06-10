<?php foreach ($patient_information as $data): endforeach;
	     //Other Main Agents
	   if($data->other_main_agent == "NULL")
	   {
		   $display ='style=display:none;';
	   }
	   else
	   {
		   $display='style=display:block;';
	   }
	   ?>
<div align="center">		   
<form method="post" id="anesth_form" autocomplete="off"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_main_agents_information">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
 <tr>
                    <td class="border-less" bgcolor="skyblue" colspan="4">MAIN AGENT</td>
          </tr>
          <tr>
            <td class="border-less" colspan="2"><input type="checkbox" style="display: none;" name='main_agent[]' class='main_agent_required'></td>
          <?php
          $num_cols = 3;
          $current_col = 0;
          $x = 0;
          foreach($anesth_agent_data as $aad):
          if($current_col == "0")echo "<tr>";
           echo "<td bgcolor='FAFAD2'><input type='checkbox' value='".$aad->id."' id='main_agent' name='main_agent[]'";
		  foreach($main_agents_details as $pfma)
		  {
			if($pfma->id == $aad->id)
			{
				echo "checked";
				break;
			}
		  }
		  
		  
		  echo ">".$aad->name."</td>";
		  
		  if($current_col == $num_cols-1)
          {
            echo "</tr>";
            $current_col = 0;
            }
            else
            {
                $current_col++;
            }
            $x++;
            endforeach;
	   ?>
	    <tr>
            <td bgcolor='FAFAD2'><input type="checkbox" name="other_main_agent" id="81" value="other_main_agent_checkbox" <?php if($data->other_main_agent != "NULL"){echo "checked=checked";}?>>Others Please Specify : </td>
            <td class="border-less"  id="other_main_agent" <?php echo $display; ?>><input type="text" size="20" name="other_main_agent_data" class="other_main_agent_valid" value="<?php if($data->other_main_agent == "NULL") echo ""; else { echo $data->other_main_agent; }?>"></td>
          </tr>
	    <tr><td class="border-less"><BR></td></tr>
	   <tr>
	    <td class="border-less"><input type="submit" name="submit" value="Save Information"></td>
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
      $('#other_main_agent').show('slow');
      $('.other_main_agent_valid').attr('class','other_main_agent_required');
      $('.main_agent_required').attr('class','main_agent_valid');
    }
    else{
      $('#other_main_agent').hide();
      $('.other_main_agent_required').attr('class','other_main_agent_valid');
      $('.main_agent_valid').attr('class','main_agent_required');
    }
});
$('input[id="main_agent"]').prop(function(){
    var pClass = '.'+$(this).val();
    if ($(this).is(':unchecked'))
    {
      $('.main_agent_required').attr('class','main_agent_valid');
    }
});
</script>