<form action="<?php echo base_url(); ?>index.php/reports_controller/anesth_region_count" method="POST">
<table>
<?php
	if (!isset($_POST['submit']))
	{
		foreach($anesth_regions as $ar)
		{
			echo "<tr><td colspan='2'>$ar->name</td></td>";
		}
	}
	else
	{
		foreach($anesth_regions as $ar)
		{
			echo "<tr><td colspan>$ar->name</td><td>".$region_count[$ar->id]."</td></td>";
		}	
	}
?>
<tr>
	<td>
		Techniques
	</td>
	<td>
		<select name = "anesth_technique" style="width: auto;" id="users_info">
			<option value = 0> ALL </option>
			<?php
				foreach($anesth_techniques as $at)
				{
				?>
					<option value ="<?php echo $at->id?>" <?php if($technique == $at->id){echo 'selected=select';}?>><?php echo $at->name?></option>
				<?php 
				}
			?>
		</select>
	</td>
</tr>
<tr>
	<td>
		Services
	</td>
	<td>
		<select name = "anesth_service" style="width: auto;" id="users_info">
			<option value = 0> ALL </option>
			<?php
				foreach($anesth_services as $as)
				{
				?>
					<option value ="<?php echo $as->id?>" <?php if($service == $as->id){echo 'selected=select';}?>><?php echo $as->name?></option>
				<?php
				}
			?>
		</select>
	</td>
</tr>
<tr>
	<td colspan="2">
		<input type="submit" name="submit" value="submit"/>
	</td>
</tr>
</table>
</form>