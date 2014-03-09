<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->model('users_model/users_model','view_caselogs');
   $this->load->model('user','',TRUE);
   $this->load->model('dropdown_select','',TRUE);
   $this->load->library('session');
   $this->load->helper('url');
   $this->load->helper(array('dompdf', 'file'));
 }
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $data["user_information"] = $session_data;
     $this->load->view('header/header', $data);
     $this->load->view('home_view');
   }
   else
   {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }
 function add_patient()
 {
   if($this->session->userdata('logged_in'))
       {
        $session_data = $this->session->userdata('logged_in');
        $data["user_information"] = $session_data;
        $case_number = $this->input->post('case_number');
        $data['case_number'] = $this->user->case_number_checking($case_number,$session_data['institution_id']);
        if ($data['case_number'] == true)
        {
         $data['message'] = "CASE NUMBER IS ALREADY EXIST.";
         $this->load->view('header/header',$data);
         $this->load->view('home_view',$data);
        }
        elseif ($data['case_number'] == false)
       {
  $data = array
  ('case_number'    => $case_number,
   'institution_id' => $session_data['institution_id'],
   'lastname'        => $this->input->post('lastname'),
   'firstname'       => $this->input->post('firstname'),
   'middle_initials' => $this->input->post('middle_initials'),
   'gender'          => $this->input->post('gender'),
   'birthdate'       => $this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day'),
   'weight'          => $this->input->post('weight'));
    $this->user->add_patient($data);
    $patient_information_id = $this->db->insert_id();
  redirect('home/anesthesiology_form/'.$patient_information_id);
  }
  else
  {
   redirect('login', 'refresh');
   }
 }
 }
 function add_anesthesiology_information()
 {
  $monitors_used = $this->input->post('monitors_used');
  $airway = $this->input->post('airway');
  $other_airway = $this->input->post('other_airway');
  $spinal_needle = $this->input->post('spinal_needle');
  $other_spinal_needle = $this->input->post('other_spinal_needle');
  $epidural_needle = $this->input->post('epidural_needle');
  $other_epidural_needle = $this->input->post('other_epidural_needle');
  $others_m = $this->input->post('other_main_agent');
  $other_main_agent = $this->input->post('other_main_agent_data');
  $others_s = $this->input->post('other_supplementary_agent');
  $other_supplementary_agent = $this->input->post('other_supplementary_agent_data');
  $other_post = $this->input->post('other_post_op_pain_agent');
  $other_post_op_pain_agent = $this->input->post('other_post_op_pain_agent_data');
  $colloids_used = $this->input->post('colloids_used');
  $other_colloids_used = $this->input->post('other_colloids_used');
  $other_monitors_used = $this->input->post('other_monitors_used');
  $other_monitors_used_data = $this->input->post('other_monitors_used_data');
  $anesthetic_technique = $this->input->post('anesthetic_technique');
  $critical_events = $this->input->post('critical_events');
  $peripheral = $this->input->post('peripheral');
  if ($airway == "Others (pls specify):"){$airway  = $other_airway; } else { $airway = $airway; }
  if ($spinal_needle == "Others (pls specify):"){ $spinal_needle = $other_spinal_needle; } else { $spinal_needle = $spinal_needle; }
  if ($epidural_needle == "Others"){ $epidural_needle = $other_epidural_needle; } else { $epidural_needle = $epidural_needle; }
  if ($colloids_used =="Others") {$colloids_used = $other_colloids_used; } else { $colloids_used=$colloids_used; }
  if ($others_m=="other_main_agent_checkbox"){$others_m = $other_main_agent;} else {$others_m = "NULL"; } 
  if ($others_s=="other_supplementary_agent_checkbox"){$others_s = $other_supplementary_agent;} else {$others_s = "NULL"; } 
  if ($other_post=="other_post_op_pain_agent_checkbox"){$other_post = $other_post_op_pain_agent;} else {$other_post = "NULL"; } 
  if ($other_monitors_used=="other_monitors_used_checkbox"){$other_monitors_used = $other_monitors_used_data;} else {$other_monitors_used = "NULL"; } 
  if ($this->input->post('colloids') == "NO") { $colloids_used = "NULL"; } else { $colloids_used = $colloids_used; }
  if ($anesthetic_technique == "9") {$peripheral = $peripheral;} else {$peripheral = "NULL";}
  if ($anesthetic_technique == "3") {$critical_events ="YES";}
  if($this->session->userdata('logged_in'))
       {
        $session_data = $this->session->userdata('logged_in');
   $data["user_information"] = $session_data;
    $data = array(
   'patient_information_id' => $this->input->post('patient_information_id'),
   'user_id' => $session_data['id'],
   'institution_id' => $session_data['institution_id'],
   'operation_date' =>$this->input->post('operation_date'),
   'level_of_involvement' =>$this->input->post('level_of_involvement'),
   'type_of_patient' => $this->input->post('type_of_patient'),
   'asa' => $this->input->post('asa'),
   'for_emergency' => $this->input->post('for_emergency'),
   'diagnosis' => addslashes($this->input->post('diagnosis')),
   'comorbid_diseases' => addslashes($this->input->post('comorbid_diseases')),
   'service' =>  $this->input->post('service'),
   'anesthetic_technique' => $anesthetic_technique,
   'peripheral' => $peripheral,
   'airway' => $airway,
   'spinal_needle' => $spinal_needle,
   'epidural_needle' => $epidural_needle,
   'spinal_needle_gauge' => $this->input->post('spinal_needle_gauge'),
   'epidural_needle_gauge' => $this->input->post('epidural_needle_gauge'),
   'anesthesia_start' => $this->input->post('anesthesia_start'),
   'anesthesia_start_time' => $this->input->post('anesthesia_start_hour').":".$this->input->post('anesthesia_start_min')." ".$this->input->post('anesthesia_start_time'),
   'anesthesia_end' => $this->input->post('anesthesia_end'),
   'anesthesia_end_time' => $this->input->post('anesthesia_end_hour').":".$this->input->post('anesthesia_end_min')." ".$this->input->post('anesthesia_end_time'),
   'other_main_agent' => addslashes($others_m),
   'other_supplementary_agent' => addslashes($others_s),
   'other_post_op_pain_agent' => addslashes($other_post),
   'other_monitors_used' => addslashes($other_monitors_used),
   'blood_loss' => $this->input->post('blood_loss'),
   'crystalloids' => $this->input->post('crystalloids'),
   'colloids' => $this->input->post('colloids'),
   'colloids_used' => $colloids_used,
   'blood_products_used' => $this->input->post('blood_products_used'),
   'fresh_whole_blood' => $this->input->post('fresh_whole_blood'),
   'cyroprecipitate' => $this->input->post('cyroprecipitate'),
   'platelets' => $this->input->post('platelets'),
   'fresh_frozen_plasma' => $this->input->post('fresh_frozen_plasma'),
   'packed_rbc' => $this->input->post('packed_rbc'),
   'others' => addslashes($this->input->post('others')),
   'procedure_done' => addslashes($this->input->post('procedure_done')),
   'other_procedure' => addslashes($this->input->post('other_procedure')),
   'muscle_relaxant_reversal_done' => $this->input->post('muscle_relaxant_reversal_done'),
   'if_delivery' => $this->input->post('if_delivery'),
   'post_operative_diagnosis' => addslashes($this->input->post('post_operative_diagnosis')),
   'discharge_notes' => addslashes($this->input->post('discharged_notes')),
   'other_notes' => addslashes($this->input->post('other_notes')),
   'critical_events' => $critical_events
);
$this->user->add_anesthesiology_information_data($data);
  $patient_form_id = $this->db->insert_id();
  if($this->input->post('if_delivery') == "YES")
  {
   $agpar_score_1m = $this->input->post('agpar_score_1m');
   $agpar_score_5m = $this->input->post('agpar_score_5m');
   $agpar_score_10m = $this->input->post('agpar_score_10m');
   $this->user->add_apgar_data($patient_form_id,$agpar_score_1m,$agpar_score_5m,$agpar_score_10m);
  }
  //CRITICAL EVENTS
  if ($critical_events == "YES")
  {
   //AIRWAY
   $critical_level_airway = $this->input->post('critical_level_airway');
    $this->user->add_critical_level_airway($patient_form_id,$critical_level_airway);
   //CARDIOVASCULAR
   $critical_level_cardiovascular = $this->input->post('critical_level_cardiovascular');
    $this->user->add_critical_level_cardiovascular($patient_form_id,$critical_level_cardiovascular);
    //DISCHARGE PLANNING
   $critical_level_discharge_planning = $this->input->post('critical_level_discharge_planning');
    $this->user->add_critical_level_discharge_planning($patient_form_id,$critical_level_discharge_planning);
    //MISCELLANEOUS
    $miscellaneous = $this->input->post('critical_level_miscellaneous');
    $this->user->add_critical_level_miscellaneous($patient_form_id,$miscellaneous);
    //NEUROLOGICAL
    $neurological = $this->input->post('critical_level_neurological');
    $this->user->add_critical_level_neurological($patient_form_id,$neurological);
    //RESPIRATORY
    $respiratory = $this->input->post('critical_level_respiratory');
    $this->user->add_critical_level_respiratory($patient_form_id,$respiratory);
    //REGIONAL ANESTHESIA
    $regional_anesthesia = $this->input->post('critical_level_regional_anesthesia');
    $this->user->add_critical_level_regional_anesthesia($patient_form_id,$regional_anesthesia);
    //PREOP
    $preop = $this->input->post('critical_level_preop');
    $this->user->add_critical_level_preop($patient_form_id,$preop);
  }
  //MAIN AGENT DETAILS
  $main_agent = $this->input->post('main_agent');
  if (!empty($main_agent))
  {
  $this->user->add_main_agent_data($patient_form_id,$main_agent);
  }
  //SUPPLEMENTARY AGENT DETAILS
  $supplementary_agent   = $this->input->post('supplementary_agent');
 if (!empty($supplementary_agent))
  {
  $this->user->add_supplementary_agent_data($patient_form_id,$supplementary_agent);
  }
  //POST OP PAIN AGENT
  $post_op_pain_agent   = $this->input->post('post_op_pain_agent');
  if (!empty($post_op_pain_agent))
  {
   $this->user->add_post_op_pain_agent_data($patient_form_id,$post_op_pain_agent);
  }
  //POST OF PAIN MANAGEMENT
  $post_op_pain_management = $this->input->post('post_op_pain_management');
  $this->user->add_post_op_pain_management_data($patient_form_id,$post_op_pain_management);
  //POST OF PAIN MANAGEMENT 1
  $post_op_pain_management_1 = $this->input->post('post_op_pain_management_1');
  $this->user->add_post_op_pain_management_data_1($patient_form_id,$post_op_pain_management_1);
  //MONITORS USED
  if (!empty($monitors_used))
  {
   $this->user->add_monitors_used_data($patient_form_id,$monitors_used);
  }
  $this->user->update_users_date_encode($session_data['id']);
  redirect('home/successful_data','refresh');
 }
 else
 {
  redirect('login', 'refresh');
 }
 }
  function successful_data()
  {
   if($this->session->userdata('logged_in'))
   {
  $session_data = $this->session->userdata('logged_in');
   $data["user_information"] = $session_data;
   $this->load->view('header/header',$data);
   $this->load->view('success_view',$data);
  }
   else
   {
     redirect('login', 'refresh');
   }
  }
 function anesthesiology_form($patient_information_id='')
 {
  $datas['patient_information_data'] = $this->user->select_patient_information($patient_information_id);
  if ($datas['patient_information_data'] == false)
  {
   $datas['message'] = "NO INFORMATION FOUND.";
  $session_data = $this->session->userdata('logged_in');
  $data["user_information"] = $session_data;
  $this->load->view('header/header',$data);
  $this->load->view('home_view',$datas);
  }
  else
  {
   if($this->session->userdata('logged_in'))
   {
  $session_data = $this->session->userdata('logged_in');
     $data["user_information"] = $session_data;
     $datas['patient_information_data'] = $this->user->select_patient_information($patient_information_id);
     $datas['anesth_services_data'] = $this->dropdown_select->anesth_services();
     $datas['anesth_technique_data'] = $this->dropdown_select->anesth_techniques();
     $datas['anesth_agent_data'] = $this->dropdown_select->anesth_agent();
     $datas['anesth_monitor_data'] = $this->dropdown_select->anesth_monitors();
     $datas['anesth_airway_data'] = $this->dropdown_select->anesth_airway();
     $datas['anesth_needle_data'] = $this->dropdown_select->anesth_needle();
     $datas['anesth_needle_gauge_data'] = $this->dropdown_select->anesth_needle_gauge();
     $datas['anesth_agpar_score_data'] = $this->dropdown_select->anesth_agpar_score();
     $datas['anesth_colloids_used'] = $this->dropdown_select->anesth_colloids_used();
     $datas['anesth_blood_loss'] = $this->dropdown_select->anesth_blood_loss();
     $datas['critical_level_airway'] = $this->dropdown_select->critical_level_airway();
     $datas['critical_level_cardiovascular'] = $this->dropdown_select->critical_level_cardiovascular();
     $datas['critical_level_discharge_planning'] = $this->dropdown_select->critical_level_discharge_planning();
     $datas['critical_level_miscellaneous'] = $this->dropdown_select->critical_level_miscellaneous();
     $datas['critical_level_neurogical'] = $this->dropdown_select->critical_level_neurogical();
     $datas['critical_level_respiratory'] = $this->dropdown_select->critical_level_respiratory();
     $datas['critical_level_regional_anesthesia'] = $this->dropdown_select->critical_level_regional_anesthesia();
     $datas['critical_level_preop'] = $this->dropdown_select->critical_level_preop();
     $datas['anesth_post_op_pain_management_data'] = $this->dropdown_select->anesth_post_op_pain_management();
     $datas['anesth_post_op_pain_management_data_1'] = $this->dropdown_select->anesth_post_op_pain_management_1();
     $datas['institution_details'] = $this->user->institution_info($session_data['institution_id']);
     $this->load->view('header/header',$data);
     $this->load->view('anesthesiology_form',$datas);
   }
  else
   {
     redirect('login', 'refresh');
   }
  }
 }
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('home', 'refresh');
 }
function pdf_report($patients_id='', $pf_id='')
	 {
          $r_id = $this->input->get('resident_id');
          if($this->session->userdata('logged_in'))
          {
          $session_data = $this->session->userdata('logged_in');
          $user_id = $data['id'] = $session_data['id'];
          $this->load->helper('dompdf');
          $this->load->helper('file');
          $this->load->model('pdf_report','',TRUE);
          $data['patient_information'] = $this->pdf_report->select_patient_information($patients_id,$pf_id);
          if ($data['patient_information'] != false)
          {
          foreach ($data['patient_information'] as $delivery){}
          $patient_form_id = $delivery->patient_form_id;
          $data['main_agent'] = $this->pdf_report->patient_form_main_agent_details($patient_form_id);
          $data['supplementary_agent'] = $this->pdf_report->patient_form_supplementary_agent_details($patient_form_id);
          $data['post_op_pain_agent'] = $this->pdf_report->patient_form_post_op_pain_agent_details($patient_form_id);
          $data['monitors_used'] = $this->pdf_report->patient_form_monitors_used_details($patient_form_id);
          $data['post_op_pain_management'] = $this->pdf_report->patient_form_post_op_pain_management_details($patient_form_id);
          $data['post_op_pain_management_1'] = $this->pdf_report->patient_form_post_op_pain_management_details_1($patient_form_id);
          if ($delivery->if_delivery == "YES")
          {
           $data['apgar_information'] = $this->pdf_report->patient_form_apgar_details($patient_form_id);
          }
          /*
          if($delivery->critical_events == "YES")
          {
          $data['critical_events_information'] = $this->pdf_report->patient_form_critical_events_details($patient_form_id);
          }
          */
          $html = $this->load->view('anesthesiology_form_pdf',$data,true);
          pdf_create($html,'Case_number'."_".$delivery->case_number,true,'letter','portrait');
          }
          else
          {
           $this->session->set_flashdata("success",'<p style="background-color:#faadad; width:80%; text-align:center; border: #c39495 1px solid; padding:10px 10px 10px 20px; color:#860d0d; font-family:tahoma;">
									<img src="../assets/images/error.png" width="15" height="15" style="margin-top:2px;">
									<font size="3" color="red"><span style="padding-top:10px;"><b>CASE LOG FORM OF SELECTED PATIENT ARE NOT YET COMPLETED!</b></span></font></p>');
           redirect('home/resident_encoded?resident_id='.$r_id,'refresh');
          }
          }
          else
          {
           redirect('login', 'refresh');
          }
    }
    function resident_lists()
	 {
          if($this->session->userdata('logged_in'))
          {
           $session_data = $this->session->userdata('logged_in');
           $data["user_information"] = $session_data;
           $insti_id = $session_data['institution_id'];
          $this->load->library('pagination');
          $config = array();
          $config["base_url"] = base_url()."index.php/home/resident_lists";
          $config["total_rows"] = $this->user->count_residents($insti_id);
          $config["per_page"] = 10;
          $config["uri_segment"] = 3;
          $this->pagination->initialize($config);
          
           $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
           $datas["residents_information"] = $this->user->fetch_residents($config["per_page"], $page,$insti_id);
           $this->load->view('header/header',$data);
           $this->load->view('resident_lists',$datas);
           }
           else
           {
           //If no session, redirect to login page
           redirect('login', 'refresh');
           }
           }
           function resident_encoded()
           {
            $status = $this->input->get('status');
            $resident_id =$this->input->get('resident_id');
            $this->load->library('pagination');
            if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
            $config["base_url"] = base_url()."index.php/home/resident_encoded";
            $config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
            $config["total_rows"] = $this->user->count_patient_information_by_resident($resident_id,$status);
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;
            $this->pagination->initialize($config);
            if($this->session->userdata('logged_in'))
          {
           $session_data = $this->session->userdata('logged_in');
           $data["user_information"] = $session_data;
           $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
           $datas["patient_informationss"] = $this->user->fetch_patient_information_by_resident($page,$config["per_page"],$resident_id,$status);
           $datas['resident_information'] = $this->user->resident_information($resident_id);
           $user_id = $resident_id;
            $datas["count_all"] = $this->view_caselogs->count_view_caselog_details_1($user_id,0);
            $datas["count_submitted"] = $this->view_caselogs->count_view_caselog_details_1($user_id,1);
            $datas["count_forRevision"] = $this->view_caselogs->count_view_caselog_details_1($user_id,3);
            $datas["count_approved"] = $this->view_caselogs->count_view_caselog_details_1($user_id,4);
            $datas["count_disapproved"] = $this->view_caselogs->count_view_caselog_details_1($user_id,5);
            $datas["count_deleted"] = $this->view_caselogs->count_view_caselog_details_1($user_id,7);
            $datas['status_list']      = $this->dropdown_select->anesth_status();
           $this->load->view('header/header',$data);
           $this->load->view('resident_encoded',$datas);
           }
          else
          {
           redirect('login', 'refresh');
          }
           }
}