<form method="post" id="search_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_controller/searched_casenumbered">
 <table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="5">SEARCH</td>
          </tr>
                    <td class="border-less" align="right" width="40%">Patient Case Number :</td>
                    <td class="border-less"><input type="text" name="case_number" size="20"></td>
         </tr>
          <tr>
                    <td class="border-less" align="right">&nbsp;</td>
                    <td class="border-less"><input type="submit" name="login" value="SEARCH"></td>
          </tr>
          <tr>
                    <td class="border-less header" align="center" colspan="5" style="color: red;"><h1>RESULT</h1></td>
          </tr>
  <th>CASE NUMBER</th>
  <th>INITIALS</th>
  <th>GENDER</th>
  <th>BIRTHDATE</th>
  <th>WEIGHT</th>
          <?php foreach($case_number as $row)
          {
          echo "<tr align='center'>
          <td><h2><a href='".base_url()."index.php/home/anesthesiology_form/".$row->id."'>".$row->case_number."</a></h2></td>
          <td><h2>".$row->lastname."-".$row->firstname."-".$row->middle_initials."</h2></td>
          <td><h2>".$row->gender."</h2></td>
          <td><h2>".$row->birthdate."</h2></td>
          <td><h2>".$row->weight." KG</h2></td>
          </tr>";
          }
          ?>
          <tr>
           <td colspan="5" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
          </tr>
</table>
</form>
</body>
</html>