<?php
Class Search_caselog_model extends CI_Model
{
 function count_search_caselog_details($user_id,$institution_id)
 {
 $this->db->select('user_id');
 $this->db->from('patient_form');
 $this->db->where('user_id', $user_id);
 $this->db->where('anesth_status_id', $institution_id);
 $q = $this->db->get();
 return $q->num_rows();
 }
 function fetch_search_caselog_details($limit,$start,$user_id,$institution_id)
 {
  $this->db->limit($start,$limit);
  $this->db->select('user_id,anesth_status_id');
  $this->db->from('patient_form');
  $this->db->where('user_id', $user_id);
  $this->db->where('anesth_status_id', $institution_id);
  $query = $this->db->get();
  return $query->result();
  }
}
?>