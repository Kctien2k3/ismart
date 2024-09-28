<?php
function get_list_post() {
    $result = db_fetch_array("SELECT * FROM `tbl_posts`");
    return $result;
}
///// add post
function add_post($data) {
    db_insert('tbl_posts', $data);
}
///// aply status
function update_post_status($data, $post_id) {
    db_update('tbl_posts', $data, "`post_id` = '{$post_id}'");
}
///// update
function get_info_post($post_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_posts` WHERE `post_id` = '{$post_id}'");
    return $result;
}
function get_post_img($field, $post_id) {
    $result = db_fetch_row("SELECT `$field` FROM `tbl_posts` WHERE `post_id` = '{$post_id}'");
    return $result[$field];
}
function update_post($data, $post_id) {
    db_update('tbl_posts', $data, "`post_id` = '{$post_id}'");
}
////// delete
function delete_post($post_id) {
    db_delete('tbl_posts', "`post_id` = '{$post_id}'");
}

////////////////////////////////////////////////////////////////////////////////////////////// category
function get_list_post_cat() {
    $result = db_fetch_array("SELECT * FROM `tbl_post_cat`");
    return $result;
}
//////// add
function add_post_cat($data) {
    db_insert('tbl_post_cat', $data);
}
//////// apply
function update_post_cat_status($data, $cat_id) {
    db_update('tbl_post_cat', $data, "`cat_id` = '{$cat_id}'");
}
///////// update
function get_info_post_cat($cat_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_post_cat` WHERE `cat_id` = '{$cat_id}'");
    return $result;
}
function update_post_cat($data, $cat_id) {
    db_update('tbl_post_cat', $data, "`cat_id` = '{$cat_id}'");
}
////////// delete
function delete_post_cat($cat_id) {
    db_delete('tbl_post_cat', "`cat_id` = '{$cat_id}'");
}