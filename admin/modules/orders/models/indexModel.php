<?php
///// list
function get_list_order() {
    $result = db_fetch_array("SELECT * FROM `tbl_orders`");
    return $result;
}
///// update
function get_info_order($order_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_orders` WHERE `order_id` = '{$order_id}'");
    return $result;
}
function order_update($data, $order_id) {
    db_update('tbl_orders', $data, "`order_id` = '{$order_id}'");
}
////// delete
function order_delete($order_id) {
    db_delete('tbl_orders', "`order_id` = '{$order_id}'");
}
////////////////////////////////////////////////////////////////////// customer
//// list
function get_list_customer() {
    $result = db_fetch_array("SELECT * FROM `tbl_customer`");
    return $result;
}
//// update
function get_info_customer($customer_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_customer` WHERE `customer_id` = '{$customer_id}'");
    return $result;
}
function customer_update($data, $customer_id) {
    db_update('tbl_customer', $data, "`customer_id` = '{$customer_id}'");
}
////// delete
function customer_delete($customer_id) {
    db_delete('tbl_customer', "`customer_id` = '{$customer_id}'");
}