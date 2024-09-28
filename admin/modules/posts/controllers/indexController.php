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
function addAction()
{
    global $error, $success, $title, $slug, $content, $desc, $category, $thumbnail, $parent_cat;
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
        if (empty($_POST['content'])) {
            $error['content'] = "Không được để trống trường này !";
        } else {
            $content = $_POST['content'];
        }
        // 
        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống trường này !";
        } else {
            $desc = $_POST['desc'];
        }
        // 
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "Không được để trống trường này !";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }

        // kiểm tra upload ảnh 
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // ktra type và size
            $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            if (!is_img($file_type, $file_size)) {
                $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
            } else {
                $thumbnail = upload_img('public/images/post/', $file_type);
            }
        } else {
            $error['upload'] = "Bạn chưa Upload tệp ảnh !";
        }

        ///// 
        if (empty($error)) {
            // $thumbnail = upload_img('public/images/post/', $file_type);
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'thumbnail' => $thumbnail,
                'parent_cat' => $parent_cat,
                'status' => 'pending',
                'creator' => $_SESSION['user_login'],
                'created_date' => date("Y-m-d"),
                'post_desc' => $desc,
            );
            add_post($data);
            $success['add'] = "Thêm mới thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=posts&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        } else {
            print_r($error);
        }
    }
    //// kiểm tra upload ảnh 
    // if (isset($_POST['btn_upload'])) {
    //     if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    //         // kiểm tra type và size
    //         $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    //         $file_size = $_FILES['file']['size'];
    //         if (!is_img($file_type, $file_size)) {
    //             $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
    //         } else {
    //             $thumbnail = upload_img('public/images/post/', $file_type);
    //         }

    //     } else {
    //         $error['upload'] = "Bạn chưa chọn tệp ảnh !";
    //     }
    //     // print_r($thumbnail);
    // }

    load_view('add');
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
            load_view('index');
        } else {
            $list_search_post = search_post($keyword);
            $count = count($list_search_post);
            $data['list_search_post'] = $list_search_post;
            // kiểm tra count
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
                $list_post_id = $_POST['checkItem'];
            }
            ;
            // kiểm tra chọn tác vụ
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'approved',
                            'approver' => $_SESSION['user_login'],
                            'approve_date' => date("Y-m-d")
                        );
                        foreach ($list_post_id as $post_id) {
                            update_post_status($data, $post_id);
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
                            'status' => 'pending',
                            'approver' => 'none',
                            'approve_date' => ''
                        );
                        foreach ($list_post_id as $post_id) {
                            update_post_status($data, $post_id);
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
                            'status' => 'trash',
                            'approver' => 'none',
                            'approve_date' => ''
                        );
                        foreach ($list_post_id as $post_id) {
                            update_post_status($data, $post_id);
                        }
                    } else {
                        $error['apply'] = "Bạn chưa chọn đối tượng cần áp dụng !";
                    }
                }
            } else {
                $error['apply'] = "Bạn chưa chọn tác vụ !";
            }
        }
        //// quyền cấp 2
        if (is_login() && check_role($_SESSION['user_login']) == 2) {
            // đẩy post_id vào mảng
            if (!empty($_POST['checkItem'])) {
                $list_post_id = $_POST['checkItem'];
            }
            ;
            // kiểm tra chọn tác vụ
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'status' => 'approved',
                            'approver' => $_SESSION['user_login'],
                            'approve_date' => date("Y-m-d")
                        );
                        foreach ($list_post_id as $post_id) {
                            update_post_status($data, $post_id);
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
                            'status' => 'pending',
                            'approver' => 'none',
                            'approve_date' => ''
                        );
                        foreach ($list_post_id as $post_id) {
                            update_post_status($data, $post_id);
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
                            'status' => 'trash',
                            'approver' => 'none',
                            'approve_date' => ''
                        );
                        foreach ($list_post_id as $post_id) {
                            update_post_status($data, $post_id);
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
    global $error, $success, $title, $slug, $content, $desc, $category, $thumbnail, $parent_cat;
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
        if (empty($_POST['content'])) {
            $error['content'] = "Không được để trống trường này !";
        } else {
            $content = $_POST['content'];
        }
        // 
        if (empty($_POST['desc'])) {
            $error['desc'] = "Không được để trống trường này !";
        } else {
            $desc = $_POST['desc'];
        }
        // 
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "Không được để trống trường này !";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }
        // kiểm tra upload ảnh 
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // ktra type và size
            $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            if (!is_img($file_type, $file_size)) {
                $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
            } else {
                $post_id = $_GET['post_id'];
                $old_thumb = get_post_img('thumbnail', $post_id);
                if (!empty($old_thumb)) {
                    delete_img($old_thumb);
                    $thumbnail = upload_img('public/images/post/', $file_type);
                } else {
                    $thumbnail = upload_img('public/images/post/', $file_type);
                }
            }
        } else {
            $post_id = $_GET['post_id'];
            $old_thumb = get_post_img('thumbnail', $post_id);
        }

        /////   
        if (empty($error)) {
            $data = array(
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'thumbnail' => $thumbnail,
                'parent_cat' => $parent_cat,
                'editor' => $_SESSION['user_login'],
                'edit_date' => date("Y-m-d"),
                'post_desc' => $desc,

            );
            $post_id = $_GET['post_id'];
            update_post($data, $post_id);
            $success['add'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=posts&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        } else {
            print_r($error);
        }
    }
    $post_id = $_GET['post_id'];
    $info_post = get_info_post($post_id);
    $data['info_post'] = $info_post;
    load_view('update', $data);
}
///////////////////////////////////////////////////////////////////////////////  delete
function deleteAction()
{
    $post_id = $_GET['post_id'];
    delete_post($post_id);
    if (isset($_GET['keyword'])) {
        load_view('search');
    } else {
        load_view('index');
    }
}


