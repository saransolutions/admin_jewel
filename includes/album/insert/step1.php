<?php


function add_photo_form($id)
{
    $sql = "select * from " . DB_NAME . ".products where id = " . $id;
    $rows = getFetchArray($sql);
    foreach ($rows as $result) {
        $id = $result['id'];
?>
        <!-- add new Project -->
        <div class="row justify-content-center">
            <div class="col-md-8 order-md-1">
                <form method="post" action="products.php" enctype="multipart/form-data">
                    <h4 class="mb-3">Project Details</h4>
                    <input type="hidden" name="parent_id" value="<?php echo $result["id"]; ?>"></input>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name">Product Type *</label>
                            <input type="text" class="form-control" readonly id="first_name" name="first_name" placeholder="" value="<?php echo $result["product_type"]; ?>">
                            <div class="invalid-feedback">Invalid First Name *</div>
                        </div>
                         <div class="col-md-6 mb-3">
                            <label for="last_name">Metal Type *</label>
                            <input type="text" class="form-control" id="last_name" readonly name="last_name" placeholder="" value="<?php echo $result["metal_type"]; ?>" required="">
                            <div class="invalid-feedback">Invalid Last Name *</div>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-3">
                            <label for="photo_file">Add your photo</label>
                            <input type="file" class="form-control-file" id="photo1" name="photo1" accept=".jpg, .jpeg, .png" >
                        </div>
                      
                    </div>
                    
                    <button type="submit" name="add_photo_project" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
        <!-- add new Project end -->
<?php
    }
}


function add_photo_project($data, $file_name)
{
    
    $parent_id = $data["parent_id"];

    $sql = "INSERT INTO ".DB_NAME.".album (id, added_date, parent_id, path) 
    VALUES (NULL, current_timestamp(), '".$parent_id."', '".$file_name."');";
    executeSQL($sql);
    return $parent_id;
}

function upload_photo($post, $files){
    $id = $post["parent_id"];
    if($id != null){
        $dir = ALBUM_PATH.'/'.$id;
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
            echo "directory is created";
        }
        $path = $dir."/".$files["photo1"]["name"];
        if(move_uploaded_file($files["photo1"]["tmp_name"], $path)){
            add_photo_project($post, $path);
        }
    }
}
