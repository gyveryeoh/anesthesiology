<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('*');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 function add_login_data($data)
 {
  $this->db->insert('user_login_summary', $data);
 }
  function resident_information($resident_id)
{
  $this->db->select('*');
  $this->db->from('users');
  $this->db->where('id',$resident_id);
  $query = $this->db->get();
  return $query->result();
 }
 function institution_info($institution_id)
 {
  $this->db->select('*');
  $this->db->from('anesth_institution');
  $this->db->where('id',$institution_id);
  $query = $this->db->get();
  return $query->result();
 }
 function case_number_checking($case_number,$institution_id)
 {
  $this->db->select('*');
  $this->db->from('patient_information');
  $this->db->where('case_number',$case_number);
  $this->db->where('institution_id',$institution_id);
  $this->db->limit(1);
  $result = $this->db->get();
  if($result->num_rows() == 1)
  {
   return $result->result();
  }
  else
  {
  return false;
  }
 }
 function user_checking($username)
 {
  $this->db->select('username');
  $this->db->from('users');
  $this->db->where('username',$username);
  $this->db->limit(1);
  $result = $this->db->get();
  if($result->num_rows() == 1)
  {
   return $result->result();
  }
  else
  {
  return false;
  }
 }
 function add_patient($data)
 {
  $this->db->insert('patient_information', $data);
  return $this->db->insert_id();
 }
 function add_anesthesiology_information_data($data)
 {
  $this->db->insert('patient_form', $data);
  return $this->db->insert_id();
 }
function add_apgar_data($patient_form_id,$agpar_score_1m,$agpar_score_5m,$agpar_score_10m)
 {
 for($i=0; $i<count($agpar_score_1m); $i++)
{
 $data[] = array(
   'patient_form_id' => $patient_form_id,
   'apgar_score_1m' =>$agpar_score_1m[$i],
   'apgar_score_5m' =>$agpar_score_5m[$i],
   'apgar_score_10m' => $agpar_score_10m[$i]
   );
 }
 if (isset($agpar_score_1m))
 {
 $this->db->insert_batch('patient_form_apgar_details', $data);
 }
}
//MAIN AGENT
function add_main_agent_data($patient_form_id,$main_agent)
{
 for($i=0; $i<count($main_agent); $i++)
{
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'anesth_agent_id' => $main_agent[$i]
                 );
 }
 if (isset($main_agent))
 {
  $this->db->insert_batch('patient_form_main_agent_details', $data);
 }
}
//SUPPLEMENTARY AGENT
function add_supplementary_agent_data($patient_form_id,$supplementary_agent)
{
 for($i=0; $i<count($supplementary_agent);$i++)
{
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'anesth_agent_id' => $supplementary_agent[$i]
                 );
 }
 if (isset($supplementary_agent))
 {
  $this->db->insert_batch('patient_form_supplementary_agent_details', $data);
  }
}
//POST OP PAIN AGENT
function add_post_op_pain_agent_data($patient_form_id,$post_op_pain_agent)
{
 for($i=0; $i<count($post_op_pain_agent);$i++)
{
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'anesth_agent_id' => $post_op_pain_agent[$i]
                 );
 }
 if (isset($post_op_pain_agent))
 {
  $this->db->insert_batch('patient_form_post_op_pain_agent_details', $data);
  }
}
//POST OP PAIN MANAGEMENT
function add_post_op_pain_management_data($patient_form_id,$post_op_pain_management)
{
 for($i=0; $i<count($post_op_pain_management);$i++)
{
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'post_op_pain_management_id' => $post_op_pain_management[$i]
                 );
 }
 if (isset($post_op_pain_management))
 {
  $this->db->insert_batch('patient_form_post_op_pain_management_details', $data);
  }
}
//POST OP PAIN MANAGEMENT_1
function add_post_op_pain_management_data_1($patient_form_id,$post_op_pain_management_1)
{
 for($i=0; $i<count($post_op_pain_management_1);$i++)
{
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'post_op_pain_management_1_id' => $post_op_pain_management_1[$i]
                 );
 }
 if (isset($post_op_pain_management_1))
 {
  $this->db->insert_batch('patient_form_post_op_pain_management_details_1', $data);
  }
}
//MONITORS USED
function add_monitors_used_data($patient_form_id,$monitors_used)
{
 for($i=0; $i<count($monitors_used);$i++)
{
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'monitors_used_id' => $monitors_used[$i]
                 );
 }
 if (isset($monitors_used))
 {
  $this->db->insert_batch('patient_form_monitors_used_details', $data);
  }
}
//CRITICAL_LEVEL_AIRWAY
 function add_critical_level_airway($patient_form_id,$airway)
 {
    for($i=0; $i<count($airway);$i++)
    {
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'critical_level_airway_id' => $airway[$i]
                 );
   }
  if(isset($airway))
 {
  $this->db->insert_batch('patient_form_critical_level_airway_details',$data);
 }
 }
//CRITICAL_LEVEL_CARDIOVASCULAR
 function add_critical_level_cardiovascular($patient_form_id,$critical_level_cardiovascular)
 {
    for($i=0; $i<count($critical_level_cardiovascular);$i++)
    {
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'critical_level_cardiovascular_id' => $critical_level_cardiovascular[$i]
                 );
   }
  if(isset($critical_level_cardiovascular))
 {
  $this->db->insert_batch('patient_form_critical_level_cardiovascular_details',$data);
 }
 }
//CRITICAL_LEVEL_DISCHARGE_PLANNING
 function add_critical_level_discharge_planning($patient_form_id,$critical_level_discharge_planning)
 {
    for($i=0; $i<count($critical_level_discharge_planning);$i++)
    {
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'critical_level_discharge_planning_id' => $critical_level_discharge_planning[$i]
                 );
   }
  if(isset($critical_level_discharge_planning))
 {
  $this->db->insert_batch('patient_form_critical_level_discharge_planning_details',$data);
 }
 }
//CRITICAL_LEVEL_MISCELLANEOUS
 function add_critical_level_miscellaneous($patient_form_id,$miscellaneous)
 {
    for($i=0; $i<count($miscellaneous);$i++)
    {
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'critical_level_miscellaneous_id' => $miscellaneous[$i]
                 );
   }
  if(isset($miscellaneous))
 {
  $this->db->insert_batch('patient_form_critical_level_miscellaneous_details',$data);
 }
 }
//CRITICAL_LEVEL_NEUROLOGICAL
 function add_critical_level_neurological($patient_form_id,$neurological)
 {
    for($i=0; $i<count($neurological);$i++)
    {
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'critical_level_neurological_id' => $neurological[$i]
                 );
   }
  if(isset($neurological))
 {
  $this->db->insert_batch('patient_form_critical_level_neurological_details',$data);
 }
 }
//CRITICAL_LEVEL_RESPIRATORY
 function add_critical_level_respiratory($patient_form_id,$respiratory)
 {
    for($i=0; $i<count($respiratory);$i++)
    {
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'critical_level_respiratory_id' => $respiratory[$i]
                 );
   }
  if(isset($respiratory))
 {
  $this->db->insert_batch('patient_form_critical_level_respiratory_details',$data);
 }
 }
//CRITICAL_LEVEL_RESPIRATORY
 function add_critical_level_regional_anesthesia($patient_form_id,$regional_anesthesia)
 {
    for($i=0; $i<count($regional_anesthesia);$i++)
    {
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'critical_level_regional_anesthesia_id' => $regional_anesthesia[$i]
                 );
   }
  if(isset($regional_anesthesia))
 {
  $this->db->insert_batch('patient_form_critical_level_regional_anesthesia_details',$data);
 }
 }
//CRITICAL_LEVEL_PREOP
 function add_critical_level_preop($patient_form_id,$preop)
 {
    for($i=0; $i<count($preop);$i++)
    {
 $data[] = array(
                 'patient_form_id' => $patient_form_id,
                 'critical_level_preop_id' => $preop[$i]
                 );
   }
  if(isset($preop))
 {
  $this->db->insert_batch('patient_form_critical_level_preop_details',$data);
 }
 }
function select_patient_information($patient_information_id)
{
  $this -> db -> select('*');
   $this -> db -> from('patient_information');
   $this -> db -> where('id', $patient_information_id);
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
}
function count_residents($insti_id)
{
 $this->db->select('*');
 $this->db->from('users');
 $this->db->where('institution_id',$insti_id);
 $this->db->where('role_id',1);
 $q = $this->db->get();
 return $q->num_rows();
}
function fetch_residents($limit, $start,$insti_id)
{
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('institution_id',$insti_id);
        $this->db->where('role_id',1);
        $query = $this->db->get();	
	return $query->result();
}
//Patient Pagination
function count_patient_information_by_resident($resident_id,$status)
	{
		$this->db->select('*');
		$this->db->from('patient_form');
		$this->db->where('user_id',$resident_id);
		if($status != 0)
		{
			$this->db->where('anesth_status_id',$status);
		}
		$q = $this->db->get();
		return $q->num_rows();
	}
function fetch_patient_information_by_resident($limit,$start,$resident_id,$status)
{
  $this->db->limit($start,$limit);
  $this->db->select('*,patient_form.id as pf_id');
  $this->db->from('patient_information');
  //Patient Form
  $this->db->join('patient_form', 'patient_information.id = patient_form.patient_information_id');
  $this->db->where('user_id', $resident_id);
  if($status != 0)
		{
			$this->db->where('anesth_status_id',$status);
		}
  $query = $this->db->get();
  return $query->result();
}
//SAVE USER
function save_user($data)
 {
  $this->db->insert('users',$data);
 }
//CHANGE PASSWORD
function password_checking($username,$old_password)
{
   $this -> db -> select('*');
   $this -> db -> from('users');
   $this -> db -> where('username', $username);
   $this -> db -> where('password', md5($old_password));
   $this -> db -> limit(1);
   $query = $this -> db -> get();
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
}
function change_password($datas,$username)
{
 $this->db->where('username',$username);
 $this->db->update('users',$datas); 
}
function date_encode()
{
 $this->db->where('id',$username);
 $this->db->update('users',$datas); 
}

}
?>