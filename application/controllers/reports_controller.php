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
	//ANESTHETIC MONTHLY REPORT
	function index()
	{
		if($this->session->userdata('logged_in'))
        {
		$session_data = $this->session->userdata('logged_in');
		$data["user_information"] = $session_data;
		if ($session_data['role_id'] == "3")
	{
		$insti_id = $this->input->post('hospital_id');
	}
	else
	{
		$insti_id = $session_data['institution_id'];
	}
		$datas['anesth_technique'] = $this->dropdown_select->anesth_techniques();
		$data['institution_list'] = $this->dropdown_select->anesth_institutions();
		$data['status_list'] = $this->dropdown_select->anesth_status();
		$data['users_list'] = $this->dropdown_select->users_lists($insti_id);
		if ($this->input->post('submit'))
		{
			$month = $this->input->post('month');
			$year = $this->input->post('year');
			$status = $this->input->post('status_id');
			$user_id = $this->input->post('user_id');
			$index = 1;
			foreach($datas['anesth_technique'] as $n)
		{
			$datas["count_per_technique"][$n->id] = $this->reports_model->anesth_technique_count($n->id,$user_id,$status,$month,$year);
		}
		}
		$this->load->view('header/header',$data);
		$this->load->view('header/reports_header');
		$this->load->view('header/technique_report_header');
		$this->load->view('reports/anesth_technique_per_resident',$datas);
	}
        else
        {
            redirect('login', 'refresh');
        }
}
//SERVICE MONTHLY REPORT
function anesth_services()
{
	if($this->session->userdata('logged_in'))
        {
	$session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
	if ($session_data['role_id'] == "3")
	{
		$insti_id = $this->input->post('hospital_id');
	}
	else
	{
		$insti_id = $session_data['institution_id'];
	}
	$user_role = "1";
        $datas['anesth_services'] = $this->dropdown_select->anesth_services();
	$data['institution_list'] = $this->dropdown_select->anesth_institutions();
	$data['status_list'] = $this->dropdown_select->anesth_status();
        $data['users_list'] = $this->dropdown_select->users_lists($insti_id);
	if ($this->input->post('submit'))
	{
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$status = $this->input->post('status_id');
		$user_id = $this->input->post('user_id');
		foreach($datas['anesth_services'] as $n)
		{
			$datas["count_per_service"][$n->id] = $this->reports_model->anesth_service_count($n->id,$user_id,$status,$month,$year);
		}
	}
        $this->load->view('header/header',$data);
        $this->load->view('header/reports_header');
        $this->load->view('header/service_report_header');
        $this->load->view('reports/anesth_service_per_resident',$datas);
}
else
{
	redirect('login', 'refresh');
}
}
//Annual Patient Classification and Distribution Summary
function annual_patient_classification_and_distribution_summary()
{
	$session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
	$this->load->view('header/header',$data);
        $this->load->view('header/reports_header');
	if ($session_data['role_id'] == "3")
	{ $insti_id = $this->input->post('institution_id'); }
	else{ $insti_id = $session_data['institution_id']; }
	$user_role = "1";
        $data['anesth_asa'] = $this->dropdown_select->anesth_asa();
        $data['anesth_emergency'] = $this->dropdown_select->anesth_emergency();
	$data['institution_list'] = $this->dropdown_select->anesth_institutions();
	$data['status_list'] = $this->dropdown_select->anesth_status();
        $data['users_list'] = $this->dropdown_select->users_lists($insti_id);
	if ($this->input->post('submit'))
	{
		$status = $this->input->post('status_id');
		$year = $this->input->post('year');
		foreach($data['anesth_asa'] as $asa):
		$data["count_asa"][$asa->id] = $this->reports_model->annual_patient_classification_and_distribution_summary_count($asa->id,$status,$year,$insti_id);
		$data["count_emergency"][$asa->id] = $this->reports_model->annual_patient_classification_and_distribution_summary_emergency_count($asa->id,$status,$year,$insti_id);
		$data["count_1st_year"][$asa->id] = $this->reports_model->annual_patient_classification_and_distribution_summary_1st_year_count($asa->id,$status,$year,$insti_id);
		$data["count_2nd_year"][$asa->id] = $this->reports_model->annual_patient_classification_and_distribution_summary_2nd_year_count($asa->id,$status,$year,$insti_id);
		$data["count_3rd_year"][$asa->id] = $this->reports_model->annual_patient_classification_and_distribution_summary_3rd_year_count($asa->id,$status,$year,$insti_id);
		$data["count_4th_year"][$asa->id] = $this->reports_model->annual_patient_classification_and_distribution_summary_4th_year_count($asa->id,$status,$year,$insti_id);
		$data["count_5th_year"][$asa->id] = $this->reports_model->annual_patient_classification_and_distribution_summary_5th_year_count($asa->id,$status,$year,$insti_id);
		endforeach;
	}
        $this->load->view('reports/annual_patient_classification_and_distribution_summary',$data);
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

    function get_resident_per_institution($insti_id='')
    {
        $data = '';
        $insti_id = $this->input->post('insti_id');
        $users_list = $this->reports_model->get_users_institution($insti_id);
        $data .= "<option value='0'>SELECT RESIDENT</option>";
        foreach ($users_list as $u_list){
            $data .= "<option value='$u_list[id]'>$u_list[lastname], $u_list[firstname] $u_list[middle_initials].</option>\n";	
        }
        echo $data;
    }
    function get_report_list()
    {
        $insti_id = $this->input->post('insti_id');
        $user_id = $this->input->post('users_info');
        $year1 = $this->input->post('year');
        $operation_d = $this->reports_model->get_year($user_id);
        $datas['anesth_technique'] = $this->dropdown_select->anesth_techniques_reports();
        $datas['anesth_services'] = $this->dropdown_select->anesth_services();
        $total = 0;
        foreach($datas['anesth_technique'] as $n)
        {
            if($year1 != 0)
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
            }
            else
            {
                $datas["count_per_technique"][$n->id] = $this->reports_model->anesth_technique_count($n->id,$user_id);
            }
        }
        
        foreach($datas['anesth_services'] as $n)
        {
            if($year1 != 0)
            {
                $total_count = 0;
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
            }
            else
            {
                $datas["count_per_service"][$n->id] = $this->reports_model->anesth_service_count($n->id,$user_id);
            }
        }

        echo "<table cellpadding='1' cellspacing='0'>
<tr>
<th width='1500'>Techniques</th>
<th>Count</th>
</tr>";
        foreach($datas['anesth_technique'] as $tech):
        echo "
<tr>
<td>".$tech->name."</td>
<td align=center>".$datas["count_per_technique"][$tech->id]."</td>
</tr>";
        $total += $datas["count_per_technique"][$tech->id];
        endforeach;
        echo "<tr><th align='right' class='border-less'>TOTAL</th><td style='color: red;text-align: center;border: hidden;'><b>$total</b></td></tr>";
        
        $total = 0;
        
        echo "<table cellpadding='1' cellspacing='0'>
<tr>
<th width='1500'>Service</th>
<th>Count</th>
</tr>";
        foreach($datas['anesth_services'] as $ser):
        echo "
<tr>
<td>".$ser->name."</td>
<td align=center>".$datas["count_per_service"][$ser->id]."</td>
</tr>";
        $total += $datas["count_per_service"][$ser->id];	
        endforeach;
        echo "<tr><th align='right' class='border-less'>TOTAL</th><td style='color: red;text-align: center;border: hidden;'><b>$total</b></td></tr>";
    }
    function activate_deactivate()
    {
        $user_id = $this->input->post('user_id');
        $index = $this->input->post('index');
        //echo $user_id;
        $status = $this->reports_model->act_dec($user_id);
        foreach($status as $row)
        {
            if($row->status == 0)
            {
                echo "<button onClick='a_d($user_id,$index,1)'>Deactivate</button>";
            }
            else
            {
                echo "<button onClick='a_d($user_id,$index,2)'>Activate</button>";
            }
        }
    }
    function execute()
    {
        $user_id = $this->input->post('user_id');
        $id = $this->input->post('id');
        if($id == 1)
        {
            $d = array(
            'status' => 1
            );
        }
        else
        {
            $d = array(
            'status' => 0
            );
        }
        $this->reports_model->exec($user_id,$d);
    }
    //TOTAL CASES BY INSTITUTION AND SERVICE DONE
    function total_cases_by_institution_and_service_done()
    {
	$session_data = $this->session->userdata('logged_in');
	$data["user_information"] = $session_data;
        $this->load->helper('form');       
	if($this->session->userdata('logged_in'))
        {
	$data['institution_list'] = $this->dropdown_select->anesth_institutions();
	$data['service_list'] = $this->dropdown_select->anesth_services();
        $this->load->view('header/header',$data);
	
		$data['results'] = $this->reports_model->total_cases_by_institution_and_service_done();
	
	
        $this->load->view('reports/total_cases_by_institution_and_service_done',$data);
    }
    else
    {
	redirect('login', 'refresh');
    }
    }
    function monthly_report()
    {
        $user_id = $this->input->get('resident_id');
        $session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
        $data["year"] = "";
        $data["user_id"] = $user_id;
        $data['status_list'] = $this->dropdown_select->anesth_status();
        $insti_id = (!empty($_POST['Report']['institution_id']) and $session_data['role_id'] == 3) ? $_POST['Report']['institution_id'] : $session_data['institution_id'];
        $data['institution_list'] = $this->dropdown_select->anesth_institutions();
        $data['users_list'] = $this->dropdown_select->users_lists($insti_id);
        $this->load->helper('form');
        
        if($this->session->userdata('logged_in'))
        {
            $this->load->view('header/header', $data);
	    $this->load->view('header/reports_header');
            $filters = array();
            foreach (array('institution_id', 'user_id', 'month', 'year', 'anesth_status_id') as $key) {
                $filters[$key] = isset($_POST['Report'][$key]) ? $_POST['Report'][$key] : null;
        
	    }
            
            $institutions = $this->dropdown_select->anesth_institutions();
            $results['institutions'][''] = '- Select institution -';
            foreach ($institutions as $inst) {
                $results['institutions'][$inst->id] = $inst->name;
            }

            $trainees = $this->dropdown_select->users_lists(empty($filters['institution_id']) ? null : $filters['institution_id']);
            $results['trainees'][''] = '- Select trainee -';
            foreach ($trainees as $trainee) {
                $results['trainees'][$trainee->id] = $trainee->username;
            }
            
            foreach (range(1, 12) as $monthNum) {
                $results['months'][$monthNum] = date('F', mktime(0,0,0,$monthNum));
            }
            
            foreach (range(intval(date('Y')), 2013) as $year) {
                $results['years'][$year] = intval($year);
            }
            if ($this->input->post('submit'))
            {
                $results['patient_type_grid'] = $this->reports_model->get_patient_type_grid($filters);
                $results['services_grid'] = $this->reports_model->get_services_grid($filters);
                $results['services_techniques_grid'] = $this->reports_model->get_services_techniques_grid($filters);
                $results['services_techniques_grid_headers'] = array_keys(get_object_vars($results['services_techniques_grid'][0]));
                $results['critical_events_grid'] = $this->reports_model->get_critical_events_grid($filters);
                $results['critical_levels_grid'] = $this->reports_model->get_critical_levels_grid($filters);
            }
            
            $results = array_merge($results, $filters);
            $this->load->view('reports/monthly_report', $results);
        }
        else
        {
            redirect('login', 'refresh');
        }
    }
    function annual_anesthetic_report() {
        $user_id = $this->input->get('resident_id');
        $session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
        $data["year"] = "";
        $data["user_id"] = $user_id;
        $data['status_list'] = $this->dropdown_select->anesth_status();
        $insti_id = (!empty($_POST['Report']['institution_id']) and $session_data['role_id'] == 3) ? $_POST['Report']['institution_id'] : $session_data['institution_id'];
        $data['institution_list'] = $this->dropdown_select->anesth_institutions();
        $data['users_list'] = $this->dropdown_select->users_lists($insti_id);
        $this->load->helper('form');
        
        if($this->session->userdata('logged_in'))
        {
            $this->load->view('header/header', $data);

            $filters = array();
            foreach (array('institution_id', 'user_id', 'year') as $key) {
                $filters[$key] = isset($_POST['Report'][$key]) ? $_POST['Report'][$key] : null;
            }

            $trainees = $this->dropdown_select->users_lists(empty($filters['institution_id']) ? null : $filters['institution_id']);
            $results['trainees'][''] = '- Select trainee -';
            foreach ($trainees as $trainee) {
                $results['trainees'][$trainee->id] = $trainee->username;
            }
            
            foreach (range(1, 12) as $monthNum) {
                $results['months'][$monthNum] = date('F', mktime(0,0,0,$monthNum));
                $results['month_labels'][$monthNum] = strtoupper(date('M', mktime(0,0,0,$monthNum)));
            }
            $results['month_labels'][] = 'TOTAL';
            
            foreach (range(intval(date('Y')), 2013) as $year) {
                $results['years'][$year] = intval($year);
            }
            
            if ($this->input->post('submit')) {
                $results['annual_anesthetic_summary_grid'] = $this->reports_model->get_annual_anesthetic_summary_grid($filters);
            }
            
            $results = array_merge($results, $filters);
	    $this->load->view('header/reports_header');
	    $this->load->view('header/technique_report_header');
            $this->load->view('reports/annual_anesthetic_report', $results);
        }
        else
        {
            redirect('login', 'refresh');
        }
    }
    //ANNUAL SERVICE REPORT
    function annual_service_report() {
        $user_id = $this->input->get('resident_id');
        $session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
        $data["year"] = "";
        $data["user_id"] = $user_id;
        $data['status_list'] = $this->dropdown_select->anesth_status();
        $insti_id = (!empty($_POST['Report']['institution_id']) and $session_data['role_id'] == 3) ? $_POST['Report']['institution_id'] : $session_data['institution_id'];
        $data['institution_list'] = $this->dropdown_select->anesth_institutions();
        $data['users_list'] = $this->dropdown_select->users_lists($insti_id);
        $this->load->helper('form');
        
        if($this->session->userdata('logged_in'))
        {
            $this->load->view('header/header', $data);

            $filters = array();
            foreach (array('institution_id', 'user_id', 'year') as $key) {
                $filters[$key] = isset($_POST['Report'][$key]) ? $_POST['Report'][$key] : null;
            }
            
            $institutions = $this->dropdown_select->anesth_institutions();
            $results['institutions'][''] = '- Select institution -';
            foreach ($institutions as $inst) {
                $results['institutions'][$inst->id] = $inst->name;
            }

            $trainees = $this->dropdown_select->users_lists(empty($filters['institution_id']) ? null : $filters['institution_id']);
            $results['trainees'][''] = '- Select trainee -';
            foreach ($trainees as $trainee) {
                $results['trainees'][$trainee->id] = $trainee->username;
            }
            
            foreach (range(1, 12) as $monthNum) {
                $results['months'][$monthNum] = date('F', mktime(0,0,0,$monthNum));
                $results['month_labels'][$monthNum] = strtoupper(date('M', mktime(0,0,0,$monthNum)));
            }
            $results['month_labels'][] = 'TOTAL';
            
            foreach (range(intval(date('Y')), 2013) as $year) {
                $results['years'][$year] = intval($year);
            }
            
            if ($this->input->post('submit')) {
                $results['annual_service_summary_grid'] = $this->reports_model->get_annual_service_summary_grid($filters);
            }
            
            $results = array_merge($results, $filters);
	    $this->load->view('header/reports_header');
	    $this->load->view('header/service_report_header');
            $this->load->view('reports/annual_service_report', $results);
        }
        else
        {
            redirect('login', 'refresh');
        }
    }
	
	function anesthesia_hours()
	{
        $user_id = $this->input->get('resident_id');
        $session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
		$data["anesth_institutions"] = $this->dropdown_select->anesth_institutions();
		$data["institution_id"] = 0;
		$data["year_level"] = 0;
		$data["year"] = 0;
		
		$institution_id = 0;
		$year_level = 0;
		$year = 0;
		$table = "";
		$compute = true;
		
		if($this->input->post('submit'))
		{
			$institution_id = $this->input->post('institution_id');
			$year_level = $this->input->post('year_level');
			$year = $this->input->post('year');
			$data["institution_id"] = $institution_id;
			$data["year_level"] = $year_level;
			$data["year"] = $year;
		}
		
		if($institution_id == 0)
		{
			$data["anesth_institutions"] = $this->dropdown_select->anesth_institutions();
		
			foreach($data["anesth_institutions"] as $ai)
			{
				$anesth_id = $ai->id;
				$data["users_per_institutions"] = $this->reports_model->users_per_institution($anesth_id,$year_level);
				foreach($data["users_per_institutions"] as $upi)
				{			
					$user_id = $upi->id;
					$total_diff = 0;	
					//echo "institution id : ". $anesth_id." =  User Id : ". $user_id . "</br>";
					$data["patient_form_get_time"] = $this->reports_model->patient_form_get_time($anesth_id,$user_id,$year);
					foreach($data["patient_form_get_time"] as $pfgt)
					{
						$anesth_year = 0;
						$anesth_start = $pfgt->anesthesia_start;
						$compute = true;
						
						if($year != 0)
						{
							$anesth_year = date('Y',strtotime($anesth_start));			
							if($anesth_year != $year)
							{
								$compute = false;
							}
						}
						
						if($compute == true)
						{
							//echo "patient form id :" . $pfgt->id."=";
							$day1 = $anesth_start." ".$pfgt->anesthesia_start_time;
							$day2 = $pfgt->anesthesia_end." ".$pfgt->anesthesia_end_time;
							$diff_seconds  = strtotime($day2) - strtotime($day1);
							$anesth_diff= floor($diff_seconds/3600).'.'.floor(($diff_seconds%3600)/60);
							$total_diff = $total_diff + $anesth_diff;
							//echo $total_diff."</br>";
						}
					}
					
					$status_id = $this->dropdown_select->anesth_status();
					foreach($status_id as $sid)
					{
						$total[$sid->id] = $this->reports_model->patient_form_status($sid->id, $user_id, $anesth_id,$year);
					}
						$table = $table . "<tr>
											<td>".$upi->lastname.",".$upi->firstname." ". $upi->middle_initials." </td>
											<td>". $upi->year_lvl ."</td>
											<td>". $total_diff ."</td>
											<td>". $total[1] ."</td>
											<td>". $total[2] ."</td>
											<td>". $total[3] ."</td>
											<td>". $total[4] ."</td>
											<td>". $total[5] ."</td>
											<td>". $total[7] ."</td>
											<td>". $total[8] ."</td>
											
										  </tr>";	
				}
			}
		}
		else
		{
				$data["users_per_institutions"] = $this->reports_model->users_per_institution($institution_id,$year_level);
				foreach($data["users_per_institutions"] as $upi)
				{
					
					$user_id = $upi->id;
					$total_diff = 0;	
					$data["patient_form_get_time"] = $this->reports_model->patient_form_get_time($institution_id,$user_id,$year);
					foreach($data["patient_form_get_time"] as $pfgt)
					{
						$anesth_year = 0;
						$anesth_start = $pfgt->anesthesia_start;
						$compute = true;
						if($year != 0)
						{
							$anesth_year = date('Y',strtotime($anesth_start));			
							if($anesth_year != $year)
							{
								$compute = false;
							}
						}
						if($compute == true)
						{
							$day1 = $anesth_start." ".$pfgt->anesthesia_start_time;
							$day2 = $pfgt->anesthesia_end." ".$pfgt->anesthesia_end_time;
							$diff_seconds  = strtotime($day2) - strtotime($day1);
							$anesth_diff= floor($diff_seconds/3600).'.'.floor(($diff_seconds%3600)/60);
							$total_diff = $total_diff + $anesth_diff;
						}
					}
					$status_id = $this->dropdown_select->anesth_status();
					foreach($status_id as $sid)
					{
						$total[$sid->id] = $this->reports_model->patient_form_status($sid->id, $user_id, $institution_id,$year);
					}
						$table = $table . "<tr>
											<td>".$upi->lastname.",".$upi->firstname." ". $upi->middle_initials." </td>
											<td>". $upi->year_lvl ."</td>
											<td>". $total_diff ."</td>
											<td>". $total[1] ."</td>
											<td>". $total[2] ."</td>
											<td>". $total[3] ."</td>
											<td>". $total[4] ."</td>
											<td>". $total[5] ."</td>
											<td>". $total[7] ."</td>
											<td>". $total[8] ."</td>						
										  </tr>";	
				}			
		}
		$data["table"] = $table;
		$this->load->view('header/header', $data);
	    $this->load->view('header/reports_header');
        $this->load->view('reports/total_anesthesia_hours',$data);		
		
	}
	
	function anesth_hospital_and_service()
	{
        $user_id = $this->input->get('resident_id');
        $session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
		$anesth_institutions = $this->dropdown_select->anesth_institutions();
		$data["anesth_institutions"] = $anesth_institutions;
		$data["anesth_services"] = $this->dropdown_select->anesth_services();
		$data["institution_id"] = 0;
		$data["services"] = NULL;
		if($this->input->post('submit'))
		{
			$institution_id = $this->input->post('institution_id');
			$service_id = $this->input->post('service_id');
			
			$data["services"] = $service_id;
			$data["institution_id"] = $institution_id;
			$string = stripslashes(implode($service_id,"',"));

			function stripslashes_deep($value)
			{
				$value = is_array($value) ?
							array_map('stripslashes_deep', $value) :
							stripslashes($value);

				return $value;
			}
			
			$service_id = stripslashes_deep($service_id);
			
			if($institution_id == 0)
			{
				foreach($anesth_institutions as $ai)
				{
					$per_institution[$ai->id] = $this->reports_model->count_services_per_institution($ai->id,$service_id);
					//echo $per_institution[$ai->id]."</br>";
				}
				
				
				foreach($anesth_institutions as $ai)
				{
					echo "Hospital Name:" . $ai->name . "     Total Services". $per_institution[$ai->id]. "</br>";
				}
			}
			else
			{
				$per_institution = $this->reports_model->count_services_per_institution($institution_id,$service_id);
				foreach($anesth_institutions as $ai)
				{
					if($ai->id == $institution_id)
					{
						echo "Hospital Name:" . $ai->name . "     Total Services". $per_institution. "</br>";
						break;
					}
				}
			}

		}
		
		$this->load->view('header/header', $data);
	    $this->load->view('header/reports_header');
		$this->load->view('reports/anesth_hospital_and_service',$data);
	}
}