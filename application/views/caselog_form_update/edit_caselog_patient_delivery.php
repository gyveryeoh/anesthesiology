<?php foreach ($patient_information as $data): endforeach;
if ($data->if_delivery == "YES")
{$display = 'table-data';} else{$display='none';}
?>
<div align="center">
<form method="post" id="anesth_form" action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_delivery">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<input type="hidden" name="anesth_status_id" value="<?php echo $data->anesth_status_id; ?>"/>
<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px;border-bottom: hidden; font-size: 14px;">
 <tr>
  <td class="border-less header" align="center" colspan="4"><h3>DELIVERY</h3></td>
  </tr>
<tr>
  <td class="border-less" bgcolor=skyblue width=25%>IF DELIVERY</td>
  <td class="border-less" colspan="2" bgcolor=fafad2>
   <input type="radio" name="if_delivery" value="YES"  id="show" <?php if($data->if_delivery == "YES"){ echo "checked";}?>> YES
   <input type="radio" name="if_delivery" value="NO"   id="hide" <?php if($data->if_delivery == "NO"){ echo "checked";}?>> NO</td>
 </tr>
</table>
<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px;border-top: hidden; border-bottom: hidden; font-size: 14px; display: <?php echo $display; ?>;" id="add_apgar">
 <tr>
  <td class="border-less header" align="center" colspan="4"><h3>ADDITIONAL APGAR SCORE</h3></td>
  </tr>
<tr>
 <td class="border-less" width=25% bgcolor=skyblue>ADD APGAR SCORE</td>
 <td class="border-less" colspan="2" bgcolor=fafad2>
  <select name="agpar_score_1m" class="agpar_score_required" style="width: 160px;">
 <option value="">Select Apgar Score</option>
 <?php
 foreach($anesth_agpar_score_data as $aasd)
 {
  echo "<option value='".$aasd->id."'>".$aasd->name."</option>";
  }
  ?>
 </select> at 1min.</td>
 </tr>
<tr>
<td class="border-less"></td>
<td class="border-less" colspan="2" bgcolor=fafad2>
 <select name="agpar_score_5m" class="agpar_score_required" style="width: 160px;">
<option value="">Select Apgar Score</option>
<?php
foreach($anesth_agpar_score_data as $aasd)
{
 echo "<option value='".$aasd->id."'>".$aasd->name."</option>";
 }
 ?>
</select> at 5mins.</td>
</tr>
<tr id="agpar_score_10m" style='<?php echo $display; ?>'>
<td class="border-less"></td>
<td class="border-less" colspan="2" bgcolor=fafad2>
 <select name="agpar_score_10m" class="agpar_score_required" style="width: 160px;">
<option value="">Select Apgar Score</option>
<?php
foreach($anesth_agpar_score_data as $aasd)
{
 echo "<option value='".$aasd->id."'>".$aasd->name."</option>";
 }
 ?>
</select> at 10mins.</td>
</tr>
</table>
<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px;border-top: hidden; border-bottom: hidden; font-size: 14px;" id=add_apgar>
      <tr>
 <td class="border-less" width=25%></td>
 <td class="border-less"><input type="submit" name="submit" value="UPDATE INFORMATION"></td>
 </tr>
</table>
</form>
<table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px;border-top: hidden; border-bottom: hidden; font-size: 14px; display: <?php echo $display; ?>;" id="add_apgar">
<?php
        if ($data->if_delivery=="YES")
        {
         foreach ($apgar_information as $apgar_data): ?>
         <form method="post" action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_delivery">
        <input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
         <input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
         <input type=hidden value="<?php echo $apgar_data->id; ?>" name="patient_form_apgar_details_id">
         <?php
         echo "<tr><td class=border-less bgcolor=skyblue width=25%>APGAR SCORE</td>";
         echo "<td class=border-less bgcolor=fafad2><select name=apgar_score_1m style='width: 60px;'>";
         foreach($anesth_agpar_score_data as $aasd): ?>
         <option value="<?php echo $aasd->id; ?>" <?php if ($aasd->id == $apgar_data->apgar_score_1m) echo "selected"; ?>><?php echo $aasd->name; ?></option>
         <?php endforeach; ?>
         </select> at 1min.</td>
          </tr>
          <?php
         echo "<tr><td class=border-less bgcolor=skyblue></td>";
         echo "<td class=border-less bgcolor=fafad2><select name=apgar_score_5m  style='width: 60px;'>";
         foreach($anesth_agpar_score_data as $aasd): ?>
         <option value="<?php echo $aasd->id; ?>" <?php if ($aasd->id == $apgar_data->apgar_score_5m) echo "selected"; ?>><?php echo $aasd->name; ?></option>
         <?php endforeach; ?>
         </select> at 5mins.</td>
          </tr>
          <?php
         echo "<tr><td class=border-less bgcolor=skyblue></td>";
         echo "<td class=border-less bgcolor=fafad2><select name=apgar_score_10m  style='width: 60px;'>";
         foreach($anesth_agpar_score_data as $aasd): ?>
         <option value="<?php echo $aasd->id; ?>" <?php if ($aasd->id == $apgar_data->apgar_score_10m) echo "selected"; ?>><?php echo $aasd->name; ?></option>
         <?php endforeach; ?>
         </select> at 10mins.</td>
          </tr>
    <tr><td class=border-less bgcolor=fafad2></td><td class=border-less bgcolor=fafad2><input type=submit name=update_apgar value=UPDATE></td></tr>
    </form>
    <?php
    endforeach;
    }
    ?>
    </table>
    <table border="0" cellpadding="0" width="90%" cellspacing="2" style="font-family: sans-serif; border: solid 1px;border-top: hidden; font-size: 14px;">
 <tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
<script>$('#show').on('click',function() {
       var selected = $(this).val();
       if(selected == 'YES')
       {
        $('#add_apgar').show();
        $('.agpar_score_valid').attr('class','agpar_score_required');
       }
});
    $('#hide').on('click',function() {
       var selected = $(this).val();
       if(selected == 'NO')
       {
        $('#add_apgar').hide();
        $('.agpar_score_required').attr('class','agpar_score_valid');
       }
});
</script>