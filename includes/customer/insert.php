<?php 

function insert_customer($data, $page)
{
    $prefix = $data["prefix"];
    if ($prefix == "--"){
        $prefix = "";
    }
    $first_name = $data["first_name"];
    $last_name = $data["last_name"];
    $address = $data["address"];
    $ort = $data["ort"];
    $pin_code = $data["pin_code"];
    $mobile = $data["mobile"];
    $email = $data["email"];
    $dob = $data["dob"];
    #echo $dob;
    $sql = "INSERT INTO ".$page["table"]." (id, prefix, first_name, last_name, address, ort, pin_code, mobile, email, dob, joined_date) VALUES (NULL, '".$prefix."', '".$first_name."', '".$last_name."', '".$address."', '".$ort."', '".$pin_code."', '".$mobile."', '".$email."', ".checkSNull($dob).", current_timestamp());";
    #echo $sql;
    executeSQL($sql);
    $id = getSingleValue("select max(id) from " .$page["table"]);
    $text = $page["php"]."?cid=".$id;
    $file = QR_CODES_CUST_DIR."/".$page["module"]."_".$id."_".uniqid().".png";
    $image_path = generate_qr_code($file, $text);
    $sql = "update ".$page["table"]." set qr_image_path = '".$image_path."' where id = ".$id;
    executeSQL($sql);
}

?>