<?php

function construct()
{
    //    echo "Dùng chung, load đầu tiên";
    load_model('index');
}
function List_customerAction()
{
    load_view('list_customer');
}
///////////////////////////////////////////////////////////////////////////////  search 
function searchAction()
{
    global $error, $text;
    if (isset($_GET['btn_search'])) {
        $error = array();
        $text = array();
        $keyword = addslashes($_GET['keyword']);
        if (empty($keyword)) {
            $error['search'] = "Yêu cầu nhập dữ liệu vào ô trống !";
            load_view('list_customer');
        } else {
            $list_search_customer = search_customer($keyword);
            $count = count($list_search_customer);
            $data['list_search_customer'] = $list_search_customer;
            if ($count < 0) {
                $error['search'] = "Không tìm thấy kết quả với từ khóa: '" . $keyword . "'";
                load_view('search_customer', $data);
            } else {
                $text['search'] = "Tìm thấy " . $count . " kết quả với từ khóa '" . $keyword . "'";
                load_view('search_customer', $data);
            }
        }
    }
}
/////////////////////////////////////////////////////////////////////////////// apply status
function apply_statusAction()
{
    global $error, $data;
    // kiểm tra button
    if (isset($_POST['sm_action'])) {
        $error = array();
        // kiểm tra phân quyền
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            // đẩy post_id vào mảng
            if (!empty($_POST['checkItem'])) {
                $list_customer_id = $_POST['checkItem'];
            }
            ;
            // kiểm tra chọn tác vụ
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        foreach ($list_customer_id as $customer_id) {
                            customer_delete($customer_id);
                        }
                    } else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần áp dụng !";
                    }
                }
            } else {
                $error['apply'] = "Bạn chưa chọn tác vụ !";
            }
        } else {
            $error['apply'] = "Tài khoản này của bạn không có quyền thực hiện chức năng này !";
        }
    }
    if(isset($_GET['keyword'])) {
        load_view('search_customer');
    }else {
        load_view('list_customer');
    }

}


///////////////////////////////////////////////////////////////////////////////  update
function updateAction()
{
    global $error, $success, $customer_name, $address, $phone_number, $email;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        //// validation 
        //
        if (empty($_POST['customer_name'])) {
            $error['customer_name'] = "Không được để trống trường này !";
        } else {
            $customer_name = $_POST['customer_name'];
        }
        //
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống trường này !";
        } else {
            $email = $_POST['email'];
        }
        //
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống trường này !";
        } else {
            $phone_number = $_POST['phone_number'];
        }
        //
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống trường này !";
        } else {
            $address = $_POST['address'];
        }


        //// 
        if (empty($error)) {
            $data = array(
                'customer_name' => $customer_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
            );
            $customer_id = $_GET['customer_id'];
            customer_update($data, $customer_id);
            $success['update'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=orders&controller=customer&action=list_customer'>"; // cách 1 (chuyển hướng tới trang login)
        }
    }
    $customer_id = $_GET['customer_id'];
    $info_customer = get_info_customer($customer_id);
    $data['info_customer'] = $info_customer;
    load_view('update_customer', $data);
}
///////////////////////////////////////////////////////////////////////////////  delete
function deleteAction() {
    $customer_id = $_GET['customer_id'];
    customer_delete($customer_id);
    if (isset($_GET['keyword'])) {
        load_view('search_customer');
    }else {
        load_view('list_customer');
    }
}
