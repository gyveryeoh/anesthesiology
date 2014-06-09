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
                        $diagnosis         = $this->input->get('diagnosis');
                        $main_agent        = $this->input->get('main_agent');
                        $datas['total'] = $config["total_rows"] = $this->search_caselogs->count_search_caselog_details($case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hopital_id,$diagnosis,$main_agent);
                        $config["per_page"] = 10;
                        $config["uri_segment"] = 3;
                        $this->pagination->initialize($config);
                        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                        $datas["caselog_information"] = $this->search_caselogs->fetch_search_caselog_details($page,$config["per_page"],$case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hopital_id,$diagnosis,$main_agent);
                        }
     $this->load->view('search/search_caselog_view',$datas);
   }
   else
   {
     redirect('login', 'refresh');
   }
 }
 function advance_searchcaselog()
 {
   if($this->session->userdata('logged_in'))
   {
        $this->load->library('pagination');
        if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config["base_url"] = base_url()."index.php/search_controller/advance_searchcaselog/";
        $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
        $session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
	$insti_id = $session_data['institution_id'];
        $datas['institution_list'] = $this->dropdown_select->anesth_institutions();
        $datas['users_list'] = $this->dropdown_select->users_lists($insti_id);
        $datas['status_list'] = $this->dropdown_select->anesth_status();
        $datas['service'] = $this->dropdown_select->anesth_services();
        $datas['technique'] = $this->dropdown_select->anesth_techniques();
        $datas['main_agents'] = $this->dropdown_select->anesth_agent();
        
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
                        $diagnosis         = $this->input->get('diagnosis');
                        $main_agent        = $this->input->get('main_agent');
                        $patient_classification = $this->input->get('patient_classification');
                        $emergency         = $this->input->get('emergency');
                        $patient_age       = $this->input->get('patient_age');
                        $datas['total'] = $config["total_rows"] = $this->search_caselogs->count_search_caselog_details($case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hopital_id,$diagnosis,$main_agent,$patient_classification,$emergency,$patient_age);
                        $config["per_page"] = 10;
                        $config["uri_segment"] = 3;
                        $this->pagination->initialize($config);
                        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                        $datas["caselog_information"] = $this->search_caselogs->fetch_search_caselog_details($page,$config["per_page"],$case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hopital_id,$diagnosis,$main_agent,$patient_classification,$emergency,$patient_age);
                        }
     $this->load->view('search/advance_search_caselog_view',$datas);
   }
   else
   {
     redirect('login', 'refresh');
   }
 }
  }