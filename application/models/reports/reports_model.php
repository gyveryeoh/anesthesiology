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
   function anesth_service_count($anesth_service,$user_id)
 {
  $this->db->select('*');
  $this->db->from('patient_form');
  $this->db->where('user_id',$user_id);
  $this->db->where('service',$anesth_service);
  $this->db->where('anesth_status_id',4);
  $result = $this->db->get();
  return $result->num_rows();
 }
 
 function get_year($user_id)
 {
  $this->db->select('operation_date');
  $this->db->from('patient_form');
  $this->db->where('user_id',$user_id);
  $this->db->where('anesth_status_id',4);
  $result = $this->db->get();
  return $result->result();
 }
 
	function anesth_technique_count_year($anesth_technique,$user_id,$ye)
	{
		$this->db->select('*');
		$this->db->from('patient_form');
		$this->db->where('user_id',$user_id);
		$this->db->where('anesthetic_technique',$anesth_technique);
		$this->db->where('operation_date',$ye);
		$this->db->where('anesth_status_id',4);
		$result = $this->db->get();
		return $result->num_rows();
	}
	
	function anesth_services_count_year($anesth_services,$user_id,$ye)
	{
		$this->db->select('*');
		$this->db->from('patient_form');
		$this->db->where('user_id',$user_id);
		$this->db->where('service',$anesth_services);
		$this->db->where('operation_date',$ye);
		$this->db->where('anesth_status_id',4);
		$result = $this->db->get();
		return $result->num_rows();
	}
 
}
?>
