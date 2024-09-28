<?php
////////////////////////////////// user
function get_user_by_username($username){
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    if (!empty($item)) 
        return $item;
}
function update_user_login($username, $data) {
    db_update('tbl_users', $data, "`username` =  '{$username}'");
}
function update_pass_new($data) {
    db_update('tbl_users', $data, "`username` = '{$_SESSION['user_login']}'");
}

////////////////////////////////// team 
// apply status
function get_list_user () {
    $list = db_fetch_array("SELECT * FROM `tbl_users`");
    return $list;
}   
function update_status($data, $user_id) {
    db_update('tbl_users', $data, "`user_id` = '{$user_id}'");
}
// add user
function add_user($data) {
    db_insert('tbl_users', $data);
}
// update_user
function get_info_user_by_user_id($user_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` =  '{$user_id}'");
    return $result;
}
function get_user_img($field, $user_id) {
    $result = db_fetch_row("SELECT `$field` FROM `tbl_users` WHERE `user_id` =  '{$user_id}'");
    return $result[$field];
}
function update_user($user_id, $data) {
    db_update('tbl_users', $data, "`user_id` = '{$user_id}'");
}
// delete_user
function delete_user($user_id){
    db_delete('tbl_users', "`user_id` = '{$user_id}'");
}