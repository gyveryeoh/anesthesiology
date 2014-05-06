<?php
Class Users_model extends CI_Model
{
	function count_view_caselog_details_1($user_id,$status)
	{
		$this->db->select('*');
		$this->db->from('patient_form');
		$this->db->where('user_id',$user_id);
		if($status != 0)
		{
			$this->db->where('anesth_status_id',$status);
		}
		$q = $this->db->get();
		return $q->num_rows();
	}
	function fetch_search_caselog_details($limit,$start,$user_id,$status)
	{
		$this->db->limit($start,$limit);
		$this->db->select('*,
				patient_form.id as patient_form_id,
		patient_form.user_id,
		anesth_status.name as anesth_name,
		patient_information.id as p_id,
		patient_information.birthdate as patient_info_birthdate,
		patient_information.weight as patient_info_weight,
		patient_information.case_number as patient_info_case_number,
		patient_information.lastname as patient_info_lastname,
		patient_information.firstname as patient_info_firstname,
		patient_information.middle_initials as patient_info_middle_initials,
		patient_information.gender as patient_info_gender');
		$this->db->from('patient_form');
		$this->db->join('patient_information', 'patient_information.id = patient_form.patient_information_id');
		$this->db->join('anesth_status','anesth_status.id = patient_form.anesth_status_id');
		$this->db->join('users','users.id = patient_form.user_id');
		$this->db->where('patient_form.user_id', $user_id);
		if($status != 0)
		{
			$this->db->where('anesth_status.id',$status);
		}
		$this->db->order_by("users.lastname", "asc");
		$query = $this->db->get();	
		return $query->result();
	}
	
	function count_hospital_list()
	{
		$this->db->select('*');
		$this->db->from('anesth_institution');
		$q = $this->db->get();
		return $q->num_rows();	
	}
	
	function hospital_list()
	{
		$this->db->select('*');
		$this->db->from('anesth_institution');
		$this->db->order_by("name", "asc");
		$this->db->where('name !=','NONE');
		$q = $this->db->get();
		return $q->result();		
	}
	function users_per_institution($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('institution_id',$id);
		$this->db->order_by("users.lastname", "asc");
		$query = $this->db->get();
		return $query->result();
	}

	function get_user_info($user_id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$user_id);
		$query = $this->db->get();
		return $query->result();	
	}
	
	function get_roles()
	{
		$this->db->select('*');
		$this->db->from('users_roles');
		$query = $this->db->get();
		return $query->result();		
	}
	
	function edit_user($data,$user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->update('users', $data); 
	}
}