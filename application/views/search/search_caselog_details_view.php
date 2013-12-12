<form method="post" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_caselog/search_caselog_details">
 <table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="2">CASELOG SEARCH</td>
          </tr>
          <tr><td style='color: red;font-size: 30px;font-weight: bold;' colspan="2" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td></tr>
          <tr>
                    <td class="border-less" align="right" width="40%">Institution :</td>
                    <td class="border-less" colspan="2">
                        <select name="institution_id">
                              <option value="0">All</option>
                              <?php
                              foreach($institution_list as $list)
                              {
                               echo "<option value='".$list->id."'>".$list->name."</option>";
                              }
                              ?>
                    </select>
                    </td>
         </tr>
          <tr>
                    <td class="border-less" align="right">Resident Name :</td>
                     <td class="border-less" colspan="2">
                        <select name="user_id">
                              <option value="0">All</option>
                              <?php
                              foreach($users_list as $list)
                              {
                               echo "<option value='".$list->id."'>".$list->lastname.", ".$list->firstname." ".$list->middle_initials.".</option>";
                              }
                              ?>
                    </select>
                    </td></tr>
          <tr>
          <tr>
                    <td class="border-less" align="right">Status :</td>
                     <td class="border-less" colspan="2">
                        <select name="status_id" class="required">
                              <option value="0">All</option>
                              <?php
                              foreach($status_list as $list)
                              {
                               echo "<option value='".$list->id."'>".$list->name."</option>";
                              }
                              ?>
                    </select>
                    </td></tr>
          <tr>
                    <td class="border-less" align="right">&nbsp;</td>
                    <td class="border-less"><input type="submit" name="login" value="SEARCH">
          </tr>
          <?php foreach($caselog_information as $row){
          echo "<tr><td>".$row->user_id."</td><td>".$row->anesth_status_id."</td></tr>";
          }
          ?>
          <tr>
           <tr>
                <td colspan="6"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
<td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
</tr>
</table>
</form>
</body>
</html>