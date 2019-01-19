<?php
    session_start();
    //$staffid = $_SESSION['staffid'];    
    require('fpdf17/fpdf.php');
    
    $company = $_GET['id'];
    $conn = mysqli_connect("localhost", "root", "", "mcs");
    $query = mysqli_query($conn, "SELECT staffs.name,
                                   staffs.email,
                                   staffs.company, 
                                   staffs.entitlement, 
                                   SUM(claim.amount) as amount, 
                                   (staffs.entitlement - SUM(claim.amount)) as balance,
                                   claim.staffno 
                              FROM staffs, 
                                   claim 
                              WHERE staffs.staffno=claim.staffno AND company='$company' AND YEAR(date)=YEAR(CURDATE())
                              GROUP BY staffno
                              ORDER BY balance ASC");
    

    $date=date('d - F - Y', strtotime(date("Y")));
        
    $pdf = new FPDF('l','mm','A4');

    $pdf -> AddPage();

        //set font to arial, bold, 14pt
    $pdf -> SetFont('Arial','B',10);

        //Cell (width, height, text, border, end line, [align] )

    $pdf -> Cell(25, 5, 'Date Printed : ', 0, 0);
    $pdf -> Cell(30, 5, $date, 0, 1);
    $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
        
    $pdf -> Image('imgs/Untitled-1.png',120,20,-200);
        
    $pdf -> SetFont('Times','B',16);
    $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
    $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
    $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
    $pdf -> Cell(280, 20, 'MEDICAL CLAIM SUMMARY', 0, 1, 'C');

    $pdf -> SetFont('Times','B',12);
    $pdf -> Cell(280, 20, $company, 0, 1, 'C');
    
    $pdf -> SetFont('Arial','B',10);
    $pdf->SetFillColor(180,180,255);
    $pdf->SetDrawColor(0,0,0);
    $pdf->Cell(15,7,'No.',1,0,'C',true);
	$pdf->Cell(30,7,'Staff ID',1,0,'C',true);
	$pdf->Cell(137,7,'Name',1,0,'C',true);
	$pdf->Cell(40,7,'Entitlement (RM)',1,0,'C',true);
    $pdf->Cell(27,7,'Amount (RM)',1,0,'C',true);
    $pdf->Cell(27,7,'Balance (RM)',1,1,'C',true);

    $counter=1;
    while($rows=mysqli_fetch_array($query))
    {
        $pdf -> SetTextColor(0,0,0);
        $pdf -> SetFont('Arial','',12);
        $pdf->Cell(15,6,$counter,'LRBT',0,'C');
        $pdf->Cell(30,6,$rows['staffno'],'LRBT',0,'C');
        $pdf->Cell(137,6,$rows['name'],'LRBT',0);        
        $pdf->Cell(40,6,$rows['entitlement'],'LRBT',0,'C');
        $pdf->Cell(27,6,number_format($rows['amount'], 2, '.', ''),'LRBT',0,'C');
        
        if($rows['balance'] <= 100)
        {
            $pdf -> SetTextColor(255,0,0);
            $pdf -> SetFont('Arial','B',12);            
            $bal = number_format($rows['balance'], 2, '.', ''); 
        }
        else
        {
            $bal = number_format($rows['balance'], 2, '.', '');
        }
        $pdf->Cell(27,6,$bal,'LRBT',1,'C');
        
        $counter++;
    }

    $pdf -> Output();
?>