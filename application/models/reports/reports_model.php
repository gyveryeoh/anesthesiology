<?php
Class Reports_model extends CI_Model
{
 function anesth_data_per_resident($anest_id)
 {
  $xi=1;
	$count = count($anest_id);
	while($xi<=$count)
        {
         $anesthetic_count = mysql_query("SELECT count(anesthetic_technique) from patient_form  where anesthetic_technique = '".$anest_id[$xi]."'");
          $counts = mysql_fetch_array($anesthetic_count);
         $c =$counts[0];
         return $c;
         $xi++;
        }
} 
}
?>
