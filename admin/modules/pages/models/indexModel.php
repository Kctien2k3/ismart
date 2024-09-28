<?php
///// list page
function get_list_page() {
    $result = db_fetch_array("SELECT * FROM `tbl_pages`");
    return $result;
}
// function get_category_page() {
//     $result = db_fetch_row("SELECT `title` FROM `tbl_pages`");
//     return $result;
// }

///// add page
function add_page($data) {
    db_insert('tbl_pages', $data);
}

////// apply status 
function update_page_status($data, $page_id) {
    db_update('tbl_pages', $data, "`page_id` = '{$page_id}'");
}
////// update page
function get_info_page_by_page_id($page_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `page_id` = '{$page_id}'");
    return $result;
}
function update_page($data, $page_id) {
    db_update('tbl_pages', $data, "`page_id` = '{$page_id}'");
}
/////// delete page
function delete_page($page_id) {
    db_delete('tbl_pages', "`page_id` = '{$page_id}'");
}