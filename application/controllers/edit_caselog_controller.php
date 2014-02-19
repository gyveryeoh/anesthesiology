<?php
class Edit_caselog_controller extends CI_Controller {
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
		$user_id = $data['id'] = $session_data['id'];
		$data['username'] = $session_data['username'];
		$data['lastname'] = $session_data['lastname'];
		$data['firstname'] = $session_data['firstname'];
		$data['middle_initials'] = $session_data['middle_initials'];
		$data['role_id'] = $session_data['role_id'];
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
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
		 'anesth_status_id' => '7');
	$this->edit_caselog_model->edit_patient_info($patient_information_id,$datas);	
	$this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
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
  $user_id = $data['id'] = $session_data['id'];
  $data['username'] = $session_data['username'];
  $data['lastname'] = $session_data['lastname'];
  $data['firstname'] = $session_data['firstname'];
  $data['middle_initials'] = $session_data['middle_initials'];
  $data['role_id'] = $session_data['role_id'];
  $data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
  $data['anesth_services_data'] = $this->dropdown_select->anesth_services();
  $data['anesth_technique_data'] = $this->dropdown_select->anesth_techniques();
  $data['apnbapt_data'] = $this->dropdown_select->anesth_peripheral_nerve_blocks_and_pain_techniques();
  $data['critical_level_airway'] = $this->dropdown_select->critical_level_airway();
  $data['critical_level_cardiovascular'] = $this->dropdown_select->critical_level_cardiovascular();
  $data['critical_level_discharge_planning'] = $this->dropdown_select->critical_level_discharge_planning();
  $data['critical_level_miscellaneous'] = $this->dropdown_select->critical_level_miscellaneous();
  $data['critical_level_neurogical'] = $this->dropdown_select->critical_level_neurogical();
  $data['critical_level_respiratory'] = $this->dropdown_select->critical_level_respiratory();
  $data['critical_level_regional_anesthesia'] = $this->dropdown_select->critical_level_regional_anesthesia();
  $data['critical_level_preop'] = $this->dropdown_select->critical_level_preop();
  $data['anesth_post_op_pain_management_data'] = $this->dropdown_select->anesth_post_op_pain_management();
  $data['anesth_post_op_pain_management_data_1'] = $this->dropdown_select->anesth_post_op_pain_management_1();
  $data['anesth_airway_data'] = $this->dropdown_select->anesth_airway();
  $this->load->view('header/header', $data);
  $this->load->view('caselog_form_update/edit_caselog_patient_diagnosis',$data);
  if ($this->input->post('diagnosis') != NULL)
  {
    $patient_information_id = $this->input->post('patient_information_id');
    $patient_form_id = $this->input->post('patient_form_id');
    $anesthetic_technique = $this->input->post('anesthetic_technique');
    $peripheral = $this->input->post('peripheral');
    $airway = $this->input->post('airway');
    $other_airway = $this->input->post('other_airway');
    $patient_id = $patient_information_id."/".$patient_form_id;
    if ($airway == "Others (pls specify):"){$airway  = $other_airway; } else { $airway = $airway; }
    if ($anesthetic_technique == "9") {$peripheral = $peripheral;} else {$peripheral = "NULL";}
   $datas2 = array(
    'diagnosis' => $this->input->post('diagnosis'),
    'comorbid_diseases' => $this->input->post('comorbid_diseases'),
    'service' => $this->input->post('service'),
    'anesthetic_technique' => $this->input->post('anesthetic_technique'),
    'airway' => $airway,
    'peripheral' => $peripheral,
    'anesth_status_id' => '7');
   $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
   redirect('caselog_controller/index/'.$patient_id);
  }
}
else
{
 redirect('login', 'refresh');
}
}
function edit_anesthesia_information($patients_id='', $pf_id='')
{
	if($this->session->userdata('logged_in'))
	{
		$session_data = $this->session->userdata('logged_in');
		$user_id = $data['id'] = $session_data['id'];
		$data['username'] = $session_data['username'];
		$data['lastname'] = $session_data['lastname'];
		$data['firstname'] = $session_data['firstname'];
		$data['middle_initials'] = $session_data['middle_initials'];
		$data['role_id'] = $session_data['role_id'];
		
		$data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
		$data['anesth_needle_type'] = $this->dropdown_select->anesth_needle();
		$data['anesth_needle_gauge'] = $this->dropdown_select->anesth_needle_gauge();
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
  $datas2 = array(
		 'spinal_needle' => $spinal_needle,
		 'epidural_needle' => $epidural_needle,
		 'spinal_needle_gauge' => $this->input->post('spinal_needle_gauge'),
		 'epidural_needle_gauge' => $this->input->post('epidural_needle_gauge'),
		 'anesthesia_start' => $this->input->post('anesthesia_start'),
		 'anesthesia_start_time' => $this->input->post('anesthesia_start_hour').":".$this->input->post('anesthesia_start_min')." ".$this->input->post('anesthesia_start_time'),
		 'anesthesia_end' => $this->input->post('anesthesia_end'),
		 'anesthesia_end_time' => $this->input->post('anesthesia_end_hour').":".$this->input->post('anesthesia_end_min')." ".$this->input->post('anesthesia_end_time'),
		 'anesth_status_id' => '7');
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 redirect('caselog_controller/index/'.$patient_id);
		}
}
}
function edit_main_agents_information($patients_id='', $pf_id='')
{
 if($this->session->userdata('logged_in'))
	{
	 
		$session_data = $this->session->userdata('logged_in');
		$user_id = $data['id'] = $session_data['id'];
		$data['lastname'] = $session_data['lastname'];
		$data['firstname'] = $session_data['firstname'];
		$data['middle_initials'] = $session_data['middle_initials'];
		$data['role_id'] = $session_data['role_id'];
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
		  $datas2 = array(
		 'other_main_agent' => $others_m,
		 'anesth_status_id' => '7');
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
  $user_id = $data['id'] = $session_data['id'];
  $data['lastname'] = $session_data['lastname'];
  $data['firstname'] = $session_data['firstname'];
  $data['middle_initials'] = $session_data['middle_initials'];
  $data['role_id'] = $session_data['role_id'];
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
   $datas2 = array(
		 'other_supplementary_agent' => $other_supplementary_agent,
		 'anesth_status_id' => '7');
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $supplementary_agent = $this->input->post('supplementary_agent');
		 if (!empty($supplementary_agent))
		 {
		 $this->edit_caselog_model->edit_supplementary_agent_data($patient_form_id,$supplementary_agent);
		 }
		 $patient_id = $patient_information_id."/".$patient_form_id;
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
		$user_id = $data['id'] = $session_data['id'];
		$data['lastname'] = $session_data['lastname'];
		$data['firstname'] = $session_data['firstname'];
		$data['middle_initials'] = $session_data['middle_initials'];
		$data['role_id'] = $session_data['role_id'];
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
		  $datas2 = array(
		 'other_post_op_pain_agent' => $other_post_op_agent,
		 'anesth_status_id' => '7');
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		 $post_op_pain_agent = $this->input->post('post_op_pain_agent');
		if (!empty($post_op_pain_agent))
		{
		 $this->edit_caselog_model->edit_post_op_agent_data($patient_form_id,$post_op_pain_agent);
		 }
		 $patient_id = $patients_id."/".$patient_form_id;
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
		$user_id = $data['id'] = $session_data['id'];
		$data['lastname'] = $session_data['lastname'];
		$data['firstname'] = $session_data['firstname'];
		$data['middle_initials'] = $session_data['middle_initials'];
		$data['role_id'] = $session_data['role_id'];
		$data['patient_form_id'] = $pf_id;
		$data['patient_information_id'] = $patients_id;
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
		  $patient_id = $this->input->post('patient_information_id')."/".$pf_id;
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
		$user_id = $data['id'] = $session_data['id'];
		$data['lastname'] = $session_data['lastname'];
		$data['firstname'] = $session_data['firstname'];
		$data['middle_initials'] = $session_data['middle_initials'];
		$data['role_id'] = $session_data['role_id'];
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
   $datas2 = array(
		 'other_monitors_used' => $other_monitors_used,
		 'anesth_status_id' => '7');
		 $this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
		  $this->edit_caselog_model->edit_monitors_used_data($patient_form_id,$monitors_used);
		  $patient_id = $this->input->post('patient_information_id')."/".$patient_form_id;
		  redirect('caselog_controller/index/'.$patient_id);
		}
		}
		else
		{
		 redirect('login', 'refresh');
		 }
}





function index_form($patients_id='', $pf_id='')
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['lastname'] = $session_data['lastname'];
			$data['firstname'] = $session_data['firstname'];
			$data['middle_initials'] = $session_data['middle_initials'];
			$data['role_id'] = $session_data['role_id'];
			$data['id'] = $session_data['id'];
			$this->load->view('header/header', $data);
			$data['patient_information'] = $this->edit_caselog_model->select_patient_information($patients_id,$pf_id);
			$data['anesth_needle'] = $this->edit_caselog_model->anesth_needle();
			$data['anesth_epidural_needle'] = $this->edit_caselog_model->anesth_epidural_needle();
	    
			
			$data['patient_form_supplementary_agent_details'] = $this->edit_caselog_model->patient_form_supplementary_agent_details($pf_id);
			$data['patient_form_post_op_pain_agent_details'] = $this->edit_caselog_model->patient_form_post_op_pain_agent_details($pf_id);
			$data['anesth_monitor_data'] = $this->edit_caselog_model->anesth_monitors();
			$data['patient_form_monitors_used_details'] = $this->edit_caselog_model->patient_form_monitors_used_details($pf_id);
			$data['anesth_blood_loss'] = $this->edit_caselog_model->anesth_blood_loss();
			$data['blood_loss'] = $this->edit_caselog_model->blood_loss($pf_id);
			$data['anesth_colloids_used'] = $this->edit_caselog_model->anesth_colloids_used();
			$this->load->view('caselog_form_update/edit_caselog_form',$data);
			//$this->load->view('home_view');
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	function edit_patient_form()
	{
		  $patient_id = $this->input->post('patient_information_id');
		  $pf_id = $this->input->post('patient_form_id');
		  $monitors_used = $this->input->post('monitors_used');
		  
		  
		  
		 $other_main_agent = $this->input->post('other_main_agent_data');
		  $others_s = $this->input->post('other_supplementary_agent');
		  $other_supplementary_agent = $this->input->post('other_supplementary_agent_data');
		  $other_post = $this->input->post('other_post_op_pain_agent');
		  $other_post_op_pain_agent = $this->input->post('other_post_op_pain_agent_data');
		  $colloids_used = $this->input->post('colloids_used');
		  $other_colloids_used = $this->input->post('other_colloids_used');
		  
		  
		  $critical_events = $this->input->post('critical_events');
		  
		  
		  
		 if ($colloids_used =="Others") {$colloids_used = $other_colloids_used; } else { $colloids_used=$colloids_used; }
		  
		  if ($others_s=="other_supplementary_agent_checkbox"){$others_s = $other_supplementary_agent;} else {$others_s = "NULL"; } 
		  if ($other_post=="other_post_op_pain_agent_checkbox"){$other_post = $other_post_op_pain_agent;} else {$other_post = "NULL"; } 
		  if ($this->input->post('colloids') == "NO") { $colloids_used = "NULL"; } else { $colloids_used = $colloids_used; }
		  if ($anesthetic_technique == "3") {$critical_events ="YES";}
		  if($this->session->userdata('logged_in'))
       {
        $session_data = $this->session->userdata('logged_in');
        $data['username'] = $session_data['username'];
        $data['lastname'] = $session_data['lastname'];
        $data['firstname'] = $session_data['firstname'];
        $data['middle_initials'] = $session_data['middle_initials'];
        $data['role_id'] = $session_data['role_id'];
        $data['id'] = $session_data['id'];
  $data = array(
   'patient_information_id' => $this->input->post('patient_information_id'),
   'user_id' => $data['id'],
   'diagnosis' => $this->input->post('diagnosis'),
   'comorbid_diseases' => $this->input->post('comorbid_diseases'),
   'service' =>  $this->input->post('service'),
   'anesthetic_technique' => $anesthetic_technique,
   
   'airway' => $airway,
   'other_main_agent' => $others_m,
   'other_supplementary_agent' => $others_s,
   'other_post_op_pain_agent' => $other_post,
   'other_monitors_used' => $other_monitors_used,
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
   'procedure_done' => $this->input->post('procedure_done'),
   'other_procedure' => $this->input->post('other_procedure'),
   'muscle_relaxant_reversal_done' => $this->input->post('muscle_relaxant_reversal_done'),
   'if_delivery' => $this->input->post('if_delivery'),
   'post_operative_diagnosis' => $this->input->post('post_operative_diagnosis'),
   'discharge_notes' => $this->input->post('discharged_notes'),
   'other_notes' => $this->input->post('other_notes'),
   'critical_events' => $critical_events
);
$this->edit_caselog_model->edit_anesthesiology_information_data($data,$pf_id);
  // $patient_form_id = $this->db->insert_id();
  // if($this->input->post('if_delivery') == "YES")
  // {
   // $agpar_score_1m = $this->input->post('agpar_score_1m');
   // $agpar_score_5m = $this->input->post('agpar_score_5m');
   // $agpar_score_10m = $this->input->post('agpar_score_10m');
   // $this->user->add_apgar_data($patient_form_id,$agpar_score_1m,$agpar_score_5m,$agpar_score_10m);
  // }
  //CRITICAL EVENTS
  // if ($critical_events == "YES")
  // {
 //  AIRWAY
   // $critical_level_airway = $this->input->post('critical_level_airway');
    // $this->user->add_critical_level_airway($patient_form_id,$critical_level_airway);
  // CARDIOVASCULAR
   // $critical_level_cardiovascular = $this->input->post('critical_level_cardiovascular');
    // $this->user->add_critical_level_cardiovascular($patient_form_id,$critical_level_cardiovascular);
   // DISCHARGE PLANNING
   // $critical_level_discharge_planning = $this->input->post('critical_level_discharge_planning');
    // $this->user->add_critical_level_discharge_planning($patient_form_id,$critical_level_discharge_planning);
    //MISCELLANEOUS
    // $miscellaneous = $this->input->post('critical_level_miscellaneous');
    // $this->user->add_critical_level_miscellaneous($patient_form_id,$miscellaneous);
    //NEUROLOGICAL
    // $neurological = $this->input->post('critical_level_neurological');
    // $this->user->add_critical_level_neurological($patient_form_id,$neurological);
    //RESPIRATORY
    // $respiratory = $this->input->post('critical_level_respiratory');
    // $this->user->add_critical_level_respiratory($patient_form_id,$respiratory);
    //REGIONAL ANESTHESIA
    // $regional_anesthesia = $this->input->post('critical_level_regional_anesthesia');
    // $this->user->add_critical_level_regional_anesthesia($patient_form_id,$regional_anesthesia);
    //PREOP
    // $preop = $this->input->post('critical_level_preop');
    // $this->user->add_critical_level_preop($patient_form_id,$preop);
  // }
  //MONITORS USED
 
  redirect('home/successful_data','refresh');
 }
}
}
?>
