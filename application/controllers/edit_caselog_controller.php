<?php
class Edit_caselog_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('edit_caselog_model','',TRUE);
		$this->load->model('caselog_model');
		$this->load->model('dropdown_select');
		$this->load->library('session');
		$this->load->helper('url');
	}
	function index($patients_id='', $pf_id='')
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['user_information'] = $session_data; 
			$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
			$data['institution_details'] = $this->dropdown_select->institution_info($session_data['institution_id']);	
			$this->load->view('header/header', $data);
			$this->load->view('caselog_form_update/edit_caselog_patient_information',$data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	function edit_patient_information()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$user_id = $data['id'] = $session_data['id'];
			//patient_information <-tables id lng yung kailangan natin i update kasi yun yung identifier nila
			$patient_information_id = $this->input->post('patient_information_id');
			//Patient_form id yan yung tables.
			$patient_form_id = $this->input->post('patient_form_id');
			//para ma redirect
			$patient_id = $patient_information_id."/".$patient_form_id;
			//Birthdate na ginawa mo..
			$birthday =$this->input->post('a_year')."-".$this->input->post('a_month')."-".$this->input->post('a_day');
			if ($this->input->post('anesth_status_id') == "8")
			{ $anesth_status_id = "8";}else{$anesth_status_id = "7";}
			$datas = array(
				       'birthdate' => $birthday,
				       'weight' => $this->input->post('weight'),
				       'lastname' => ucwords($this->input->post('lastname')),
				       'firstname' => ucwords($this->input->post('firstname')),
				       'middle_initials' => ucwords($this->input->post('middlename')),
				       'gender' => $this->input->post('gender'));
			$datas2 = array(
					'operation_date' => $this->input->post('operation_date'),
					'level_of_involvement' => $this->input->post('level_of_involvement'),
					'type_of_patient' => $this->input->post('type_of_patient'),
					'asa' => $this->input->post('asa'),
					'for_emergency' => $this->input->post('for_emergency'),
					'anesth_status_id' => $anesth_status_id);
			$this->edit_caselog_model->edit_patient_info($patient_information_id,$datas);
			$this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
			$this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED PATIENT INFORMATION</b></span></font></p>');
			redirect('caselog_controller/index/'.$patient_id);
			}
			else
{
 redirect('login', 'refresh');
}
}
function edit_diagnosis_information($patients_id='', $pf_id='')
{ 
 if($this->session->userdata('logged_in'))
 {
  $session_data = $this->session->userdata('logged_in');
  $data['user_information'] = $session_data; 
  $data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
  $data['anesth_services_data'] = $this->dropdown_select->anesth_services();
  $data['anesth_technique_data'] = $this->dropdown_select->anesth_techniques();
  $data['apnbapt_data'] = $this->dropdown_select->anesth_peripheral_nerve_blocks_and_pain_techniques();
  $data['critical_level_miscellaneous'] = $this->dropdown_select->critical_level_miscellaneous();
  $data['critical_level_neurogical'] = $this->dropdown_select->critical_level_neurogical();
  $data['critical_level_respiratory'] = $this->dropdown_select->critical_level_respiratory();
  $data['critical_level_regional_anesthesia'] = $this->dropdown_select->critical_level_regional_anesthesia();
  $data['critical_level_preop'] = $this->dropdown_select->critical_level_preop();
  $data['anesth_post_op_pain_management_data'] = $this->dropdown_select->anesth_post_op_pain_management();
  $data['anesth_post_op_pain_management_data_1'] = $this->dropdown_select->anesth_post_op_pain_management_1();
  $data['anesth_airway_data'] = $this->dropdown_select->anesth_airway();
   //CRITICAL EVENTS AIRWAY
  $data['critical_events_airway_data'] = $this->dropdown_select->critical_level_airway();
  $data['critical_events_airway_details'] = $this->edit_caselog_model->critical_events_airway_details($pf_id);
  //CRITICAL EVENTS CARDIOVASCULAR
  $data['critical_events_cardiovacular_data'] = $this->dropdown_select->critical_level_cardiovascular();
  $data['critical_events_cardiovascular_details'] = $this->edit_caselog_model->critical_events_cardiovascular_details($pf_id);
  //CRITICAL EVENTS DISCHARGE PLANNING
  $data['critical_events_discharge_planning_data'] = $this->dropdown_select->critical_level_discharge_planning();
  $data['critical_events_discharge_planning_details'] = $this->edit_caselog_model->critical_level_discharge_planning_details($pf_id);
  //CRITICAL EVENTS MISCELLANEOUS
  $data['critical_events_miscellaneous_data'] = $this->dropdown_select->critical_level_miscellaneous();
  $data['critical_events_miscellaneous_details'] = $this->edit_caselog_model->critical_level_miscellaneous_details($pf_id);
  //CRITICAL EVENTS NEUROLOGICAL
  $data['critical_events_neurological_data'] = $this->dropdown_select->critical_level_neurogical();
  $data['critical_events_neurological_details'] = $this->edit_caselog_model->critical_level_neurological_details($pf_id);
  //CRITICAL EVENTS RESPIRATORY
  $data['critical_events_respiratory_data'] = $this->dropdown_select->critical_level_respiratory();
  $data['critical_events_respiratory_details'] = $this->edit_caselog_model->critical_level_respiratory_details($pf_id);
  //CRITICAL EVENTS REGIONAL ANESTHESIA
  $data['critical_events_regional_anesthesia_data'] = $this->dropdown_select->critical_level_regional_anesthesia();
  $data['critical_events_regional_anesthesia_details'] = $this->edit_caselog_model->critical_level_regional_anesthesia_details($pf_id);
  //CRITICAL EVENTS PREOP
  $data['critical_events_preop_data'] = $this->dropdown_select->critical_level_preop();
  $data['critical_events_preop_details'] = $this->edit_caselog_model->critical_level_preop_details($pf_id);
  $this->load->view('header/header', $data);
  $this->load->view('caselog_form_update/edit_caselog_patient_diagnosis',$data);
  if ($this->input->post('save'))
  {
	
	$patient_information_id = $this->input->post('patient_information_id');
	$patient_form_id = $this->input->post('patient_form_id');
	$patient_id = $patient_information_id."/".$patient_form_id;
	$anesthetic_technique = $this->input->post('anesthetic_technique');
	$peripheral = $this->input->post('peripheral');
	$airway = $this->input->post('airway');
	$other_airway = $this->input->post('other_airway');
	if ($airway == "Others (pls specify):"){$airway  = $other_airway; } else { $airway = $airway; }
	if ($anesthetic_technique == "9") {$peripheral = $peripheral;} else {$peripheral = "NULL";}
	if ($this->input->post('anesthetic_technique') == "3")
	{ $critical_events = "YES"; } else { $critical_events = "NO";}
	if ($this->input->post('anesth_status_id') == "8")
	{ $anesth_status_id = "8";}else{$anesth_status_id = "7";}
	$datas2 = array(
			'diagnosis' => $this->input->post('diagnosis'),
			'comorbid_diseases' => $this->input->post('comorbid_diseases'),
			'service' => $this->input->post('service'),
			'anesthetic_technique' => $this->input->post('anesthetic_technique'),
			'airway' => $airway,
			'peripheral' => $peripheral,
			'critical_events' => $critical_events,
			'anesth_status_id' => $anesth_status_id);
	$this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
	if ($this->input->post('anesthetic_technique') == "3")
	{
		//UPDATE CRITICAL EVENTS AIRWAY
		$critical_level_airway = $this->input->post('critical_level_airway');
		$this->edit_caselog_model->edit_critical_events_airway($patient_form_id,$critical_level_airway);
		//UPDATE CRITICAL EVENTS CARDIOVASCULAR
		$critical_events_cardiovascular = $this->input->post('cardiovascular');
		$this->edit_caselog_model->edit_critical_events_cardiovascular($patient_form_id,$critical_events_cardiovascular);
		//UPDATE CRITICAL EVENTS DISCHARGE PLANNING
		$critical_events_discharge_planning = $this->input->post('discharge_planning');
		$this->edit_caselog_model->edit_critical_events_discharge_planning($patient_form_id,$critical_events_discharge_planning);
		//UPDATE CRITICAL EVENTS MISCELLANEOUS
		$critical_events_miscellaneous = $this->input->post('miscellaneous');
		$this->edit_caselog_model->edit_critical_events_miscellaneous($patient_form_id,$critical_events_miscellaneous);
		//UPDATE CRITICAL EVENTS NEUROLOGICAL
		$critical_events_neurological = $this->input->post('neurological');
		$this->edit_caselog_model->edit_critical_events_neurological($patient_form_id,$critical_events_neurological);
		//UPDATE CRITICAL EVENTS RESPIRATORY
		$critical_events_respiratory = $this->input->post('respiratory');
		$this->edit_caselog_model->edit_critical_events_respiratory($patient_form_id,$critical_events_respiratory);
		//UPDATE CRITICAL EVENTS REGIONA ANESTHESIA
		$critical_events_regional_anesthesia = $this->input->post('regional_anesthesia');
		$this->edit_caselog_model->edit_critical_events_regional_anesthesia($patient_form_id,$critical_events_regional_anesthesia);
		//UPDATE CRITICAL EVENTS REGIONA PREOP
		$critical_events_preop = $this->input->post('preop');
		$this->edit_caselog_model->edit_critical_events_preop($patient_form_id,$critical_events_preop);
	}
   $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED DIAGNOSIS INFORMATION</b></span></font></p>');
   redirect('caselog_controller/index/'.$patient_id);
  }
}
else
{
 redirect('login', 'refresh');
}
}
function edit_epidural($patients_id='', $pf_id='')
{
	if($this->session->userdata('logged_in'))
	{
		$session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$data['anesth_needle_type'] = $this->dropdown_select->anesth_needle();
		$data['anesth_needle_gauge'] = $this->dropdown_select->anesth_needle_gauge();
		$this->load->view('header/header', $data);
		$this->load->view('caselog_form_update/edit_caselog_patient_epidural',$data);
		if ($this->input->post('submit'))
		{
		 $patient_information_id = $this->input->post('patient_information_id');
		 $patient_form_id = $this->input->post('patient_form_id');
		 $patient_id = $patient_information_id."/".$patient_form_id;
		 $spinal_needle = $this->input->post('spinal_needle');
		 $other_spinal_needle = $this->input->post('other_spinal_needle');
		 $epidural_needle = $this->input->post('epidural_needle');
		 $other_epidural_needle = $this->input->post('other_epidural_needle');
		 if ($spinal_needle == "Others (pls specify):"){ $spinal_needle = $other_spinal_needle; } else { $spinal_needle = $spinal_needle; }
		 if ($epidural_needle == "Others (pls specify):"){ $epidural_needle = $other_epidural_needle; } else { $epidural_needle = $epidural_needle; }
		 if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		 $datas2 = array(
				 'spinal_needle' => $spinal_needle,
				 'epidural_needle' => $epidural_needle,
				 'spinal_needle_gauge' => $this->input->post('spinal_needle_gauge'),
				 'epidural_needle_gauge' => $this->input->post('epidural_needle_gauge'),
				 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED PATIENT EPIDURAL</b></span></font></p>');
		 redirect('caselog_controller/index/'.$patient_id);
		}
}
}
function edit_anesthesia_information($patients_id='', $pf_id='')
{
	if($this->session->userdata('logged_in'))
	{
		$session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$this->load->view('header/header', $data);
		$this->load->view('caselog_form_update/edit_caselog_patient_anesthesia',$data);
		if ($this->input->post('submit'))
		{
		 $patient_information_id = $this->input->post('patient_information_id');
		 $patient_form_id = $this->input->post('patient_form_id');
		 $patient_id = $patient_information_id."/".$patient_form_id;
		 $spinal_needle = $this->input->post('spinal_needle');
		 $other_spinal_needle = $this->input->post('other_spinal_needle');
		 $epidural_needle = $this->input->post('epidural_needle');
		 $other_epidural_needle = $this->input->post('other_epidural_needle');
		 if ($spinal_needle == "Others (pls specify):"){ $spinal_needle = $other_spinal_needle; } else { $spinal_needle = $spinal_needle; }
		 if ($epidural_needle == "Others (pls specify):"){ $epidural_needle = $other_epidural_needle; } else { $epidural_needle = $epidural_needle; }
		 if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		 $datas2 = array(
		 'anesthesia_start' => $this->input->post('anesthesia_start'),
		 'anesthesia_start_time' => DATE("h:i A", STRTOTIME($this->input->post('anesthesia_start_hour').":".$this->input->post('anesthesia_start_min'))),
		 'anesthesia_end' => $this->input->post('anesthesia_end'),
		 'anesthesia_end_time' => DATE("h:i A", STRTOTIME($this->input->post('anesthesia_end_hour').":".$this->input->post('anesthesia_end_min'))),
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED PATIENT ANESTHESIA INFORMATION</b></span></font></p>');
		 redirect('caselog_controller/index/'.$patient_id);
		}
}
}
function edit_main_agents_information($patients_id='', $pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 
		$session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['main_agents_details'] = $this->edit_caselog_model->patient_form_main_agent_details($pf_id);
		$data['anesth_agent_data'] = $this->dropdown_select->anesth_agent();
		$data['patients_id'] = $patients_id;
		$data['pf_id'] = $pf_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_main_agents_information',$data);
		if ($this->input->post('submit'))
		{
		 $patient_information_id = $this->input->post('patient_information_id');
		 $patient_form_id = $this->input->post('patient_form_id');
		 $others_m = $this->input->post('other_main_agent');
		 $other_main_agent = $this->input->post('other_main_agent_data');
		 if ($others_m=="other_main_agent_checkbox"){$others_m = $other_main_agent;} else {$others_m = "NULL"; }
		if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		$datas2 = array(
		 'other_main_agent' => $others_m,
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $main_agent = $this->input->post('main_agent');
		if (!empty($main_agent))
		{
		 $this->edit_caselog_model->edit_main_agent_data($patient_form_id,$main_agent);
		}
		else
		{
		 $this->edit_caselog_model->delete_main_agent_data($patient_form_id,$main_agent);
		}
		 $patient_id = $patient_information_id."/".$patient_form_id;
		 $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED MAIN AGENTS</b></span></font></p>');
		 redirect('caselog_controller/index/'.$patient_id);
		}
	}
else
{
  redirect('login', 'refresh');
}
}
function edit_supp_agents_information($patients_id='', $pf_id='')
{
 if($this->session->userdata('logged_in'))
 {
  $session_data = $this->session->userdata('logged_in');
  $data['user_information'] = $session_data; 
  $data['supp_agents_details'] = $this->edit_caselog_model->patient_form_supp_agent_details($pf_id);
  $data['anesth_agent_data'] = $this->dropdown_select->anesth_agent();
  $data['patients_id'] = $patients_id;
  $data['pf_id'] = $pf_id;
  $data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
  $this->load->view('header/header',$data);
  $this->load->view('caselog_form_update/edit_caselog_supplementary_agents_information',$data);
  if ($this->input->post('submit'))
  {
   $patient_information_id = $this->input->post('patient_information_id');
   $patient_form_id = $this->input->post('patient_form_id');
   $other_supplementary_agent = $this->input->post('other_supplementary_agent');
   $other_supp_agent = $this->input->post('other_supp_agent_data');
   if ($other_supplementary_agent=="other_supp_agent_checkbox"){$other_supplementary_agent = $other_supp_agent;} else {$other_supplementary_agent = "NULL"; }
   if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
   $datas2 = array(
		 'other_supplementary_agent' => $other_supplementary_agent,
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $supplementary_agent = $this->input->post('supplementary_agent');
		 if (!empty($supplementary_agent))
		 {
		 $this->edit_caselog_model->edit_supplementary_agent_data($patient_form_id,$supplementary_agent);
		 }
		 $patient_id = $patient_information_id."/".$patient_form_id;
		 $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED SUPPLEMENTARY AGENTS</b></span></font></p>');
		 redirect('caselog_controller/index/'.$patient_id);
		}
	}
else
{
  redirect('login', 'refresh');
}
}
function edit_post_op_agents_information($patients_id='',$pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 $session_data = $this->session->userdata('logged_in');
	        $data['user_information'] = $session_data; 
		$data['patient_form_post_op_pain_agent_details'] = $this->edit_caselog_model->patient_form_post_op_pain_agent_details($pf_id);
		$data['anesth_agent_data'] = $this->dropdown_select->anesth_agent();
		$data['patients_id'] = $patients_id;
		$data['pf_id'] = $pf_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_post_op_pain_agents_information',$data);
		if ($this->input->post('submit'))
		{
		 $patient_information_id = $this->input->post('patient_information_id');
		 $patient_form_id = $this->input->post('patient_form_id');
		 $other_post_op_agent = $this->input->post('other_post_op_pain_agent');
		 $other_post_op_agent1 = $this->input->post('other_post_op_pain_agent_data');
		 if ($other_post_op_agent=="other_post_op_agent_checkbox"){$other_post_op_agent = $other_post_op_agent1;} else {$other_post_op_agent = "NULL"; }
		if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		$datas2 = array(
		 'other_post_op_pain_agent' => $other_post_op_agent,
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $post_op_pain_agent = $this->input->post('post_op_pain_agent');
		if (!empty($post_op_pain_agent))
		{
		 $this->edit_caselog_model->edit_post_op_agent_data($patient_form_id,$post_op_pain_agent);
		 }
		 $patient_id = $patient_information_id."/".$patient_form_id;
		 $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED POST OP PAIN AGENTS</b></span></font></p>');
		 redirect('caselog_controller/index/'.$patient_id);
		}
	}
else
{
  redirect('login', 'refresh');
}
}
function edit_post_op_pain_management_information($patients_id='',$pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 $session_data = $this->session->userdata('logged_in');
	        $data['user_information'] = $session_data; 
		$data['patient_form_id'] = $pf_id;
		$data['patient_information_id'] = $patients_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$data['anesth_post_op_pain_management_data'] = $this->dropdown_select->anesth_post_op_pain_management();
		$data['anesth_post_op_pain_management_data_1'] = $this->dropdown_select->anesth_post_op_pain_management_1();
		$data['patient_form_post_op_pain_management_details'] = $this->edit_caselog_model->patient_form_post_op_pain_management_details($pf_id);
		$data['patient_form_post_op_pain_management_details_1'] = $this->edit_caselog_model->patient_form_post_op_pain_management_details_1($pf_id);
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_post_op_pain_management_information',$data);
		if ($this->input->post('submit'))
		{
		 $pf_id = $this->input->post('patient_form_id');
		  //POST OF PAIN MANAGEMENT
		  $post_op_pain_management = $this->input->post('post_op_pain_management');
		  $this->edit_caselog_model->edit_post_op_pain_management_data($pf_id,$post_op_pain_management);
		  //POST OF PAIN MANAGEMENT 1
		  $post_op_pain_management_1 = $this->input->post('post_op_pain_management_1');
		  $this->edit_caselog_model->edit_post_op_pain_management_data_1($pf_id,$post_op_pain_management_1);
		  if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		$datas2 = array(
		 'anesth_status_id' => $anesth_status_id);
		  $patient_id = $this->input->post('patient_information_id')."/".$pf_id;
		  $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED POST OP PAIN MANAGEMENT</b></span></font></p>');
		  redirect('caselog_controller/index/'.$patient_id);
		}
		}
		else
		{
		 redirect('login', 'refresh');
		 }
		 }
function edit_monitors_used_information($patients_id='',$pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 $session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['patient_form_id'] = $pf_id;
		$data['patient_information_id'] = $patients_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$data['anesth_monitor_data'] = $this->dropdown_select->anesth_monitors();
		$data['patient_form_monitors_used_details'] = $this->edit_caselog_model->patient_form_monitors_used_details($pf_id);
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_monitors_used',$data);
		if ($this->input->post('submit'))
		{
		  $patient_form_id = $this->input->post('patient_form_id');
		  $monitors_used = $this->input->post('monitors_used');
		  $other_monitors_used = $this->input->post('other_monitors_used');
		  $other_monitors_used_data = $this->input->post('other_monitors_used_data');
		  if ($other_monitors_used=="other_monitors_used_checkbox"){$other_monitors_used = $other_monitors_used_data;} else {$other_monitors_used = "NULL"; }
		  if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		  $datas2 = array(
		 'other_monitors_used' => $other_monitors_used,
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		  $this->edit_caselog_model->edit_monitors_used_data($patient_form_id,$monitors_used);
		  $patient_id = $this->input->post('patient_information_id')."/".$patient_form_id;
		  $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED MONITORS USED</b></span></font></p>');
		  redirect('caselog_controller/index/'.$patient_id);
		}
		}
		else
		{
		 redirect('login', 'refresh');
		 }
}
function edit_replacement($patients_id='', $pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 $session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['patient_form_id'] = $pf_id;
		$data['patient_information_id'] = $patients_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$data['anesth_blood_loss'] = $this->dropdown_select->anesth_blood_loss();
		$data['anesth_colloids_used'] = $this->dropdown_select->anesth_colloids_used();
		$data['blood_loss'] = $this->edit_caselog_model->blood_loss($pf_id);
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_replacement',$data);
		if ($this->input->post('submit'))
		{
		  $patient_form_id = $this->input->post('patient_form_id');
		  $colloids_used = $this->input->post('colloids_used');
		  $other_colloids_used = $this->input->post('other_colloids_used');
		 if ($colloids_used =="Others") {$colloids_used = $other_colloids_used; } else { $colloids_used=$colloids_used; }
		  if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		 $datas2 = array(
		 'blood_loss' => $this->input->post('blood_loss'),
		 'crystalloids' => $this->input->post('crystalloids'),
		 'colloids' => $this->input->post('colloids'),
		 'colloids_used' => $colloids_used,
		 'blood_products_used' => $this->input->post('blood_products_used'),
		 'fresh_whole_blood' => $this->input->post('fresh_whole_blood'),
		 'cyroprecipitate' => $this->input->post('cyroprecipitate'),
		 'platelets' => $this->input->post('platelets'),
		 'fresh_frozen_plasma' => $this->input->post('fresh_frozen_plasma'),
		 'packed_rbc' => $this->input->post('packed_rbc'),
		 'others' => $this->input->post('others'),
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		  $patient_id = $this->input->post('patient_information_id')."/".$patient_form_id;
		  $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED REPLACEMENT</b></span></font></p>');
		  redirect('caselog_controller/index/'.$patient_id);
		}
		}
		else
		{
		 redirect('login', 'refresh');
		 }
}
function edit_procedure($patients_id='', $pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 $session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['patient_form_id'] = $pf_id;
		$data['patient_information_id'] = $patients_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_patient_procedure',$data);
		if ($this->input->post('submit'))
		{
		 $patient_form_id = $this->input->post('patient_form_id');
		 if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		 $datas2 = array(
		 'procedure_done' => $this->input->post('procedure_done'),
		 'other_procedure' => $this->input->post('other_procedure'),
		 'muscle_relaxant_reversal_done' => $this->input->post('muscle_relaxant_reversal_done'),
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $patient_id = $this->input->post('patient_information_id')."/".$patient_form_id;
		 $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED PROCEDURE</b></span></font></p>');
		 redirect('caselog_controller/index/'.$patient_id,'refresh');
		}
		}
		else
		{
		 redirect('login', 'refresh');
		 }
}
function edit_delivery($patients_id='', $pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 $session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['patient_form_id'] = $pf_id;
		$data['patient_information_id'] = $patients_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$data['apgar_information'] = $this->edit_caselog_model->apgar_details($pf_id);
		$data['anesth_agpar_score_data'] = $this->dropdown_select->anesth_agpar_score();
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_patient_delivery',$data);
		if ($this->input->post('submit'))
		{
		 $patient_form_id = $this->input->post('patient_form_id');
		 if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		 $datas2 = array(
		 'if_delivery' => $this->input->post('if_delivery'),
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		  $data_agpar = array(
		 'patient_form_id' =>$patient_form_id,
		 'apgar_score_1m' => $this->input->post('agpar_score_1m'),
		 'apgar_score_5m' => $this->input->post('agpar_score_5m'),
		 'apgar_score_10m' => $this->input->post('agpar_score_10m'));
		 $this->edit_caselog_model->add_apgar_score($patient_form_id,$data_agpar);
		 if ($this->input->post('if_delivery') == "NO")
		 {
		  $this->edit_caselog_model->delete_apgar_score($patient_form_id);
		 }
		 $patient_id = $this->input->post('patient_information_id')."/".$patient_form_id;
		 $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED DELIVERY</b></span></font></p>');
		 redirect('caselog_controller/index/'.$patient_id,'refresh');
		}
		if ($this->input->post('update_apgar'))
		{
		 $patient_form_apgar_details_id = $this->input->post('patient_form_apgar_details_id');
		 $patient_form_id = $this->input->post('patient_form_id');
		 $data = array(
		 'apgar_score_1m' => $this->input->post('apgar_score_1m'),
		 'apgar_score_5m' => $this->input->post('apgar_score_5m'),
		 'apgar_score_10m' => $this->input->post('apgar_score_10m'));
		 $this->edit_caselog_model->edit_apgar_score($patient_form_apgar_details_id,$data);
		 $datas2 = array('anesth_status_id' => '7');
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $patient_id = $this->input->post('patient_information_id')."/".$patient_form_id;
		  redirect('edit_caselog_controller/edit_delivery/'.$patient_id,'refresh');
		}
		}
		else
		{
		 redirect('login', 'refresh');
		 }
}
function edit_other_information($patients_id='', $pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 $session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['patient_form_id'] = $pf_id;
		$data['patient_information_id'] = $patients_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_other_information',$data);
		if ($this->input->post('submit'))
		{
		 $patient_form_id = $this->input->post('patient_form_id');
		 if ($this->input->post('anesth_status_id') == "8")
		 { $anesth_status_id = "8";}else{$anesth_status_id = "7";}
		 $datas2 = array(
		 'post_operative_diagnosis' => $this->input->post('post_operative_diagnosis'),
		 'discharge_notes' => $this->input->post('discharge_notes'),
		 'other_notes' => $this->input->post('other_notes'),
		 'anesth_status_id' => $anesth_status_id);
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		  $patient_id = $this->input->post('patient_information_id')."/".$patient_form_id;
		  $this->session->set_flashdata("success",'<p style="background-color:#fafad2; width:70%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;"><font size="3" color="green"><span style="padding-top:10px;"><b>SUCCESSFULLY UPDATED OTHER INFORMATION</b></span></font></p>');
		  redirect('caselog_controller/index/'.$patient_id,'refresh');
		}
		}
		else
		{
		 redirect('login', 'refresh');
		 }
}
function edit_critical_events_information($patients_id='', $pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 $session_data = $this->session->userdata('logged_in');
		$data['user_information'] = $session_data; 
		$data['patient_form_id'] = $pf_id;
		$data['patient_information_id'] = $patients_id;
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$data['critical_events_airway_data'] = $this->dropdown_select->critical_level_airway();
		$data['critical_events_cardiovacular_data'] = $this->dropdown_select->critical_level_cardiovascular();
		$data['critical_events_discharge_planning_data'] = $this->dropdown_select->critical_level_discharge_planning();
		$data['critical_events_miscellaneous_data'] = $this->dropdown_select->critical_level_miscellaneous();
		$data['critical_events_airway_details'] = $this->edit_caselog_model->critical_events_airway_details($pf_id);$data['critical_level_neurological_data'] = $this->dropdown_select->critical_level_neurogical();
		$data['critical_level_respiratory_data'] = $this->dropdown_select->critical_level_respiratory();
		$data['critical_level_regional_anesthesia_data'] = $this->dropdown_select->critical_level_regional_anesthesia();
		$data['critical_level_preop_data'] = $this->dropdown_select->critical_level_preop();
		$data['critical_events_airway_details'] = $this->edit_caselog_model->critical_events_airway_details($pf_id);
		$data['critical_events_cardiovascular_details'] = $this->edit_caselog_model->critical_events_cardiovascular_details($pf_id);
		$data['critical_events_discharge_planning_details'] = $this->edit_caselog_model->critical_level_discharge_planning_details($pf_id);
		$data['critical_events_miscellaneous_details'] = $this->edit_caselog_model->critical_level_miscellaneous_details($pf_id);
		$data['critical_level_neurological_details'] = $this->edit_caselog_model->critical_level_neurological_details($pf_id);
		$data['critical_level_respiratory_details'] = $this->edit_caselog_model->critical_level_respiratory_details($pf_id);
		$data['critical_level_regional_anesthesia_details'] = $this->edit_caselog_model->critical_level_regional_anesthesia_details($pf_id);
		$data['critical_level_preop_details'] = $this->edit_caselog_model->critical_level_preop_details($pf_id);
		$this->load->view('header/header',$data);
		$this->load->view('caselog_form_update/edit_caselog_critical_events',$data);
		if ($this->input->post('submit'))
		{
			$array = $_POST['miscellaneous'][9];
			$patient_form_id = $this->input->post('patient_form_id');
		}
		}
		else
		{
		 redirect('login', 'refresh');
		 }
}
}
?>