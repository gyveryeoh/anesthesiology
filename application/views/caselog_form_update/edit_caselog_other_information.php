<?php 
foreach ($patient_information as $data):
endforeach;
?>
<div align="center">
<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_other_information">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="80%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
<tr>
 <td class="border-less header" align="center" colspan="4">OTHER INFORMATION</td>
</tr>
    <tr>
 <td class="border-less" bgcolor="SkyBlue" width=25%>POST OPERATIVE DIAGNOSIS</td>
 <td class="border-less" align="left" colspan="2" bgcolor="FAFAD2"><textarea name="post_operative_diagnosis" class="required" cols="35"><?php echo $data->post_operative_diagnosis; ?></textarea></td>
</tr>
<tr>
 <td class="border-less" bgcolor="SkyBlue">DISCHARGE NOTES</td>
 <td class="border-less" align="left" colspan="2" bgcolor="FAFAD2"><textarea name="discharge_notes" class="required" cols="35"><?php echo $data->discharge_notes; ?></textarea></td>
</tr>
<tr>
  <td class="border-less" bgcolor=skyblue>OTHER NOTES</td>
  <td class="border-less" colspan="2" BGCOLOR=FAFAD2><textarea name="other_notes" class="required" cols="35"><?php echo $data->other_notes; ?></textarea> </td>
  </tr>
<tr>
          <tr>
 <td class="border-less"></td>
 <td class="border-less"><input type="submit" name="submit" value="Update Information"></td>
 </tr>
 <tr>
<td colspan="2" align="center" class="border-less"><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</form>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>