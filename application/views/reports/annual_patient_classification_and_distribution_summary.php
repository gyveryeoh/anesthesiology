<form method="post" action="<?php echo base_url(); ?>index.php/reports_controller/annual_patient_classification_and_distribution_summary">
<table width="90%" cellpadding="0" cellspacing="2">
        <tr>
                <td class="border-less header" align="center" colspan="3">ANNUAL PATIENT CLASSIFICATION AND DISTRIBUTION SUMMARY</td>
        </tr>
        <tr>
                <td style='color: red;font-size: 30px;font-weight: bold;' colspan="3" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td>
	</tr>
        <tr <?php if ($user_information['role_id'] !=3) {echo "style=display:none;"; } ?>>
                <td class="border-less question" align="right" colspan="2">HOSPITAL </td>
                <td class="border-less answer" colspan="3">
                        <select name="institution_id">
                                <option value="">-SELECT INSTITUTION-</option>
                                <?php
                                foreach ($institution_list as $ai):
                                ?>
                                <option value="<?php echo $ai->id; ?>" <?php if ($ai->id == $this->input->post('institution_id')) { echo 'selected=selected'; }?>><?php echo $ai->name; ?></option>
                                <?php
                                endforeach;
                                ?>
                        </select>
                </td>
        </tr>
	<tr>
	  <td class="border-less question" align="right" colspan="2">YEAR</td>
	  <td class="border-less answer">
	    <select name="year" size="1" style="width: 60px;">
		<option value="0">ALL</option>
				<?php
				for($x=date('Y');$x>=2010;$x--)
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
                              <option value="0">ALL</option>
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
<table width="90%" cellpadding="0" cellspacing="2">
          <tr>
		<th width="30%" class="question header">ASA CLASSIFICATION</th>
		<th width="10%" class="question header">TOTAL</th>
		<th width="14%" class="question header">EMERGENCY</th>
		<th width="14%" class="question header">1ST YEAR</th>
		<th width="14%" class="question header">2ND YEAR</th>
		<th width="14%" class="question header">3RD YEAR</th>
		<th width="14%" class="question header">4TH YEAR</th>
		<th width="14%" class="question header">5TH YEAR</th>
		<th class="border-less"></th>
          </tr>
          <?php
	  
          $total_asa=0;
          $total_emergency=0;
          $total_year1=0;
          $total_year2=0;
          $total_year3=0;
          $total_year4=0;
          $total_year5=0;
	  if(!empty($count_asa))
	  {
	foreach($anesth_asa as $asa):
		echo "
		<tr>
		<td class='answer'>".$asa->name."</td>
		<td align=center style='font-size:16px;' class='answer'>".$count_asa[$asa->id]."</td>";
		echo "<td align=center style='font-size:16px;' class='answer'>".$count_emergency[$asa->id]."</td>
		<td align=center style='font-size:16px;' class='answer'>".$count_1st_year[$asa->id]."</td>
		<td align=center style='font-size:16px;' class='answer'>".$count_2nd_year[$asa->id]."</td>
		<td align=center style='font-size:16px;' class='answer'>".$count_3rd_year[$asa->id]."</td>
		<td align=center style='font-size:16px;' class='answer'>".$count_4th_year[$asa->id]."</td>
		<td align=center style='font-size:16px;' class='answer'>".$count_5th_year[$asa->id]."</td>
		</tr>";
		$total_asa += $count_asa[$asa->id];
		$total_emergency += $count_emergency[$asa->id];
		$total_year1 += $count_1st_year[$asa->id];
		$total_year2 += $count_2nd_year[$asa->id];
		$total_year3 += $count_3rd_year[$asa->id];
		$total_year4 += $count_4th_year[$asa->id];
		$total_year5 += $count_5th_year[$asa->id];
                endforeach;
                ?>
          <tr><th align="right" class="border-less" style="font-size: 20px;">TOTAL</th>
	    <td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total_asa; ?></b></td>
	    <td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total_emergency; ?></b></td>
	    <td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total_year1; ?></b></td>
	    <td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total_year2; ?></b></td>
	    <td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total_year3; ?></b></td>
	    <td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total_year4; ?></b></td>
	    <td style="color: red;text-align: center;border: hidden;font-size: 20px;"><b><?php echo $total_year5; ?></b></td>
	  </tr>
	  <?php } ?>
	<tr>
		<td colspan="8" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
	</tr>
</table>
