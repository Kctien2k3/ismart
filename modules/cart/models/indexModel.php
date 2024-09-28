<?php
//// function 
function get_info_product_by_product_id($product_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    return $result;
}
