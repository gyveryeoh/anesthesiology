<?php
Class Search_caselog_model extends CI_Model
{
        function count_search_caselog_details($case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hospital_id,$diagnosis,$main_agent,$patient_classification,$emergency,$patient_age)
        {
                $this->db->select('*');
                $this->db->from('patient_form');
                if($patient_age !=0)        $this->db->join('patient_information', 'patient_information.id = patient_form.patient_information_id');
                if(!empty($case_number))        $this->db->join('patient_information', 'patient_information.id = patient_form.patient_information_id');
                if(!empty($case_number))        $this->db->where('patient_information.case_number',$case_number);
                if($main_agent !=0)             $this->db->join('patient_form_main_agent_details', 'patient_form.id = patient_form_main_agent_details.patient_form_id');
                if($main_agent !=0)             $this->db->where('patient_form_main_agent_details.anesth_agent_id',$main_agent);
                if($service !=0)                $this->db->where('service',$service);
                if($patient_classification !=0) $this->db->where('asa',$patient_classification);
                if($emergency == "Y")           $this->db->where('for_emergency',$emergency);
                if($technique !=0)              $this->db->where('anesthetic_technique',$technique);
                if($user_id !=0)                $this->db->where('user_id',$user_id);
                if($status_id !=0)              $this->db->where('anesth_status_id',$status_id);
                if($include_date !=0)           $this->db->where('operation_date >=', $start_date);
                if($include_date !=0)           $this->db->where('operation_date <=', $end_date);
                if($hospital_id !=0)            $this->db->where('patient_form.institution_id', $hospital_id);
                if(!empty($diagnosis))          $this->db->where('diagnosis', $diagnosis);
                if($patient_age == "1")         $this->db->where('birthdate >=', date('Y-m-d', strtotime('-1 year')));
                if($patient_age == "1")         $this->db->where('birthdate <=', date('Y-m-d'));
                if($patient_age == "3")         $this->db->where('birthdate >=', date('Y-m-d', strtotime('-3 year')));
                if($patient_age == "3")         $this->db->where('birthdate <=', date('Y-m-d', strtotime('-2 year')));   
                if($patient_age == "18")         $this->db->where('birthdate >=', date('Y-m-d', strtotime('-18 year')));
                if($patient_age == "18")         $this->db->where('birthdate <=', date('Y-m-d', strtotime('-3 year')));  
                if($patient_age == "65")        $this->db->where('birthdate >=', date('Y-m-d', strtotime('-65 year')));
                if($patient_age == "65")        $this->db->where('birthdate <=', date('Y-m-d', strtotime('-18 year')));    
                if($patient_age == "66")        $this->db->where('birthdate >=', date('Y-m-d', strtotime('-110 year')));
                if($patient_age == "66")        $this->db->where('birthdate <=', date('Y-m-d', strtotime('-66 year')));  
                
                $q = $this->db->get();
                return $q->num_rows();
        }
        //END NUNG CONDITION NG FILTER SEARCHs
        function fetch_search_caselog_details($limit,$start,$case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hospital_id,$diagnosis,$main_agent,$patient_classification,$emergency,$patient_age)
        {
                $this->db->limit($start,$limit);
                $this->db->select('*,
                patient_form.id as patient_form_id,
		patient_form.user_id,
		patient_form.date_created as pf_date_created,
		patient_form.date_updated as pf_date_updated,
		anesth_status.name as anesth_name,
		patient_information.id as p_id,
		patient_information.birthdate as patient_info_birthdate,
		patient_information.weight as patient_info_weight,
		patient_information.case_number as patient_info_case_number,
		patient_information.lastname as patient_info_lastname,
		patient_information.firstname as patient_info_firstname,
		patient_information.middle_initials as patient_info_middle_initials,
		patient_information.gender as patient_info_gender');
                $this->db->from('patient_form');
                $this->db->join('patient_information', 'patient_information.id = patient_form.patient_information_id');
                $this->db->join('anesth_status','anesth_status.id = patient_form.anesth_status_id');
                $this->db->join('users','users.id = patient_form.user_id');
                $this->db->order_by("users.lastname", "asc");
                if($main_agent !=0)             $this->db->join('patient_form_main_agent_details', 'patient_form.id = patient_form_main_agent_details.patient_form_id');
                if($main_agent !=0)             $this->db->where('patient_form_main_agent_details.anesth_agent_id',$main_agent);
                if($hospital_id != 0)           $this->db->where('patient_form.institution_id',$hospital_id);
                if($user_id != 0)               $this->db->where('patient_form.user_id', $user_id);
                if($status_id != 0)             $this->db->where('patient_form.anesth_status_id', $status_id);
                if (!empty($case_number))       $this->db->where('patient_information.case_number', $case_number);
                if($service != 0)               $this->db->where('patient_form.service', $service);
                if($patient_classification !=0) $this->db->where('patient_form.asa',$patient_classification);
                if($emergency == "Y")           $this->db->where('patient_form.for_emergency',$emergency);
                if($technique != 0)             $this->db->where('patient_form.anesthetic_technique', $technique);
                if($include_date !=0)           $this->db->where('operation_date >=', $start_date);
                if($include_date !=0)           $this->db->where('operation_date <=', $end_date);
                if(!empty($diagnosis))          $this->db->where('diagnosis', $diagnosis);
                if($patient_age == "1")         $this->db->where('birthdate >=', date('Y-m-d', strtotime('-1 year')));
                if($patient_age == "1")         $this->db->where('birthdate <=', date('Y-m-d'));
                if($patient_age == "3")         $this->db->where('birthdate >=', date('Y-m-d', strtotime('-3 year')));
                if($patient_age == "3")         $this->db->where('birthdate <=', date('Y-m-d', strtotime('-2 year')));  
                if($patient_age == "18")        $this->db->where('birthdate >=', date('Y-m-d', strtotime('-18 year')));
                if($patient_age == "18")        $this->db->where('birthdate <=', date('Y-m-d', strtotime('-3 year')));  
                if($patient_age == "65")        $this->db->where('birthdate >=', date('Y-m-d', strtotime('-65 year')));
                if($patient_age == "65")        $this->db->where('birthdate <=', date('Y-m-d', strtotime('-18 year')));    
                if($patient_age == "66")        $this->db->where('birthdate >=', date('Y-m-d', strtotime('-110 year')));
                if($patient_age == "66")        $this->db->where('birthdate <=', date('Y-m-d', strtotime('-65 year')));   
                $query = $this->db->get();
                return $query->result();
        }
}
?>