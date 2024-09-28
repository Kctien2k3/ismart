<?php 
//// hàm check_login 
function check_login($username,$password){
    $list_users = db_fetch_array("SELECT * FROM `tbl_users`");
    foreach($list_users as $user){
        if($username == $user['username'] && md5($password) == $user['password']){
            return True;  
        } 
    } 
    return FALSE;   
}

//// tạo hàm is_login -> trả về true nếu đã login
function is_login() {
    if (isset($_SESSION['is_login'])) // check đã tồn tại is_login thông qua sử dụng session
    return True;
return FALSE;
}

//// hàm user_login -> trả về username của người login
function user_login() {
    if (!empty($_SESSION['user_login'])) 
        return $_SESSION['user_login'];
    return FALSE;
}

//// hàm lấy fullname của người dùng 
function get_info_account($data){
    $info = db_fetch_row("SELECT `$data` FROM `tbl_users` WHERE `username` = '{$_SESSION['user_login']}'");
    if(!empty($info)) 
    return $info[$data];
    return FALSE;
}

//// hafmm lấy thông tin theo field của user 
function get_info_user() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}
function info_user($field) {
    $list_user = get_info_user();
    if (isset($_SESSION['is_login'])) {
        foreach ($list_user as $user) {
            if (($_SESSION['user_login']) == $user['username']) {
                if (array_key_exists($field, $user)) {
                    return $user[$field];
                }
            }
        }
    }
}
//// check thông tin phân quyền 
function check_role($username) {
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    return $result['role'];
}

