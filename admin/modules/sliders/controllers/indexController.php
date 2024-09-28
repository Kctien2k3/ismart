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


///////////////////////////////////////////////////////////////////////////////  add 
function addAction() {
    global $error, $success, $slider_title, $slider_slug, $slider_desc, $slider_thumb, $slider_link, $slider_ordinal, $slider_status;
    if (isset($_POST['btn_add'])) {
        $error = array();
        $success = array();
        ///// validation
        //
        if (empty($_POST['slider_title'])){
            $error['slider_title'] = "Không được để trống trường này !";
        }else {
            $slider_title = $_POST['slider_title'];
        }
        //
        if (empty($_POST['slider_slug'])){
            $error['slider_slug'] = "Không được để trống trường này !";
        }else {
            $slider_slug = $_POST['slider_slug'];
        }
        //
        if (empty($_POST['slider_desc'])){
            $error['slider_desc'] = "Không được để trống trường này !";
        }else {
            $slider_desc = $_POST['slider_desc'];
        }
        //
        if (empty($_POST['slider_link'])){
            $error['slider_link'] = "Không được để trống trường này !";
        }else {
            $slider_link = $_POST['slider_link'];
        }
        //
        if (empty($_POST['slider_ordinal'])){
            $error['slider_ordinal'] = "Không được để trống trường này !";
        }else {
            $slider_ordinal = $_POST['slider_ordinal'];
        }
        // check upload img
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // ktra type và size
            $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            if (!is_img($file_type, $file_size)) {
                $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
            } else {
                $slider_thumb = upload_img('public/images/slider/', $file_type);
            }
        } else {
            $error['upload'] = "Bạn chưa Upload tệp ảnh !";
        }

        
        //////
        if (empty($error)) {
            $data = array(
                'slider_title' => $slider_title, 
                'slider_slug' => $slider_slug, 
                'slider_desc' => $slider_desc, 
                'slider_thumb' => $slider_thumb, 
                'slider_link' => $slider_link, 
                'slider_ordinal' => $slider_ordinal, 
                'slider_status' => "pending",
                'creator' => $_SESSION['user_login'],
                'created_date' => date("Y-m-d"),
            );
            add_slider($data);
            $success['add'] = "Thêm mới thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=sliders&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        }else {
            print_r($error);
        }

    }
    load_view('add');
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
            $list_search_slider = search_slider($keyword);
            $count = count($list_search_slider);
            $data['list_search_slider'] = $list_search_slider;
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

///////////////////////////////////////////////////////////////////////////////  apply status
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
                $list_slider_id = $_POST['checkItem'];
            }
            ;
            // kiểm tra chọn tác vụ
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'slider_status' => 'approved',
                            'editor' => $_SESSION['user_login'],
                            'edit_date' => date("Y-m-d")

                        );
                        foreach ($list_slider_id as $slider_id) {
                            update_slider_status($data, $slider_id);
                        }
                    } else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần áp dụng !";
                    }
                }
                // chọn tác vụ = 2
                if ($_POST['actions'] == 2) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'slider_status' => 'pending',
                            'editor' => $_SESSION['user_login'],
                            'edit_date' => date("Y-m-d")
                        );
                        foreach ($list_slider_id as $slider_id) {
                            update_slider_status($data, $slider_id);
                        }
                    } else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần áp dụng !";
                    }
                }
                // chọn tác vụ = 3
                if ($_POST['actions'] == 3) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'slider_status' => 'trash',
                            'editor' => $_SESSION['user_login'],
                            'edit_date' => date("Y-m-d")
                        );
                        foreach ($list_slider_id as $slider_id) {
                            update_slider_status($data, $slider_id);
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

///////////////////////////////////////////////////////////////////////////////  add 
function updateAction() {
    global $error, $success, $slider_title, $slider_slug, $slider_desc, $slider_thumb, $slider_link, $slider_ordinal, $slider_status;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        ///// validation
        //
        if (empty($_POST['slider_title'])){
            $error['slider_title'] = "Không được để trống trường này !";
        }else {
            $slider_title = $_POST['slider_title'];
        }
        //
        if (empty($_POST['slider_slug'])){
            $error['slider_slug'] = "Không được để trống trường này !";
        }else {
            $slider_slug = $_POST['slider_slug'];
        }
        //
        if (empty($_POST['slider_desc'])){
            $error['slider_desc'] = "Không được để trống trường này !";
        }else {
            $slider_desc = $_POST['slider_desc'];
        }
        //
        if (empty($_POST['slider_link'])){
            $error['slider_link'] = "Không được để trống trường này !";
        }else {
            $slider_link = $_POST['slider_link'];
        }
        //
        if (empty($_POST['slider_ordinal'])){
            $error['slider_ordinal'] = "Không được để trống trường này !";
        }else {
            $slider_ordinal = $_POST['slider_ordinal'];
        }
        // check upload img
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // ktra type và size
            $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            if (!is_img($file_type, $file_size)) {
                $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
            } else {
                $slider_id = $_GET['slider_id'];
                $old_thumb = get_slider_img('slider_thumb', $slider_id);
                if (!empty($old_thumb)) {
                    delete_img($old_thumb);
                    $slider_thumb = upload_img('public/images/slider/', $file_type);
                } else {
                    $slider_thumb = upload_img('public/images/slider/', $file_type);
                }
            }
        } else {
            $slider_id = $_GET['slider_id'];
            $old_thumb = get_slider_img('slider_thumb', $slider_id);
        }

        
        //////
        if (empty($error)) {
            $data = array(
                'slider_title' => $slider_title, 
                'slider_slug' => $slider_slug, 
                'slider_desc' => $slider_desc, 
                'slider_thumb' => $slider_thumb, 
                'slider_link' => $slider_link, 
                'slider_ordinal' => $slider_ordinal, 
                'editor' => $_SESSION['user_login'],
                'edit_date' => date("Y-m-d"),
            );
            $slider_id = $_GET['slider_id'];
            update_slider($data, $slider_id);
            $success['update'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=sliders&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        }else {
            print_r($error);
        }

    }
    $slider_id = $_GET['slider_id'];
    $info_slider = get_info_slider($slider_id);
    $data['info_slider'] = $info_slider;
    load_view('update', $data);
}
///////////////////////////////////////////////////////////////////////////////  delete 
function deleteAction() {
    
}
