<?php
Class Reports_model extends CI_Model
{
 function anesth_technique_count($anesth_technique,$user_id)
 {
  $this->db->select('*');
  $this->db->from('patient_form');
  $this->db->where('user_id',$user_id);
  $this->db->where('anesthetic_technique',$anesth_technique);
  $this->db->where('anesth_status_id',4);
  $result = $this->db->get();
  return $result->num_rows();
 }
}
?>
