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
	//MAIN AGENT MO PAUL
	function patient_form_main_agent_details($pf_id)
	{
		$this->db->select('*');
		$this->db->from('patient_form_main_agent_details');
		$this->db->join('anesth_agent', 'anesth_agent.id = patient_form_main_agent_details.anesth_agent_id ');
		$this->db->where('patient_form_id',$pf_id);
		$query = $this->db->get();
		return $query->result();
	}
	//UPDATE NUNG MAIN AGENT MO
	function edit_main_agent_data($patient_form_id,$main_agent)
	{
		$this->db->where('patient_form_id',$patient_form_id);
		$this->db->delete('patient_form_main_agent_details');
		
		for($i=0; $i<count($main_agent); $i++)
		{
			$data[] = array(
			'patient_form_id' => $patient_form_id,
			'anesth_agent_id' => $main_agent[$i]
			);
		}
		if (isset($main_agent))
		{
			$this->db->insert_batch('patient_form_main_agent_details', $data);
		}
	}
	function edit_supplementary_agent_data($patient_form_id,$supplementary_agent)
	{
		$this->db->where('patient_form_id',$patient_form_id);
		for($i=0; $i<count($supplementary_agent);$i++)
		{
			$data[] = array(
					 'patient_form_id' => $patient_form_id,
					 'anesth_agent_id' => $supplementary_agent[$i]
					 );
		}
		if (isset($supplementary_agent))
		{
			$this->db->update_batch('patient_form_supplementary_agent_details', $data);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function  patient_form_supplementary_agent_details($pf_id)
	{
		$this->db->select('*,anesth_agent.name as aa_name');
		$this->db->from('patient_form_supplementary_agent_details');
		$this->db->join('anesth_agent','anesth_agent.id = patient_form_supplementary_agent_details.anesth_agent_id');
		$this->db->where('patient_form_supplementary_agent_details.patient_form_id',$pf_id);
		$query = $this->db->get();
		return $query->result();
	}
		
	function  patient_form_post_op_pain_agent_details($pf_id)
	{
		$this->db->select('*,anesth_agent.name as aa_name');
		$this->db->from('patient_form_post_op_pain_agent_details');
		$this->db->join('anesth_agent', 'anesth_agent.id = patient_form_post_op_pain_agent_details.anesth_agent_id');
		$this->db->where('patient_form_post_op_pain_agent_details.patient_form_id',$pf_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function  anesth_post_op_pain_management()
	{
		$this->db->select('*');
		$this->db->from('anesth_post_op_pain_management');
		$query = $this->db->get();
		return $query->result();
	}

	function  anesth_post_op_pain_management_1()
	{
		$this->db->select('*');
		$this->db->from('anesth_post_op_pain_management_1');
		$query = $this->db->get();
		return $query->result();
	}	
	
	function  patient_form_post_op_pain_management_details($pf_id)
	{
		$this->db->select('*,anesth_post_op_pain_management.name as apopm_name');
		$this->db->from('patient_form_post_op_pain_management_details');
		$this->db->join('anesth_post_op_pain_management', 'anesth_post_op_pain_management.id = patient_form_post_op_pain_management_details.post_op_pain_management_id');
		$this->db->where('patient_form_post_op_pain_management_details.patient_form_id',$pf_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function  patient_form_post_op_pain_management_details_1($pf_id)
	{
		$this->db->select('*,anesth_post_op_pain_management_1.name as apopm1_name');
		$this->db->from('patient_form_post_op_pain_management_details_1');
		$this->db->join('anesth_post_op_pain_management_1', 'anesth_post_op_pain_management_1.id = patient_form_post_op_pain_management_details_1.post_op_pain_management_1_id');
		$this->db->where('patient_form_post_op_pain_management_details_1.patient_form_id',$pf_id);
		$query = $this->db->get();
		return $query->result();
	}

	function  anesth_monitors()
	{
		$this->db->select('*');
		$this->db->from('anesth_monitors');
		$query = $this->db->get();
		return $query->result();
	}
	
	function  patient_form_monitors_used_details($pf_id)
	{
		$this->db->select('*,anesth_monitors.name as monitor_name');
		$this->db->from('patient_form_monitors_used_details');
		$this->db->join('anesth_monitors', 'anesth_monitors.id = patient_form_monitors_used_details.monitors_used_id');
		$this->db->where('patient_form_monitors_used_details.patient_form_id',$pf_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function  anesth_blood_loss()
	{
		$this->db->select('*');
		$this->db->from('anesth_blood_loss');
		$query = $this->db->get();
		return $query->result();
	}

	function  blood_loss($pf_id)	
	{
		$this->db->select('*,anesth_blood_loss.name as bl_name');
		$this->db->from('patient_form');
		$this->db->join('anesth_blood_loss', 'anesth_blood_loss.id = patient_form.blood_loss');
		$this->db->where('patient_form.id',$pf_id);
		$query = $this->db->get();
		return $query->result();
	}

	function anesth_colloids_used()
	{
		$this->db->select('*');
		$this->db->from('anesth_colloids_used');
		$query = $this->db->get();
		return $query->result();
	} 
	
	function edit_anesthesiology_information_data($data,$pf_id)
	{
		$this->db->where('id',$pf_id);
		$this->db->update('patient_form',$data); 
	}
	function edit_post_op_pain_agent_data($pf_id,$post_op_pain_agent)
	{
		$this->db->where('patient_form_id',$pf_id);
		$this->db->delete('patient_form_post_op_pain_agent_details');		
		
		for($i=0; $i<count($post_op_pain_agent);$i++)
		{
			$data[] = array(
				 'patient_form_id' => $pf_id,
				 'anesth_agent_id' => $post_op_pain_agent[$i]
				 );
		}
		if (isset($post_op_pain_agent))
		{
			$this->db->insert_batch('patient_form_post_op_pain_agent_details', $data);
		}
	}
	
	function edit_post_op_pain_management_data($pf_id,$post_op_pain_management)
	{
		$this->db->where('patient_form_id',$pf_id);
		$this->db->delete('patient_form_post_op_pain_management_details');		
		
		for($i=0; $i<count($post_op_pain_management);$i++)
		{
			$data[] = array(
			'patient_form_id' => $pf_id,
			'post_op_pain_management_id' => $post_op_pain_management[$i]
			);
		}
		if (isset($post_op_pain_management))
		{
			$this->db->insert_batch('patient_form_post_op_pain_management_details', $data);
		}
	}
	
	function edit_post_op_pain_management_data_1($pf_id,$post_op_pain_management_1)
	{
		$this->db->where('patient_form_id',$pf_id);
		$this->db->delete('patient_form_post_op_pain_management_details_1');		
		
		for($i=0; $i<count($post_op_pain_management_1);$i++)
		{
			$data[] = array(
			'patient_form_id' => $pf_id,
			'post_op_pain_management_1_id' => $post_op_pain_management_1[$i]
			);
		}
		if (isset($post_op_pain_management_1))
		{
			$this->db->insert_batch('patient_form_post_op_pain_management_details_1', $data);
		}
	}
	
	function edit_monitors_used_data($pf_id,$monitors_used)
	{
		$this->db->where('patient_form_id',$pf_id);
		$this->db->delete('patient_form_monitors_used_details');
		
		for($i=0; $i<count($monitors_used);$i++)
		{
			$data[] = array(
			'patient_form_id' => $pf_id,
			'monitors_used_id' => $monitors_used[$i]
			);
		}
		if (isset($monitors_used))
		{
			$this->db->insert_batch('patient_form_monitors_used_details', $data);
		}
	}
	}
?>