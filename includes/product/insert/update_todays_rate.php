<?php
function update_todays_rate($data)
{
    $gold_22k = $data["gold_22k"];
    $gold_24k = $data["gold_24k"];
    $silver = $data["silver"];

    executeSQL(get_sql_for_insert("gold", "22", $gold_22k));
    executeSQL(get_sql_for_insert("gold", "24", $gold_24k));
    executeSQL(get_sql_for_insert("silver", "0", $silver));
}

function get_sql_for_insert($metal_type, $purity, $rate){
    return "INSERT INTO ".DB_NAME.".today_rates(id, modified_date, metal_type, purity, rate) VALUES (NULL, current_timestamp(), '".$metal_type."', '".$purity."', '".$rate."')";
}
?>