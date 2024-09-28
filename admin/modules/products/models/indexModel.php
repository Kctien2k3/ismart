<?php
///// list
function get_list_product() {
    $result = db_fetch_array("SELECT * FROM `tbl_products`");
    return $result;
}
///// add
function add_product($data) {
    db_insert('tbl_products', $data);   
}
//// apply status
function update_product_status($data, $product_id) {
    db_update('tbl_products', $data, "`product_id` = '{$product_id}'");
}
//// update 
function update_product($data, $product_id) {
    db_update('tbl_products', $data, "`product_id` = '{$product_id}'");
}
function get_info_product_by_product_id($product_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    return $result;
}
function get_product_img($field ,$product_id) {
    $result = db_fetch_row("SELECT `$field` FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    return $result[$field];
}
///// delete
function delete_product($product_id) {
    db_delete('tbl_products', "`product_id` = '{$product_id}'");
}

//////////////////////////////////////////////////////////////////////////////////// category
// list cat
function get_list_product_cat() {
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    return $result;
}
// add cat
function add_cat($data) {
    db_insert('tbl_product_cat', $data);
}
// apply status
function update_product_cat_status($data, $cat_id) {
    db_update('tbl_product_cat', $data, "`cat_id` = '{$cat_id}'");
}
// update cat
function get_info_cat_by_cat_id($cat_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_id` = '{$cat_id}'");
    return $result;
}
function update_product_cat($data, $cat_id) {
    db_update('tbl_product_cat', $data, "`cat_id` = '{$cat_id}'");
}
// delete cat 
function delete_cat($cat_id) {
    db_delete('tbl_product_cat', "`cat_id` = '{$cat_id}'");
}
