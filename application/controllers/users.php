<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
   $this->load->model('dropdown_select','',TRUE);
   $this->load->library('session');
   $this->load->helper('url');
 }
 function add_user()
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
     $this->load->view('header', $data);
     $this->load->view('users/add_user');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
}