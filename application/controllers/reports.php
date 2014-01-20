<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->model('dropdown_select','',TRUE);
   $this->load->model('reports/reports_model','reports_model');
   $this->load->library('session');
   $this->load->helper('url');
 }
 function index()
 {
     $session_data = $this->session->userdata('logged_in');
     $data['username'] = $session_data['username'];
     $data['lastname'] = $session_data['lastname'];
     $data['firstname'] = $session_data['firstname'];
     $data['middle_initials'] = $session_data['middle_initials'];
     $data['role_id'] = $session_data['role_id'];
     $data['id'] = $session_data['id'];
     $data['anesth_technique_data'] = $this->dropdown_select->anesth_techniques();
     $this->load->view('header/header',$data);
     echo "<table>";
 $x=1;
     foreach($data['anesth_technique_data'] as $and)
     {
       $anest_id[$x] = $and->id;
       $anesth_name[$x] = $and->name;
       $x++;
     }
     $xi=1;
	$count = count($anest_id);
	while($xi<=$count)
        {
          $anesthetic_count = mysql_query("SELECT count(anesthetic_technique) from patient_form  where anesthetic_technique = '".$anest_id[$xi]."'");
          $counts = mysql_fetch_array($anesthetic_count);
          
        $total += $counts[0];
        echo "<tr>";
        echo "<td>".$anesth_name[$xi]."</td>";
        echo "<td>".$counts[0]."</td>";
        echo "</tr>";
        $xi++;
        }
        echo "<tr><td></td><td>".$total."</td></tr></table>";
     $this->load->view('reports/anesth_technique_per_resident',$data);
        
 }
 
}