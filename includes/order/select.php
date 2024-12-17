<?php 

function get_main_table()
{
    $sql = "select o.*, p.id product_id, p.product_type_id, c.id customer_id, c.first_name, c.last_name from " . DB_NAME . ".orders o, products p, customers c where o.product_id = p.id and o.customer_id = c.id ORDER BY o.id DESC";
    $part1 = '<table class="table table-bordered" cellspacing="0" width="100%" id="dataTable" cellspacing="0">
    <thead>
        <tr>
            <th class="w-auto p-1">S.No</th>
            <th>Id</th>
            <th>Product</th>
            <th>Customer</th>
            <th>Total Amount</th>
            <th>Mobile</th>
            <th>Delivery</th>
            <th>Payment</th>
            <th>Created Date</th>
        </tr>
    </thead>
    <tbody>';
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $product_sql = "
select 
	concat(metal_type, ' > ', product_type, ' > ', weight_in_grams)product 
from (
	select 
    	p.metal_type,
    	(select name from product_types where id=p.product_type_id)product_type,
    	p.weight_in_grams
    from products p where p.id = ".$result['product_id'].")t";
        $product = getSingleValue($product_sql);
        $customer_sql = "select prefix, first_name, last_name, mobile from customers c where id = ".$result["customer_id"];
        $crow=getFetchArray($customer_sql)[0];
        $cname = null;
        $cmobile = "";
        $first_name = $crow["first_name"];
        $last_name = $crow["last_name"];
        $prefix = $crow["prefix"];
        if ($prefix != null){$cname = $prefix.". ".$first_name." ".$last_name;}else{$cname = $first_name." ".$last_name;}
        $mobile = $crow["mobile"];
        if ($mobile != null){$cmobile = $mobile;}
        $product = getSingleValue($product_sql);
        $total_amount = $result['total_amount'];
        $delivery_status = $result['delivery_status'];
        $payment_status = $result['payment_status'];
        $created_date = $result['created_date'];

        $data = $data . '<tr>
            <td class="w-auto p-1"><input type="checkbox" class="btn-check" name="id" value="' . $id . '" autocomplete="off"></td>
			<td><a href="orders.php?id=' . $result['id'] . '">'.$result['id'].'</a></td>
            <td><a href="products.php?pid=' . $result['product_id'] . '">'.$product.'</a></td>
            <td><a href="customers.php?cid=' . $result['customer_id'] . '">' . $cname . '</a></td>
            <td>' . $total_amount . '</td>
            <td>' . $cmobile . '</td>
            <td>' . $delivery_status . '</td>
            <td>' . $payment_status . '</td>
            <td>' . $created_date . '</td>
		</tr>';
    }
    $part3 = '
    </tbody>
</table>';
    return $part1 . $data . $part3;
}

function export($id)
{
    $sql = "select * from " . DB_NAME . ".projects where id=" . $id;
    $rows = getFetchArray($sql);
    $data = '';
    if (count($rows) > 0) {
        $result = $rows[0];
        $delivery_date = $result["start_date_time"];
        if ($delivery_date == null) {
            return null;
        }
        $part1 = pdf_head() . '
        <body>
        ' . pdf_block($id) . '
        <div style="text-align: right">Date: ' . date('F j, Y', strtotime($delivery_date)) . '</div>
        <br />
        <table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">';

        $id = $result['id'];
        $name = $result['first_name'] . ' ' . $result['last_name'];
        $type_of_service = $result["type_of_service"];
        $building_type = $result["building_type"];
        $floor = $result["floor"];
        $number_of_rooms = $result["number_of_rooms"];
        $square_meters = $result["square_meters"];
        $is_elevator = $result["is_elevator"];
        $execution_date = $result["start_date_time"];

        $address = $result["address"];
        $ort = $result["ort"];
        $pin_code = $result["pin_code"];
        $mobile = $result["mobile"];
        

        $data .= pdf_table_tr_th_td_span("<h3>Personal Details</h3>");
        
        $data .= pdf_table_tr_th_td("Name", $name);
        $data .= pdf_table_tr_th_td("Address", $address);
        $data .= pdf_table_tr_th_td("Ort", $ort);
        $data .= pdf_table_tr_th_td("Pin Code", $pin_code);
        $data .= pdf_table_tr_th_td("Mobile", $mobile);
        $data .= pdf_table_tr_th_td("E-Mail", $email);

        $data .= pdf_table_tr_th_td_span("<h3>Project Details</h3>");
        $data .= pdf_table_tr_th_td("Type of Service", $type_of_service);
        $data .= pdf_table_tr_th_td("Square meters", $square_meters);
        $data .= pdf_table_tr_th_td("Building Type", $building_type);
        $data .= pdf_table_tr_th_td("Floor", $floor);
        
        $data .= pdf_table_tr_th_td("Number of rooms ", $number_of_rooms);
        $data .= pdf_table_tr_th_td("is Elevator ", $is_elevator);
        $data .= pdf_table_tr_th_td("Execution Date ", $execution_date);

        $data .= pdf_table_tr_th_td_span("<h3>Payment Details</h3>");

        $data .= pdf_table_tr_th_td("Total price ", $total_price);
        $data .= pdf_table_tr_th_td("Advance amount ", $advance_amount);
        $data .= pdf_table_tr_th_td("balance ", $balance);

        $data .= pdf_table_tr_th_td_span("<h3>Extra Details</h3>");
        $data .= pdf_table_tr_th_td("Comments 1 ", $comments_1);
        $data .= pdf_table_tr_th_td("Comments 2 ", $comments_2);
        $data .= pdf_table_tr_th_td("Comments 3 ", $comments_3);
        
        $part2 = '</tbody>
        </table>';
        $part2 .= '</body></html>';
        $content = $part1 . $data . $part2;
        echo $content;
        
        // // Create an instance of the class:
        // $mpdf = new \Mpdf\Mpdf([
        //     'margin_left' => 20,
        //     'margin_right' => 15,
        //     'margin_top' => 48,
        //     'margin_bottom' => 25,
        //     'margin_header' => 10,
        //     'margin_footer' => 10
        // ]);

        // $mpdf->SetProtection(array('print'));
        // $mpdf->SetAuthor(MAIN_TITLE);
        // $mpdf->showWatermarkText = true;
        // $mpdf->watermark_font = 'DejaVuSansCondensed';
        // $mpdf->watermarkTextAlpha = 0.1;
        // $mpdf->SetDisplayMode('fullpage');
        // $mpdf->WriteHTML($content);
        // $file_name = 'FE-00' . $id . '_' . str_replace(' ', '_', $name) . '.pdf';
        // $mpdf->Output($file_name, "I");
    }
}

function letter_pad($id)
{
    return pdf_head().'<body>'.pdf_block($id).'</body>';
}

function invoice($id,$lang)
{
    $row_count = 1;
    $sql = "select o.*, p.metal_type, p.purity, p.weight_in_grams, (select name from product_types where id = p.product_type_id)product_type, p.product_type_id, c.prefix, c.first_name, c.last_name, c.address, c.ort, c.pin_code, c.mobile from " . DB_NAME . ".orders o, products p, customers c where o.product_id = p.id and o.customer_id = c.id and o.id=" . $id;
    $rows = getFetchArray($sql);
    $data = '';
    if (count($rows) > 0) {
        $result = $rows[0];
        $created_date = $result["created_date"];
        if ($created_date == null) {
            return null;
        }
        $id = $result['id'];
        if ($lang=='de') {
        $part1 = pdf_head() . '
        <body>
        ' . pdf_block($id) . '
        <table width="100%" style="font-size: 9pt; border-collapse: collapse; margin-top:5%;margin-bottom:5%;" cellpadding="8">
            <tr class="blank_row">
                <td colspan="2"></td>
            </tr>
            <tr>
                <td width="50%" style="text-align: left;">
                    <div>
                    <p><span style="font-weight: normal; font-size: 10pt;">Auftrag Nr. #SJ-00' . $id .' </span></p>
                    <p><span style="font-weight: normal; font-size: 10pt;">' . date('d-m-Y', strtotime($created_date)) .' </span></p>
                 
                    </div>
                </td>
                <td width="50%" style="text-align: right;">
                    <div>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['prefix'] . '. '.$result['first_name'].' '.$result['last_name'].'</span></p>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['address'].'</span></p>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['pin_code'].'  '.$result["ort"].' </span></p><br>
                        <p><span style="font-weight: normal; font-size: 12pt;">Tel-Nummer : '.$result["mobile"].' </span></p>
                        
                    </div>
                </td>
            </tr>
           
          
        </table>
        ';
    }

        $name = $result['first_name'] . ' ' . $result['last_name'];
        $product_type = $result["product_type"];
        
        $prefix = $result["prefix"];
        $address = $result["address"];
        $ort = $result["ort"];
        $pin_code = $result["pin_code"];
        $mobile = $result["mobile"];

        $total_amount = $result["total_amount"];
        

    
        $title = "";
       
        if($lang=='de'){
           $title = "Art des Produkts : ".$product_type;
        }

        $part2 = '';
        
        $part2 .= '<h1>'.$title.'</h1>';
        if($lang=='de'){
            $part2 .= '<div style="text-align: left;font-size:12pt;margin-top: 3%;margin-bottom: 10%;">
            <p>Sehr geehrter '.$prefix.'.'.$name.'</p>
            <p>Vielen Dank für Ihr Auftrag. Gerne bestätigen Wir Ihnen folgendes Angebot.</p>
            </div>';
        }
    
        if($lang=='de'){
        $description = '<table width="100%" style="font-size: 9pt; border-collapse: collapse; margin-top:5%;margin-bottom:1%;" cellpadding="15">
            <tr>
                <td width="80%" style="text-align: left;font-size:12pt;">

                    <br>
                    Abgabegarantie Inkl. 8.1% Mwst Pauschal
                </td>
                <td width="20%" style="text-align: right;font-size:12pt;">'.$total_amount.' CHF</td>
            </tr>
        </table>
        <hr>';
    }
        $part2 .= $description;
        
}
        
        $part2 .= '</body></html>';
        return $part1 . $data . $part2;
    }


function get_status($total_price, $advance_amount, $balance){
    $status = '<span class="badge badge-warning">Requested</span>';
    if ($total_price > 0 && $advance_amount > 0){
        if ($balance == 0){
            $status = '<span class="badge badge-success">Paid</span>';
        }else{
            $status = '<span class="badge badge-danger">Unpaid</span>';
        }
    }
    return $status;
}

function get_single_project($id){
    $sql = "select * from " . DB_NAME . ".orders where id = ".$id;
    $part1 = '<table class="table">
    <thead colspan="2" style="font"><strong style>Order Details</strong></thead>
        <tbody>
        ';
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $product_id = $result['product_id'];
        $customer_id = $result['customer_id'];

        $data .= '<tr><td>Id</td><td>'.$id.'</td></tr>';
        $data .= '<tr><td>Product Id</td><td>'.$product_id.'</td></tr>';
        $data .= '<tr><td>Customer Id</td><td>'.$customer_id.'</td></tr>';
        
    }
    $part3 = '
    </tbody>
</table>';
    return $part1 . $data . $part3;
}

function generate_bill($id, $name, $address, $balance)
{
    return
        '   <br>

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; margin-top:5%;margin-bottom:5%;" cellpadding="8"><tbody>
    <tr>
        <td width="30%">
            <h2>Empfangsschein</h2>
            <br>
            <h4>Konto / Zahlbar an</h4>
            <h5>'.MAIN_ACCOUNT_NUMBER.'</h5>
            <p>'.MAIN_TITLE.'</p>
            <p>'.HEAD_ADDRESS_LINE_1.'</p>
            <p>'.HEAD_ADDRESS_LINE_2.'</p>
            <br>
            <p>Referencez</p>
            <p>FE-00' . $id . '</p>
            <br>
            Zahlbar durch<br>
            ' . $name . '
            <br>
            ' . $address . '
            <br>
            <br>
            <h4>CHF ' . $balance . '</h4>
        </td>
        <td width="35%" style="border:0">
            <h2>Zahlteil</h2>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>    
            <h4>Währung CHF </h4>
            <h4>Betrag ' . $balance . '</h4>
            <br>
        </td>
        <td width="35%" style="border:0">
            <h4>Konto / Zahlbar an</h4>
            <h5>'.MAIN_ACCOUNT_NUMBER.'</h5>
            <p>'.MAIN_TITLE.'</p>
            <p>'.HEAD_ADDRESS_LINE_1.'</p>
            <p>'.HEAD_ADDRESS_LINE_2.'</p>
            <br>
            Zusätzliche Informationen
            <br>
            Rechnungskonto: FE-00' . $id . ' <br>
            Monat: <br>
            Zahlbar bis:  <br>
            
            <br>
            <p>Referencez</p>
            <p>FE-00' . $id . '</p>
            <br>
            Zahlbar durch<br>
            ' . $name . '
            <br>
            ' . $address . '
            <br>
        </td>
        </tr>
    </tbody>
   
</table><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<table width="100%" style="font-size: 11pt; border-collapse: collapse; margin-top:3%;margin-bottom:3%;" cellpadding="15">
<tr>
       <td width="30%" style="text-align: left;font-size:12pt;">
       Ort,Datum:<br><br> ________________________________<br><br><br><br>
       
       
       </td>
       <td width="70%" style="text-align: right;font-size:12pt;">
      
       
       </td>
   </tr>
   <tr>
       <td width="30%" style="text-align: left;font-size:12pt;">
       Unterschrift Kunden<br><br> ________________________________
       
       
       </td>
       <td width="70%" style="text-align: right;font-size:12pt;">
       Unterschrift Teamchef<br><br> ________________________________
       </td>
   </tr>
</table>';
}

function reports_form()
{ ?>
    <!-- Add New Modal -->
    <div class="modal fade" id="reports_form_modal" tabindex="-1" role="dialog" aria-labelledby="reports_form_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reports_form_modalLabel">Reports</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="reports_modal">
                    <div class=" row justify-content-center">
                        <div class="col-md-8 order-md-1">
                            <form method="post" action="projects.php">
                                <span class="badge badge-pill badge-primary">Yearly Report</span>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <l6abel for="report_month">Select Year *</l6abel>
                                        <input type="number" class="form-control" id="report_year" name="report_year" required="" placeholder="select year" min="2024" max="2030">
                                        <div class="invalid-feedback">Invalid Year *</div>
                                    </div>
                                </div>
                                <span class="badge badge-pill badge-success">Monthly Report</span>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="report_month">Select Month *</label>
                                        <input type="month" class="form-control" id="report_month" name="report_month" required="">
                                        <div class="invalid-feedback">Invalid Execution Date *</div>
                                    </div>
                                </div>
                                <span class="badge badge-pill badge-danger">Daily Report</span>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="report_date">Select Date *</label>
                                        <input type="date" class="form-control" id="report_date" name="report_date" required="">
                                        <div class="invalid-feedback">Invalid Execution Date *</div>
                                        <button type="submit" name="run_report" class="btn btn-primary float-right">Submit</button>
                                    </div>
                                </div>
                                <button type="submit" name="run_report" class="btn btn-primary float-right">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Add New Modal -->

<?php }


?>