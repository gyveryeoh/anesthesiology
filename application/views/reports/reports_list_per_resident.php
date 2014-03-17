<?php
if($year == NULL)
{$year = "";}
?>
<table width="80%" cellpadding="1" cellspacing="0">
          <tr>
			<form method="post" action="<?php echo base_url(); ?>index.php/reports_controller/reports_list?resident_id=<?php echo $user_id; ?>">
			<th colspan="2" align="center">
				Filter Year : <select name="year" size="1" style="width: 60px;">
				<?php
				for($x=date('Y');$x>=2013;$x--)
				{
					echo "<option value=".$x."";
					
						if($year == $x)
						{
							echo "selected = selected";
						}
					
					echo ">".$x."</option>";  
				}
				?>
			</select><input type="submit" name="submit" value="submit">
			</th>
			</form>
		  </tr>
		  <tr>
		<th>Techniques</th>
		<th>Count</th>
          </tr>
          <?php
          $total=0;
	foreach($anesth_technique as $tech):
		echo "
		<tr>
		<td>".$tech->name."</td>
		<td align=center>".$count_per_technique[$tech->id]."</td>
		</tr>";
                $total += $count_per_technique[$tech->id];
                endforeach;
                ?>
          <tr><th align="right" class="border-less">TOTAL</th><td style="color: red;text-align: center;border: hidden;"><b><?php echo $total; ?></b></td></tr>
          <tr>
<th>Service</th>
		<th>Count</th>
          </tr>
          <?php
          $total=0;
	foreach($anesth_services as $service):
		echo "
		<tr>
		<td>".$service->name."</td>
		<td align=center>".$count_per_service[$service->id]."</td>
		</tr>";
                $total += $count_per_service[$service->id];
                endforeach;
                ?>
          <tr><th align="right" class="border-less">TOTAL</th><td style="color: red;text-align: center;border: hidden;"><b><?php echo $total; ?></b></td></tr>
	<tr>
		<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
	</tr>
</table>