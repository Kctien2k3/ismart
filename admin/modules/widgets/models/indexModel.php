<?php
/////////////////////////////////////////////////////////////////// Menu
///// list
// page
function get_list_page() {
    $result = db_fetch_array("SELECT * FROM `tbl_pages`");
    return $result;
}
// product
function get_list_product_cat() {
    $result = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    return $result;
}
// post
function get_list_post_cat() {
    $result = db_fetch_array("SELECT * FROM `tbl_post_cat`");
    return $result;
}
// 
function get_list_menu() {
    $result = db_fetch_array("SELECT * FROM `tbl_menu`");
    return $result;
}
////// add menu
function add_menu($data) {
    db_insert('tbl_menu', $data);
}
////// update
function update_menu($data, $menu_id) {
    db_update('tbl_menu', $data, "`menu_id` = '{$menu_id}'");
}
function get_info_menu($menu_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_menu` WHERE `menu_id` = '{$menu_id}'");
    return $result;
}
/////// delete
function menu_delete($menu_id) {
    db_delete('tbl_menu', "`menu_id` = '{$menu_id}'");
}