<?php
//////////////////// validation form 
function is_username($username)
{
    $pattern = '/^[A-Za-z0-9_\.]{6,32}$/';
    if (!preg_match($pattern, $username, $matchs))
        return false;
    return true;
}
function is_password($password)
{
    $pattern = '/^[A-Za-z0-9_\.!@#$%^&*()]{6,32}$/';
    if (!preg_match($pattern, $password, $matchs))
        return false;
    return true;
}
function is_fullname($fullname)
{
    $partten = "/^[A-Z a-z]$/";
    if (!preg_match($partten, $fullname, $matchs)) 
        return false;
    return true;
}
// function is_email($email)
// {
//     $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
//     if (!preg_match($partten, $email, $matchs))
//         return FALSE;
//     return true;
// }
function is_email($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } 
    return true;
}
function is_phone_number($phone)
{
    $partten = "/^(09|08|03[2|6|7|8|9])+([0-9]){8}$/";
    if (!preg_match($partten, $phone, $matchs))
        return false;
    return true;
}
// check number valid
function is_number($number)
{
    $pattern = "/^[0-9]*$/";
    if (preg_match($pattern, $number, $matchs))
        return true;
    return false;
}
// check img 
function is_img($file_type, $file_size) {
    $file_type_allow = array('png', 'jpg', 'gif', 'jpeg');
    if (!in_array(strtolower($file_type),$file_type_allow)){
        return false;
    }else {
        if ($file_size > 21000000) {
            return false;
        }
    }
    return true;
}
//////////////////// error alert, success alert, set_value
function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field]))
        return "<p style='color: red;font-size: 14px;font-style: italic;text-align: left;'>{$error[$label_field]}</p>";
}
function form_text($label_field)
{
    global $text;
    if (!empty($text[$label_field]))
        return "<p style='color: gray;font-size: 14px;text-align: left;'>{$text[$label_field]}</p>";
}
function form_success($label_field)
{
    global $success;
    if (!empty($success[$label_field]))
    return "<p style='
    color: green;
    padding: 10px 15px;
    border-radius: 5px;
    color: white;
    font-weight: 600;
    margin-bottom: 15px;
    background-color: lightgreen;
    font-size: 16px;
    text-align: center;
    '>{$success[$label_field]}</p>";
}

function set_value($label_field)
{
    global $$label_field;
    if (!empty($$label_field))
        return $$label_field;
}

function success_notice($label_field)
{
    global $$label_field;
    if (!empty($$label_field))
        return "<p style='color: blue;font-size: 24px; margin-bottom: 20px; font-weight: 600;'>{$$label_field}</p>";
}
