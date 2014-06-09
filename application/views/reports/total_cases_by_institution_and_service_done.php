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
                categories: [<?php foreach ($results as $list): echo "'".$list->name."',"; endforeach; ?>],
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
                data: [107, 31, 635,107, 31, 635,107, 31, 635,107, 31, 635,107, 31, 635, 203, 2,5,8,0,6,2,5,8,0,6,2,5,8,0,6,2,5,8,0,6,2,5,8,0,6,2,5,8,0,6,2,5,8,0,6]
            }]
        });
    });
    </script>
	</head>
	<body>
<?php echo form_open('reports_controller/total_cases_by_institution_and_service_done', array(
    'id' => 'annual_report-form',
    'autocomplete' => 'off',
)); ?>
<table width="90%" cellpadding="0" cellspacing="0">
<tr>
<td class="border-less header" align="center" colspan="11">Resident Trainee's Annual Technique Summary</td>
</tr>
<tr>
<td class="border-less question" align="right" colspan="2"><?php echo form_label('HOSPITAL', 'insti_id'); ?></td>
<td class="border-less answer" colspan="9">
<select name="institution" id="institution_id" style="width:auto;">
<option value="-111">ALL INSTITUTIONS</option>
<?php foreach ($institution_list as $ai): ?>
<option value="<?php echo $ai->id; ?>"><?php echo $ai->name; ?></option>
<?php endforeach; ?>
</select>
</td>
</tr>
<tr>
<td class="border-less question" align="right" colspan="2"><?php echo form_label('SERVICE', 'insti_id'); ?></td>
<td class="border-less answer" colspan="9">
<select name="service" id="insti_id" style="width:auto;">
<option value="0">ALL SERVICES</option>
<?php foreach ($service_list as $sl): ?>
<option value="<?php echo $sl->id; ?>"><?php echo $sl->name; ?></option>
<?php endforeach; ?>
</select>
</td>
</tr>
<tr>
	  <td class="border-less question" align="right" colspan="2">YEAR</td>
	  <td class="border-less answer">
<select name="year" size="1" style="width: 60px;">
    <option value="0">ALL</option>
				<?php
				for($x=date('Y');$x>=2010;$x--)
				{
					echo "<option value=".$x."";
					
						if($this->input->post('year') == $x)
						{
							echo "selected = selected";
						}
					
					echo ">".$x."</option>";  
				}
				?>
			</select>
	  </td>
	</tr>
<tr>
<td class="border-less question" align="right" colspan="2">&nbsp;</td>
<td class="border-less answer" colspan="9"> <?php
                echo form_submit(array(
                    'type' => 'submit',
                    'name' => 'submit',
                    'value' => 'SEARCH',
                    'content' => 'Get Summary',
                ));
                ?> <?php
                echo form_submit(array(
                    'type' => 'submit',
                    'name' => 'clear',
                    'value' => 'CLEAR',
                    'onclick' => <<<EOD
$('select', $(this).closest('form')).val('');
EOD
                )); ?>
</td>
</tr>
</table>

<script src="<?php echo base_url(); ?>assets/javascript/highcharts/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/javascript/modules/exporting.js"></script>


<div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>

	</body>
</html>