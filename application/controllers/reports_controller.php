<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports_controller extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->model('dropdown_select','',TRUE);
   $this->load->model('reports/reports_model','reports_model');
   $this->load->library('session');
   $this->load->helper('url');
 }
 function index()
 {
  $session_data = $this->session->userdata('logged_in');
  $data["user_information"] = $session_data;
  $user_id = $session_data['id'];
  $datas['anesth_technique'] = $this->dropdown_select->anesth_techniques_reports();
  $index = 1;
  foreach($datas['anesth_technique'] as $n)
  {
   $datas["count_per_technique"][$index] = $this->reports_model->anesth_technique_count($n->id,$user_id);
   $index+=1;
  }
  $this->load->view('header/header',$data);
  $this->load->view('header/reports_header');
  $this->load->view('reports/anesth_technique_per_resident',$datas);
	}
 
}