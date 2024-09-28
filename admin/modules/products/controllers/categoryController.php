<?php

function construct()
{
    //    echo "Dùng chung, load đầu tiên";
    load_model('index');
}
function list_catAction()
{
    load_view('list_cat');
}

///////////////////////////////////////////////////////////////////////////////  add 
function add_catAction()  {
    global $error, $success, $cat_title, $cat_slug, $parent_id;
    if (isset($_POST['btn_add'])) {
        $error = array();
        $success = array();
        ///// validation 
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Không được để trống trường này !";
        }else {
            $cat_title = $_POST['cat_title'];
        }
        // 
        if (empty($_POST['cat_slug'])) {
            $error['cat_slug'] = "Không được để trống trường này !";
        }else {
            $cat_slug = $_POST['cat_slug'];
        }
        // 
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        }else  {
            $parent_id = $_POST['parent_id'];
        }
        
        ///// 
        if (empty($error)) {
            $data = array(
                'cat_title' => $cat_title,
                'cat_slug' => $cat_slug,
                'cat_status' => 'pending',
                'created_date' => date("Y-m-d"),
                'creator' => $_SESSION['user_login'],
                'parent_id' => $parent_id,
            );
            add_cat($data);
            $success['add_cat'] = "Thêm mới thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=products&controller=category&action=list_cat'>"; // cách 1 (chuyển hướng tới trang login) 
        }
    }
    load_view('add_cat');
}

///////////////////////////////////////////////////////////////////////////////  search 
function search_catAction() {
    global $error, $text;
    if (isset($_GET['btn_search'])) {
        $error = array();
        $text = array();
        $keyword = addslashes($_GET['keyword']);
        if (empty($keyword)) {
            $error['search'] = "Yêu cầu nhập dữ liệu vào ô trống !";
            load_view('list_cat');
        }else {
            $list_search_cat = search_product_cat($keyword);
            $data['list_search_cat'] = $list_search_cat;
            $count = count($list_search_cat);
            if ($count < 0) {
                $error['search'] = "Không tìm thấy kết quả với từ khóa: '" . $keyword . "'";
                load_view('search_cat', $data);
            }else {
                $text['search'] = "Tìm thấy " . $count . " kết quả với từ khóa '" . $keyword . "'";
                load_view('search_cat', $data);
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
                $list_product_cat_id = $_POST['checkItem'];
            }
            ;
            // kiểm tra chọn tác vụ
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'cat_status' => 'approved',

                        );
                        foreach ($list_product_cat_id as $cat_id) {
                            update_product_cat_status($data, $cat_id);
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
                            'cat_status' => 'pending',

                        );
                        foreach ($list_product_cat_id as $cat_id) {
                            update_product_cat_status($data, $cat_id);
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
                            'cat_status' => 'trash',

                        );
                        foreach ($list_product_cat_id as $cat_id) {
                            update_product_cat_status($data, $cat_id);
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
        load_view('search_cat');
    } else {
        load_view('list_cat');
    }
}

///////////////////////////////////////////////////////////////////////////////  update cat
function update_catAction() {
    global $error, $success, $cat_title, $cat_slug, $parent_id;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        ///// validation 
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Không được để trống trường này !";
        }else {
            $cat_title = $_POST['cat_title'];
        }
        // 
        if (empty($_POST['cat_slug'])) {
            $error['cat_slug'] = "Không được để trống trường này !";
        }else {
            $cat_slug = $_POST['cat_slug'];
        }
        // 
        if (!empty($_POST['parent_id'])) {
            $parent_id = $_POST['parent_id'];
        }
        
        ///// 
        if (empty($error)) {
            $data = array(
                'cat_title' => $cat_title,
                'cat_slug' => $cat_slug,
                'edit_date' => date("Y-m-d"),
                'editor' => $_SESSION['user_login'],
                'parent_id' => $parent_id,
            );
            $cat_id = $_GET['cat_id'];
            update_product_cat($data, $cat_id);
            $success['update_cat'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=products&controller=category&action=list_cat'>"; // cách 1 (chuyển hướng tới trang login) 
        }
    }
    $cat_id = $_GET['cat_id'];
    $info_cat = get_info_cat_by_cat_id($cat_id);
    $data['info_cat'] = $info_cat;
    load_view('update_cat', $data);
}
///////////////////////////////////////////////////////////////////////////////  delete
function delete_catAction() {
    $cat_id = $_GET['cat_id'];
    delete_cat($cat_id);
    if (isset($keyword)) {
        load_view('search_cat');
    }else {
        load_view('list_cat');
    }
}
