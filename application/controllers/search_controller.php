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
     $data["user_information"] = $session_data;
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
   $session_data = $this->session->userdata('logged_in');
   $data["user_information"] = $session_data;
   $case_number = $this->input->post('case_number');
   $datas['case_number'] = $this->user->case_number_checking($case_number,$session_data['institution_id']);
  if ($datas['case_number'] == true)
  {
   $datas['case_number'] = $this->user->case_number_checking($case_number,$session_data['institution_id']);
   $this->load->view('header/header',$data);
   $this->load->view('search/searched_index_view',$datas);
  }
  else
  {
   $error['message'] = "CASE NUMBER DOES NOT EXIST.";
   $session_data = $this->session->userdata('logged_in');
   $data["user_information"] = $session_data;
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
        $this->load->library('pagination');
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config["base_url"] = base_url()."index.php/search_controller/searchcaselog/";
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
	$insti_id = $session_data['institution_id'];
        $datas['institution_list'] = $this->dropdown_select->anesth_institutions();
        $datas['users_list'] = $this->dropdown_select->users_lists($insti_id);
        $datas['status_list'] = $this->dropdown_select->anesth_status();
        $datas['service'] = $this->dropdown_select->anesth_services();
        $datas['technique'] = $this->dropdown_select->anesth_techniques();
        $this->load->view('header/header', $data);
        if ($this->input->get('submit'))
                {
                        $case_number       = $this->input->get('case_number');
                        $service           = $this->input->get('service');
                        $technique         = $this->input->get('technique');
                        $user_id           = $this->input->get('user_id');
                        $status_id         = $this->input->get('status_id');
                        $include_date      = $this->input->get('include_date');
                        $start_date        = $this->input->get('start_date');
                        $end_date          = $this->input->get('end_date');
                        $hopital_id        = $this->input->get('hospital_id');
                        
                        $datas['total'] = $config["total_rows"] = $this->search_caselogs->count_search_caselog_details($case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hopital_id);
                        $config["per_page"] = 10;
                        $config["uri_segment"] = 3;
                        $this->pagination->initialize($config);
                        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                        $datas["caselog_information"] = $this->search_caselogs->fetch_search_caselog_details($page,$config["per_page"],$case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hopital_id);
                        }
     $this->load->view('search/search_caselog_view',$datas);
   }
   else
   {
     redirect('login', 'refresh');
   }
 }
 /*
   function admin_search_caselog()
  {
        if($this->session->userdata('logged_in'))
        {
                $this->load->library('pagination');
                if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
                        $config["base_url"] = base_url()."index.php/search_controller/admin_search_caselog/";
                        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
                $session_data = $this->session->userdata('logged_in');
                $data["user_information"] = $session_data;
                $data['status_list'] = $this->dropdown_select->anesth_status();
                $data['institution_list'] = $this->dropdown_select->anesth_institutions();
                $this->load->view('header/header',$data);
                if ($this->input->get('submit'))
                {
                        $institution_id = $this->input->get('institution_id');
                        $user_id = $this->input->get('users_id');
                        $status_id = $this->input->get('status_id');
                        $insti_id = "0";
                        $config["total_rows"] = $this->search_caselogs->count_caselog1($user_id,$status_id,$institution_id,$insti_id);
                        $config["per_page"] = 10;
                        $config["uri_segment"] = 3;
                        $this->pagination->initialize($config);
                        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                        
                        $data["caselog_information"] = $this->search_caselogs->fetch_search_caselog_details($page,$config["per_page"],$user_id,$status_id,$institution_id,$insti_id);
                }
                $this->load->view('search/admin_search_caselog',$data); 
        }
  }
  */
  }