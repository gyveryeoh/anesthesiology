 <table width="90%" cellpadding="0" cellspacing="0" border="0" style="border-top: hidden;border-bottom: hidden;font-size: 13px;">
          <tr>
                    <td class="border-less header" align="center" colspan="5">LOGIN SUMMARY</td>
          </tr>
          <tr>
          <td class="border-less" bgcolor=skyblue width=20%>TOTAL NUMBERS LOGGED</td>
          <td class="border-less" bgcolor=fafad2><?php echo $total_number; ?></td>
    
          </tr>
         <tr>
          <td class="border-less" bgcolor=skyblue>RESIDENT NAME</td>
          <?php foreach($resident_information as $res_info): ?>
          <td class="border-less" bgcolor=fafad2><?php echo ucwords($res_info->lastname)." ".ucwords($res_info->firstname)." ".ucwords($res_info->middle_initials); ?></td>
          <?php endforeach; ?>
          </tr>
          <?php foreach($login_summary as $data): ?>
          <tr bgcolor="fafad2">
            <td colspan=2><?php echo $data->login_date; ?></td>
          </tr>
          <?php endforeach; ?>
          <tr>
            <tr>
                <td colspan="4" class="border-less"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
            <td colspan="5" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
          </tr>
</table>