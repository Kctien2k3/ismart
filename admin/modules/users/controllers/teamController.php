<?php
function construct()
{
    load_model('index');
}

function indexAction()
{
    // global $list_user, $data;
    // $list_user = get_list_user();
    // $data['list_user'] = $list_user;
    load_view('teamIndex');
}

//////////////////////////////////////////////////// search users 
function searchAction()
{
    global $list_search_user, $error, $text;
    if (isset($_GET['btn_search'])) {
        $error = array();
        $text = array();
        $keyword = addslashes($_GET['keyword']);
        if (empty($keyword)) {
            $error['search'] = "Yêu cầu nhập dữ liệu vào ô trống !";
            load_view('teamIndex');
        } else {
            $list_search_user = search_user($keyword);
            $count = count($list_search_user);
            $data['list_search_user'] = $list_search_user;
            if ($count <= 0) {
                $error['search'] = "Không tìm thấy kết quả với từ khóa: '" . $keyword . "'";
                load_view('search', $data);
            } else {
                $text['search'] = "Tìm thấy " . $count . " kết quả với từ khóa: '" . $keyword . "'";
                load_view('search', $data);
            }
        }
    }
}

/////////////////////////////////////////////////// apply status
function apply_userAction()
{
    global $error, $data;
    // kiểm tra tồn tại button submit
    if (isset($_POST['sm_action'])) {
        // kiểm tra người đang login có quyền truy cập cấp 1 hay không
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            // đẩy đối tượng item vào mảng cố định
            if (!empty($_POST['checkItem'])) {
                $list_user_id = $_POST['checkItem'];
            }
            // đảm bảo rằng phải không được để tróng tác vụ
            if (!empty($_POST['actions'])) {
                // nếu tác vụ = 1 là phê duyệt
                if ($_POST['actions'] == 1) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'approved'
                        );
                        foreach ($list_user_id as $user_id) {
                            update_status($data, $user_id);
                        }
                    } else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần áp dụng";
                    }
                }
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'pending'
                        );
                        foreach ($list_user_id as $user_id) {
                            update_status($data, $user_id);
                        }
                    } else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần áp dụng !";
                    }
                }
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'trash'
                        );
                        foreach ($list_user_id as $user_id) {
                            update_status($data, $user_id);
                        }
                    } else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần ấp dụng !";
                    }
                }
            } else {
                $error['apply'] = "Bạn chưa chọn tác vụ";
            }
        } else {
            $error['apply'] = "Tài khoản này của bạn không có quyền thực hiện chức năng này !";
        }
    }
    if (isset($_GET['keyword'])) {
        load_view('search');
    } else {
        load_view('teamIndex');
    }
}


/////////////////////////////////////////////////// add user
function add_userAction()
{
    global $error, $success, $username, $fullname, $email, $password, $phone_number, $address, $avatar, $role, $file_type;
    if (isset($_POST['btn_add'])) {
        $error = array();
        // validation form
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống trường này !";
        } else {
            // if (!is_fullname($_POST['fullname'])) {
            //     $error['fullname'] = "Họ và Tên nhập không đúng định dạng !";
            // }else {
            $fullname = $_POST['fullname'];
            // }
        }
        //
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống trường này !";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng !";
            } else {
                if (db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$_POST['username']}' >= 1")) {
                    $error['username'] = "Tên đăng nhập đã tồn tại";
                } else {
                    $username = $_POST['username'];
                }
            }
        }
        // 
        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống trường này !";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu nhập không đúng định dạng !";
            } else {
                $password = md5($_POST['password']);
            }
        }
        // 
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống trường này !";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email nhập không đúng định dạng !";
            } else {
                // if ("SELECT * FROM `tbl_users` WHERE `email` = '{$_POST['email']}' >= 1") {
                //     $error['email'] = "Email này đã tồn tại";
                // }else {
                $email = $_POST['email'];
                // }
            }
        }
        // 
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống trường này !";
        } else {
            if (!is_phone_number($_POST['phone_number'])) {
                $error['phone_number'] = "Số điện thoại nhập không đúng định dạng !";
            } else {
                $phone_number = $_POST['phone_number'];
            }
        }
        // 
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống trường này !";
        } else {
            $address = $_POST['address'];
        }
        // Check phân quyền
        if (empty($_POST['role'])) {
            $error['role'] = "Không được để trống trường này !";
        } else {
            $role = $_POST['role'];
        }
        // Check Upload file 
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // lấy dữ liệu file theo tên và size        
            $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            // thực hiện kiểm tra kiểu file và size file
            if (!is_img($file_type, $file_size)) {
                $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
            } else {
                $avatar = upload_img('public/images/users/', $file_type);
            }
        } else {
            $error['upload'] = "Bạn chưa Upload tệp ảnh !";
        }

        //// 
        if (empty($error)) {
            if ($role == 1) {
                $status = 'approved';
            } else {
                $status = 'pending';
            }
            // $avatar = upload_img('public/images/users/', $file_type);
            $data = array(
                'fullname' => $fullname,
                'username' => $username,
                'password' => md5($password),
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'avatar' => $avatar,
                'role' => $role,
                'status' => $status,
                'creator' => $_SESSION['user_login'],
                'created_at' => date("Y-m-d"),
                'active' => 'inactive'
            );
            add_user($data);
            $success['add'] = "Đã thêm Thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=users&controller=team&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        } else {
            print_r($error);
        }
    }
    // if (isset($_POST['btn_upload'])) {
    //     if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    //         // lấy dữ liệu file theo tên và size        
    //         $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    //         $file_size = $_FILES['file']['size'];
    //         // thực hiện kiểm tra kiểu file và size file
    //         if (!is_img($file_type, $file_size)) {
    //             $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
    //         }else {
    //             $avatar = upload_img('public/images/users/', $file_type);
    //         }

    //     }else {
    //         $error['upload'] = "Bạn chưa chọn tệp ảnh !";
    //     }
    //     // print_r($avatar);
    // }

    load_view('add_user');
}

/////////////////////////////////////////////////// info users
function info_userAction()
{
    $user_id = $_GET['user_id'];
    $info_user_id = get_info_user_by_user_id($user_id);
    $data['info_user_id'] = $info_user_id;
    load_view('info_user', $data);
}

/////////////////////////////////////////////////// modify users

function update_userAction()
{
    global $error, $success, $username, $fullname, $email, $phone_number, $address, $avatar, $role, $file_type, $user_id;
    if (isset($_POST['btn_update'])) {
        $error = array();
        //// validation form 
        #fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống trường này !";
        } else {
            // if (!is_fullname($_POST['fullname'])) {
            //     $error['fullname'] = "Họ và Tên nhập không đúng định dạng !";
            // }else {
            $fullname = $_POST['fullname'];
            // }
        }
        #username
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống trường này !";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng !";
            } else {
                $username = $_POST['username'];
            }
        }
        #email
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống trường này !";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email nhập không đúng định dạng !";
            } else {
                $email = $_POST['email'];
            }
        }
        #phone_number
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống trường này !";
        } else {
            if (!is_phone_number($_POST['phone_number'])) {
                $error['phone_number'] = "Số điện thoại nhập không đúng định dạng !";
            } else {
                $phone_number = $_POST['phone_number'];
            }
        }
        #address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống trường này !";
        } else {
            $address = $_POST['address'];
        }
        #role
        if (empty($_POST['role'])) {
            $error['role'] = "Không được để trống trường này !";
        } else {
            $role = $_POST['role'];
        }
        #avatar
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // lấy dữ liệu file theo tên và size        
            $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            // thực hiện kiểm tra kiểu file và size file
            if (!is_img($file_type, $file_size)) {
                $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
            } else {
                $user_id = $_GET['user_id'];
                $old_img = get_user_img('avatar', $user_id);
                if (!empty($old_img)) {
                    delete_img($old_img);
                }
                $avatar = upload_img('public/images/users/', $file_type);
            }
        } else {
            $user_id = $_GET['user_id'];
            $avatar = get_user_img('avatar', $user_id);
        }


        //// 
        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'username' => $username,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'avatar' => $avatar,
                'role' => $role,
                'editor' => $_SESSION['user_login'],
                'edit_date' => date("Y-m-d"),
                'active' => 'inactive'
            );
            $user_id = $_GET['user_id'];
            update_user($user_id, $data);
            $success['update'] = "Đã cập nhật Thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=users&controller=team&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        }
    } else {
        print_r($error);
    }

    $user_id = $_GET['user_id'];
    // print_r($user_id);
    $info_user_id = get_info_user_by_user_id($user_id);
    $data['info_user_id'] = $info_user_id;
    load_view('update_user', $data);

}

/////////////////////////////////////////////////// delete user
function delete_userAction()
{
    $user_id = $_GET['user_id'];
    // print_r($user_id);
    delete_user($user_id);
    if (isset($_GET['keyword'])) {
        load_view('search');
    } else {
        load_view('teamIndex');
    }
}
