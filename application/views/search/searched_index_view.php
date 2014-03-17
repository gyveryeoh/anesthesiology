<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_controller/searched_index">
<table border="0" cellpadding="0" cellspacing="0" width="80%" style="font-family: sans-serif; border: solid 1px; font-size: 12px;">
        <tr>
                <td class="border-less header" align="center" colspan="5">SEARCH</td>
        </tr>
                <td class="border-less" width="20%" bgcolor="skyblue">PATIENT CASE NUMBER</td>
                <td class="border-less" colspan="5" bgcolor=fafad2><input type="text" name="case_number" size="20" class="required"></td>
        </tr>
        <tr>
                <td class="border-less" align="right">&nbsp;</td>
                <td class="border-less"><input type="submit" name="login" value="SEARCH"></td>
        </tr>
        <tr>
                <td class="border-less" align="center" colspan="5" style="color: red;"><h1>RESULT</h1></td>
        </tr>
        <tr bgcolor=skyblue>
                <th>CASE NUMBER</th>
                <th>INITIALS</th>
                <th>GENDER</th>
                <th>BIRTHDATE</th>
                <th>WEIGHT</th>
        </tr>
          <?php foreach($case_number as $row)
          {
          echo "<tr align='center' bgcolor=fafad2>
          <td><h2><a href='".base_url()."index.php/home/anesthesiology_form/".$row->id."'>".$row->case_number."</a></h2></td>
          <td><h2>".$row->lastname."-".$row->firstname."-".$row->middle_initials."</h2></td>
          <td><h2>".$row->gender."</h2></td>
          <td><h2>".$row->birthdate."</h2></td>
          <td><h2>".$row->weight." KG</h2></td>
          </tr>";
          }
          ?>
          <tr>
           <td colspan="12" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
          </tr>
</table>
</form>
</body>
</html>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>