<table width="80%" cellpadding="1" cellspacing="0" style="border-top: hidden;font-size: 13px;">
          <tr>
                    <td class="border-less header" align="center" colspan="6">ENCODED SUMMARY</td>
          </tr>
          <tr>
                    <?php foreach($resident_information as $data): ?>
                    <td class="border-less question" width=15%>RESIDENT NAME</td><td class="border-less answer" colspan=5><?php echo $data->lastname; ?>, <?php echo $data->firstname; ?> <?php echo $data->middle_initials; ?>.</b></td>
                    <?php endforeach; ?>
          </tr>
          <?php
          $x=0;
          foreach($status_list as $list):
          $list_id[$x] = $list->id;
          $x++;
          endforeach;
          ?>
          <tr class="answer">
                    <td align="left" class="border-less" style="font-weight:bold;font-size: 15px;" colspan=6>
                    <?php echo '<a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status=0">ALL : '.$count_all.'</a> |
                    <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[0].'">SUBMITTED : '.$count_submitted.'</a> |
                    <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[2].'">FOR REVISION : '.$count_forRevision.'</a> |
                    <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[5].'">REVISED : '.$count_deleted.'</a> |
                    <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[3].'">APPROVED : '.$count_approved.'</a> |
                    <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[4].'">DISAPPROVED : '.$count_disapproved.'</a>'; ?>
                    </td>
          </tr>
          <tr>
                    <td colspan="6" align="center"><?php if($this->session->flashdata("success") !== FALSE){ echo $this->session->flashdata("success"); }?></td>
          </tr>
          <th class="question border-less"><b>CASE NUMBER</b></th>
          <th class="question border-less"><b>PATIENT NAME</b></th>
          <th class="question border-less"><b>GENDER</b></th>
          <th class="question border-less"><b>AGE</b></th>
          <th class="question border-less"><b>STATUS</b></th>
          <th class="question border-less"><b>EXPORT</b></th>
          <?php foreach($patient_informationss as $patients_infos)
          {
            $date1 = new DateTime($patients_infos->birthdate);
            $date2 = new DateTime(date('Y-m-d'));
            $diff = $date1->diff($date2);
            $age = $diff->y . "Y".$diff->m."M".$diff->d."D";
            $patients_id = $patients_infos->patient_information_id;
            $pf_id = $patients_infos->pf_id;
            if($patients_infos->anesth_status_id == "1") {$patients_infos->anesth_status_id = "SUBMITTED";}
            if($patients_infos->anesth_status_id == "2") {$patients_infos->anesth_status_id = "REVISE";}
            if($patients_infos->anesth_status_id == "3") {$patients_infos->anesth_status_id = "FOR REVISION";}
            if($patients_infos->anesth_status_id == "4") {$patients_infos->anesth_status_id = "APPROVED";}
            if($patients_infos->anesth_status_id == "5") {$patients_infos->anesth_status_id = "DISAPPROVED";}   
            if($patients_infos->anesth_status_id == "7") {$patients_infos->anesth_status_id = "REVISED";}
            if($patients_infos->anesth_status_id == "8") {$patients_infos->anesth_status_id = "OPEN";}
            ?>
          <tr class="answer" align=center>
            <td><a href="<?php echo base_url(); ?>index.php/caselog_controller/index/<?php echo $patients_id; ?>/<?php echo $pf_id; ?>?resident_id=<?php echo $this->input->get('resident_id'); ?>&status_id=<?php echo $this->input->get('status'); ?>"><?php echo $patients_infos->case_number; ?></a></td>
            <td><?php echo ucwords($patients_infos->lastname); ?>,
            <?php echo ucwords($patients_infos->firstname); ?>
            <?php echo ucwords($patients_infos->middle_initials); ?>.</td>
            <td><?php echo $patients_infos->gender; ?></td>
            <td align="center"><?php echo $age; ?></td>
            <td align="center"><?php echo $patients_infos->anesth_status_id; ?></td>
            <td align="center"><a href="<?php echo base_url(); ?>index.php/home/pdf_report/<?php echo $patients_id; ?>/<?php echo $pf_id; ?>?resident_id=<?php echo $this->input->get('resident_id'); ?>">Export to PDF</a></td>
          </tr>
          <?php } ?>
           <tr>
                <td colspan="6" class="border-less"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
          <tr>
            <td colspan="6" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology </td>
          </tr>
</table>