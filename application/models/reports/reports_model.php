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
    
    function get_patient_type_matrix() {
        $results = $this->db->query(<<<EOD

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
            ) `pay_emergency`
    ) `pf1`
) `pf2`
-- filter condition
EOD
            , array(
                
            )
        )->result();
        
        return isset($results[0]) ? $results[0] : null;
    }
    
    function get_services_grid()
    {
        $results = $this->db->query(<<<EOD
select
    pf.service `service_id`,
    asv.name `service_name`,
    count(pf.service) `total`
from
    patient_form `pf`,
    anesth_services `asv`
where
    pf.service = asv.id
group by
    pf.service
order by
    pf.service asc
EOD
            , array(
            
            )
        )->result();
        
        return $results;
    }
    
    function get_services_techniques_grid()
    {
        $results = $this->db->query(<<<EOD
select
    pf.service `service_id`,
    asv.name `service_name`,
    pf.anesthetic_technique `technique_id`,
    at.name `technique_name`,
    count(pf.anesthetic_technique) `technique_total`
from
    patient_form `pf`,
    anesth_services `asv`,
    anesth_technique `at`
where
    pf.service = asv.id
    and pf.anesthetic_technique = at.id
group by
    pf.anesthetic_technique
order by
    pf.service asc,
    at.id asc
EOD
            , array(
            
            )
        )->result();
        
        return $results;
    }
}
?>