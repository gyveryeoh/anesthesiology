<?php
Class Dropdown_select extends CI_Model
{
 function anesth_services()
 {
     $this->db->select('*');
     $this->db->from('anesth_services');
     $query = $this->db->get();
     return $query->result();
}
 function anesth_techniques()
 {
     $this->db->select('*');
     $this->db->from('anesth_technique');
     $query = $this->db->get();
     return $query->result();
}
 function anesth_agent()
 {
     $this->db->select('*');
     $this->db->from('anesth_agent');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_monitors()
 {
     $this->db->select('*');
     $this->db->from('anesth_monitors');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_airway()
 {
     $this->db->select('*');
     $this->db->from('anesth_airway');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_needle()
 {
     $this->db->select('*');
     $this->db->from('anesth_needle');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_needle_gauge()
 {
     $this->db->select('*');
     $this->db->from('anesth_needle_gauge');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_agpar_score()
 {
     $this->db->select('*');
     $this->db->from('anesth_agpar_score');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_colloids_used()
 {
     $this->db->select('*');
     $this->db->from('anesth_colloids_used');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_blood_loss()
 {
     $this->db->select('*');
     $this->db->from('anesth_blood_loss');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function critical_level_airway()
 {
     $this->db->select('*');
     $this->db->from('critical_level_airway');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function critical_level_cardiovascular()
 {
     $this->db->select('*');
     $this->db->from('critical_level_cardiovascular');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function critical_level_discharge_planning()
 {
     $this->db->select('*');
     $this->db->from('critical_level_discharge_planning');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function critical_level_miscellaneous()
 {
     $this->db->select('*');
     $this->db->from('critical_level_miscellaneous');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function critical_level_neurogical()
 {
     $this->db->select('*');
     $this->db->from('critical_level_neurogical');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function critical_level_respiratory()
 {
     $this->db->select('*');
     $this->db->from('critical_level_respiratory');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function critical_level_regional_anesthesia()
 {
     $this->db->select('*');
     $this->db->from('critical_level_regional_anesthesia');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function critical_level_preop()
 {
     $this->db->select('*');
     $this->db->from('critical_level_preop');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_post_op_pain_management()
 {
     $this->db->select('*');
     $this->db->from('anesth_post_op_pain_management');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_post_op_pain_management_1()
 {
     $this->db->select('*');
     $this->db->from('anesth_post_op_pain_management_1');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_institutions()
 {
     $this->db->select('*');
     $this->db->from('anesth_institution');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function users_lists()
 {
     $this->db->select('*');
     $this->db->from('users');
     $this->db->order_by("lastname", "asc");
     $query = $this->db->get();
     return $query->result();
}
 function anesth_status()
 {
     $this->db->select('*');
     $this->db->from('anesth_status');
     $this->db->order_by("id", "asc");
     $query = $this->db->get();
     return $query->result();
}
}
?>