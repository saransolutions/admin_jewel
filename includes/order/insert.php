<?php
function add_new_form()
{ ?>
    <!-- Add New Modal -->
    <div class="modal fade" id="add_new_modal" tabindex="-1" role="dialog" aria-labelledby="add_new_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_new_modalLabel">Neues Projekt hinzufügen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>-
                <div class="modal-body" id="add_new_modal">
                    <div class=" row justify-content-center">
                        <div class="col-md-8 order-md-1">
                         <form method="post" action="projects.php">
                                <h4>Offerte</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_date">Von *</label>
                                        <input type="datetime-local"  min="<?php echo date("Y-m-d"); ?>" class="form-control" id="start_date" name="start_date" required="">
                                        <div class="invalid-feedback">Invalid Execution Date *</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="end_date">Bis *</label>
                                        <input type="datetime-local"  min="<?php echo date("Y-m-d"); ?>" class="form-control" id="end_date" name="end_date" required="">
                                        <div class="invalid-feedback">Invalid Execution Date *</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="type_of_service">Diensleitungen *</label>
                                        <select class="form-control" id="type_of_service" name="type_of_service"  required="">
                                            <option></option>
                                            <option>Häusern Reinigung</option>
                                            <option>Wohnung Reinigung</option>
                                            <option>Treppen Reinigung</option>
                                            <option>Buro Reinigung</option>
                                            <option>Fenster Reinigung</option>
                                            <option>Gastronomie reinigung</option>
                                            <option>Umzug</option>
                                            <option>Umzug bei Reinigung</option>
                                        </select>
                                        <div class="invalid-feedback">Invalid Type of Service *</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="building_type">Gebäude *</label>
                                        <select class="form-control" id="building_type" name="building_type"  required="">
                                            <option></option>
                                            <option>Häusern</option>
                                            <option>Wohnung</option>
                                            <option>Treppen</option>
                                            <option>Buro</option>
                                        </select>
                                        <div class="invalid-feedback">Invalid Building Type *</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="number_of_rooms">Zimmer *</label>
                                        <select class="form-control" id="number_of_rooms" name="number_of_rooms"  required="">
                                            <option></option>
                                            <option>1.5</option>
                                            <option>2</option>
                                            <option>2.5</option>
                                            <option>3</option>
                                            <option>3.5</option>
                                            <option>4</option>
                                            <option>4.5</option>
                                            <option>5</option>
                                            <option>5.5</option>
                                            <option>5.5 Mehr</option>
                                        </select>
                                        <div class="invalid-feedback">Invalid Number of Rooms *</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                    <label for="floors">Stock *</label>
                                    <select class="form-control" id="floor" name="floor"  required="">
                                            <option></option>
                                                <option>Erdgeschoss</option>
                                                <option>1.Stock</option>
                                                <option>2.Stock</option>
                                                <option>3.Stock</option>
                                                <option>4.Stock</option>
                                                <option>5.Stock</option>
                                                <option>Mehr 5</option>
                                        </select>
                                    
                                        <div class="invalid-feedback">Invalid Floor *</div>
                                    </div>
                                  
                                    <div class="col-md-4 mb-3"><label for="square_meters">Qudarat Meter*</label>
                                        <input type="text" class="form-control" id="square_meters" name="square_meters"  required="">
                                        <div class="invalid-feedback">Invalid Square meters *</div>
                                    </div>

                                    <div class="col-md-4 mb-3"><label for="is_elevator">is elevator *</label>
                                        <select class="form-control" id="is_elevator" name="is_elevator"  required="">
                                            <option>Nein</option>
                                            <option>Ja</option>
                                        </select>
                                        <div class="invalid-feedback">Invalid is elevator *</div>
                                    </div>
                                 
                                </div>


                                <h5>Kunden Info</h5>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="prefix">Präfix *</label>
                                        <select class="form-control" id="prefix" name="prefix"  required="">
                                            <option>Herr</option>
                                            <option>Frau</option>
                                        </select>
                                        <div class="invalid-feedback">Invalid Prefix *</div>
                                    </div>
                                    <div class="col-md-5 mb-3"><label for="first_name">Name *</label><input type="text" class="form-control" id="first_name" name="first_name"  required="">
                                        <div class="invalid-feedback">Invalid First Name *</div>
                                    </div>
                                    <div class="col-md-4 mb-3"><label for="last_name">Vorname *</label><input type="text" class="form-control" id="last_name" name="last_name"  required="">
                                        <div class="invalid-feedback">Invalid Last Name *</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3"><label for="address">Addresse *</label><input type="text" class="form-control" id="address" name="address"  required="">
                                        <div class="invalid-feedback">Invalid Address *</div>
                                    </div>
                                    <div class="col-md-6 mb-3"><label for="mobile">Handy*</label><input type="text" class="form-control" id="mobile" name="mobile"  required="">
                                        <div class="invalid-feedback">Invalid Mobile *</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3"><label for="ort">Ort *</label><input type="text" class="form-control" id="ort" name="ort"  required="">
                                        <div class="invalid-feedback">Invalid Ort *</div>
                                    </div>
                                    

                                    <div class="col-md-4 mb-3"><label for="pin_code">PLZ *</label><input type="text" class="form-control" id="pin_code" name="pin_code"  required="">
                                        <div class="invalid-feedback">Invalid Pin Code *</div>
                                    </div>
                                    <div class="col-md-4 mb-3"><label for="email">Email</label><input type="text" class="form-control" id="email" name="email" >
                                        <div class="invalid-feedback">Invalid Email</div>
                                    </div>
                                </div>
                                
                                <h5>Zahlungsinformationen</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3"><label for="total_price">Gesamtpreis *</label><input type="text" class="form-control" id="total_price" name="total_price"  required="">
                                        <div class="invalid-feedback">Invalid Total</div>
                                    </div>

                                    <div class="col-md-6 mb-3"><label for="advance_amount">Vorschuss-Betrag *</label><input type="text" class="form-control" id="advance_amount" name="advance_amount"  required="">
                                        <div class="invalid-feedback">Invalid Advance</div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="comments1">Bemerkungen 1</label>
                                    <textarea class="form-control" id="comments1" name="comments_1" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="comments1">Bemerkungen 2</label>
                                    <textarea class="form-control" id="comments2" name="comments_2" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="comments1">Bemerkungen 3</label>
                                    <textarea class="form-control" id="comments3" name="comments_3" rows="3"></textarea>
                                </div>
                                <button type="submit" name="add-new-project-form" class="btn btn-primary float-right">Senden </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schliessen</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Add New Modal -->

<?php }


function insert_project($data){

	$type_of_service = $data["type_of_service"];
	$building_type = $data["building_type"];
	$floor = $data["floor"];
    $number_of_rooms = $data["number_of_rooms"];
	$square_meters = $data["square_meters"];
	$is_elevator = $data["is_elevator"];
    
    $start_date = $data["start_date"];
    $end_date = $data["end_date"];

    $prefix = $data["prefix"];
    $first_name = $data["first_name"];
    $last_name = $data["last_name"];
    $address = $data["address"];
    $ort = $data["ort"];
    $pin_code = $data["pin_code"];
    $mobile = $data["mobile"];
    $email = $data["email"];

    $total_price = $data["total_price"];
    $advance_amount = $data["advance_amount"];
    $balance = ($total_price - $advance_amount);

    $comments_1 = $data["comments_1"];
    $comments_2 = $data["comments_2"];
    $comments_3 = $data["comments_3"];
    

    $sql="INSERT INTO ".DB_NAME.".projects
    (id, created_date, type_of_service, building_type, floor, number_of_rooms, square_meters, is_elevator, prefix, first_name, last_name, address, ort, pin_code, mobile, email, start_date_time, end_date_time, total_price, advance_amount, balance, comments_1, comments_2, comments_3)
    VALUES (Null, CURRENT_TIMESTAMP, '".$type_of_service."','".$building_type."','".$floor."','".$number_of_rooms."','".$square_meters."','".$is_elevator."', '".$prefix."' ,'".$first_name."','".$last_name."','".$address."','".$ort."','".$pin_code."','".$mobile."','".$email."', '".$start_date."', '".$end_date."', ".$total_price.",".$advance_amount.", ".$balance.", '".$comments_1."','".$comments_2."', '".$comments_3."' )";
    print($sql);
    executeSQL($sql);
    return getSingleValue("select max(id) from ".DB_NAME.".projects");
}


?>