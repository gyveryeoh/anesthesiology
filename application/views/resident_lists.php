<table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="4">RESIDENT LISTS</td>
          </tr>
          <th><b>LASTNAME</b></th>
          <th><b>FIRSTNAME</b></th>
          <th><b>MIDDLE INITIALS</b></th>
          <th><b>STATUS</b></th>
          <th><b>LAST DATE OF ENCODING</b></th>
          <?php foreach($residents_information as $res_info)
          {
            $user_id = $res_info->id;
            ?>
          <tr>
            <td><?php echo $res_info->lastname; ?></td>
            <td><?php echo $res_info->firstname; ?></td>
            <td><?php echo $res_info->middle_initials; ?></td>
            <td align="center"><a href="<?php echo base_url(); ?>index.php/home/resident_encoded?resident_id=<?php echo $user_id; ?>">VIEW</a></td>
          </tr>
          <?php } ?>
          <tr>
            <tr>
                <td colspan="4"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
            <td colspan="4" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
          </tr>
</table>