<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model/users_model','view_caselogs');
		$this->load->model('reports/reports_model','reports_model');
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
			$data["user_information"] = $session_data;
			$data['user_role'] = $this->dropdown_select->roles();
			$data['institutions_list'] = $this->dropdown_select->anesth_institutions();
			$this->load->view('header/header', $data);
			$this->load->view('header/users_header');
			$this->load->view('users/users_add');
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	function save_user()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data["user_information"] = $session_data;
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
				('institution_id' => $this->input->post('institution_id'),
				 'lastname'       => $this->input->post('lastname'),
				 'firstname'      => $this->input->post('firstname'),
				 'middle_initials'=> $this->input->post('middle_initials'),
				 'username'       => $username,
				 'password'	=> md5($this->input->post('password')),
				 'role_id'	=> $this->input->post('role_id'));
				$this->user->save_user($data);
				$data['user_role'] = $this->dropdown_select->roles();
				$data["user_information"] = $session_data;
				$this->session->set_flashdata("success",'<b>SUCCESSFULLY CREATED USER INFO</b>');
				redirect('users_controller/add_user');
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	function users_caselog()
	{
		if($this->session->userdata('logged_in'))
		{
			$status = $this->input->get('status');
			$session_data = $this->session->userdata('logged_in');
			$data["user_information"] = $session_data;
			$user_id = $session_data['id'];
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
			$datas["count_revised"] = $this->view_caselogs->count_view_caselog_details_1($user_id,7);
			$datas["count_open"] = $this->view_caselogs->count_view_caselog_details_1($user_id,8);
			$datas['status_list'] = $this->dropdown_select->anesth_status();
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
			$data["user_information"] = $session_data;
			$this->load->view('header/header', $data);
			$this->load->view('header/users_header', $data);
			if($this->input->post('old_password') != NULL and $this->input->post('new_password') != NULL and $this->input->post('confirm_password') != NULL)
			{
				$old_password = $this->input->post('old_password');
				$new_password = $this->input->post('new_password');
				$confirm_password = $this->input->post('confirm_password');
				$data["validate_old"] = $this->user->password_checking($session_data['username'],$old_password);
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
					$username = $session_data['username'];
					$datas = array('password' => md5($this->input->post('new_password')));
					$data["change_password"] = $this->user->change_password($datas,$username);
					$data["success"] = 1;
				}
			}
			$this->load->view('users/change_password',$data);
			}
			else
			{
				redirect('login', 'refresh');
			}
	}
	function update_profile($resident_id='')
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data["user_information"] = $session_data;
			$this->load->view('header/header', $data);
			$this->load->view('header/users_header');
			if($this->input->post('update'))
			{
				$data = array('firstname' => $this->input->post('firstname'),
					      'lastname' => $this->input->post('lastname'),
					      'middle_initials' => $this->input->post('middle_initials'),
					      'prc_number' => $this->input->post('prc_number'));
				$this->user->update_profile($data,$session_data['id']);
				$data['message'] = "SUCCESSFULLY UPDATED YOUR PROFILE INFORMATION PLEASE RE LOGIN TO TAKE EFFECT";
			}
			$this->load->view('users/users_update_profile',$data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	function hospital_list()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data["user_information"] = $session_data;
			$user_id = $session_data['id'];
			$datas["hospital_list"] = $this->view_caselogs->hospital_list();
			$this->load->view('header/header', $data);
			$this->load->view('header/reports_header');
			$this->load->view('users/hospital_list',$datas);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	
	function edit_user()
	{
		if($this->session->userdata('logged_in'))
		{
			$user_id = $this->input->get('resident_id');
			$session_data = $this->session->userdata('logged_in');
			$data["user_information"] = $session_data;
			$datas["user_info"] = $this->view_caselogs->get_user_info($user_id);
			$datas["user_role"] = $this->view_caselogs->get_roles();
			$this->load->view('header/header', $data);
			$this->load->view('header/reports_header');
			$this->load->view('users/edit_user',$datas);
			if($this->input->post("submit") == "edit")
			{
				$username = $this->input->post('username');
				$user_id = $this->input->post('resident_id');
				$data['username'] = $this->user->user_checking($username);
				if ($this->input->post('password') != $this->input->post('confirm_password'))
				{
					$data['message'] = "Password and Confirm Password do not Match.";
					$data['user_role'] = $this->dropdown_select->roles();
					$this->load->view('header/header', $data);
					$this->load->view('header/reports_header');
					$this->load->view('users/users_add');
				}
				elseif ($data['username'] == true)
				{
					$data['user_message'] = "USERNAME IS ALREADY EXISTS.";
					$data['user_role'] = $this->dropdown_select->roles();
					$this->load->view('header/header', $data);
					$this->load->view('header/reports_header');
					$this->load->view('users/edit_user');
				}
				$data = array
				(
				 'lastname'       => $this->input->post('lastname'),
				 'firstname'      => $this->input->post('firstname'),
				 'middle_initials'=> $this->input->post('middle_initials'),
				 'username'       => $username,
				 'password'	=> md5($this->input->post('password')),
				 'role_id'	=> $this->input->post('role_id'));			
				 $this->view_caselogs->edit_user($data,$user_id);
				 redirect('users_controller/hospital_list');
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

}