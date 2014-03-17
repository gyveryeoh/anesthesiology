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
 
function count_users_login_summary_table($resident_id)
	{
		$this->db->select('*');
		$this->db->from('user_login_summary');
		 $this->db->where('user_id',$resident_id);
		$q = $this->db->get();
		return $q->num_rows();
	}
	function fetch_users_login_summary($limit,$start,$resident_id)
	{
		$this->db->limit($start,$limit);
		$this->db->select('*');
		$this->db->from('user_login_summary');
		$this->db->where('user_id',$resident_id);
		$this->db->order_by("login_date", "desc");
		$query = $this->db->get();
		return $query->result();
	}
function anesth_service_count($anesth_service,$id)
 {
  $this->db->select('*');
  $this->db->from('patient_form');
  $this->db->where('user_id',$id);
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
<<<<<<< HEAD
=======

 
>>>>>>> 575644a97648a98611dacf788f5c641d6057fd39
}
?>
