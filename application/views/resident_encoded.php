<table width="80%" cellpadding="1" cellspacing="0">
          <tr>
                    <td class="border-less header" align="center" colspan="6">PATIENT LISTS</td>
          </tr>
          <tr>
                    <?php foreach($resident_information as $data): ?>
                    <td class="border-less" colspan="3">RESIDENT NAME : <b><?php echo $data->lastname; ?>, <?php echo $data->firstname; ?> <?php echo $data->middle_initials; ?>.</b></td>
                    <?php endforeach; ?>
          </tr>
          <?php
  $x=0;
  foreach($status_list as $list):
  $list_id[$x] = $list->id;
  $x++;
  endforeach;
  ?>
  <tr>
   <td align="left" class="border-less" style="background-color:white; font-family: sans-serif;font-size: 10px;font-weight:bold;">
    <?php echo '<a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status=0">ALL</a> | <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[0].'">Submitted</a> | <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[2].'">For Revision</a> | <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[5].'">Revised</a> | <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[3].'">Approved</a> | <a href="'.base_url().'index.php/home/resident_encoded?resident_id='.$this->input->get('resident_id').'&status='.$list_id[4].'">Disapproved</a>'; ?>
   </td>
   </tr>
  <tr>
   <td  align="left" class="border-less" style="background-color:white; font-family: sans-serif;font-size: 10px;font-weight:bold;"><?php echo "All : ".$count_all." | Submitted : ".$count_submitted." | For Revision : ".$count_forRevision." | REVISED : ".$count_deleted." | Approved : ".$count_approved." | Disapproved : ".$count_disapproved.""?></td>
  </tr>
          <tr>
                    <td colspan="6" align="center"><?php if($this->session->flashdata("success") !== FALSE){ echo $this->session->flashdata("success"); }?></td>
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
            $patients_id = $patients_infos->patient_information_id;
            $pf_id = $patients_infos->pf_id;
            
            if($patients_infos->anesth_status_id == "1") {$patients_infos->anesth_status_id = "SUBMITTED";}
            ?>
          <tr>
            <td><a href="<?php echo base_url(); ?>index.php/caselog_controller/index/<?php echo $patients_id; ?>/<?php echo $pf_id; ?>?resident_id=<?php echo $this->input->get('resident_id'); ?>"><?php echo $patients_infos->case_number; ?></a></td>
            <td><?php echo ucwords($patients_infos->lastname); ?>,
            <?php echo ucwords($patients_infos->firstname); ?>
            <?php echo ucwords($patients_infos->middle_initials); ?>.</td>
            <td><?php echo $patients_infos->gender; ?></td>
            <td align="center"><?php echo $age; ?></td>
            <td align="center"><b><?php echo $patients_infos->anesth_status_id; ?></b></td>
            <td align="center"><a href="<?php echo base_url(); ?>index.php/home/pdf_report/<?php echo $patients_id; ?>/<?php echo $pf_id; ?>?resident_id=<?php echo $this->input->get('resident_id'); ?>">Export to PDF</a></td>
          </tr>
          <?php } ?>
           <tr>
                <td colspan="6"><?php echo $this->pagination->create_links(); ?></td>
          </tr>
          <tr>
            <td colspan="6" align="center" class="border-less"><br><br><br>Copyright 2013 PBA - Philippine Board of Anesthesiology </td>
          </tr>
</table>