<?php


function to_pdf($employee_head){
    
$employeename = $employee_head[1][0];

$dateperiod = date("F d, Y") ." to " . date("F d, Y");
// $employeename = 'test';

$nopresent = 0;
$deduction = ' - ';
$earnings = '1';




$html = '<style type="text/css">
	table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
    text-align: center;
    padding: 3px;
    white-space: nowrap;
}
.head{
	padding: 2px;
}
.first{
	position: relative;
	right: 2px;
}

.left{
	position: relative;
	width: 45%;
	float:left;
	right: 2px;
}
.right{
	position: relative;
	width: 45%;
	float:right;
	left: 2px;
}
.left .h{
	border: 2px solid black;
	text-align: center;
	padding: 5px;
}




.left .b{ float:left;width: 59% }
.left .d{ float:left;width: 30% }
.left .b div{line-height: 100%;margin: 6px;}
.left .d div{ text-align: center;line-height: 100%;margin: 6px;}





.right .b{ float:left;width: 59% }
.right .d{ float:left;width: 30% }
.right .b div{ line-height: 100%;margin: 6px;}
.right .d div{ text-align: center;line-height: 100%;margin: 6px;}

.right .h{
	padding: 5px;
	border: 2px solid black;
	text-align: center;
}

.last{
	border-top:  1px solid black;
	border-bottom:  1px solid black;
	padding: 5px 0px;
margin-bottom: 15px !important;
}

.net{
	float:left;
	width: 85%;
	padding: 6px;
	border: 2px solid black;
}


</style>






	<div style="border: solid 2px black; width: 100%; height: 570px;line-height: 50%;">';


	$html .= '<img style="position: absolute;float: right;right: 20px;" alt="nelsoft_logo.png" src="data:image/png;base64,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">';



	$html .='<div class="head">
		<h4>NELSOFT SYSTEMS INC.</h4>
		<h4>PAYSLIP</h4>
		<div><i>for the period covering: '.$dateperiod.'</i></div>
		<h4>Employee: '.$employeename.'</h4>
	</div>';

	
	$html .='<table  class="first">
		<tr>
			<td>No. Days <br>Present</td>
			<td>No. Days <br>Absent</td>
			<td>No. Days <br>VL/EL</td>
			<td>No. Days <br>SL</td>
			<td>No. Days <br>LH</td>
			<td>No. Days <br>SH</td>
			<td>No. Hours <br>Premium</td>
			<td>No. Hours <br>Ot-Reg</td>
			<td>No. Hours <br>Ot-Rd/Spl</td>
			<td>No. Hours <br>Ot-Lh</td>
			<td>No. Minutes <br>Late</td>
		</tr>
		<tr>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
			<td>'.$nopresent.'</td>
		</tr>

	</table>';


$html .='<div style="position: relative;top: 25px;">

<div class="left">
	<div class="h">EARNINGS</div>
	<div class="b">
		<div>Basic Salary</div>
		<div>Legal Holiday Pay</div>
		<div>Special Holiday Pay</div>
		<div>De Minimis Benefits</div>
		<div>Reimbursable Allowance</div>
		<div>Sick Leave</div>
		<div>Travel Allowance</div>
		<div>Premium Pay</div>
		<div>Overtime Pay</div>
		<div>Adjustments</div>
		<div><b>Total Earnings</b></div>
	</div>

	<div class="d">
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div> '.$earnings.'</div>
				<div class="last"> '.$earnings.'</div>
	</div>';
	

$html .='</div>

<div class="right">
	<div class="h">DEDUCTIONS</div>
	
	<div class="b">
		<div>Absent/Late/Undertime</div>
		<div>Withholding Tax</div>
		<div>SSS Premium</div>
		<div>PHIC Premium</div>
		<div>HDMF Premium</div>
		<div>HDMF Premiu</div>
		<div>Advances</div>
		<div>Medicard</div>
		<div>SSS Loan Payable</div>
		<div>HDMF Loan Payable</div>
		<div><b>Total Deductions</b></div>
	</div>	

	<div class="d">
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div> '.$deduction.'</div>
		<div class="last">'.$deduction.'</div>
	</div>

	<div class="net">NET PAY</div>
</div>


</div>


</div>';

    $temp_file = tempnam(sys_get_temp_dir(), 'html').".html";
    $html = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'.$html;

    $file = fopen($temp_file,"w");
    fwrite($file,$html);
    fclose($file);
    $temp_pdf = tempnam(sys_get_temp_dir(), 'pdf');
    exec("C:\wkhtmltopdf  $temp_file $temp_pdf");
    unlink($temp_file);
    return $temp_pdf;

}
// echo to_pdf([]);



?>