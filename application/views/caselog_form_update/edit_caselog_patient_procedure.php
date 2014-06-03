<?php 
foreach ($patient_information as $data):
endforeach;
?>
<div align="center">
<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_procedure">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
<tr>
 <td class="border-less header" align="center" colspan="4">PROCEDURE INFORMATION</td>
</tr>
<tr>
 <td class="border-less" bgcolor="SkyBlue" width=30%>PROCEDURE DONE</td>
 <td class="border-less" align="left" colspan="2" bgcolor="FAFAD2"><textarea name="procedure_done" cols="35" row="7" class="required"><?php echo $data->procedure_done; ?></textarea></td>
</tr>
<tr>
 <td class="border-less" bgcolor="SkyBlue">OTHER PROCEDURE</td>
 <td class="border-less" align="left" colspan="2" bgcolor="FAFAD2"><textarea name="other_procedure" class="required" cols="35"><?php echo $data->other_procedure; ?></textarea></td>
</tr>
<tr>
  <td class="border-less" bgcolor=skyblue>MUSCLE RELAXANT REVERSAL DONE</td>
  <td class="border-less" colspan="2" BGCOLOR=FAFAD2>
   <input type="radio" name="muscle_relaxant_reversal_done" value="YES" <?php if($data->muscle_relaxant_reversal_done=="YES"){ echo "checked";}?>> YES
   <input type="radio" name="muscle_relaxant_reversal_done" value="NO" <?php if($data->muscle_relaxant_reversal_done=="NO"){ echo "checked";}?>> NO 
   <input type="radio" name="muscle_relaxant_reversal_done" value="N/A" <?php if($data->muscle_relaxant_reversal_done=="N/A"){ echo "checked";}?>> N/A
  </td>
  </tr>
<tr>
          <tr>
 <td class="border-less"></td>
 <td class="border-less"><input type="submit" name="submit" value="Save Information"></td>
 </tr>
 <tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>