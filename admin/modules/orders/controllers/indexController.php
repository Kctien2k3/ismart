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
            load_view('index');
        } else {
            $list_search_order = search_order($keyword);
            $count = count($list_search_order);
            $data['list_search_order'] = $list_search_order;
            if ($count < 0) {
                $error['search'] = "Không tìm thấy kết quả với từ khóa: '" . $keyword . "'";
                load_view('search', $data);
            } else {
                $text['search'] = "Tìm thấy " . $count . " kết quả với từ khóa '" . $keyword . "'";
                load_view('search', $data);
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
                $list_oder_id = $_POST['checkItem'];
            }
            ;
            // kiểm tra chọn tác vụ
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        foreach ($list_oder_id as $order_id) {
                            order_delete($order_id);
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
    if (isset($_GET['keyword'])) {
        load_view('search');
    } else {
        load_view('index');
    }

}

///////////////////////////////////////////////////////////////////////////////  update
function updateAction()
{
    global $error, $success, $order_code, $customer_name, $num_product, $total_price, $email, $phone_number, $address, $payment_method, $order_status;
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
        if (empty($_POST['num_product'])) {
            $error['num_product'] = "Không được để trống trường này !";
        } else {
            $num_product = $_POST['num_product'];
        }
        //
        if (empty($_POST['total_price'])) {
            $error['total_price'] = "Không được để trống trường này !";
        } else {
            $total_price = $_POST['total_price'];
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
        //
        if (empty($_POST['payment_method'])) {
            $error['payment_method'] = "Không được để trống trường này !";
        } else {
            $payment_method = $_POST['payment_method'];
        }
        //
        if (empty($_POST['order_status'])) {
            $error['order_status'] = "Không được để trống trường này !";
        } else {
            $order_status = $_POST['order_status'];
        }
        ////////
        if (empty($error)) {
            $data = array(
                'customer_name' => $customer_name,
                'num_product' => $num_product,
                'total_price' => $total_price,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'payment_method' => $payment_method,
                'order_status' => $order_status,
                'created_date' => date("Y-m-d")
            );
            $order_id = $_GET['order_id'];
            order_update($data, $order_id);
            $success['update'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=orders&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        }

    }
    $order_id = $_GET['order_id'];
    $info_order = get_info_order($order_id);
    $data['info_order'] = $info_order;
    load_view('update', $data);
}
///////////////////////////////////////////////////////////////////////////////  delete
function deleteAction()
{
    $order_id = $_GET['order_id'];
    order_delete($order_id);
    if (isset($_GET['keyword'])) {
        load_view('search');
    } else {
        load_view('index');
    }
}


///////////////////////////////////////////////////////////////////////////////  detail order
function detail_orderAction()
{
    load_view('detail_order');
}
