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
     $data['user_role'] = $this->dropdown_select->roles();
     $this->load->view('header', $data);
     $this->load->view('users/add_user');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 function save_user()
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
			$username = $this->input->post('username');
			
			$data['username'] = $this->user->user_checking($username);
			if ($this->input->post('password') != $this->input->post('confirm_password'))
			{
			$data['user_message'] = "USERNAME ALREADY EXISTS.";
			$data['message'] = "Password and Confirm Password do not Match.";
			$data['user_role'] = $this->dropdown_select->roles();
			$this->load->view('header', $data);
			$this->load->view('users/add_user');
     }
     elseif ($data['username'] == true)
     {
     $data['user_message'] = "USERNAME ALREADY EXISTS.";
     $data['user_role'] = $this->dropdown_select->roles();
     $this->load->view('header', $data);
     $this->load->view('users/add_user');
     }
	else
	{
      $data = array
      ('institution_id'       	=> 1,
       'lastname'       	=> $this->input->post('lastname'),
       'firstname'      	=> $this->input->post('firstname'),
       'middle_initials'	=> $this->input->post('middle_initials'),
       'username'       	=> $username,
       'password'		=> md5($this->input->post('password')),
       'role_id'		=> $this->input->post('role_id'));
      $this->user->save_user($data);
      $data['user_role'] = $this->dropdown_select->roles();
      $data['username'] = $session_data['username'];
      $data['lastname'] = $session_data['lastname'];
      $data['firstname'] = $session_data['firstname'];
      $data['middle_initials'] = $session_data['middle_initials'];
      $data['role_id'] = $session_data['role_id'];
      $data['id'] = $session_data['id'];
      $this->session->set_flashdata("success",'<p style="background-color:#faadad; width:80%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="../assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;"><b>SUCCESSFULL CREATED RESIDENT INFO</b></span></font></p>');
      redirect('users/add_user');
      }
		}
      else
      {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
}