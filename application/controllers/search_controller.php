<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search_controller extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->model('dropdown_select','',TRUE);
   $this->load->model('user');
   $this->load->model('search/search_caselog_model','search_caselogs');
   $this->load->library('session');
   $this->load->helper('url');
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
     $data['institution_id'] = $session_data['institution_id'];
     $this->load->view('header/header', $data);
     $this->load->view('search/search_index_view');
   }
   else
   {
     redirect('login', 'refresh');
   }
}
function searched_index()
{
 if($this->session->userdata('logged_in'))
 {
  
  $case_number = $this->input->post('case_number');
  $institution_id = $this->input->post('institution_id');
  $datas['case_number'] = $this->user->case_number_checking($case_number,$institution_id);
  if ($datas['case_number'] == true)
  {
   $session_data = $this->session->userdata('logged_in');
   $data['username'] = $session_data['username'];
   $data['lastname'] = $session_data['lastname'];
   $data['firstname'] = $session_data['firstname'];
   $data['middle_initials'] = $session_data['middle_initials'];
   $data['role_id'] = $session_data['role_id'];
   $data['id'] = $session_data['id'];
   $data['institution_id'] =  $session_data['institution_id'];
   $datas['case_number'] = $this->user->case_number_checking($case_number,$institution_id);
   $this->load->view('header/header',$data);
   $this->load->view('search/searched_index_view',$datas);
  }
  else
  {
   $error['message'] = "CASE NUMBER NOT EXIST.";
   $session_data = $this->session->userdata('logged_in');
   $data['username'] = $session_data['username'];
   $data['lastname'] = $session_data['lastname'];
   $data['firstname'] = $session_data['firstname'];
   $data['middle_initials'] = $session_data['middle_initials'];
   $data['role_id'] = $session_data['role_id'];
   $data['id'] = $session_data['id'];
   $data['institution_id'] = $session_data['institution_id'];
   $this->load->view('header/header',$data);
   $this->load->view('search/search_index_view',$error);
}
}
else
{
 redirect('login', 'refresh');
}
}
 function searchcaselog()
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
     $insti_id = $session_data['institution_id'];
     $this->load->view('header/header', $data);
     $datas['institution_list'] = $this->dropdown_select->anesth_institutions();
     $datas['users_list'] = $this->dropdown_select->users_lists($insti_id);
     $datas['status_list'] = $this->dropdown_select->anesth_status();
     $this->load->view('search/search_caselog_view',$datas);
   }
   else
   {
     redirect('login', 'refresh');
   }
 }
  function searchcaselog_details()
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
     $insti_id = $session_data['institution_id'];
     
          $user_id        = $this->input->get('user_id');
          $institution_id = $this->input->get('institution_id');
          $status_id = $this->input->get('status_id');
          
          $this->load->library('pagination');
          if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
          $config["base_url"] = base_url()."index.php/search_controller/searchcaselog_details/";
          $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
          if ($user_id != 0 && $status_id == 0)
          {
          $config["total_rows"] = $this->search_caselogs->count_search_caselog_details_1($user_id,$insti_id);
          }
          if ($status_id != 0 && $user_id == 0)
          {
           $config["total_rows"] = $this->search_caselogs->count_search_caselog_details_2($status_id,$insti_id);
          }
          if ($status_id == 0 && $user_id == 0)
          {
           $config["total_rows"] = $this->search_caselogs->count_search_caselog_details_3($insti_id);
          }
          if ($status_id != 0 && $user_id != 0)
          {
           $config["total_rows"] = $this->search_caselogs->count_search_caselog_details_4($user_id,$insti_id);
          }
          $config["per_page"] = 10;
          $config["uri_segment"] = 3;
          $this->pagination->initialize($config);
           $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
           $datas["caselog_information"] = $this->search_caselogs->fetch_search_caselog_details($page,$config["per_page"],$user_id,$institution_id,$status_id,$insti_id);
           $datas['institution_list'] = $this->dropdown_select->anesth_institutions();
	   $datas['users_list']       = $this->dropdown_select->users_lists($insti_id);
	   $datas['status_list']      = $this->dropdown_select->anesth_status();
           $datas['user_id']          = $this->input->get('user_id');
           $datas['institution_id']   = $this->input->get('institution_id');
           $datas['status_id']        = $this->input->get('status_id');
           $this->input->get('status');
           $this->load->view('header/header',$data);
           $this->load->view('search/search_caselog_details_view',$datas);
   }
   else
   {
    redirect('login', 'refresh');
   }
  }
}