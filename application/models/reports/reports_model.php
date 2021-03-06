<?php
Class Reports_model extends CI_Model
{
    function anesth_technique_count($anesth_technique,$user_id,$status,$month,$year)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('user_id',$user_id);
        $this->db->where('anesthetic_technique',$anesth_technique);
        $this->db->where('anesth_status_id',$status);
	$this->db->where('month(operation_date)', $month);
	$this->db->where('year(operation_date) ', $year);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function anesth_service_count($anesth_service,$user_id,$status,$month,$year)
    {
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('user_id',$user_id);
        $this->db->where('service',$anesth_service);
        $this->db->where('anesth_status_id',$status);
	$this->db->where('month(operation_date)', $month);
	$this->db->where('year(operation_date) ', $year);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function annual_patient_classification_and_distribution_summary_count($anesth_asa,$status,$year,$insti_id)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('asa',$anesth_asa);
        if($status != 0)$this->db->where('anesth_status_id',$status);
	if($year != 0) $this->db->where('year(operation_date) ', $year);
	if($insti_id != 0) $this->db->where('institution_id', $insti_id);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function annual_patient_classification_and_distribution_summary_emergency_count($anesth_asa,$status,$year,$insti_id)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('asa',$anesth_asa);
        $this->db->where('for_emergency',"Y");
        if($status != 0)$this->db->where('anesth_status_id',$status);
	if($year != 0) $this->db->where('year(operation_date) ', $year);
	if($insti_id != 0) $this->db->where('institution_id', $insti_id);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function annual_patient_classification_and_distribution_summary_1st_year_count($anesth_asa,$status,$year,$insti_id)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('asa',$anesth_asa);
        $this->db->where('year_lvl_id',1);
        if($status != 0)$this->db->where('anesth_status_id',$status);
	if($year != 0) $this->db->where('year(operation_date) ', $year);
	if($insti_id != 0) $this->db->where('institution_id', $insti_id);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function annual_patient_classification_and_distribution_summary_2nd_year_count($anesth_asa,$status,$year,$insti_id)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('asa',$anesth_asa);
	$this->db->where('year_lvl_id',2);
        if($status != 0)$this->db->where('anesth_status_id',$status);
	if($year != 0) $this->db->where('year(operation_date) ', $year);
	if($insti_id != 0) $this->db->where('institution_id',$insti_id);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function annual_patient_classification_and_distribution_summary_3rd_year_count($anesth_asa,$status,$year,$insti_id)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('asa',$anesth_asa);
	$this->db->where('year_lvl_id',3);
        if($status != 0)$this->db->where('anesth_status_id',$status);
	if($year != 0) $this->db->where('year(operation_date) ', $year);
	$this->db->where('year(operation_date) ', $year);
	if($insti_id != 0) $this->db->where('institution_id', $insti_id);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function annual_patient_classification_and_distribution_summary_4th_year_count($anesth_asa,$status,$year,$insti_id)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('asa',$anesth_asa);
        $this->db->where('year_lvl_id',4);
	if($status != 0)$this->db->where('anesth_status_id',$status);
	if($year != 0) $this->db->where('year(operation_date) ', $year);
	if($insti_id != 0) $this->db->where('institution_id', $insti_id);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function annual_patient_classification_and_distribution_summary_5th_year_count($anesth_asa,$status,$year,$insti_id)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('asa',$anesth_asa);
        $this->db->where('year_lvl_id',5);
        if($status != 0)$this->db->where('anesth_status_id',$status);
	if($year != 0) $this->db->where('year(operation_date) ', $year);
	if($insti_id != 0) $this->db->where('institution_id', $insti_id);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function count_users_login_summary_table($resident_id)
    {
        $this->db->select('*');
        $this->db->from('user_login_summary');
        $this->db->where('user_id',$resident_id);
        $q = $this->db->get();
        return $q->num_rows();
    }
    function fetch_users_login_summary($limit,$start,$resident_id)
    {
        $this->db->limit($start,$limit);
        $this->db->select('*');
        $this->db->from('user_login_summary');
        $this->db->where('user_id',$resident_id);
        $this->db->order_by("login_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }
    function get_year($user_id)
    {
        $this->db->select('operation_date');
        $this->db->from('patient_form');
        $this->db->where('user_id',$user_id);
        $this->db->where('anesth_status_id',4);
        $result = $this->db->get();
        return $result->result();
    }
    function anesth_technique_count_year($anesth_technique,$user_id,$ye)
    {
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('user_id',$user_id);
        $this->db->where('anesthetic_technique',$anesth_technique);
        $this->db->where('operation_date',$ye);
        $this->db->where('anesth_status_id',4);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function anesth_services_count_year($anesth_services,$user_id,$ye)
    {
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('user_id',$user_id);
        $this->db->where('service',$anesth_services);
        $this->db->where('operation_date',$ye);
        $this->db->where('anesth_status_id',4);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function get_users_institution($insti_id)
    {
        $this->db->where('institution_id',$insti_id);
        $this->db->where('role_id',1);
	$this->db->order_by("lastname", "asc");
        $result = $this->db->get('users');
        if ($result->num_rows() > 0 )
        {
            return $result->result_array();	
        }
        else
        {
            return array();	
        }
    }
    function act_dec($user_id)
    {
        $this->db->where('id',$user_id);
        $result = $this->db->get('users');
        return $result->result();
    }

    function exec($user_id,$d)
    {
        $this->db->where('id', $user_id);
        $this->db->update('users', $d);
    }
    //TOTAL CASES BY INSTITTUTION AND SERVICE DONE
    function total_cases_by_institution_and_service_done()
    {
     $this->db->select('*');
     $this->db->from('anesth_institution');
     $this->db->order_by("name", "asc");
     $query = $this->db->get();
     return $query->result();
    }
    
    function prepareFilters($options, $where=false) {
        $filters = '';
        $conditions = array();
        if (!empty($options)) {
            $options = array_filter($options, function($val) {
                if (!empty($val) and $val != -111) {
                    return $val;
                }
            });
            
            foreach ($options as $key => $val) {
                if ($key == 'year') {
                    $conditions[] = 'year(operation_date) = ' . intval($val);
                }
                elseif ($key == 'month') {
                    $conditions[] = 'month(operation_date) = ' . intval($val);
                }
                else {
                    $conditions[] = $key . " = '" . $val . "'";
                }
            }
            
            if (!empty($conditions))
                $filters = (empty($where) ? ' and ' : ' where ') . implode(' and ', $conditions);
        }
        
        return $filters;
    }//*/
    
    /*function get_patient_type_grid($options=array()) {
        $filters = $this->prepareFilters($options);
        
        $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/patient_type_grid.sql'), array(
            '{$filters}' => $filters,
        ));
        
        $results = $this->db->query($query)->result();
        
        return isset($results[0]) ? $results[0] : null;
    }//*/
    
    /*function get_services_grid($options=array())
    {
        $filters = $this->prepareFilters($options, true);
        
        $query = $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/services_grid.sql'), array(
            '{$filters}' => $filters,
        ));
        
        $results = $this->db->query($query)->result();
        
        return $results;
    }//*/
    
    /*function get_services_techniques_grid($options=array())
    {
        $filters = $this->prepareFilters($options);
        
        $results = array();
        $query = '';
        $cols = '';
        $joins = '';
        
        $techniques = $this->dropdown_select->anesth_techniques();
        
        foreach ($techniques as $i => $t) {
            $id = $t->id;
            $name = $t->name;
            $next = $i+1;
            
            $joins .= strtr(file_get_contents(dirname(__FILE__) . '/sql/services_techniques_grid_joins.sql'), array(
                '{$filters}' => $filters,
                '{$id}' => $id,
                '{$next}' => $next,
            ));
            
            $cols .= "t{$next}.total `{$name}`,";
        }
        
        if (!empty($cols) and !empty($joins)) {
            $cols =substr($cols, 0, -1);
            
            $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/services_techniques_grid_query.sql'), array(
                '{$filters}' => $filters,
                '{$cols}' => $cols,
                '{$joins}' => $joins,
            ));
            $this->db->query('SET SQL_BIG_SELECTS=1'); 
            $results = $this->db->query($query)->result();
        }
        
        return $results;
    }//*/
    
    /*function get_critical_events_grid($options=array()) {
        $filters = $this->prepareFilters($options, true);
        
        $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/critical_events_grid.sql'), array(
            '{$filters}' => $filters,
        ));
        
        $results = $this->db->query($query)->result();
        
        return isset($results[0]) ? $results[0] : null;
    }//*/
    
    function prepare_filters($options) {
        $conditions = array();
        
        if (!empty($options)) {
            $options = array_filter($options, function($val) {
                if (!empty($val) and $val != -111) {
                    return $val;
                }
            });
            
            foreach ($options as $key => $val) {
                if ($key == 'year') {
                    $conditions['year(operation_date)'] = intval($val);
                }
                elseif ($key == 'month') {
                    $conditions['month(operation_date)'] = intval($val);
                }
                else {
                    $conditions[$key] = $val;
                }
            }
        }
        
        return $conditions;
    }
    
    function get_patient_type_grid($options=array()) {
        $resultSet = array();
        
        $filters = $this->prepare_filters($options);
        
        // charity: primary elective
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('type_of_patient', 'C');
        $this->db->where('level_of_involvement', 'P');
        $this->db->where($filters);
        $result = $this->db->get();
        $resultSet['charity_primary_elective'] = $result->num_rows();
        
        // charity: assist elective
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('type_of_patient', 'C');
        $this->db->where('level_of_involvement', 'A');
        $this->db->where($filters);
        $result = $this->db->get();
        $resultSet['charity_assist_elective'] = $result->num_rows();
        
        // pay: primary elective
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('type_of_patient', 'P');
        $this->db->where('level_of_involvement', 'P');
        $this->db->where($filters);
        $result = $this->db->get();
        $resultSet['pay_primary_elective'] = $result->num_rows();
        
        // pay: assist elective
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('type_of_patient', 'P');
        $this->db->where('level_of_involvement', 'A');
        $this->db->where($filters);
        $result = $this->db->get();
        $resultSet['pay_assist_elective'] = $result->num_rows();
        
        // charity: emergency
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('type_of_patient', 'C');
        $this->db->where('for_emergency', 'Y');
        $this->db->where($filters);
        $result = $this->db->get();
        $resultSet['charity_emergency'] = $result->num_rows();
        
        // pay: emergency
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('type_of_patient', 'P');
        $this->db->where('for_emergency', 'Y');
        $this->db->where($filters);
        $result = $this->db->get();
        $resultSet['pay_emergency'] = $result->num_rows();
        
        $resultSet['total_elective'] = $resultSet['charity_primary_elective'] + $resultSet['charity_assist_elective'] + $resultSet['pay_primary_elective'] + $resultSet['pay_assist_elective'];
        $resultSet['total_emergency'] = $resultSet['charity_emergency'] + $resultSet['pay_emergency'];
        $resultSet['total_charity'] = $resultSet['charity_primary_elective'] + $resultSet['charity_assist_elective'] + $resultSet['charity_emergency'];
        $resultSet['total_pay'] = $resultSet['pay_primary_elective'] + $resultSet['pay_assist_elective'] + $resultSet['pay_emergency'];
        $resultSet['total_overall'] = $resultSet['total_elective'] + $resultSet['total_emergency'];
        
        return (object)$resultSet;
    }
    
    function get_services_grid($options=array())
    {
        $resultSet = array();
        $filters = $this->prepare_filters($options, true);
        
        $services = $this->db->order_by('name')->get('anesth_services')->result();
        
        foreach ($services as $service) {
            $this->db->select('*');
            $this->db->from('patient_form');
            $this->db->where('service', $service->id);
            $this->db->where($filters);
            
            $resultSet[] = (object)array(
                'service_name' => $service->name,
                'total' => $this->db->get()->num_rows()
            );
        }
        
        return $resultSet;
    }
    
    function get_services_techniques_grid($options=array())
    {
        $resultSet = array();
        $filters = $this->prepare_filters($options, true);
        
        $services = $this->db->order_by('name')->get('anesth_services')->result();
        $techniques = $this->db->order_by('name')->get('anesth_technique')->result();
        
        foreach ($services as $service) {
            foreach ($techniques as $technique) {
                $this->db->select('*');
                $this->db->from('patient_form');
                $this->db->where('anesthetic_technique', $technique->id);
                $this->db->where('service', $service->id);
                $this->db->where($filters);
                
                $resultSet[$service->name][$technique->name] = (object) array(
                    'technique_name' => $technique->name,
                    'total' => $this->db->get()->num_rows()
                );
            }
        }
        
        foreach ($techniques as $technique) {
            $this->db->select('*');
            $this->db->from('patient_form');
            $this->db->where('anesthetic_technique', $technique->id);
            $this->db->where($filters);
            
            $resultSet['TOTAL'][$technique->name] = (object) array(
                'technique_name' => $technique->name,
                'total' => $this->db->get()->num_rows()
            );
        }
        
        return $resultSet;
    }
    
    function get_critical_events_grid($options=array()) {
        $resultSet = array();
        $filters = $this->prepare_filters($options, true);
        
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('upper(critical_events)', 'YES');
        $this->db->where($filters);
        $resultSet['yes'] = $this->db->get()->num_rows();
        
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('upper(critical_events)', 'NO');
        $this->db->where($filters);
        $resultSet['no'] = $this->db->get()->num_rows();
        
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where_in('upper(critical_events)', array('YES', 'NO'));
        $this->db->where($filters);
        $resultSet['total'] = $this->db->get()->num_rows();
        
        return (object) $resultSet;
    }
    
    function get_critical_levels_grid($options=array()) {
        $filters = $this->prepareFilters($options, true);
        
        $results = array();
        $critical_levels = array(
            'airway' => 'airway',
            'cardiovascular' => 'cardiovascular',
            'discharge_planning' => 'discharge_planning',
            'miscellaneous' => 'miscellaneous',
            'neurological' => 'neurogical',
            'respiratory' => 'respiratory',
            'regional_anesthesia' => 'regional_anesthesia',
            'preop' => 'preop',
        );
        
        foreach ($critical_levels as $key => $level) {
            $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/critical_levels_grid.sql'), array(
                '{$filters}' => $filters,
                '{$key}' => $key,
                '{$level}' => $level,
            ));
            
            $results[$level] = $this->db->query($query)->result();
        }
        
        return $results;
    }
    
    
    
    function get_annual_anesthetic_summary_grid2($options=array())
    {
        $resultSet = array();
        $filters = $this->prepare_filters($options, true);
        
        $techniques = $this->db->order_by('name')->get('anesth_technique')->result();
        
        foreach ($techniques as $technique) {
            foreach (range(1, 12) as $month) {
                $this->db->select('*');
                $this->db->from('patient_form');
                $this->db->where('anesthetic_technique', $technique->id);
                $this->db->where('month(operation_date)', $month);
                $this->db->where('anesth_status_id', 4); // Approve
                $this->db->where($filters);
                
                $resultSet[$technique->name][$month] = (object)array(
                    'total' => $this->db->get()->num_rows()
                );
            }
            
            $this->db->select('*');
            $this->db->from('patient_form');
            $this->db->where('anesthetic_technique', $technique->id);
            $this->db->where('anesth_status_id', 4); // Approve
            $this->db->where($filters);
            
            $resultSet[$technique->name]['total'] = (object)array(
                'total' => $this->db->get()->num_rows()
            );
        }
        
        foreach (range(1, 12) as $month) {
            $this->db->select('*');
            $this->db->from('patient_form');
            $this->db->where('month(operation_date)', $month);
            $this->db->where('anesth_status_id', 4); // Approve
            $this->db->where($filters);
            
            $resultSet['TOTAL'][$month] = (object)array(
                'total' => $this->db->get()->num_rows()
            );
        }
        
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('anesth_status_id', 4); // Approve
        $this->db->where($filters);
        
        $resultSet['TOTAL']['total'] = (object)array(
            'total' => $this->db->get()->num_rows()
        );
        
        return $resultSet;
    }
    
    function get_annual_anesthetic_summary_grid($options=array()) {
        $filters = $this->prepareFilters($options);
        
        // $monthsArr = array();
        // foreach (range(date('m', strtotime('january')), date('m', strtotime('december'))) as $m) {
        // $monthsArr[] = 'sum(if(month_operation_date = ' . $m . ', 1, 0)) `' . date('M', mktime(0, 0, 0, $m, 10)) . '`';
        // }
        
        // $months = implode(",\n\t", $monthsArr);
        
        $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/annual_anesthetic_summary_grid.sql'), array(
            // '{$months}' => $months,
            '{$filters}' => $filters,
        ));
        $results = $this->db->query($query)->result();
        
        return $results;
    }
    function get_annual_service_summary_grid($options=array()) {
        $filters = $this->prepareFilters($options);
        
        // $monthsArr = array();
        // foreach (range(date('m', strtotime('january')), date('m', strtotime('december'))) as $m) {
        // $monthsArr[] = 'sum(if(month_operation_date = ' . $m . ', 1, 0)) `' . date('M', mktime(0, 0, 0, $m, 10)) . '`';
        // }
        
        // $months = implode(",\n\t", $monthsArr);
        
        $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/annual_service_summary_grid.sql'), array(
            // '{$months}' => $months,
            '{$filters}' => $filters,
        ));
        chrome_log($query);
        $results = $this->db->query($query)->result();
        
        return $results;
    }
	
    function users_per_institution($institution_id,$year_level)
    {
	$this->db->select('*');
	$this->db->from('users');
	if($institution_id != 0) $this->db->where('institution_id',$institution_id);
	$this->db->where('year_lvl is not null');	
	$this->db->where("year_lvl !=",6);
	if($year_level != 0) $this->db->where("year_lvl",$year_level);
	$this->db->order_by("year_lvl", "asc");
	$query = $this->db->get();
	return $query->result();
	}

function patient_form_get_time($institution_id,$user_id,$year)
{
$this->db->select('*');
$this->db->from('patient_form');
if($institution_id != 0) $this->db->where('institution_id',$institution_id);
$this->db->where('user_id',$user_id);
$this->db->where('anesth_status_id',4);
if($year != 0) $this->db->where('year(operation_date) ',$year);
$query = $this->db->get();
return $query->result();
}

function patient_form_status($status_id, $user_id,$institution_id,$year)
{
$this->db->select('anesth_status_id');
$this->db->from('patient_form');
if($institution_id != 0) $this->db->where('institution_id',$institution_id);
$this->db->where('anesth_status_id',$status_id);
$this->db->where('user_id',$user_id);
if($year != 0) $this->db->where('year(operation_date) ', $year);
$result = $this->db->get();
return $result->num_rows();	
}
function count_services_per_institution($institution_id,$service_id)
{
$this->db->select('*');
$this->db->from('patient_form');
if($institution_id != 0) $this->db->where('institution_id',$institution_id);
$this->db->where('anesth_status_id',4);
$this->db->where_in('service',$service_id);
$query = $this->db->get();
return $query->num_rows();
}

function region_count($region_id,$service_id,$technique_id)
{
		$this->db->select("*");
		$this->db->from("patient_form,anesth_institution");
		$this->db->where("anesth_institution.anessth_region_id = $region_id");
		$this->db->where("patient_form.institution_id = anesth_institution.id");
		$this->db->where("patient_form.anesth_status_id",4);
		if($service_id != 0)
		{
			$this->db->where("patient_form.service",$service_id);
		}
		if($technique_id != 0)
		{
			$this->db->where("patient_form.anesthetic_technique",$technique_id);
		}
		$query = $this->db->get();
		return $query->num_rows();
}

}
?>