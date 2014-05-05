 <table width="90%" cellpadding="0" cellspacing="0" border="0" style="border-top: hidden;border-bottom: hidden;font-size: 13px;">
          <tr>
                    <td class="border-less header" align="center" colspan="7">RESIDENT LISTS</td>
          </tr>
          <tr>
          <th class="border-less" bgcolor=skyblue><b>RESIDENT NAME</b></th>
          <th class="border-less" bgcolor=skyblue><b>CASELOG</b></th>
          <th class="border-less" bgcolor=skyblue><b>LOGIN SUMMARY</b></th>
          <th class="border-less" bgcolor=skyblue><b>PROFILE</b></th>
	  <th class="border-less" bgcolor=skyblue><b>REPORTS LIST</b></th>
          <th class="border-less" bgcolor=skyblue><b>LAST DATE OF ENCODING</b></th>
          </tr>
          <?php
          foreach($residents_information as $res_info):
            $user_id = $res_info->id;
            $date_legend =  date("Y-m-d H:i:s");
            $date1 = new DateTime($res_info->date_encode);
            $date2 = new DateTime($date_legend);
            $diff = $date2->diff($date1);
            $total = $diff->format('%a');
            
          if ($res_info->date_encode == "0000-00-00 00:00:00")
          { $color = "red"; } else { $color = "white";}
          if($total >="0" && $total <="7")
          { $color = "lightgreen"; }
          elseif($total >="8" && $total <="30")
          { $color = "yellow";}
          elseif($total >="31")
          { $color = "red";}
          ?>
          <tr>
            <td width=23% class="answer"><?php echo $res_info->lastname." ".$res_info->firstname." ".$res_info->middle_initials."."; ?></td>
            <td align="center" width=10% class="answer"><a href="<?php echo base_url(); ?>index.php/home/resident_encoded?resident_id=<?php echo $user_id; ?>">VIEW</a></td>
            <td align="center" width=15% class="answer"><a href="<?php echo base_url(); ?>index.php/reports_controller/login_summary?resident_id=<?php echo $user_id; ?>">VIEW</a></td>
          <td align="center" width=15% class="answer">VIEW</a></td>
          <td align="center" width=15% class="answer"><a href="<?php /* echo base_url(); ?>index.php/reports_controller/reports_list?resident_id=<?php echo $user_id; */ ?>">VIEW</a></td>
          <td align="center" width=15% bgcolor="<?php echo $color; ?>"><?php echo $res_info->date_encode; ?></td>
          </tr>
          <?php endforeach; ?>
          <tr>
            <tr>
                <td colspan="4" class="border-less"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
          <tr>
                    <td class="border-less"><b>LEGEND:</b></td>
          </tr>
          <tr>
                    <td class="border-less" colspan=2><b><font color="lightgreen">GREEN</font></b> - Encoding not more than 1 week old </td>
          </tr>
          <tr>
                    <td class="border-less" colspan=3><b><font color="yellow">YELLOW</font></b> - Encoding older than 1 week but not more than 1 month old</td>
          </tr>
          <tr>
                    <td class="border-less" colspan=2><b><font color="red">RED</font></b> - Encoding older than 1 month</td>
          </tr>
            <td colspan="7" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology </td>
          </tr>
</table>