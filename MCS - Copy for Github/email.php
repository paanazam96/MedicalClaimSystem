<?php   //including the database connection file
    session_start();
    include_once("config.php");
?>
<?php

    $email = $_GET['email'];
    $balance = $_GET['id'];
    $name = $_GET['name'];
    $no = $_GET['no'];
    $date = date("Y");

    $result5 = mysqli_query($conn, "SELECT entitlement FROM staffs WHERE staffno='$no' ");
    $result4 = mysqli_query($conn, "SELECT SUM(amount) AS totalamount FROM claim WHERE staffno='$no' AND YEAR(date)=YEAR(CURDATE())");
    $result3 = mysqli_query($conn, "SELECT * FROM claim WHERE staffno='$no' AND YEAR(date)=YEAR(CURDATE()) ORDER BY date"); 

    $to = $email;
    //Dear '.$name.', your medical entitle balance for year '.$date.' is RM'.$balance.'. Please contact HR for more details. TQ.
    $subject = 'Your Medical Entitlement Balance is Low!';

    $message = '
        <html>
            <body>
                <p>
                    Dear <b>'.$name.'</b>, 
                    <br> 
                    Your medical entitle balance for year <b>'.$date.'</b> is <b>RM'.number_format($balance, 2, '.', '').'</b>. 
                    <br> 
                    Please contact Human Resource department for further assistance. 
                    <br> 
                    Thank you.
                    <br>
                    <br>
                    Please refer to the list below for any inaccurate statement.  
                </p>
                <table border="1">
                <tr bgcolor="#dddddd" style="font-weight:bold">
                    <td align=center>No.</td>
                    <td align=center>Date</td>
                    <td align=center>Name</td>
                    <td align=center>Clinic</td>
                    <td align=center>Invoice No</td>
                    <td align=center>Amount (RM)</td>
                </tr>';
                $counter = 1;
                while($res = mysqli_fetch_array($result3))
                {
                    $tarikh=$res['date'];
                    $date=date('j/M/y', strtotime($tarikh));

                    $message .= "
                    <tr>
                        <td align='center'>$counter</td>
                        <td >$date</td>
                        <td >$res[famname]</td>
                        <td >$res[clinic]</td>
                        <td align='center'>$res[invoice]</td>
                        <td align='center'>$res[amount]</td>
                    <tr>
                    ";
                    $counter++;
                }
                while($res = mysqli_fetch_array($result4))
                {
                    $smallest = number_format($res['totalamount'], 2, '.', ''); 
                    $message .= "
                    <tr>
                        <td colspan='5' align='right'><b>Total Amount (RM)</b></td>
                        <td align='center'>$smallest</td>
                    </tr>
                    ";
                }
                while($res = mysqli_fetch_array($result5))
                {
                    $entitlement = number_format($res['entitlement'], 2, '.', ''); 
                    $balance = $entitlement - $smallest;

                    if($balance <= 100)
                    {
                        $bal = "<b style='color:red;'>".number_format($balance, 2, '.', '')."</b>";
                    }
                    else
                    {
                        $bal = number_format($balance, 2, '.', '');
                    }

                    $message .= "
                    <tr>
                        <td colspan='5' align='right'><b>Balance (RM)</b></td>
                        <td align='center'>$bal</td>
                    </tr>
                    ";
                } 
                    $message .= "
            </body>
        <html> ";

    $headers = "From: Human Resource of Selia Selenggara <admin@seliagroup.com>\r\n";

    $headers .= "Reply-To: admin@seliagroup.com\r\n";

    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);
    //echo "<script>window.location.href='staffsummary.php';</script>";
    echo "<script>alert('Email sent successfully to :-\\n$name\\n$email\\n$no'); window.location.href='staffsummary.php?id=';</script>";

?>