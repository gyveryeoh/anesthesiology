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
 	function anesth_services()
	{
		$session_data = $this->session->userdata('logged_in');
		$data["user_information"] = $session_data;
		$datas['anesth_services'] = $this->dropdown_select->anesth_services();
		$index = 1;
		foreach($datas['anesth_services'] as $n)
		{
			$datas["count_per_service"][$n->id] = $this->reports_model->anesth_service_count($n->id,$session_data['id']);
			$index+=1;
		}
		$this->load->view('header/header',$data);
		$this->load->view('header/reports_header');
		$this->load->view('reports/anesth_service_per_resident',$datas);
	}	
	function reports_list()
	{
		$user_id = $this->input->get('resident_id');  
		$session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
		$data["year"] = "";
		$data["user_id"] = $user_id;
		$datas['anesth_technique'] = $this->dropdown_select->anesth_techniques_reports();
		$datas['anesth_services'] = $this->dropdown_select->anesth_services();
		if($this->session->userdata('logged_in'))
		{
			if($this->input->post('submit') == "submit")
			{
				$year1 = $this->input->post("year");
				$data["year"] = $year1;
				$operation_d = $this->reports_model->get_year($user_id);
				
						$index = 1;
						foreach($datas['anesth_technique'] as $n)
						{	
							$total_count = 0;
							foreach($operation_d as $y)
							{
								$ye = $y->operation_date;
								$year2 = date("Y", strtotime($ye));
								if($year1 == $year2)
								{
									$total_count+=$this->reports_model->anesth_technique_count_year($n->id,$user_id,$ye);
								}
								else
								{
									$datas["count_per_technique"][$n->id] = 0;
								}
								
							}
							$datas["count_per_technique"][$n->id] = $total_count;
							$index+=1;
						}
				
						foreach($datas['anesth_services'] as $n)
						{
							$total_count = 0;
							$index+=1;
								foreach($operation_d as $y)
								{
									$ye = $y->operation_date;
									$year2 = date("Y", strtotime($ye));
									if($year1 == $year2)
									{
										$total_count+=$this->reports_model->anesth_services_count_year($n->id,$user_id,$ye);
									}
									else
									{
										$datas["count_per_service"][$n->id] = 0;
									}
								}
							$datas["count_per_service"][$n->id] = $total_count;
							$index+=1;
						}
				
				$this->load->view('header/header',$data);
				$this->load->view('reports/reports_list_per_resident',$datas);
			}
			else
			{
				$index = 1;
				foreach($datas['anesth_technique'] as $n)
				{
					$datas["count_per_technique"][$n->id] = $this->reports_model->anesth_technique_count($n->id,$user_id);
					$index+=1;
				}
				
				
				$index = 1;
				foreach($datas['anesth_services'] as $n)
				{
					$datas["count_per_service"][$n->id] = $this->reports_model->anesth_service_count($n->id,$user_id);
					$index+=1;
				}
				
				$this->load->view('header/header',$data);
				$this->load->view('reports/reports_list_per_resident',$datas);
			}

		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	
	function institution_view()
	{
		$session_data = $this->session->userdata('logged_in');
		$data["user_information"] = $session_data;
		$datas['anesth_institutions'] = $this->dropdown_select->anesth_institutions();
		$datas["year"] = "";
		$this->load->view('header/header',$data);
		$this->load->view('reports/residents_per_institution',$datas);
	}
	function get_resident_per_institution()
	{
<<<<<<< HEAD
		$insti_id = $this->input->post('insti_id');
=======
		$inst_id = $this->input->get('inst_id');
>>>>>>> 575644a97648a98611dacf788f5c641d6057fd39
		$residents_list = array();
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('institution_id',$insti_id);
		$result = $this->db->get();
		$inst = $result->result();
<<<<<<< HEAD
			$data .= "<option value=''>--Pilih--</option>";
		foreach ($inst as $mp){
			$data .= "<option value='".$mp->id."'>".$mp->id."</option>\n";	
		}
		echo $data;
=======
		$count = $result->num_rows();
		echo "<option value=''>Select Resident</option>";
			foreach($inst as $ai):
					echo "<option value='". $ai->institution_id ."'>".$ai->lastname.", ".$ai->firstname." ".$ai->middle_initials."</option>";
			endforeach;
>>>>>>> 575644a97648a98611dacf788f5c641d6057fd39
	}
}