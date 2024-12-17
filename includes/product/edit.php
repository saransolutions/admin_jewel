<?php


function edit_form($id)
{
    $sql = "select * from " . DB_NAME . ".projects where id = " . $id;
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
?>
        <!-- add new Project -->
        <div class="row justify-content-center">
            <div class="col-md-8 order-md-1">
                <form method="post" action="projects.php">
                    <h4 class="mb-3">Project Details</h4>
                    <input type="hidden" name="edit_project_id" value="<?php echo $result["id"]; ?>"></input>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name">First Name *</label>
                            <input type="text" class="form-control" required="" id="first_name" name="first_name" placeholder="" value="<?php echo $result["first_name"]; ?>">
                            <div class="invalid-feedback">Invalid First Name *</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name">Last Name *</label>
                            <input type="text" class="form-control" id="last_name" required="" name="last_name" placeholder="" value="<?php echo $result["last_name"]; ?>" required="">
                            <div class="invalid-feedback">Invalid Last Name *</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date">Von *</label>
                            <input type="datetime-local" min="<?php echo date("Y-m-d"); ?>" class="form-control" id="start_date" name="start_date" required="" value="<?php echo $result["start_date_time"]; ?>">
                            <div class="invalid-feedback">Invalid Execution Date *</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date">Bis *</label>
                            <input type="datetime-local" min="<?php echo date("Y-m-d"); ?>" class="form-control" id="end_date" name="end_date" required="" value="<?php echo $result["end_date_time"]; ?>">
                            <div class="invalid-feedback">Invalid Execution Date *</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mobile">Mobile *</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="" value="<?php echo $result["mobile"]; ?>" required="">
                            <div class="invalid-feedback">Invalid Mobile *</div>
                        </div>
                        <div class="col-md-6 mb-3"><label for="email">Email</label><input type="text" class="form-control" id="email" name="email" placeholder="" value="<?php echo $result["email"]; ?>" required="">
                            <div class="invalid-feedback">Invalid Email</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3"><label for="square_meters">Qudarat Meter*</label>
                            <input type="text" class="form-control" id="square_meters" name="square_meters" value="<?php echo $result["square_meters"]; ?>" required="">
                            <div class="invalid-feedback">Invalid Square meters *</div>
                        </div>
                        <div class="col-md-4 mb-3"><label for="address">Addresse *</label><input type="text" class="form-control" id="address" name="address" required="" value="<?php echo $result["address"]; ?>">
                            <div class="invalid-feedback">Invalid Address *</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3"><label for="ort">Ort *</label><input type="text" class="form-control" id="ort" name="ort" required="" value="<?php echo $result["ort"]; ?>">
                            <div class="invalid-feedback">Invalid Ort *</div>
                        </div>
                        <div class="col-md-4 mb-3"><label for="pin_code">PLZ *</label><input type="text" class="form-control" id="pin_code" name="pin_code" required="" value="<?php echo $result["pin_code"]; ?>">
                            <div class="invalid-feedback">Invalid Pin Code *</div>
                        </div>
                    </div>
                    <h4 class="mb-3">Payment Details</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label for="total_price">Total Price *</label><input type="text" class="form-control" id="total_price" name="total_price" placeholder="" value="<?php echo $result["total_price"]; ?>" required="">
                            <div class="invalid-feedback">Invalid Total price *</div>
                        </div>

                        <div class="col-md-6 mb-3"><label for="advance">Paid amount *</label><input type="text" class="form-control" id="advance" name="advance" placeholder="" value="<?php echo $result["advance_amount"]; ?>" required="">
                            <div class="invalid-feedback">Invalid Advance amount *</div>
                        </div>

                        <div class="col-md-6 mb-3"><label for="balance">Balance *</label><input type="text" class="form-control" id="balance" name="balance" placeholder="" value="<?php echo $result["balance"]; ?>" required="">
                            <div class="invalid-feedback">Invalid Balance *</div>
                        </div>
                    </div>
                    <button type="submit" name="update_project" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
        <!-- add new Project end -->
<?php
    }
}


function edit_project($data)
{
    
    $edit_project_id = $data["edit_project_id"];
    $balance = $data["balance"];
    $total_price = $data["total_price"];
    $advance_amount = $data["advance"];
    $first_name = $data["first_name"];
    $last_name = $data["last_name"];
    $start_date = $data["start_date"];
    $end_date = $data["end_date"];
    $square_meters = $data["square_meters"];

    $mobile = $data["mobile"];
    $email = $data["email"];

    $address = $data["address"];
    $ort = $data["ort"];
    $pin_code = $data["pin_code"];
    
    
    

    $sql = "UPDATE " . DB_NAME . ".projects SET balance='" . $balance . "', total_price='".$total_price."', advance_amount='".$advance_amount."', first_name='".$first_name."', last_name='".$last_name."', start_date_time='".$start_date."', end_date_time='".$end_date."', mobile='".$mobile."', email='".$email."', square_meters='".$square_meters."', address='".$address."', ort='".$ort."', pin_code='".$pin_code."' WHERE id = " . $edit_project_id;
    executeSQL($sql);
    return $edit_project_id;
}
