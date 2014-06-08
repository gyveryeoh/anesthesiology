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
<form method="post" action="<?php echo base_url(); ?>index.php/reports_controller/index">
<table width="90%" cellpadding="0" cellspacing="2">
        <tr>
                <td class="border-less header" align="center" colspan="3">Total Anesthesia Hours</td>
        </tr>
        <tr>
                <td style='color: red;font-size: 30px;font-weight: bold;' colspan="3" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td>
	</tr>
        <tr <?php if ($user_information['role_id']!=3) {echo "style=display:none;"; } ?>>
                <td class="border-less question" align="right" colspan="2" width="40%">Training Institution</td>
                <td class="border-less answer" colspan="3">
                        <select name="user_id" style="width: auto;" id="users_info">
			      <option value="0">ALL</option>
                              <?php
								foreach($anesth_institutions as $ai):
							  ?>
							  <option value="<?php echo $ai->id?>"><?php echo $ai->name?></option>
							  <?php
							  endforeach;
							  ?>
                        </select>
                </td>
        </tr>
		<tr>
                <td class="border-less question" align="right" colspan="2" width="40%">Training Institution</td>
                <td class="border-less answer" colspan="3">
                        <select name="user_id" style="width: auto;" id="users_info">
			      <option value="0">ALL</option>
                              <?php
								foreach($anesth_institutions as $ai):
							  ?>
							  <option value="<?php echo $ai->id?>"><?php echo $ai->name?></option>
							  <?php
							  endforeach;
							  ?>
                        </select>
                </td>			
		</tr>
	<tr>
	  <td class="border-less question" align="right" colspan="2">Year</td>
	<td>
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
	
    </tr>
	<tr>
	  <td colspan=2 class="border-less"></td>
	  <td class="border-less"><input type="submit" name="submit" value="SEARCH"></td>
	</tr>

        <?php if (!empty($count_per_technique)) { ?>
<table width="90%" cellpadding="0" cellspacing="2">
          <tr>
		<th width="40%" class="question header">TECHNIQUE</th>
		<th width="20%" class="question header">TOTAL</th>
		<th class="border-less"></th>
          </tr>
          <?php
          $total=0;
	foreach($anesth_technique as $tech):
		echo "
		<tr>
		<td class='answer'>".$tech->name."</td>
		<td align=center style='font-size:16px;' class='answer'>".$count_per_technique[$tech->id]."</td>
		</tr>";
                $total += $count_per_technique[$tech->id];
                endforeach;
                ?>
          <tr><th align="right" class="border-less" style="font-size: 20px;">TOTAL</th><td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total; ?></b></td></tr>
	<tr>
          <?php } ?>
		<td colspan="3" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
	</tr>
</table>