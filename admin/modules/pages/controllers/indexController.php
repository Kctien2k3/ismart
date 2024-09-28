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


///////////////////////////////////////////////////////////////////////////////  add page
function addAction() {
    global $title, $slug, $content, $category, $error, $success;
    if (isset($_POST['btn_add'])) {
        $error = array();
        // validation
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống trường này !";
        }else {
            $title = $_POST['title'];
        }
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống trường này !";
        }else {
            $slug = $_POST['slug'];
        }
        if (empty($_POST['content'])) {
            $error['content'] = "Không được để trống trường này !";
        }else {
            $content = $_POST['content'];
        }
        if (empty($_POST['category'])) {
            $error['category'] = "Không được để trống trường này !";
        }else {
            $category = $_POST['category'];
        }

        //// 
        if (empty($error)) {
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'creator' => $_SESSION['user_login'],
                'created_date' => date("Y-m-d"),
                'active' => 'inactive',
                'status' => 'pending',
                'category' => $category
            );
            add_page($data);
            $success['add'] = "Thêm mới thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=pages&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        }
    };
    load_view('add');
}

///////////////////////////////////////////////////////////////////////////////  search 
function searchAction() {
    global $list_search_page, $error, $text;
    if (isset($_GET['btn_search'])) {
        $error = array();
        $text = array();
        $keyword = addslashes($_GET['keyword']);
        if (empty($keyword)) {
            $error['search'] = "Yêu cầu nhập dữ liệu vào ô trống !";
            load_view('index');
        }else {
            $list_search_page = search_page($keyword);
            $count = count($list_search_page);
            $data['list_search_page'] = $list_search_page;
            if ($count < 0) {
                $error['search'] = "Không tìm thấy kết quả với từ khóa: '" . $keyword . "'";
                load_view('search', $data);
            }else {
                $text['search'] = "Tìm thấy " . $count . " kết quả với từ khóa: '" . $keyword . "'";
                load_view('search', $data);
            }
        }
    }
}

/////////////////////////////////////////////////////////////////////////////// apply status
function apply_statusAction() {
    global $error, $data;
    // kiểm tra button
    if (isset($_POST['sm_action'])) {
        // kiểm tra phân quyền 
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            // thực hiện đẩy page_id vào check_item
            if (!empty($_POST['checkItem'])) {
                $list_page_id = $_POST['checkItem'];
            }
            // thực hiện chức năng 
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra chọn đối tượng
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'approved',
                        );
                        foreach ($list_page_id as $page_id) {
                            update_page_status($data, $page_id);
                        }
                    }else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần thực hiện !";
                    }   
                }
                // chọn tác vụ = 2 
                if ($_POST['actions'] == 2) {
                    // kiểm tra chọn đối tượng
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'pending',
                        );
                        foreach ($list_page_id as $page_id) {
                            update_page_status($data, $page_id);
                        }
                    }else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần thực hiện !";
                    }   
                }
                // chọn tác vụ = 3 
                if ($_POST['actions'] == 3) {
                    // kiểm tra chọn đối tượng
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'trash',
                        );
                        foreach ($list_page_id as $page_id) {
                            update_page_status($data, $page_id);
                        }
                    }else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần thực hiện !";
                    }   
                }
            }else {
                $error['apply'] = "Bạn chưa chọn tác vụ !";
            }
        }else {
            $error['apply'] = "Tài khoản này của bạn không có quyền thực hiện chức năng này !";
        }
    }
    if (isset($_GET['keyword'])) {
        load_view('search');
    } else {
        load_view('index');
    }
}

/////////////////////////////////////////////////////////////////////////////// update page
function updateAction() {
    global $title, $slug, $content, $category, $error, $success;
    if (isset($_POST['btn_update'])) {
        $error = array();
        // validation
        if (empty($_POST['title'])) {
            $error['title'] = "Không được để trống trường này !";
        }else {
            $title = $_POST['title'];
        }
        if (empty($_POST['slug'])) {
            $error['slug'] = "Không được để trống trường này !";
        }else {
            $slug = $_POST['slug'];
        }
        if (empty($_POST['content'])) {
            $error['content'] = "Không được để trống trường này !";
        }else {
            $content = $_POST['content'];
        }
        if (empty($_POST['category'])) {
            $error['category'] = "Không được để trống trường này !";
        }else {
            $category = $_POST['category'];
        }

        //// 
        if (empty($error)) {
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'creator' => $_SESSION['user_login'],
                'created_date' => date("Y-m-d"),
                'active' => 'inactive',
                'category' => $category
            );
            $page_id = $_GET['page_id'];
            update_page($data, $page_id);
            $success['add'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=pages&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        }
    };
    $page_id = $_GET['page_id'];
    $info_page = get_info_page_by_page_id($page_id);
    $data['info_page'] = $info_page;
    // print_r($info_page);
    load_view('update', $data);
}

/////////////////////////////////////////////////////////////////////////////// delete page 
function deleteAction(){
    $page_id = $_GET['page_id'];
    delete_page($page_id);
    if (isset($_GET['keyword'])) {
        load_view('search');
    } else {
        load_view('index');
    }
}


