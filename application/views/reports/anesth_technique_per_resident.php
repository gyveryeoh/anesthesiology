<table width="80%" cellpadding="1" cellspacing="0">
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
		<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
	</tr>
</table>