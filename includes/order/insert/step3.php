<?php

function create_order($data, $page){
    $step2 = unserialize($data["step2"]);
    $order_id = null;
    $pid = $step2["pid"];
    $sql = "select in_stock from ".DB_NAME.".products where in_stock = 'yes' and id = ".$pid;
    $in_stock = getSingleValue($sql);
    if("yes" == $in_stock){
        $cid = $step2["cid"];
        $discount = $data["discount"];
        $discount_notes = $data["discount_notes"];
        $total_amount = $data["total_amount"];
        $balance = $data["total_amount"];
        $sql = "INSERT INTO ".DB_NAME.".orders  (id, product_id, customer_id, total_amount, balance, discount, discount_notes, delivery_status, payment_status, created_date) VALUES (NULL, '".$pid."', '".$cid."', '".$total_amount."','".$balance."', ".checkSNull($discount).", ".checkSNull($discount_notes).", '".ORDER_INI_DEL_STATUS."', '".ORDER_INI_PAY_STATUS."', current_timestamp())";
        echo $sql;
        executeSQL($sql);
        $order_id = getSingleValue("select max(id) from " .$page["table"]);
        $sql = "UPDATE ".DB_NAME.".products SET in_stock = 'no' WHERE ".DB_NAME.".products.id = ".$pid;
        executeSQL($sql);
    }
    return $order_id;
}
?>