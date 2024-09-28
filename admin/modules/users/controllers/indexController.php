<?php

function construct()
{
    //    echo "Dùng chung, load đầu tiên";
    load_model('index');
}

function indexAction()
{
    load_view('index');
}

/////////////////////////////////////////////////////////////////////////////// Login 
function loginAction()
{
    global $error, $username, $password;
    if (isset($_POST['btn_login'])) {
        $error = array();
        ////// validation form
        if (empty($_POST['username'])) {
            $error['username'] = "Không được để trống username !";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không đúng định dạng !";
            } else {
                $username = $_POST['username'];
            }
        }

        if (empty($_POST['password'])) {
            $error['password'] = "Không được để trống password !";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu nhập không đúng định dạng !";
            } else {
                $password = $_POST['password'];
            }
        }
        //////////
        if (empty($error)) {
            if (check_login($username, $password)) {
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                //Chuyển hướng vào trong hệ thống
                if (isset($_POST['remember_me'])) {
                    setcookie('is_login', true, time() + 3600);
                    setcookie('user_login', $username, time() + 3600);
                }
                //Luư trữ phiên đăng nhập
                // update_active_user();
                // update_active_admin();
                redirect("?mod=users&controller=team&action=index");
            } else {
                $error['acount'] = 'Tên đăng nhập hoặc mật khẩu không đúng';
            }
        } else {
            print_r($error);
        }
    }
    load_view('login');
}
/////////////////////////////////////////////////////////////////////////////// logout
function LogoutAction()
{
    setcookie('is_login', '', time() - 3600);
    setcookie('user_login', '', time() - 3600);
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=users&action=login");
}
/////////////////////////////////////////////////////////////////////////////// info

function infoAction()
{
    $info_user = get_user_by_username($_SESSION['user_login']);
    $data['info_user'] = $info_user;
    load_view('info', $data);
}
/////////////////////////////////////////////////////////////////////////////// update 
function updateAction()
{
    global $error, $username, $fullname, $email, $address, $phone_number, $success, $avatar, $file_type;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        //////// validation form
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống tên hiển thị !";
        } else {
            if (!(strlen($_POST['fullname']) >= 6 && strlen($_POST['fullname']) <= 32)) {
                $error['fullname'] = "fullname yêu cầu từ 6 đến 32 ký tự";
            } else {
                $fullname = $_POST['fullname'];
                is_fullname($fullname);
            }
        }
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống Email !";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email nhập không đúng định dạng !";
            } else {
                $email = $_POST['email'];
            }
        }
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại !";
        } else {
            if (!is_phone_number($_POST['phone_number'])) {
                $error['phone_number'] = "Số điện thoại nhập không đúng định dạng !";
            } else {
                $phone_number = $_POST['phone_number'];
            }
        }
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống địa chỉ !";
        } else {
            $address = $_POST['address'];
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
                $old_img = info_user('avatar');
                if (!empty($old_img)) {
                    delete_img($old_img);
                    $avatar = upload_img('public/images/users/', $file_type);
                }else {
                $avatar = upload_img('public/images/users/', $file_type);
                }
            }
        } else {
            $avatar = info_user('avatar');
        }

        ///////
        if (empty($error)) {

            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'address' => $address,
                'phone_number' => $phone_number,
                'avatar' => $avatar,
            );
            update_user_login(user_login(), $data);
            $success['update'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=users&action=info'>"; // cách 1 (chuyển hướng tới trang login)       
        } else {
            // $error['update'] = "Cập nhật không thành công !";
            print_r($error);
        }

    }

    $info_user = get_user_by_username($_SESSION['user_login']);
    $data['info_user'] = $info_user;
    load_view('update', $data);
}
/////////////////////////////////////////////////////////////////////////////// reset 
function resetAction()
{
    global $error, $success, $pass_old, $pass_new, $confirm_pass, $password;
    if (isset($_POST['btn_reset'])) {
        $error = array();
        $success = array();
        $password = info_user('password');
        ////// validation form 
        if (empty($_POST['pass_old'])) {
            $error['pass_old'] = "không được để trống trường này !";
        } else {
            if (!is_password($_POST['pass_old'])) {
                $error['pass_old'] = "Password của bạn sai định dạng !";
            } else {
                $pass_old = $_POST['pass_old'];
            }
        }
        if (empty($_POST['pass_new'])) {
            $error['pass_new'] = "không được để trống trường này !";
        } else {
            if (!is_password($_POST['pass_new'])) {
                $error['pass_new'] = "Passworđ của bạn sai định dạng !";
            } else {
                $pass_new = $_POST['pass_new'];
            }
        }
        if (empty($_POST['confirm_pass'])) {
            $error['confirm_pass'] = "không được để trống trường này !";
        } else {
            if (!is_password($_POST['confirm_pass'])) {
                $error['confirm_pass'] = "Password của bạn sai định dạng !";
            } else {
                $confirm_pass = $_POST['confirm_pass'];
            }
        }
        //////// 
        if (empty($error)) {
            if (md5($pass_old) != $password) {
                $error['pass_old'] = "Mật khẩu cũ chưa đúng !";
            } else {
                if ($confirm_pass == $pass_new) {
                    $data = array(
                        'password' => md5($pass_new),
                    );
                    update_pass_new($data);
                    $success['reset'] = "Cập nhật mật khẩu thành công";
                    // echo "<meta http-equiv='refresh' content='5;url=?mod=users&action=login'>"; // cách 1 (chuyển hướng tới trang login)
                    echo "<script>
                    setTimeout(function() {
                    window.location.href = '?mod=users&action=login';
                    }, 3000); // 3000 milliseconds = 3 giây
                    </script>"; // cách 2 (chuyển hướng tới trang login)

                    // exit(); // Dừng kịch bản sau khi chuyển hướng
                } else {
                    $error['confirm_pass'] = "Xác nhận mật khẩu mới chưa đúng !";
                }
            }
        } else {
            print_r($error);
        }

    }
    load_view('reset');
}



