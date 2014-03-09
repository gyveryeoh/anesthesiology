<form method="post" id="anesth_form" autocomplete="off" action="<?php echo base_url(); ?>index.php/search_controller/searched_index">
<table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="2">SEARCH</td>
          </tr>
          <tr>
           <td style='color: red;font-size: 30px;font-weight: bold;' colspan="2" class="border-less" align="center"><?php if (isset($message)){ echo $message; } ?></td></tr>
          <tr>
                    <td class="border-less" width="20%" bgcolor=skyblue>PATIENT CASE NUMBER</td>
                    <td class="border-less" colspan="2" bgcolor=fafad2><input type="text" name="case_number" size="20" class="required"></td>
         </tr>
          <tr>
                    <td class="border-less" align="right">&nbsp;</td>
                    <td class="border-less"><input type="submit" name="login" value="SEARCH"></td>
          </tr>
          <tr>
           <td colspan="2" class="border-less" align="center"><?php if (isset($message)){ echo '<a href="'.base_url().'index.php/home/"><b>ADD NEW PATIENT INFORMATION</b></a>'; } ?></td>
          </tr>
          <tr>
           <td colspan="2" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
          </tr>
</table>
</form>
</body>
</html> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/datepicker/zebra_datepicker.js"></script>