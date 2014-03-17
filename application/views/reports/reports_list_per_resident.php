<?php
if($year == NULL)
{$year = "";}
?>

<table width="80%" cellpadding="1" cellspacing="0">
<form method="post" action="#">
<tr>
<th colspan="2" align="center">
Institution : <select name="institution" size="1" style="width: 300px;" id="category">
<option ="">Select Institution</option>
<?php
foreach($anesth_institutions as $ai):
echo "<option value='".$ai->id."'>".$ai->name."</option>";
endforeach
?>
</select>
</br>
Resident Name : <select id="sub_category" name="sub_category" style="width: 250px;">
<option value="">Select Resident</option>
</select>
</br>
Filter Year : <select name="year" size="1" style="width: 60px;">
<?php
for($x=date('Y');$x>=1900;$x--)
{
echo "<option value=".$x."";

if($year == $x)
{
echo "selected = selected";
}

echo ">".$x."</option>";
}
?>
</select>
</br>
<input type="submit" name="submit" value="submit">
</th>
</tr>
</form>
<tr>
</table>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#category").change(function() {
$.get('<?php echo base_url();?>index.php/reports_controller/get_resident_per_institution?inst_id=' + $(this).val(), function(data) {
$("#sub_category").html(data);
});
});
});
</script>