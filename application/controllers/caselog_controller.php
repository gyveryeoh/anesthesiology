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
          $user_id = $data['id'] = $session_data['id'];
           $data['username'] = $session_data['username'];
           $data['lastname'] = $session_data['lastname'];
           $data['firstname'] = $session_data['firstname'];
           $data['middle_initials'] = $session_data['middle_initials'];
           $data['role_id'] = $session_data['role_id'];
           $data['patient_information'] = $this->caselog_model->select_patient_information($patients_id,$pf_id);
          if ($data['patient_information'] != false)
          {
          foreach ($data['patient_information'] as $delivery){}
          $patient_form_id = $delivery->patient_form_id;
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
          /*
          if($delivery->critical_events == "YES")
          {
          $data['critical_events_information'] = $this->caselog_model->patient_form_critical_events_details($patient_form_id);
          }
          */
          $this->load->view('header/header', $data);
	  $data['status_list'] = $this->dropdown_select->anesth_status();
          $this->load->view('caselog_view',$data);
          }
          else
          {
           $this->session->set_flashdata("success",'<p style="background-color:#faadad; width:80%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="../assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;"><b>CASE LOG FORM OF SELECTED PATIENT ARE NOT YET COMPLETED!</b></span></font></p>');
           redirect('home/resident_encoded?resident_id='.$r_id,'refresh');
          }
          }
          else
          {
           redirect('login', 'refresh');
          }
    }
function update_caselog()
{
 $patient_form_id = $this->input->post('patient_form_id');
 $data = array
 ('anesth_status_id'  => $this->input->post('anesth_status_id'),
  'notes'          => $this->input->post('notes'));
 $this->caselog_model->update_caselog_status($data,$patient_form_id);
 $this->load->view('header/header');
 $data['status_list'] = $this->dropdown_select->anesth_status();
 $this->load->view('caselog_view',$data);
}
}
?>