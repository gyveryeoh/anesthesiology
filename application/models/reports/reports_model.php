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
}
?>
