 <table width="80%" cellpadding="0" cellspacing="0" border="0" style="border-top: hidden;border-bottom: hidden;font-size: 13px;">
          <tr>
                    <td class="border-less header" align="center" colspan="5">RESIDENT LISTS</td>
          </tr>
          <tr>
          <th class="border-less" bgcolor=skyblue><b>RESIDENT NAME</b></th>
          <th class="border-less" bgcolor=skyblue><b>CASELOG</b></th>
          <th class="border-less" bgcolor=skyblue><b>LOGIN SUMMARY</b></th>
          <th class="border-less" bgcolor=skyblue><b>PROFILE</b></th>
		  <th class="border-less" bgcolor=skyblue><b>REPORTS LIST</b></th>
          <th class="border-less" bgcolor=skyblue><b>LAST DATE OF ENCODING</b></th>
          </tr>
          <?php foreach($residents_information as $res_info):
            $user_id = $res_info->id;
            
          if ($res_info->date_encode == NULL || $res_info->date_encode == "")
          {
            $color = "green";
          }else{
            $color = "fafad2";
          }
          ?>
          <tr>
            <td width=23% class="answer"><?php echo $res_info->lastname." ".$res_info->firstname." ".$res_info->middle_initials."."; ?></td>
            <td align="center" width=10% class="answer"><a href="<?php echo base_url(); ?>index.php/home/resident_encoded?resident_id=<?php echo $user_id; ?>">VIEW</a></td>
            <td align="center" width=15% class="answer"><a href="<?php echo base_url(); ?>index.php/reports_controller/login_summary?resident_id=<?php echo $user_id; ?>">VIEW</a></td>
          <td align="center" width=15% class="answer">VIEW</a></td>
          <td align="center" width=15% class="answer"><a href="<?php echo base_url(); ?>index.php/reports_controller/reports_list?resident_id=<?php echo $user_id; ?>">VIEW</a></td>
          <td align="center" width=15% bgcolor="<?php echo $color; ?>"><?php echo $res_info->date_encode; ?></td>
          </tr>
          <?php endforeach; ?>
          <tr>
            <tr>
                <td colspan="4" class="border-less"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
            <td colspan="5" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
          </tr>
</table>