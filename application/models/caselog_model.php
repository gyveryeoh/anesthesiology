<?php
Class Caselog_model extends CI_Model
{
 function select_patient_information($patients_id,$pf_id)
 {
     $this->db->select('*,patient_form.id as patient_form_id,
                       patient_form.date_created as pf_date_created,
                       patient_form.date_updated as pf_date_updated,
                       patient_information.lastname as patient_information_lastname,
                       patient_information.firstname as patient_information_firstname,
                       patient_information.middle_initials as patient_information_middle_initials,
                       anesth_services.name as service_name,
                       anesth_technique.name as technique_name,
                       anesth_blood_loss.name as blood_loss_name,
                       anesth_needle_gauge_spinal.name as p1,
                       anesth_needle_gauge_epidural.name as p2,
                       anesth_status.id as anesth_id,
                       anesth_institution.name as hospital_rotation_name,
                       anesth_peripheral_nerve_blocks_and_pain_techniques.name as apnbapt');
     $this->db->from('patient_information');
     //Patient Form
     $this->db->join('patient_form', 'patient_information.id = patient_form.patient_information_id');
     //STATUS
     $this->db->join('anesth_status', 'anesth_status.id = patient_form.anesth_status_id');
     //Resident Name
     $this->db->join('users', 'users.id = patient_form.user_id');
     //Services
     $this->db->join('anesth_services', 'anesth_services.id = patient_form.service');
     //Techniques
     $this->db->join('anesth_technique', 'anesth_technique.id = patient_form.anesthetic_technique');
     //Blood Loss
     $this->db->join('anesth_blood_loss', 'anesth_blood_loss.id = patient_form.blood_loss');
     //Spinal Needle Gauge
     $this->db->join('anesth_needle_gauge as anesth_needle_gauge_spinal', 'anesth_needle_gauge_spinal.id = patient_form.spinal_needle_gauge', 'left');
     //Epidural Needle Gauge
     $this->db->join('anesth_needle_gauge as anesth_needle_gauge_epidural', 'anesth_needle_gauge_epidural.id = patient_form.epidural_needle_gauge', 'left');
     //Peripheral Nerve
     $this->db->join('anesth_peripheral_nerve_blocks_and_pain_techniques', 'anesth_peripheral_nerve_blocks_and_pain_techniques.id = patient_form.peripheral', 'inner');
     //training institution
      $this->db->join('anesth_institution', 'anesth_institution.id = patient_form.hospital_rotation_id');
     $this->db->where('patient_information.id', $patients_id);
     $this->db->where('patient_form.id',$pf_id);
     $query = $this->db->get();
     if($query->num_rows() > 0)
            {
              return $query->result();
            } else {
                    return false;
            }
}
function patient_form_main_agent_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_main_agent_details');
 $this->db->join('anesth_agent', 'anesth_agent.id = patient_form_main_agent_details.anesth_agent_id ');        
 $this->db->where('patient_form_id',$patient_form_id);
  $query = $this->db->get();
   return $query->result();
}
function patient_form_supplementary_agent_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_supplementary_agent_details');
 $this->db->join('anesth_agent', 'anesth_agent.id = patient_form_supplementary_agent_details.anesth_agent_id ');        
 $this->db->where('patient_form_id',$patient_form_id);
  $query = $this->db->get();
   return $query->result();
}
function patient_form_post_op_pain_agent_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_post_op_pain_agent_details');
 $this->db->join('anesth_agent', 'anesth_agent.id = patient_form_post_op_pain_agent_details.anesth_agent_id ');        
 $this->db->where('patient_form_id',$patient_form_id);
  $query = $this->db->get();
   return $query->result();
}
function patient_form_post_op_pain_management_details($patient_form_id)
{
  $this->db->select('*');
 $this->db->from('patient_form_post_op_pain_management_details');
 $this->db->join('anesth_post_op_pain_management', 'anesth_post_op_pain_management.id = patient_form_post_op_pain_management_details.post_op_pain_management_id');        
 $this->db->where('patient_form_id',$patient_form_id);
  $query = $this->db->get();
   return $query->result();
}
function patient_form_post_op_pain_management_details_1($patient_form_id)
{
  $this->db->select('*');
 $this->db->from('patient_form_post_op_pain_management_details_1');
 $this->db->join('anesth_post_op_pain_management_1', 'anesth_post_op_pain_management_1.id = patient_form_post_op_pain_management_details_1.post_op_pain_management_1_id');        
 $this->db->where('patient_form_id',$patient_form_id);
  $query = $this->db->get();
   return $query->result();
}
function patient_form_monitors_used_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_monitors_used_details');
 $this->db->join('anesth_monitors', 'anesth_monitors.id = patient_form_monitors_used_details.monitors_used_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}
function patient_form_apgar_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_apgar_details');
 $this->db->where('patient_form_id',$patient_form_id);
  $query = $this->db->get();
   return $query->result();
}
function patient_form_critical_level_airway_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_critical_level_airway_details');
 $this->db->join('critical_level_airway', 'critical_level_airway.id = patient_form_critical_level_airway_details.critical_level_airway_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}
function patient_form_critical_level_cardiovascular_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_critical_level_cardiovascular_details');
 $this->db->join('critical_level_cardiovascular', 'critical_level_cardiovascular.id = patient_form_critical_level_cardiovascular_details.critical_level_cardiovascular_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}
function patient_form_critical_level_discharge_planning_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_critical_level_discharge_planning_details');
 $this->db->join('critical_level_discharge_planning', 'critical_level_discharge_planning.id = patient_form_critical_level_discharge_planning_details.critical_level_discharge_planning_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}
function patient_form_critical_level_miscellaneous_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_critical_level_miscellaneous_details');
 $this->db->join('critical_level_miscellaneous', 'critical_level_miscellaneous.id = patient_form_critical_level_miscellaneous_details.critical_level_miscellaneous_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}
function patient_form_critical_level_neurological_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_critical_level_neurological_details');
 $this->db->join('critical_level_neurogical', 'critical_level_neurogical.id = patient_form_critical_level_neurological_details.critical_level_neurological_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}
function patient_form_critical_level_respiratory_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_critical_level_respiratory_details');
 $this->db->join('critical_level_respiratory', 'critical_level_respiratory.id = patient_form_critical_level_respiratory_details.critical_level_respiratory_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}
function patient_form_critical_level_regional_anesthesia_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_critical_level_regional_anesthesia_details');
 $this->db->join('critical_level_regional_anesthesia', 'critical_level_regional_anesthesia.id = patient_form_critical_level_regional_anesthesia_details.critical_level_regional_anesthesia_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}
function patient_form_critical_level_preop_details($patient_form_id)
{
 $this->db->select('*');
 $this->db->from('patient_form_critical_level_preop_details');
 $this->db->join('critical_level_preop', 'critical_level_preop.id = patient_form_critical_level_preop_details.critical_level_preop_id');        
 $this->db->where('patient_form_id',$patient_form_id);
 $query = $this->db->get();
 return $query->result();
}


function update_caselog_status($data,$patient_form_id)
{
 $this->db->where('id', $patient_form_id);
 $this->db->update('patient_form', $data); 
}
}
?>