<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<table width="80%" cellpadding="1" cellspacing="0">
          <tr>
           <th width="50%">Institution Name</th>
           <th>Users</th>
          </tr>
          <?php
		  $index = 0;
		  foreach($hospital_list as $row){
			echo "<tr>
				<td>
					$row->name
				</td>
				<td>
				<select name='user' style='width:400px;' id='user_id$index'>
				<option value=''>Select User</option>";
				foreach($user_per_hospital[$row->id] as $row2)
				{
					echo "<option value='$row2->id'>$row2->lastname, $row2->firstname $row2->middle_initials</option>";
				}
			echo "</select>";
			?>
				<button onclick="report_list(<?php echo $index?>,1)">View Reports</button>
				<button onclick="report_list(<?php echo $index?>,2)">Edit Profile</button>
				<button onclick="report_list(<?php echo $index?>,3)">Deactivate</button>
				<div id="mess<?php echo $index?>" style="color:red"></div>
			<?php echo "</td></tr>";
			$index++;
		  }
          ?>
           <tr>
                <td colspan="7"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
           <tr>
            <td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
           </tr>
</table>
<script>
    function report_list($index,$button)
	{
		var user = $("#user_id"+$index).val();
		if(user != '')
		{
			if($button == 1)
			{
				document.location.href='<?php echo base_url(); ?>index.php/reports_controller/reports_list?resident_id='+user;
			}
			else if($button == 2)
			{
				document.location.href='<?php echo base_url(); ?>index.php/users_controller/edit_user?resident_id='+user;
			}
			else
			{
				alert("fuck");
			}
		}
		else
		{
			$("#mess"+$index).html("Select User");
		}
	}
</script>