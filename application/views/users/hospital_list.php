<table width="90%" cellpadding="0" cellspacing="0">
	  <tr>
		    <th class="header question">INSTITUTIONS LIST</th>
          </tr>
	  <?php
	  foreach($hospital_list as $row): ?>
	  <tr>
		    <td><a href="<?php echo base_url(); ?>index.php/home/institution_info?institution_id=<?php echo $row->id; ?>"><?php echo $row->name; ?></a></td>
		    <td>EDIT</td>
	  </tr>
	  <?php endforeach; ?>
</table>