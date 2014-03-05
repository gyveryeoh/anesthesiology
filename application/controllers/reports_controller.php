<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('dropdown_select','',TRUE);
		$this->load->model('user');
		$this->load->model('reports/reports_model','reports_model');
		$this->load->library('session');
		$this->load->helper('url');
	}
	function index()
	{
		if($this->session->userdata('logged_in'))
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
		else
		{
			redirect('login', 'refresh');
		}
	}
	function login_summary()
	{
		if($this->session->userdata('logged_in'))
		{
			$resident_id =$this->input->get('resident_id');
			$this->load->library('pagination');
			if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
			$config["base_url"] = base_url()."index.php/reports_controller/login_summary";
			$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
			$config["total_rows"] = $this->reports_model->count_users_login_summary_table($resident_id);
			$data['total_number'] = $config['total_rows'];
			$config["per_page"] = 10;
			$config["uri_segment"] = 3;
			$this->pagination->initialize($config);
			$data['user_information'] = $this->session->userdata('logged_in');
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data["login_summary"] = $this->reports_model->fetch_users_login_summary($page,$config["per_page"],$resident_id);
			$data['resident_information'] = $this->user->resident_information($resident_id);
			$this->load->view('header/header',$data);
			$this->load->view('reports/login_summary',$data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
}