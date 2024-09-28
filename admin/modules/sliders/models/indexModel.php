<?php
///// list
function get_list_slider() {
    $result = db_fetch_array("SELECT * FROM `tbl_sliders`");
    return $result;
}
///// add
function add_slider($data) {
    db_insert('tbl_sliders', $data);
}
///// apply status
function update_slider_status($data, $slider_id) {
    db_update('tbl_sliders', $data, "`slider_id` = '{$slider_id}'");
}
///// update
function get_slider_img($field, $slider_id) {
    $result = db_fetch_row("SELECT `$field` FROM `tbl_sliders` WHERE `slider_id` = '{$slider_id}'");
    return $result[$field];
}
function update_slider($data, $slider_id) {
    db_update('tbl_sliders', $data, "`slider_id` = '{$slider_id}'");
}
function get_info_slider($slider_id) {
    $result = db_fetch_row("SELECT * FROM `tbl_sliders` WHERE `slider_id` = '{$slider_id}'");
    return $result;
}