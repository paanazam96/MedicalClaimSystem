<?php
    session_start();
    //$staffid = $_SESSION['staffid'];    
    require('fpdf17/fpdf.php');
    
    $id = $_GET['id'];
    $year = $_GET['year'];

    $conn = mysqli_connect("localhost", "root", "", "mcs");
    $query = mysqli_query($conn, " SELECT * FROM claim WHERE staffno='$id' AND YEAR(date)=$year ");
    $query1 = mysqli_query($conn, " SELECT * FROM staffs WHERE staffno='$id' ");
    $query2 = mysqli_query($conn, " SELECT entitlement FROM staffs WHERE staffno='$id' ");
    $query3 = mysqli_query($conn, " SELECT SUM(amount) AS totalamount FROM claim WHERE staffno='$id' AND YEAR(date)=$year ");

    while($rows=mysqli_fetch_array($query1))
    {
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
        $pdf -> Cell(280, 20, 'MEDICAL CLAIM DETAILS', 0, 1, 'C');

        $pdf -> SetFont('Times','B',12);
        $pdf -> Cell(50, 5, 'PERSONAL DETAILS', 0, 1);
        $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
        
        //set font to arial, bold, 10pt
        $pdf -> SetFont('Arial','',12);

        $pdf -> Cell(20, 5, 'Staff ID : ', 0, 0);
        $pdf -> Cell(30, 5, $rows['staffno'], 0, 0);
        $pdf -> Cell(15, 5, 'Email : ', 0, 0);
        $pdf -> Cell(75, 5, $rows['email'], 0, 0);
        $pdf -> Cell(15, 5, 'Name : ', 0, 0);
        $pdf -> Cell(20, 5, $rows['name'], 0, 1);
        $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
        
        $pdf -> Cell(10, 5, 'I/C : ', 0, 0);
        $pdf -> Cell(40, 5, $rows['ic'], 0, 0);
        $pdf -> Cell(15, 5, 'D.o.B : ', 0, 0);
        $pdf -> Cell(30, 5, $rows['dob'], 0, 0);
        $pdf -> Cell(25, 5, 'Telephone : ', 0, 0);
        $pdf -> Cell(30, 5, $rows['tel'], 0, 0);
        $pdf -> Cell(30, 5, 'Mobile Phone : ', 0, 0);
        $pdf -> Cell(45, 5, $rows['mobile'], 0, 1);
        $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
        
        $pdf -> Cell(35, 5, 'Entitlement (RM) : ', 0, 0);
        $pdf -> Cell(30, 5, $rows['entitlement'], 0, 0);
        $pdf -> Cell(15, 5, 'Status : ', 0, 0);
        $pdf -> Cell(35, 5, $rows['status'], 0, 0);
        $pdf -> Cell(15, 5, 'Grade : ', 0, 0);
        $pdf -> Cell(35, 5, $rows['grade'], 0, 0);
        $pdf -> Cell(27, 5, 'Designation : ', 0, 0);
        $pdf -> Cell(100, 5, $rows['designation'], 0, 1);
        $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
        
        $pdf -> Cell(27, 5, 'Department : ', 0, 0);
        $pdf -> Cell(100, 5, $rows['dept'], 0, 0);
        $pdf -> Cell(23, 5, 'Company : ', 0, 0);
        $pdf -> Cell(20, 5, $rows['company'], 0, 1);
        $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
        $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW
    }
    $pdf -> SetFont('Times','B',12);
    $pdf -> Cell(55, 5, 'MEDICAL CLAIM YEAR : ', 0, 0);
    $pdf -> Cell(10, 5, $year, 0, 1);
    $pdf -> Cell(189, 5, '', 0, 1); //SKIP ROW

    $pdf -> SetFont('Arial','B',10);
    $pdf->SetFillColor(180,180,255);
    $pdf->SetDrawColor(0,0,0);
    $pdf->Cell(13,7,'No.',1,0,'C',true);
	$pdf->Cell(25,7,'Date',1,0,'C',true);
	$pdf->Cell(115,7,'Name',1,0,'C',true);
	$pdf->Cell(55,7,'Clinic',1,0,'C',true);
	$pdf->Cell(40,7,'Invoice No.',1,0,'C',true);
    $pdf->Cell(27,7,'Amount (RM)',1,1,'C',true);

    $pdf -> SetFont('Arial','',11);
    $counter=1;
    while($rows=mysqli_fetch_array($query))
    {
        $tarikh=$rows['date'];
        $date=date('j/M/y', strtotime($tarikh));
        
        $pdf->Cell(13,6,$counter,'LRBT',0,'C');
        $pdf->Cell(25,6,$date,'LRBT',0);
        $pdf->Cell(115,6,$rows['famname'],'LRBT',0);
        $pdf->Cell(55,6,$rows['clinic'],'LRBT',0);
        $pdf->Cell(40,6,$rows['invoice'],'LRBT',0);
        $pdf->Cell(27,6,$rows['amount'],'LRBT',1,'C');
        
        $counter++;
    }

    while($rows=mysqli_fetch_array($query3))
    {
        $smallest = number_format($rows['totalamount'], 2, '.', ''); 
        $pdf -> Cell(248, 6, 'Total (RM)','LRBT', 0,'R');
        $pdf -> Cell(27,6,number_format($rows['totalamount'], 2, '.', '') ,'LRBT',1,'C');
    }

    while($rows=mysqli_fetch_array($query2))
    {
        $entitlement = number_format($rows['entitlement'], 2, '.', ''); 
        $smallest;
        $balance = $entitlement - $smallest;
        
        if($balance <= 100)
        {
            $pdf -> SetTextColor(255,0,0);
            $pdf -> SetFont('Arial','B',12);            
            $bal = number_format($balance, 2, '.', ''); 
        }
        else
        {
            $bal = number_format($balance, 2, '.', '');
        }
        
        $pdf -> Cell(248, 6, 'Balance (RM)','LRBT', 0,'R');
        $pdf -> Cell(27,6,number_format($bal, 2, '.', ''),'LRBT',1,'C');
    }
    
    $pdf -> Output();
?>