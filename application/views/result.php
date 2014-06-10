<a name="result"></a>
<table border=0 width="90%" cellpadding="0" cellspacing="0">
<?php foreach($case_number as $row): ?>      
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
        <?php
          echo "<tr align='center' bgcolor=fafad2>
          <td><h2><a href='".base_url()."index.php/home/anesthesiology_form/".$row->id."'>".$row->case_number."</a></h2></td>
          <td><h2>".$row->lastname."-".$row->firstname."-".$row->middle_initials."</h2></td>
          <td><h2>".$row->gender."</h2></td>
          <td><h2>".$row->birthdate."</h2></td>
          <td><h2>".$row->weight." KG</h2></td>
          </tr>";
          endforeach;
?>
          <tr>
                    <td colspan="5" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology</td>
          </tr>
</table>