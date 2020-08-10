<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
<?php
    include '../conn.php';
    $uid = $_REQUEST['uid'];

    require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payslip: ');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(true);
    $pdf->SetAutoPageBreak(TRUE, 10);
    
    $pdf->AddPage();
    $contents = '';
    $date = date('m/d/Y h:i:s a', time());

    $sql = "SELECT * FROM order_item LEFT JOIN users ON order_item.buyer_id = users.id WHERE order_no ='$uid' ";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

        $contents .= '
                <br>
                <h1>Daily Agri Farm</h1><br>
                <h2 style="text-align: center">Receipt of Purchase</h2>
                <br>
                <table width="100%" border="0">
                    <tr>
                        <td style="float: left;">
                            <address>
                                <strong>'.$row['firstname'].'  '.$row['lastname'].'</strong>
                                <br>
                                '.$row['address'].'
                                <br>
                                Zipcode: '.$row['zipcode'].', '.$row['state'].'
                                <br>
                                '.$row['country'].'
                                <br>
                                Tel: '.$row['phone'].'
                            </address>
                        </td>
                        <td style="float: right; text-align: right">
                            <em>Date: '.$row['order_date'].'</em>
                            <br>
                            <em>Receipt #: '.$row['order_no'].'</em>
                        </td>

                    </tr>
                </table>
                <br><br>

                <table width="100%" border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th><h2>Product Name </h2></th>
                            <th></th>
                            <th></th>
                            <th><h2>Qty</h2></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><h4><em>'.$row['product'].'</em></h4></td>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-center"> '.$row['qty'].' </td>   
                        </tr>
                        
                        <tr>
                            <td>   </td>
                                <td>   </td>
                            <td class="text-right">
                                <p>
                                    <strong>Subtotal: </strong>
                                </p>
                                <p>
                                    <strong>Total Qty: </strong>
                                </p>
                            </td>
                            <td class="text-center">
                                <p>
                                    <strong>'.$row['priceperkg'].' TK</strong>
                                </p>
                                <p>
                                    <strong>x '.$row['qty'].'</strong>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Total Price: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>'.$row['totalprice'].' TK</strong></h4></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>
        ';
    
    $pdf->writeHTML($contents); 
    ob_end_clean();
    $pdf->Output('receipt.pdf', 'I');

?>