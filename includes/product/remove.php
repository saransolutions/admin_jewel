<?php 

function get_remove_form($id){
    $sql = "select * from " . DB_NAME . ".products where id = " . $id;
    $data = '';
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
        $data = '
    <!-- remove product -->
    <div class="row justify-content-center">
    <div class="col-md-8 order-md-1">
        <form method="post" action="products.php">
            <h4 class="mb-3">Product Details</h4>
            <input type="hidden" name="remove_product_id" value="' . $id . '"></input>
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
                <div class="col-md-6 mb-3"><label for="total_price">Total Price *</label><input type="text" class="form-control" id="total_price" name="total_price" placeholder="" value="'.$result["total_price"].'" readonly>
                    <div class="invalid-feedback">Invalid Total price *</div>
                </div>

                <div class="col-md-6 mb-3"><label for="balance">Balance</label><input type="text" class="form-control" id="balance" name="balance" placeholder="" value="'.$result["balance"].'" readonly>
                    <div class="invalid-feedback">Invalid Balance</div>
                </div>
            </div>
            <button type="submit" name="remove-project-form" class="btn btn-danger btn-sm float-right">Remove Product</button>
            </form>
        </div>
    </div>
    <!-- add new Project end -->
    ';
    }
    return $data;
}

function single_view($data){

}

function remove_project($data){
    $remove_project_id = $data["remove_project_id"];
    $sql="DELETE FROM ".DB_NAME.".projects WHERE id = ".$remove_project_id;
    executeSQL($sql);
}

?>