<?php
Class Edit_caselog_model extends CI_Model
{
	function edit_patient_info($patient_information_id,$datas)
	{
		$this->db->where('id',$patient_information_id);
		$this->db->update('patient_information',$datas); 
	}
	
	function edit_patient_form($patient_form_id,$datas2)
	{
		$this->db->where('id',$patient_form_id);
		$this->db->update('patient_form',$datas2); 
	}
}
?>