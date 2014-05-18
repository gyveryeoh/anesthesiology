<?php
Class Reports_model extends CI_Model
{
    function anesth_technique_count($anesth_technique,$user_id)
    {
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('user_id',$user_id);
        $this->db->where('anesthetic_technique',$anesth_technique);
        $this->db->where('anesth_status_id',4);
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
    function anesth_service_count($anesth_service,$id)
    {
        $this->db->select('*');
        $this->db->from('patient_form');
        $this->db->where('user_id',$id);
        $this->db->where('service',$anesth_service);
        $this->db->where('anesth_status_id',4);
        $result = $this->db->get();
        return $result->num_rows();
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
        
        $query = <<<EOD
select
*,
(`total_elective` + `total_emergency`) `total_overall`
from (
select
*,
(`charity_primary_elective` + `charity_assist_elective` + `pay_primary_elective` + `pay_assist_elective`) `total_elective`,
(`charity_emergency` + `pay_emergency`) `total_emergency`,
(`charity_primary_elective` + `charity_assist_elective` + `charity_emergency`) `total_charity`,
(`pay_primary_elective` + `pay_assist_elective` + `pay_emergency`) `total_pay`
from (
select
(
-- charity: primary elective
select
count(pf.level_of_involvement)
from
patient_form pf
where
pf.type_of_patient = 'C'
and pf.level_of_involvement = 'P'
{$filters}
) `charity_primary_elective`,
(
-- charity: assist elective
select
count(pf.level_of_involvement)
from
patient_form pf
where
pf.type_of_patient = 'C'
and pf.level_of_involvement = 'A'
{$filters}
) `charity_assist_elective`,
(
-- pay: primary elective
select
count(pf.level_of_involvement)
from
patient_form pf
where
pf.type_of_patient = 'P'
and pf.level_of_involvement = 'P'
{$filters}
) `pay_primary_elective`,
(
-- pay: assist elective
select
count(pf.level_of_involvement)
from
patient_form pf
where
pf.type_of_patient = 'P'
and pf.level_of_involvement = 'A'
{$filters}
) `pay_assist_elective`,
(
-- charity: emergency
select
count(pf.for_emergency)
from
patient_form pf
where
pf.type_of_patient = 'C'
and pf.for_emergency = 'Y'
{$filters}
) `charity_emergency`,
(
-- pay: emergency
select
count(pf.for_emergency)
from
patient_form pf
where
pf.type_of_patient = 'P'
and pf.for_emergency = 'Y'
{$filters}
) `pay_emergency`
) `pf1`
) `pf2`
EOD
        ;
        
        $results = $this->db->query($query)->result();
        
        return isset($results[0]) ? $results[0] : null;
    }
    
    function get_services_grid($options=array())
    {
        $filters = $this->prepareFilters($options, true);
        
        $results = $this->db->query(<<<EOD
select
t0.id `service_id`,
t0.name `service_name`,
t1.total
from
anesth_services t0
left join (
select
pf.service `service_id`,
count(pf.service) `total`
from
patient_form `pf`
{$filters}
group by
pf.service
order by
pf.service asc
) t1
on t0.id = t1.service_id
EOD
            , array(
            
            )
        )->result();
        
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
            
            $joins .= <<<EOD

left join (
select
pf.service `id`,
count(pf.anesthetic_technique) `total`
from
patient_form `pf`,
anesth_technique `atq`
where
pf.anesthetic_technique = $id
and pf.anesthetic_technique = atq.id
{$filters}
group by
pf.service,
pf.anesthetic_technique
union (
select
-111 `id`,
count(pf.anesthetic_technique) `total`
from
patient_form `pf`,
anesth_technique `atq`
where
pf.anesthetic_technique = $id
and pf.anesthetic_technique = atq.id
{$filters}
)
) t{$next}
on t0.id = t{$next}.id
EOD
            ;
            
            $cols .= <<<EOD
t{$next}.total `$name`,
EOD
            ;
        }
        
        if (!empty($cols) and !empty($joins)) {
            $cols = substr($cols, 0, -1);
            
            $query = <<<EOD
select
t0.name `Service - Technique`,
{$cols}
from (
select
*
from
anesth_services t0
union (
select
-111 `id`,
'<b>Total</b>' `name`
)
) t0
{$joins}
EOD
            ;
            
            $results = $this->db->query($query)->result();
        }
        
        return $results;
    }
    
    function get_critical_events_grid($options) {
        $filters = $this->prepareFilters($options, true);
        
        $query = <<<EOD
select
sum(if(upper(pf.critical_events) = 'YES', 1, 0)) `Yes`,
sum(if(upper(pf.critical_events) = 'NO', 1, 0)) `No`,
sum(if(upper(pf.critical_events) in ('YES', 'NO'), 1, 0)) `Total`
from
patient_form `pf`
{$filters}
EOD
        ;
        
        $results = $this->db->query($query)->result();
        
        return isset($results[0]) ? $results[0] : null;
    }
}
?>