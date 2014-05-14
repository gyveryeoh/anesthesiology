<?php
Class Search_caselog_model extends CI_Model
{
        function count_search_caselog_details($case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hospital_id)
        {
                $this->db->select('*');
                $this->db->from('patient_form');
                if( (!empty($case_number)))
                {
                        $this->db->join('patient_information', 'patient_information.id = patient_form.patient_information_id');
                        $this->db->where('patient_information.case_number',$case_number);
                }
                if($service !=0)
                {
                        $this->db->where('service',$service);
                }
                if($technique !=0)
                {
                        $this->db->where('anesthetic_technique',$technique);
                }
                if($user_id !=0)
                {
                        $this->db->where('user_id',$user_id);
                }
                if($status_id !=0)
                {
                        $this->db->where('anesth_status_id',$status_id);
                }
                if($include_date !=0)
                {
                        $this->db->where('operation_date >=', $start_date);
                        $this->db->where('operation_date <=', $end_date);
                }
                if($hospital_id !=0)
                {
                        $this->db->where('patient_form.institution_id', $hospital_id);
                }
                $q = $this->db->get();
                return $q->num_rows();
        }
        //END NUNG CONDITION NG FILTER SEARCHs
        function fetch_search_caselog_details($limit,$start,$case_number,$service,$technique,$user_id,$status_id,$include_date,$start_date,$end_date,$hospital_id)
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
                if($hospital_id != 0)
                {
                        $this->db->where('patient_form.institution_id',$hospital_id);
                }
                if($user_id != 0)
                {
                        $this->db->where('patient_form.user_id', $user_id);
                }
                if($status_id != 0 )
                {
                        $this->db->where('patient_form.anesth_status_id', $status_id);
                }
                if ($case_number !='')
                {
                        $this->db->where('patient_information.case_number', $case_number);
                }
                if($service != 0)
                {
                        $this->db->where('patient_form.service', $service);
                }
                if($technique != 0)
                {
                        $this->db->where('patient_form.anesthetic_technique', $technique);
                }
                if($include_date !=0)
                {
                        $this->db->where('operation_date >=', $start_date);
                        $this->db->where('operation_date <=', $end_date);
                }
                $this->db->order_by("users.lastname", "asc");
                $query = $this->db->get();
                return $query->result();
        }
}
?>