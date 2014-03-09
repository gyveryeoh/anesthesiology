<table width="80%" cellpadding="1" cellspacing="0">
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
		<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
	</tr>
</table>