<?php 

function db_search($keyword, $field, $table){
    $sql = "SELECT * FROM $table WHERE $field LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
////////////////////////////////// searching - users
function search_user($keyword){
    $sql = "SELECT * FROM `tbl_users` WHERE  CONVERT(`username` USING utf8) LIKE '%$keyword%' OR CONVERT(`fullname` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
////////////////////////////////// searching - pages
function search_page($keyword) {
    $sql = "SELECT * FROM `tbl_pages` WHERE CONVERT(`title` USING utf8) LIKE '%$keyword%' OR CONVERT(`category` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
////////////////////////////////// searching - post

function search_post($keyword) {
    $sql = "SELECT * FROM `tbl_posts` WHERE CONVERT(`title` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
//// category
function search_post_cat($keyword) {
    $sql = "SELECT * FROM `tbl_post_cat` WHERE CONVERT(`cat_title` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}

////////////////////////////////// searching - products
function search_product($keyword) {
    $sql = "SELECT * FROM `tbl_products` WHERE CONVERT(`product_title` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
// category
function search_product_cat($keyword) {
    $sql = "SELECT * FROM `tbl_product_cat` WHERE CONVERT(`cat_title` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
////////////////////////////////// searching - orders
function search_order($keyword) {
    $sql = "SELECT * FROM `tbl_orders` WHERE CONVERT(`customer_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`order_code` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
function search_customer($keyword) {
    $sql = "SELECT * FROM `tbl_customer` WHERE CONVERT(`customer_name` USING utf8) LIKE '%$keyword%' OR CONVERT(`phone_number` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
////////////////////////////////// searching - sliders
function search_slider($keyword) {
    $sql = "SELECT * FROM `tbl_sliders` WHERE CONVERT(`slider_title` USING utf8) LIKE '%$keyword%'";
    $result = db_fetch_array($sql);
    return $result;
}
