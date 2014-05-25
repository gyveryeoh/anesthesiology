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
    function annual_patient_classification_and_distribution_summary_count($anesth_asa,$user_id,$status,$year)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('user_id',$user_id);
        $this->db->where('asa',$anesth_asa);
        $this->db->where('anesth_status_id',$status);
	$this->db->where('year(operation_date) ', $year);
        $result = $this->db->get();
        return $result->num_rows();
    }
    function annual_patient_classification_and_distribution_summary_emergency_count($anesth_asa,$user_id,$status,$year)
    {
	$this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('user_id',$user_id);
        $this->db->where('asa',$anesth_asa);
        $this->db->where('for_emergency',"Y");
        $this->db->where('anesth_status_id',$status);
	$this->db->where('year(operation_date) ', $year);
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
    }
    
    function get_patient_type_grid($options=array()) {
        $filters = $this->prepareFilters($options);
        
        $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/patient_type_grid.sql'), array(
            '{$filters}' => $filters,
        ));
        chrome_log($query);
        $results = $this->db->query($query)->result();
        
        return isset($results[0]) ? $results[0] : null;
    }
    
    function get_services_grid($options=array())
    {
        $filters = $this->prepareFilters($options, true);
        
        $query = $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/services_grid.sql'), array(
            '{$filters}' => $filters,
        ));
        
        $results = $this->db->query($query)->result();
        
        return $results;
    }
    
    function get_services_techniques_grid($options=array())
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
            
            $results = $this->db->query($query)->result();
        }
        
        return $results;
    }
    
    function get_critical_events_grid($options=array()) {
        $filters = $this->prepareFilters($options, true);
        
        $query = strtr(file_get_contents(dirname(__FILE__) . '/sql/critical_events_grid.sql'), array(
            '{$filters}' => $filters,
        ));
        
        $results = $this->db->query($query)->result();
        
        return isset($results[0]) ? $results[0] : null;
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
}
?>