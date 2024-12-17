<?php 

function get_main_table()
{
    $sql = "select * from " . DB_NAME . ".schemes ORDER BY id DESC";
    $part1 = '<table class="table table-bordered" cellspacing="0" width="100%" id="dataTable" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Total Terms</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Created Date</th>
        </tr>
    </thead>
    <tbody>
        ';
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $name = $result['name'];
        $terms = $result['total_terms'];
        $amount = $result['amount'];
        $status = $result['status'];
        $created_date = $result['created_date'];
        $data = $data . '<tr>
            <td class="w-auto p-1">
                <input type="checkbox" class="btn-check" name="id" value="' . $id . '" autocomplete="off">
            </td>
            <td><a href="schemes.php?id=' . $id . '">'. ucfirst($name) . '</a></td>
            <td>' . $terms . '</td>
            <td>' . $amount . '</td>
            <td>' . $status . '</td>
            <td>' . $created_date . '</td>
		</tr>';
    }
    $part3 = '
    </tbody>
</table>';
    return $part1 . $data . $part3;
}


function get_members_table($id)
{
    $sql = "select amount from " . DB_NAME . ".schemes where id = ".$id;
    $amount = getSingleValue($sql);
    $sql = "select * from " . DB_NAME . ".members where parent_id = ".$id." ORDER BY id DESC";
    $part1 = '<table class="table table-bordered" cellspacing="0" width="100%" id="dataTable" cellspacing="0">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Joined Date</th>
        </tr>
    </thead>
    <tbody>
        ';
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $customer_id = $result['customer_id'];
        $sql = "select * from " . DB_NAME . ".customers where id = ".$customer_id;
        $customers = getFetchArray($sql);
        $customer = $customers[0];
        
        $prefix = $customer['prefix'];
        $first_name = $customer['first_name'];
        $last_name = $customer['last_name'];
        $name = $first_name." ".$last_name;
        if ($prefix != null){
            $name = $prefix.". ".$name;
        }
        
        $status = $result['status'];
        $joined_date = $result['joined_date'];
        $data = $data . '<tr>
            <td class="w-auto p-1">
                <input type="checkbox" class="btn-check" name="id" value="' . $id . '" autocomplete="off">
            </td>
            <td><a href="customers.php?cid=' . $customer_id . '">'. ucfirst($name) . '</a></td>
            <td>' . $amount . '</td>
            <td>' . $status . '</td>
            <td>' . $joined_date . '</td>
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
        $email = $result["email"];

        $total_price = $result["total_price"];
        $advance_amount = $result["advance_amount"];
        $balance = $result["balance"];

        $comments_1 = $result["comments_1"];
        $comments_2 = $result["comments_2"];
        $comments_3 = $result["comments_3"];

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
    $sql = "select * from " . DB_NAME . ".projects where id=" . $id;
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
                    <p><span style="font-weight: normal; font-size: 10pt;">Auftrag Nr. #FE-00' . $id .' </span></p>
                    <p><span style="font-weight: normal; font-size: 10pt;">' . date('d-m-Y', strtotime($created_date)) .' </span></p>
                 
                    </div>
                </td>
                <td width="50%" style="text-align: right;">
                    <div>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['prefix'] . '. '.$result['first_name'].' '.$result['last_name'].'</span></p>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['address'].'</span></p>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['pin_code'].'  '.$result["ort"].' </span></p><br>
                        <p><span style="font-weight: normal; font-size: 12pt;">Tel-Nummer : '.$result["mobile"].' </span></p>
                        <p><span style="font-weight: normal; font-size: 12pt;">Mail-Id : '.$result["email"].' </span></p>
                    </div>
                </td>
            </tr>
           
          
        </table>
        ';
    }
    else {
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
                    <p><span style="font-weight: normal; font-size: 10pt;">Numéro de commande. #FE-00' . $id .' </span></p>
                    <p><span style="font-weight: normal; font-size: 10pt;">' . date('d-m-Y', strtotime($created_date)) .' </span></p>
                 
                    </div>
                </td>
                <td width="50%" style="text-align: right;">
                    <div>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['prefix'] . '. '.$result['first_name'].' '.$result['last_name'].'</span></p>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['address'].'</span></p>
                        <p><span style="font-weight: normal; font-size: 12pt;">' . $result['pin_code'].'  '.$result["ort"].' </span></p>
                    </div>
                </td>
            </tr>
           
          
        </table>
        ';
    }
    

        $name = $result['first_name'] . ' ' . $result['last_name'];
        $type_of_service = $result["type_of_service"];
        $building_type = $result["building_type"];
        $floor = $result["floor"];
        $number_of_rooms = $result["number_of_rooms"];
        $square_meters = $result["square_meters"];
        $is_elevator = $result["is_elevator"];
        $start_date = $result["start_date_time"];
        $end_date = $result["end_date_time"];

        $prefix = $result["prefix"];
        $first_name = $result["first_name"];
        $last_name = $result["last_name"];
        $address = $result["address"];
        $ort = $result["ort"];
        $pin_code = $result["pin_code"];
        $mobile = $result["mobile"];
        $email = $result["email"];

        $total_price = $result["total_price"];
        $advance_amount = $result["advance_amount"];
        $balance = $result["balance"];
        $title = "";
       
        if(strpos($type_of_service, "Reinigung" )!== false && $lang=='de'){
            $title = "Reinigung Auftragsbestätigung";
        }else {
            $title = "Nettoyage Confirmation de commande";
        }

        $part2 = '';
        
        $part2 .= '<h1>'.$title.'</h1>';
        if($lang=='de'){
        $part2 .= '<div style="text-align: left;font-size:12pt;margin-top: 3%;margin-bottom: 10%;">
        <p>Sehr geehrter '.$prefix.'.'.$name.'</p>
        <p>Vielen Dank für Ihr Auftrag. Gerne bestätigen Wir Ihnen folgendes Angebot.</p>
        </div>';
    }else{
        $prefix="Mr";
        if($prefix=='Frau'){
            $prefix="Madame";
        }
        $part2 .= 
        '<div style="text-align: left;font-size:12pt;margin-top: 3%;margin-bottom: 10%;">
        <p>Cher '.$prefix.'.'.$name.'</p>
        <p>Nous vous remercions de votre commande. Nous vous confirmons volontiers le devis suivant.</p>
        </div>';
    } 
    
        if($lang=='de'){
        $description = '<table width="100%" style="font-size: 9pt; border-collapse: collapse; margin-top:5%;margin-bottom:1%;" cellpadding="15">
            <tr>
                <td width="80%" style="text-align: left;font-size:12pt;">
                    '.$number_of_rooms.' Zimmer-'.$building_type.' '.$square_meters.' m2Inkl.'.'
                    <br>
                    Abgabegarantie Inkl. 8.1% Mwst Pauschal
                </td>
                <td width="20%" style="text-align: right;font-size:12pt;">'.$total_price.' CHF</td>
            </tr>
        </table>
        <hr>';
    }else {   
        $building_type="Appartement";
        if($building_type=='Haus'){ 
            $building_type=="Maison";
        }
        $description = '<table width="100%" style="font-size: 9pt; border-collapse: collapse; margin-top:5%;margin-bottom:1%;" cellpadding="15">
        <tr>
            <td width="80%" style="text-align: left;font-size:12pt;">
                '.$number_of_rooms.' Le Zimmer-'.$building_type.' '.$square_meters.' m2Inkl.'.'
                <br>
                Garantie de remise Incl. 8.1% Mwst Pauschal
            </td>
            <td width="20%" style="text-align: right;font-size:12pt;">'.$total_price.' CHF</td>
        </tr>
    </table>
    <hr>';
        
    }
        $part2 .= $description;

        if($lang=='de') { 
        $termin = '<table width="100%" style="font-size: 11pt; border-collapse: collapse; margin-top:3%;margin-bottom:3%;" cellpadding="15">
            <tr>
                <td width="30%" style="text-align: left;font-size:12pt;">
                    Reinigungstermin: 
                </td>
                <td width="70%" style="text-align: left;font-size:12pt;">
                    '.date('d-m-Y', strtotime($start_date)).'
                </td>
            </tr>
            <tr>
                <td width="30%" style="text-align: left;font-size:12pt;">
                    Begin bei Kunde  
                </td>
                <td width="70%" style="text-align: left;font-size:12pt;">
                    '.date('H:i', strtotime($start_date)).'
                </td>
            </tr>
            <tr>
                <td width="30%" style="text-align: left;font-size:12pt;">
                    Reinigung Abgabe:
                </td>
                <td width="70%" style="text-align: left;font-size:12pt;">
                    '.date('d-m-Y', strtotime($end_date)).' '.date('H:i', strtotime($end_date)).'
                </td>
            </tr>
            <tr>
                <td width="30%" style="text-align: left;font-size:12pt;">
                    Zahlungskondition
                </td>
                <td width="70%" style="text-align: left;font-size:12pt;">
                    Barzahlung nach Abgabetermin an den Teamchef
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left;font-size:12pt;">
                    <i>Bei Fragen Unklarheiten stehen Wir Ihnen gerne zur Verfügung</i>.
                </td>
            </tr>
        </table>
        '; 
    }else {
            $termin = '<table width="100%" style="font-size: 11pt; border-collapse: collapse; margin-top:3%;margin-bottom:3%;" cellpadding="15">
            <tr>
                <td width="30%" style="text-align: left;font-size:12pt;">
                Date de nettoyage: 
                </td>
                <td width="70%" style="text-align: left;font-size:12pt;">
                    '.date('d-m-Y', strtotime($start_date)).'
                </td>
            </tr>
            <tr>
                <td width="30%" style="text-align: left;font-size:12pt;">
                Début chez le client  
                </td>
                <td width="70%" style="text-align: left;font-size:12pt;">
                    '.date('h:i A', strtotime($start_date)).'
                </td>
            </tr>
            <tr>
                <td width="30%" style="text-align: left;font-size:12pt;">
                Nettoyage Remise:
                </td>
                <td width="70%" style="text-align: left;font-size:12pt;">
                    '.date('l F j, Y', strtotime($end_date)).' '.date('h:i A', strtotime($end_date)).'
                </td>
            </tr>
            <tr>
                <td width="30%" style="text-align: left;font-size:12pt;">
                Condition de paiement
                </td>
                <td width="70%" style="text-align: left;font-size:12pt;">
                Paiement en espèces après la date de remise au chef des équipes
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left;font-size:12pt;">
                    <i>Nous sommes à votre disposition pour répondre à vos questions.</i>.
                </td>
            </tr>
        </table>
        ';
    }

        $part2 .= $termin;
if ($lang=='de') {
    $part2 .= '
    <table width="100%" style="font-size: 11pt; border-collapse: collapse; margin-top:3%;margin-bottom:3%;" cellpadding="15">
 <tr>
        <td width="30%" style="text-align: left;font-size:12pt;">
        Datum,Kunden Unterschrift :<br><br> ________________________________
        
        </td>
        <td width="70%" style="text-align: right;font-size:12pt;">
        Freundliche Grüsse<br>'.MAIN_TITLE.'
        </td>
    </tr>
   
</table>';
}else {
    $part2 .= '
    <table width="100%" style="font-size: 11pt; border-collapse: collapse; margin-top:3%;margin-bottom:3%;" cellpadding="15">
 <tr>
        <td width="30%" style="text-align: left;font-size:12pt;">
        Dates,Enseignement :<br><br> ________________________________
        
        </td>
        <td width="70%" style="text-align: right;font-size:12pt;">
        Cordialement, merci<br>'.MAIN_TITLE.'
        </td>
    </tr>
   
</table>
    ';
    
}
        if($balance == 0) {
            $part2 .= '<div style="text-align: center; font-style: italic;">Payment fully paid</div>';
        } else {
            $part2 .= generate_bill($id, $name, $address, $balance);
        }
        
        $part2 .= '</body></html>';
        return $part1 . $data . $part2;
    }

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

function get_single($id, $module, $page_title, $page_php){
    $sql = "select * from " . DB_NAME . ".schemes where id = ".$id;
    $part1 = '<table class="table">
    <thead colspan="2" style="font"><strong style>'.$page_title.' Details</strong></thead>
        <tbody>
        ';
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $name = $result['name'];
        $amount = $result['amount'];
        $status = $result['status'];

        $data .= '<tr><td>Id</td><td>'.$id.'</td></tr>';
        $data .= '<tr><td>Namefix</td><td>'.$name.'</td></tr>';
        $data .= '<tr><td>Amount</td><td>'.$amount.'</td></tr>';
        $data .= '<tr><td>Status</td><td>'.$status.'</td></tr>';
    }

    $part3 = '
    </tbody>
</table>';
    $part4 = '<div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="text-right">
                <button type="button" class="btn btn-success btn-sm"
                    name="add_new" data-toggle="modal"
                    data-target="#add_new_modal">Add New Member
                </button>
                <button type="button" class="btn btn-danger btn-sm" name="remove" id="remove_button" data-toggle="modal" data-target="#remove_modal">Löschung</button>
                <button type="button" class="btn btn-secondary btn-sm" name="pay" id="pay_button" data-toggle="modal" data-target="#pay_modal">Pay</button>
                <button type="button" class="btn btn-primary btn-sm" name="pay" id="pay_button" data-toggle="modal" data-target="#pay_modal">Mark Winner</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                '.get_members_table($id).'
            </div>
        </div>
    </div>';
    return $part1 . $data . $part3.$part4;
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