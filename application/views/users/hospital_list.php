<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<table width="90%" cellpadding="1" cellspacing="0">
          <tr>
           <th width="50%">Institution Name</th>
           <th colspan="4">Users</th>
          </tr>
          <?php
		  $index = 0;
		  foreach($hospital_list as $row){
			echo "<tr>
				<td>
					$row->name
				</td>
				<td width='10%'>
				<select name='user' style='width:300px;' id='user_id$index' onChange='act_dec($index)'>
				<option value=''>Select User</option>";
				foreach($user_per_hospital[$row->id] as $row2)
				{
					echo "<option value='$row2->id'>$row2->lastname, $row2->firstname $row2->middle_initials</option>";
				}
			echo "</select>";
			?>
			<?php echo "</td>";
			?>
				<td width='10%'>
					
					<button onclick="report_list(<?php echo $index?>,1)">View Reports</button>
				
				</td>
				
				<td width='10%'>
				
					<button onclick="report_list(<?php echo $index?>,2)">Edit Profile</button>
				
				</td>
				
				<td width='10%' id="activate_deactivate<?php echo $index;?>" style="color:red;">
					
				</td>
		  <?php
			echo "</tr>";
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
<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<script>

	function act_dec($index)
	{
		var user_id = $("#user_id"+$index).val();
		$.ajax({
			type : "POST",
			url  : "<?php echo base_url(); ?>index.php/reports_controller/activate_deactivate",
			data : "user_id=" + user_id + "&index=" + $index,
			success: function(data){
			   $("#activate_deactivate"+$index).html(data);
		}
		});
	}
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
			
		}
		else
		{
			$("#activate_deactivate"+$index	).html("Select User");
		}
		
	}
	
	function a_d($user_id,$index,$id)
	{
			$.ajax({
				type : "POST",
				url  : "<?php echo base_url(); ?>index.php/reports_controller/execute",
				data : "user_id=" + $user_id + "&id=" + $id,
				success: function(data){
				if($id == 1)
				{
					alert("Account Deactivated");
				}
				else
				{
					alert("Account Activated");
				}
				act_dec($index);
			}
			});
	}
</script>