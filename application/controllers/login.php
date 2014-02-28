<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
 function __construct()
 {
   parent::__construct();
 }
 function index()
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
     
  redirect('search_controller/index','refresh');
 }
 else
 {
  
   $this->load->helper(array('form'));
   $this->load->view('login_view');
 }
 }
}
?>