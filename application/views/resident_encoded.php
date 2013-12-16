<table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="6">PATIENT LISTS</td>
          </tr>
          <tr>
                    <td colspan="6" align="center"><?php
   if($this->session->flashdata("success") !== FALSE)
{
    echo $this->session->flashdata("success");
    }
    ?></td>
          </tr>
          <th><b>CASE NUMBER</b></th>
          <th><b>PATIENT NAME</b></th>
          <th><b>GENDER</b></th>
          <th><b>AGE</b></th>
          <th><b>STATUS</b></th>
          <th><b>EXPORT</b></th>
          <?php foreach($patient_informationss as $patients_infos)
          {
            $date1 = new DateTime($patients_infos->birthdate);
            $date2 = new DateTime(date('Y-m-d'));
            $diff = $date1->diff($date2);
            $age = $diff->y . "Y".$diff->m."M".$diff->d."D";
            $patients_id = $patients_infos->patient_information_id ;
            if($patients_infos->anesth_status_id == "1") {$patients_infos->anesth_status_id = "SUBMITTED";}
            ?>
          <tr>
            <td><?php echo $patients_infos->case_number; ?></td>
            <td><?php echo ucwords($patients_infos->lastname); ?>,
            <?php echo ucwords($patients_infos->firstname); ?>
            <?php echo ucwords($patients_infos->middle_initials); ?>.</td>
            <td><?php echo $patients_infos->gender; ?></td>
            <td align="center"><?php echo $age; ?></td>
            <td align="center"><b><?php echo $patients_infos->anesth_status_id; ?></b></td>
            <td align="center"><a href="<?php echo base_url(); ?>index.php/home/pdf_report/<?php echo $patients_id; ?>?resident_id=<?php echo $this->input->get('resident_id'); ?>">Export to PDF</a></td>
          </tr>
          <?php } ?>
           <tr>
                <td colspan="6"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
          <tr>
            <td colspan="6" align="center" class="border-less"><br><br><br>Copyright 2013 PGH - Philippine General Hospital </td>
          </tr>
</table>