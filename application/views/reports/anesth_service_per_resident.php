<script src="<?php echo base_url() ?>assets/javascript/jquery.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $("#insti_id").change(function(){
            var insti_id = $("#insti_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>index.php/reports_controller/get_resident_per_institution",
               data : "insti_id=" + insti_id,
               success: function(data){
                   $("#users_info").html(data);
               }
            });
        });
    });
</script>
<form method="post" action="<?php echo base_url(); ?>index.php/reports_controller/anesth_services">
<table width="90%" cellpadding="0" cellspacing="2">
        <tr>
                <td class="border-less header" align="center" colspan="3">SERVICE REPORT</td>
        </tr>
        <tr>
                <td style='color: red;font-size: 30px;font-weight: bold;' colspan="3" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td>
	</tr>
        <tr <?php if ($user_information['role_id'] !=3) {echo "style=display:none;"; } ?>>
                <td class="border-less question" align="right" colspan="2">HOSPITAL </td>
                <td class="border-less answer" colspan="3">
                        <select name="hospital_id" id="insti_id">
                                <option value="">-SELECT HOSPITAL-</option>
                                <?php
                                foreach ($institution_list as $ai):
                                ?>
                                <option value="<?php echo $ai->id; ?>" <?php if ($ai->id == $this->input->post('hospital_id')) { echo 'selected=selected'; }?>><?php echo $ai->name; ?></option>
                                <?php
                                endforeach;
                                ?>
                        </select>
                </td>
        </tr>
        <tr <?php if ($user_information['role_id'] !=3 && $user_information['role_id'] !=2) {echo "style=display:none;"; } ?>>
                <td class="border-less question" align="right" colspan="2" width="40%">RESIDENT NAME</td>
                <td class="border-less answer" colspan="3">
                        <select name="user_id" style="width: auto;" id="users_info">
			      <option value="0" <?php if ($user_information['id'] == 3) { echo 'selected=selected'; }?>>SELECT RESIDENT</option>
                              <?php
                              foreach($users_list as $list): ?>
                              <option value="<?php echo $list->id; ?>" <?php if ($list->id == $user_information['id'] || $list->id == $this->input->post('user_id')) { echo 'selected=selected'; }?>><?php echo $list->lastname.", ".$list->firstname." ".$list->middle_initials; ?></option>
                              <?php endforeach; ?>
                        </select>
                </td>
        </tr>
	<tr>
	  <td class="border-less question" align="right" colspan="2">DATE</td>
	  <td class="border-less answer">
		    <select name="month" style="width: auto;">
<?php
for($i=1;$i<13;$i++)
{
	  $monthName = date("F", mktime(0, 0, 0, $i, 10));
	  $value = strlen($i);
	  if($value==1)
	  {
		    $k = "0".$i;
		    }
		    else
		    {
			      $k=$i;
		    }
		    echo "<option value='$k'";
		    if ($this->input->post('month') == $i)
		    {
			      echo "selected='selected'";
		    }
		    echo ">$monthName</option>";
	  }

?>
</select> -
<select name="year" size="1" style="width: 60px;">
				<?php
				for($x=date('Y');$x>=2013;$x--)
				{
					echo "<option value=".$x."";
					
						if($this->input->post('year') == $x)
						{
							echo "selected = selected";
						}
					
					echo ">".$x."</option>";  
				}
				?>
			</select>
	  </td>
	</tr>
	<tr>
                <td class="border-less question" align="right" colspan="2">STATUS</td>
                <td class="border-less answer" colspan="3">
                        <select name="status_id" style="width: auto;">
                              <option value="8">Open</option>
                              <?php
                              $x=0;
                              foreach($status_list as $list):
                              $list_id[$x] = $list->id;
                              $list_name[$x] = $list->name;
                              $x++;
                              endforeach;
			      ?>
			           
				    <option value="<?php echo $list_id[0];?>"<?php if ($this->input->post('status_id') == $list_id[0]) {echo "selected=selected";} ?>><?php echo $list_name[0]; ?></option>
                                    <option value="<?php echo $list_id[2];?>"<?php if ($this->input->post('status_id') == $list_id[2]) {echo "selected=selected";} ?>><?php echo $list_name[2]; ?></option>
                                    <option value="<?php echo $list_id[5];?>"<?php if ($this->input->post('status_id') == $list_id[5]) {echo "selected=selected";} ?>><?php echo $list_name[5]; ?></option>
                                    <option value="<?php echo $list_id[3];?>"<?php if ($this->input->post('status_id') == $list_id[3]) {echo "selected=selected";} ?>><?php echo $list_name[3]; ?>d</option>
                                    <option value="<?php echo $list_id[4];?>"<?php if ($this->input->post('status_id') == $list_id[4]) {echo "selected=selected";} ?>><?php echo $list_name[4]; ?>d</option>";
                              
                        </select>
                </td>
        </tr>
	<tr>
	  <td colspan=2 class="border-less"></td>
	  <td class="border-less"><input type="submit" name="submit" value="SEARCH"></td>
	</tr>
<?php if (!empty($count_per_service)) { ?>
<table width="90%" cellpadding="1" cellspacing="0">
          <tr>
		<th width="40%" class="question header">SERVICE</th>
		<th width="20%" class="question header">TOTAL</th>
		<th class="border-less"></th>
          </tr>
          <?php
		    $total=0;
		    foreach($anesth_services as $service):
		    if ($count_per_service[$service->id] == "0")
		    {
			      $count_per_service[$service->id] = "-";
			      }
			      echo "
		<tr>
		<td class='answer'>".$service->name."</td>
		<td align=center style='font-size:16px;' class='answer'>".$count_per_service[$service->id]."</td>
		</tr>";
                $total += $count_per_service[$service->id];
                endforeach;
                ?>
          <tr><th align="right" class="border-less" style="font-size: 20px;">TOTAL</th><td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total; ?></b></td></tr>
	<tr>
	  <?php } ?>
		<td colspan="3" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
	</tr>
</table>