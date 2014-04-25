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
     if ($session_data['role_id'] == "1")
     {
     redirect('home','refresh');
     }
     if ($session_data['role_id'] == "2")
     {
     redirect('search_controller/searchcaselog','refresh');
     }
     if ($session_data['role_id'] == "3")
     {
     redirect('users_controller/add_user','refresh');
     }
     }
 else
 {
  
   $this->load->helper(array('form'));
   $this->load->view('login_view');
 }
 }
}
?>