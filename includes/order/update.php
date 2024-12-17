<?php 


function get_pay_form($id)
{
    $sql = "select o.*, c.first_name, c.last_name, c.mobile, c.email from " . DB_NAME . ".orders o, customers c where c.id = o.customer_id and o.id = " . $id;
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $data = '
    <!-- add new Project -->
    <div class="row justify-content-center">
    <div class="col-md-8 order-md-1">
        <form method="post" action="projects.php">
            <h4 class="mb-3">Project Details</h4>
            <input type="hidden" name="pay_project_id" value="'.$id.'"></input>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name">First Name *</label>
                    <input type="text" class="form-control" readonly id="first_name" name="first_name" placeholder="" value="'.$result['first_name'].'">
                    <div class="invalid-feedback">Invalid First Name *</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name">Last Name *</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" value="'.$result['last_name'].'" readonly>
                    <div class="invalid-feedback">Invalid Last Name *</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="mobile">Mobile *</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="" value="'.$result["mobile"].'" readonly>
                    <div class="invalid-feedback">Invalid Mobile *</div>
                </div>
                <div class="col-md-6 mb-3"><label for="email">Email</label><input type="text" class="form-control" id="email" name="email" placeholder="" value="'.$result["email"].'" readonly>
                    <div class="invalid-feedback">Invalid Email</div>
                </div>
            </div>
            <h4 class="mb-3">Payment Details</h4>
            <div class="row">
                <div class="col-md-6 mb-3"><label for="total_price">Total Price *</label><input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="" value="'.$result["total_amount"].'" readonly>
                    <div class="invalid-feedback">Invalid Total price *</div>
                </div>
                <div class="col-md-6 mb-3"><label for="advance">Paid amount *</label><input type="text" class="form-control" id="advance" name="advance" placeholder="" value="'.($result["total_amount"] - $result["balance"]).'" readonly>
                    <div class="invalid-feedback">Invalid Advance amount *</div>
                </div>
                <div class="col-md-6 mb-3"><label for="balance">Balance *</label><input type="text" class="form-control" id="balance" name="balance" placeholder="" value="'.$result["balance"].'" readonly>
                    <div class="invalid-feedback">Invalid Balance *</div>
                </div>

                <div class="col-md-6 mb-3"><label for="pay_now">Pay now</label><input type="text" class="form-control" id="pay_now" name="pay_now" required="">
                    <div class="invalid-feedback">Invalid Pay now</div>
                </div>
            </div>
            <button type="submit" name="pay_project_form" class="btn btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
    <!-- add new Project end -->
    ';
    }

    return $data;
}


function pay_project($data){
    $pay_now = $data["pay_now"];
    $pay_project_id = $data["pay_project_id"];
    $balance = $data["balance"];
    $new_balance = ($balance - $pay_now);
    
    $sql="UPDATE ".DB_NAME.".projects SET balance='".$new_balance."' WHERE id = ".$pay_project_id;
    print($sql);
    executeSQL($sql);
    return $pay_project_id;
}

?>