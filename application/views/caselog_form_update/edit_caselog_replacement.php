<?php foreach ($patient_information as $data): endforeach; ?>
<div align="center">		   
<form method="post" id="anesth_form"  action="<?php echo base_url(); ?>index.php/edit_caselog_controller/edit_replacement">
<input type="hidden" name="patient_information_id" value="<?php echo $data->patient_information_id; ?>"/>
<input type="hidden" name="patient_form_id" value="<?php echo $data->patient_form_id; ?>"/>
<table border="0" cellpadding="0" width="80%" cellspacing="2" style="font-family: sans-serif; border: solid 1px; font-size: 14px;">
 <tr>
  <td class="border-less header" align="center" colspan="4"><h3>REPLACEMENT</h3></td>
  </tr>
 <tr>
  <td class="border-less" width="20%" bgcolor=skyblue>BLOOD LOSS</td>
  <td class="border-less" colspan="2"  bgcolor=fafad2><select name="blood_loss" style="width: 150px;">
  <?php
  foreach($anesth_blood_loss as $abl)
  {
   echo "<option value='".$abl->id."'";
   foreach($blood_loss as $bl)
   {
    if($bl->name == $abl->name)
    {
     echo "selected='selected'";
     }
     }
     echo ">".$abl->name."</option>";
     }
     ?>
  </select>
   </td>
  </tr>
 <tr>
  <td class="border-less" bgcolor=skyblue>CRYSTALLOIDS</td>
  <td class="border-less" colspan="2" bgcolor=fafad2>
    <input type="radio" name="crystalloids" value="YES" <?php if($data->crystalloids=="YES"){ echo "checked";}?>> YES
    <input type="radio" name="crystalloids" value="NO" <?php if($data->crystalloids=="NO"){ echo "checked";}?>> NO
    <input type="radio" name="crystalloids" value="N/A" <?php if($data->crystalloids=="N/A"){ echo "checked";}?>> N/A</td>
 </tr>
 <tr>
  <td class="border-less" bgcolor=skyblue>COLLOIDS</td>
  <td class="border-less" colspan="2" bgcolor=fafad2>
   <input type="radio" name="colloids" value="YES" id="colloids_used_show" <?php if($data->colloids == "YES"){ echo "checked";}?>> YES
   <input type="radio" name="colloids" value="NO" id="colloids_used_hide" <?php if($data->colloids == "NO"){ echo "checked";}?>> NO</td>
 </tr>
 <?php
 if($data->colloids == "YES") { $display ='style=display:table-row;'; } else { $display='style=display:none;'; } ?>
 <tr id="colloids_used_info" <?php echo $display; ?>>
  <td class="border-less" bgcolor=skyblue>COLLOID USED</td>
  <td class="border-less" colspan="2" bgcolor=fafad2><select name="colloids_used" id="colloids_used" class="colloids_used_info_valid"  style="width: 150px;">
  <?php
  $counter = 0;
  foreach($anesth_colloids_used as $acu)
  {
   echo "<option value='".$acu->name."'";
   if($data->colloids_used == $acu->name)
   {
    echo "selected";
    $counter++;
    }
    if($counter == 0 and $acu->name == "Others")
     {
      echo "selected";
      }
      echo ">".$acu->name."</option>";
      }
      ?>
  </select>
   </td>
  </tr>
  <?php
  $not_in_database = true;
  foreach($anesth_colloids_used as $acu)
  {
   if($acu->name == $data->colloids_used)
    {
	$not_in_database = false;
	break;
    }
  }
  if ($not_in_database)
{
 $display_other_colloids_used = 'display:table-row;';
}
else
{
 $display_other_colloids_used = 'display:none;';
}
?>
 <tr id="other_colloids_used" style=<?php echo $display_other_colloids_used; ?>>
  <td class="border-less" bgcolor=skyblue>OTHERS</td>
  <td class="border-less" bgcolor=fafad2 colspan=2><input type="text" size="20" name="other_colloids_used" class="colloids_used_info_valid" value="<?php if($not_in_database == true)echo $data->colloids_used; ?>"></td>
 </tr>
 <tr>
  <td class="border-less" bgcolor=skyblue>BLOOD PRODUCT USED</td>
  <td class="border-less" colspan="2" BGCOLOR=FAFAD2>
   <input type="radio" name="blood_products_used" value="YES" <?php if($data->blood_products_used=="YES"){ echo "checked";}?>> YES
   <input type="radio" name="blood_products_used" value="NO" <?php if($data->blood_products_used=="NO"){ echo "checked";}?>> NO 
   <input type="radio" name="blood_products_used" value="N/A" <?php if($data->blood_products_used=="N/A"){ echo "checked";}?>> N/A
  </td>
  </tr>
  <tr>
   <td class="border-less"></td><td class="border-less" width="20%" bgcolor=skyblue>FRESH WHOLE BLOOD</td>
   <td class="border-less" BGCOLOR=FAFAD2>
    <input type="radio" name="fresh_whole_blood" value="YES" <?php if($data->fresh_whole_blood=="YES"){ echo "checked";}?>> YES 
    <input type="radio" name="fresh_whole_blood" value="NO" <?php if($data->fresh_whole_blood=="NO"){ echo "checked";}?>> NO
   </td>
   </tr>
  <tr>
   <td class="border-less"></td><td class="border-less" BGCOLOR=SKYBLUE>CYROPRECIPITATE</td>
   <td class="border-less" BGCOLOR=FAFAD2>
    <input type="radio" name="cyroprecipitate" value="YES" <?php if($data->cyroprecipitate=="YES"){ echo "checked";}?>> YES
    <input type="radio" name="cyroprecipitate" value="NO"  <?php if($data->cyroprecipitate=="NO"){ echo "checked";}?>> NO
   </td>
   </tr>
  <tr>
   <td class="border-less"></td><td class="border-less" BGCOLOR=SKYBLUE>PLATELETS</td>
   <td class="border-less" BGCOLOR=FAFAD2>
    <input type="radio" name="platelets" value="YES" <?php if($data->platelets=="YES"){ echo "checked";}?>> YES 
    <input type="radio" name="platelets" value="NO" <?php if($data->platelets=="NO"){ echo "checked";}?>> NO
   </td>
   </tr>
  <tr>
    <td class="border-less"></td><td class="border-less" BGCOLOR=SKYBLUE>FRESH FROZEN PLASMA</td>
    <td class="border-less" BGCOLOR=FAFAD2>
     <input type="radio" name="fresh_frozen_plasma" value="YES" <?php if($data->fresh_frozen_plasma=="YES"){ echo "checked";}?>> YES 
     <input type="radio" name="fresh_frozen_plasma" value="NO" <?php if($data->fresh_frozen_plasma=="NO"){ echo "checked";}?>> NO
    </td>
    </tr>
  <tr>
   <td class="border-less"></td><td class="border-less" BGCOLOR=SKYBLUE>PACKED RBC</td>
   <td class="border-less" BGCOLOR=FAFAD2>
    <input type="radio" name="packed_rbc" value="YES" <?php if($data->packed_rbc=="YES"){ echo "checked";}?>> YES 
    <input type="radio" name="packed_rbc" value="NO" <?php if($data->packed_rbc=="NO"){ echo "checked";}?>> NO
   </td>
   </tr>
  <tr>
   <td class="border-less"></td><td class="border-less" BGCOLOR=SKYBLUE>OTHERS</td>
   <td class="border-less" colspan="2" bgcolor=fafad2>
    <textarea name="others" rows=1 cols="35" class="required"><?php echo $data->others;?></textarea>
    </td>
   </tr>
  <tr>
	    <td class=border-less></td><td class="border-less"><input type="submit" name="submit" value="Save Information"></td>
	   </tr>
     <tr>
<td colspan="3" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</form>	
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>
<script>
$('#colloids_used_show').click(function() {
       var selected = $(this).val();
       if(selected == 'YES')
       {
        $('#colloids_used_info').show();
        $('.colloids_used_info_valid').attr('class','colloids_used_info_required');
		if($('#colloids_used').val() == 'Others')
		{
			  $('#other_colloids_used').show();
			  $('.colloids_used_valid').attr('class','colloids_used_required');
			  
		}
       }
});
    $('#colloids_used_hide').click(function() {
       var selected = $(this).val();
       if(selected == 'NO')
       {
        $('#colloids_used_info').hide();
        $('.colloids_used_info_required').attr('class','colloids_used_info_valid');
		$('#other_colloids_used').hide();
        $('.colloids_used_required').attr('class','colloids_used_valid');
       }
});
    $('#colloids_used').change(function() {
    var selected = $(this).val();
    if(selected == 'Others'){
      $('#other_colloids_used').show();
      $('.colloids_used_info_valid').attr('class','colloids_used_info_required');
    }
    else{
      $('#other_colloids_used').hide();
      $('.colloids_used_info_required').attr('class','colloids_used_info_valid');
    }
});
</script>