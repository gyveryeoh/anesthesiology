<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }

 function index()
 {
   $this->load->library('form_validation');
   $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->load->view('login_view');
   }
   else
   {
     //Go to private area
     redirect('home', 'refresh');
   }

 }
 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');

   //query the database
   $result = $this->user->login($username, $password);

   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       if ($row->status == "1")
       {
        $this->form_validation->set_message('check_database', 'User Information is deactivated please contact PBA Office.');
        return false;
       }
       if ($row->role_id == "2" && $row->status == "0")
       {
        $sess_array = array(
         'id' => $row->id,
         'username' => $row->username,
         'lastname' => $row->lastname,
         'firstname' => $row->firstname,
         'middle_initials' => $row->middle_initials,
         'role_id' => $row->role_id,
         'institution_id' => $row->institution_id,
         'prc_number' => $row->prc_number,
         'year_lvl' => $row->year_lvl
       );
        $this->session->set_userdata('logged_in', $sess_array);
       $session_data = $this->session->userdata('logged_in');
        redirect('search_controller/searchcaselog', 'refresh');
       }
       if ($row->role_id == "3" && $row->status == "0")
       {
        $sess_array = array(
         'id' => $row->id,
         'username' => $row->username,
         'lastname' => $row->lastname,
         'firstname' => $row->firstname,
         'middle_initials' => $row->middle_initials,
         'role_id' => $row->role_id,
         'institution_id' => $row->institution_id,
         'prc_number' => $row->prc_number,
         'year_lvl' => $row->year_lvl
       );
        $this->session->set_userdata('logged_in', $sess_array);
       $session_data = $this->session->userdata('logged_in');
        redirect('users_controller/hospital_list', 'refresh');
       }
       else
       {
       $sess_array = array(
         'id' => $row->id,
         'username' => $row->username,
         'lastname' => $row->lastname,
         'firstname' => $row->firstname,
         'middle_initials' => $row->middle_initials,
         'role_id' => $row->role_id,
         'institution_id' => $row->institution_id,
         'prc_number' => $row->prc_number,
         'year_lvl' => $row->year_lvl
       );
       $this->session->set_userdata('logged_in', $sess_array);
       $session_data = $this->session->userdata('logged_in');
       $data = array
     ('user_id'    => $session_data['id']);
     $this->user->add_login_data($data);
     }
     return TRUE;
   }
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
?>
