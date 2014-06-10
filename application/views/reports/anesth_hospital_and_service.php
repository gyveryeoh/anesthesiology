<!DOCTYPE HTML>
<html>
   <style>
    .highcharts-axis-labels span {
  left: 0 !important;
}
   </style>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar',
                height: 2000
            },
            title: {
                text: 'TOTAL CASES BY INSTITUTION AND SERVICE DONE'
            },
            subtitle: {
                text: 'Source: aendicus.pba-ph.com'
            },
            
            xAxis:
            {
                x: -40,
                categories: [ <?php $count = 1;
    foreach($anesth_institutions as $ai)
    {
        if($institution_id != 0)
        {
            if($institution_id == $ai->id)
            {
                echo $data_name =  "'".$ai->name."',";
                break;
                }
                }
                else
{
echo $data_name =  "'".$ai->name."',";
}
$count++;
} ?>],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'TOTAL COUNTS',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 200,
                floating: true,
                borderWidth: 1,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Filtered Year : 2013 ',
                data: [<?php
   
foreach($anesth_institutions as $ai)
{
if($institution_id != 0)
{
if($institution_id == $ai->id)
{
$per_institution[$institution_id].",";
break;
}
}
else
{
echo $per_institution[$ai->id].",";
}
$count++;
}
?>]
            }]
        });
    });
    </script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/jquery.js"></script>
<script>
$(document).ready(function() {
$('#selectall').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    }
else{
$(':checkbox').each(function() { //loop through each checkbox
this.checked = false; //deselect all checkboxes with class "checkbox1"
});
}
});
});
</script>
<form method="post" action="<?php echo base_url(); ?>index.php/reports_controller/anesth_hospital_and_service"/>
<table>
<tr>
<td align="center">
<input type="submit" name="submit" value="submit"/>
<select name="institution_id">
<option value = 0> ALL </option>
  <?php
foreach($anesth_institutions as $ai):
  ?>
<option value="<?php echo $ai->id?>" <?php if ($ai->id == $institution_id) { echo 'selected="selected"'; }?>><?php echo $ai->name?></option>
<?php
  endforeach;
  ?>
</select>
</td>
</tr>
<tr>
<td>
<input type="checkbox" id="selectall">Select All
<?php
echo "</br>";
foreach($anesth_services as $as)
{	
echo '<input type="checkbox" name="service_id[]" value = "'.$as->id.'"';
if($services != NULL)
{
foreach($services as $key=>$value)
{
if($as->id == $value)
{
echo "checked";
}
}
}
echo ">".$as->name."</br>";
}
?>
</td>
</tr>
</table>
</form>


<script src="<?php echo base_url(); ?>assets/javascript/highcharts/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

	</body>
</html>