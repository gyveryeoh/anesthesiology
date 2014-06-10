<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Caselog_controller extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('caselog_model','',TRUE);
		$this->load->model('dropdown_select');
		$this->load->library('session');
		$this->load->helper('url');
	}
	function index($patients_id='', $pf_id='')
	{
		$r_id = $this->input->get('resident_id');
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data["user_information"] = $session_data;
			$user_id = $session_data['id'];
			$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
			//save caselog as submitted
				if ($this->input->post('submit'))
				{
					$patient_form_id = $this->input->post('patient_form_id');
					$data = array
					(
						'anesth_status_id' => 1);
						$this->caselog_model->update_caselog_status($data,$patient_form_id);
						
						$this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED CASELOG AS SUBMITTED</b></span></font></p>');
						redirect('users_controller/users_caselog?&status=0', 'refresh');
					}
			if ($data['patient_information'] != false)
			{
				foreach ($data['patient_information'] as $delivery){}
				$patient_form_id = $delivery->patient_form_id;
				$hospital_rotation_id = $delivery->hospital_rotation_id;
				$institution_id = $delivery->institution_id;
				$data['main_agent'] = $this->caselog_model->patient_form_main_agent_details($patient_form_id);
				$data['supplementary_agent'] = $this->caselog_model->patient_form_supplementary_agent_details($patient_form_id);
				$data['post_op_pain_agent'] = $this->caselog_model->patient_form_post_op_pain_agent_details($patient_form_id);
				$data['monitors_used'] = $this->caselog_model->patient_form_monitors_used_details($patient_form_id);
				$data['post_op_pain_management'] = $this->caselog_model->patient_form_post_op_pain_management_details($patient_form_id);
				$data['post_op_pain_management_1'] = $this->caselog_model->patient_form_post_op_pain_management_details_1($patient_form_id);
				if ($delivery->if_delivery == "YES")
				{
					$data['apgar_information'] = $this->caselog_model->patient_form_apgar_details($patient_form_id);
				}
				if ($delivery->critical_events == "YES")
				{
					$data['patient_form_critical_level_airway_details'] = $this->caselog_model->patient_form_critical_level_airway_details($patient_form_id);
					$data['patient_form_critical_level_cardiovascular_details'] = $this->caselog_model->patient_form_critical_level_cardiovascular_details($patient_form_id);
					$data['patient_form_critical_level_discharge_planning_details'] = $this->caselog_model->patient_form_critical_level_discharge_planning_details($patient_form_id);
					$data['patient_form_critical_level_miscellaneous_details'] = $this->caselog_model->patient_form_critical_level_miscellaneous_details($patient_form_id);
					$data['patient_form_critical_level_neurological_details'] = $this->caselog_model->patient_form_critical_level_neurological_details($patient_form_id);
					$data['patient_form_critical_level_respiratory_details'] = $this->caselog_model->patient_form_critical_level_respiratory_details($patient_form_id);
					$data['patient_form_critical_level_regional_anesthesia_details'] = $this->caselog_model->patient_form_critical_level_regional_anesthesia_details($patient_form_id);
					$data['patient_form_critical_level_preop_details'] = $this->caselog_model->patient_form_critical_level_preop_details($patient_form_id);
				}
				$this->load->view('header/header', $data);
				$data['status_list'] = $this->dropdown_select->anesth_status();
				$data['institution_details'] = $this->dropdown_select->institution_info($institution_id);
				$data['hospital_rotation_details'] = $this->dropdown_select->select_hospital_rotation($hospital_rotation_id);
				$this->load->view('caselog_view',$data);
				}
				else
				{
					$this->session->set_flashdata("success",'<p style="background-color:#faadad; width:80%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="../assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;"><b>CASE LOG FORM OF SELECTED PATIENT ARE NOT YET COMPLETED!</b></span></font></p>');
					redirect('search_controller/searchcaselog_details?institution_id=0&user_id=0&status_id=3');
				}
				}
				else
				{
					redirect('login', 'refresh');
				}
	}
	function update_caselog()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data["user_information"] = $session_data;
			$user_id = $session_data['id'];
			$patient_form_id = $this->input->post('patient_form_id');
			$anesth_status_id = $this->input->post('anesth_status_id');
			if ($anesth_status_id == "2"){$anesth_status_id ="3";}else{$anesth_status_id = $anesth_status_id;}
			$data = array
			('anesth_status_id'  => $anesth_status_id,
			 'notes'             => $this->input->post('notes'));
			$this->caselog_model->update_caselog_status($data,$patient_form_id);
			$this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:90%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED DATA.</b></span></font></p>');
			if ($this->input->post('resident_id') != NULL)
			{
			redirect('home/resident_encoded?resident_id='.$this->input->post('resident_id').'&status='.$this->input->post('status_id').'');
			}
			if ($this->input->get('resident_id') == NULL)
			{
			redirect('search_controller/searchcaselog?case_number='.$this->input->post('case_number').'&service='.$this->input->post('service').'&technique='.$this->input->post('technique').'&hospital_id='.$this->input->post('hospital_id').'&user_id='.$this->input->post('user_id').'&start_date='.$this->input->post('start_date').'&end_date='.$this->input->post('end_date').'&status_id='.$this->input->post('status_id').'&diagnosis='.$this->input->post('diagnosis').'&submit=SEARCH');
			}
			else
			{
				redirect('login', 'refresh');
			}
		}
	}
}
?>