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
function add_catAction()
{
    global $error, $success, $title, $slug, $parent_id;
    if (isset($_POST['btn_add'])) {
        $error = array();
        //// validation
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống trường này !";
        } else {
            $title = $_POST['title'];
        }
        //
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống trường này !";
        } else {
            $slug = $_POST['slug'];
        }
        //
        if (empty($_POST['parent_id'])) {   
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }

        ////
        if (empty($error)) {
            $data = array(
                'cat_title' => $title,
                'cat_slug' => $slug,
                'parent_id' => $parent_id,
                'creator' => $_SESSION['user_login'],
                'created_date' => date("Y-m-d"),
                'cat_status' => 'pending',
            );
            add_post_cat($data);
            $success['add_cat'] = "Thêm mới thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=posts&controller=category&action=list_cat'>"; // cách 1 (chuyển hướng tới trang login) 
        }
    }
    load_view('add_cat');
}

///////////////////////////////////////////////////////////////////////////////  search
function searchAction()
{
    global $error, $text;
    // kiểm tra button
    if (isset($_GET['btn_search'])) {
        $error = array();
        $text = array();
        // lấy dữ liệu keyword
        $keyword = addslashes($_GET['keyword']);
        // kiểm tra keyword 
        if (empty($keyword)) {
            $error['search'] = "Yêu cầu nhập dữ liệu vào ô trống !";
            load_view('list_cat');
        } else {
            $list_search_post = search_post_cat($keyword);
            $count = count($list_search_post);
            $data['list_search_post'] = $list_search_post;
            // kiểm tra count
            if ($count < 0) {
                $error['search'] = "Không tìm thấy kết quả với từ khóa: '" . $keyword . "'";
                load_view('search_cat', $data);
            } else {
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
                $list_post_cat_id = $_POST['checkItem'];
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
                        foreach ($list_post_cat_id as $cat_id) {
                            update_post_cat_status($data, $cat_id);
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
                        foreach ($list_post_cat_id as $cat_id) {
                            update_post_cat_status($data, $cat_id);
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
                        foreach ($list_post_cat_id as $cat_id) {
                            update_post_cat_status($data, $cat_id);
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
///////////////////////////////////////////////////////////////////////////////  update_cat
function update_catAction()
{
    global $error, $success, $title, $slug, $parent_id;
    if (isset($_POST['btn_update'])) {
        $error = array();
        //// validation
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống trường này !";
        } else {
            $title = $_POST['title'];
        }
        //
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống trường này !";
        } else {
            $slug = $_POST['slug'];
        }
        //
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $old_parent_id = 
            $parent_id = $_POST['parent_id'];
        }

        ////
        if (empty($error)) {
            $data = array(
                'cat_title' => $title,
                'cat_slug' => $slug,
                'parent_id' => $parent_id,
                'editor' => $_SESSION['user_login'],
                'edit_date' => date("Y-m-d"),
            );
            $cat_id = $_GET['cat_id'];
            update_post_cat($data, $cat_id);
            $success['update_cat'] = "Thêm mới thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=posts&controller=category&action=list_cat'>"; // cách 1 (chuyển hướng tới trang login) 
        }
    }
    $cat_id = $_GET['cat_id'];
    $info_cat = get_info_post_cat($cat_id);
    $data['info_cat'] = $info_cat;
    load_view('update_cat', $data);
}

///////////////////////////////////////////////////////////////////////////////  delete_cat
function delete_catAction()
{
    $cat_id = $_GET['cat_id'];
    delete_post_cat($cat_id);
    if (isset($_GET['keyword'])) {
        load_view('search_cat');
    } else {
        load_view('list_cat');
    }
}