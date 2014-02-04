<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_controller extends CI_Controller
{
 function __construct()
 {
   parent::__construct();
   $this->load->model('users_model/users_model','view_caselogs');
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
     $data['institution_id'] = $session_data['institution_id'];
     $data['user_role'] = $this->dropdown_select->roles();
     $this->load->view('header/header', $data);
     $this->load->view('header/users_header');
     $this->load->view('users/users_add');
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
    $data['message'] = "Password and Confirm Password do not Match.";
    $data['user_role'] = $this->dropdown_select->roles();
    $this->load->view('header/header', $data);
    $this->load->view('users/users_add');
    }
    elseif ($data['username'] == true)
    {
     $data['user_message'] = "USERNAME IS ALREADY EXISTS.";
     $data['user_role'] = $this->dropdown_select->roles();
     $this->load->view('header/header', $data);
     $this->load->view('users/users_add');
     }
     else
     {
      $data = array
      ('institution_id' => 1,
       'lastname'       => $this->input->post('lastname'),
       'firstname'      => $this->input->post('firstname'),
       'middle_initials'=> $this->input->post('middle_initials'),
       'username'       => $username,
       'password'	=> md5($this->input->post('password')),
       'role_id'	=> $this->input->post('role_id'));
       $this->user->save_user($data);
       $data['user_role'] = $this->dropdown_select->roles();
       $data['username'] = $session_data['username'];
       $data['lastname'] = $session_data['lastname'];
       $data['firstname'] = $session_data['firstname'];
       $data['middle_initials'] = $session_data['middle_initials'];
       $data['role_id'] = $session_data['role_id'];
       $data['id'] = $session_data['id'];
       $this->session->set_flashdata("success",'<b>SUCCESSFULLY CREATED RESIDENT INFO</b>');
       redirect('users_controller/add_user');
       }
       }
       else
       {
	//If no session, redirect to login page
	redirect('login', 'refresh');
	}
	}
function users_caselog()
{
 if($this->session->userdata('logged_in'))
 {
  $status = $this->input->get('status');
  $session_data = $this->session->userdata('logged_in');
  $data['username'] = $session_data['username'];
  $data['lastname'] = $session_data['lastname'];
  $data['firstname'] = $session_data['firstname'];
  $data['middle_initials'] = $session_data['middle_initials'];
  $data['role_id'] = $session_data['role_id'];
  $data['id'] = $session_data['id'];
  $user_id = $data['id'];
  $this->load->library('pagination');
  if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
  $config["base_url"] = base_url()."index.php/users_controller/users_caselog";
  $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
  $config["total_rows"] = $this->view_caselogs->count_view_caselog_details_1($user_id,$status);
  $config["per_page"] = 10;
  $config["uri_segment"] = 3;
  $this->pagination->initialize($config);
  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
  $datas["caselog_information"] = $this->view_caselogs->fetch_search_caselog_details($page,$config["per_page"],$user_id,$status);	
  $datas["count_all"] = $this->view_caselogs->count_view_caselog_details_1($user_id,0);
  $datas["count_submitted"] = $this->view_caselogs->count_view_caselog_details_1($user_id,1);
  $datas["count_forRevision"] = $this->view_caselogs->count_view_caselog_details_1($user_id,3);
  $datas["count_approved"] = $this->view_caselogs->count_view_caselog_details_1($user_id,4);
  $datas["count_disapproved"] = $this->view_caselogs->count_view_caselog_details_1($user_id,5);
  $datas["count_deleted"] = $this->view_caselogs->count_view_caselog_details_1($user_id,7);
  $datas['status_list']      = $this->dropdown_select->anesth_status();
  $this->load->view('header/header', $data);
  $this->load->view('header/reports_header');
  $this->load->view('users/users_caselog',$datas);
  }
  else
  {
   redirect('login', 'refresh');
  }
  }
function change_password()
{
 if($this->session->userdata('logged_in'))
 {
  $data["error_1"] = 0;
  $data["error_2"] = 0;
  $data["error_3"] = 0;
  $data["success"] = 0;
  $session_data = $this->session->userdata('logged_in');
  $data['username'] = $session_data['username'];
  $data['lastname'] = $session_data['lastname'];
  $data['firstname'] = $session_data['firstname'];
  $data['middle_initials'] = $session_data['middle_initials'];
  $data['role_id'] = $session_data['role_id'];
  $data['id'] = $session_data['id'];
  $this->load->view('header/header', $data);
  $this->load->view('header/users_header', $data);
  if($this->input->post('old_password') != NULL and $this->input->post('new_password') != NULL and $this->input->post('confirm_password') != NULL)
  {
   $old_password = $this->input->post('old_password');
   $new_password = $this->input->post('new_password');
   $confirm_password = $this->input->post('confirm_password');
   $data["validate_old"] = $this->user->password_checking($data['username'],$old_password);
   if($data["validate_old"] == False)
   {
    $data["error_1"] = 1;
    }
    if($new_password != $confirm_password)
    {
     $data["error_2"] = 1;
     }
     if($data["error_1"] != 1 and $data["error_2"] != 1)
     {
      $username = $data['username'];
      $datas = array(
       'password' => md5($this->input->post('new_password')),
       );
      $data["change_password"] = $this->user->change_password($datas,$username);
      $data["success"] = 1;
      }
      }
       $this->load->view('users/change_password',$data);
       }
       else
       {
	 //If no session, redirect to login page
	 redirect('login', 'refresh');
	   }
	}
}