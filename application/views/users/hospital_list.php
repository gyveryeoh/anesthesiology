<table width="90%" cellpadding="0" cellspacing="0">
	  <tr>
		    <th class="header question">INSTITUTIONS LIST</th>
          </tr>
	  <?php
	  foreach($hospital_list as $row):
	  echo "<tr><td class='answer'>".$row->name."</td></tr>";
	  endforeach;
	  ?>
</table>