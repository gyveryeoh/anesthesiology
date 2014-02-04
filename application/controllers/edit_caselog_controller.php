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
		$this->load->view('caselog_form_update/edit_caselog_patient_information.php',$data);
}	
}
function edit_patient_information()
{
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
		'for_emergency' => $this->input->post('for_emergency'));
	$this->edit_caselog_model->edit_patient_info($patient_information_id,$datas);	
	$this->edit_caselog_model->edit_patient_form($patient_form_id,$datas2);
	redirect('caselog_controller/index/'.$patient_id);

}
}
?>