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
    global $error, $product_title, $product_desc, $product_slug, $product_code, $product_content,
    $product_price_new, $product_qty, $product_status, $product_thumb, $success;
    if (isset($_POST['btn_add'])) {
        $error = array();
        $success = array();
        ////// validation
        //
        if (empty($_POST['product_title'])) {
            $error['product_title'] = "Không được để trống trường này !";
        } else {
            $product_title = $_POST['product_title'];
        }
        //
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Không được để trống trường này !";
        } else {
            $product_code = $_POST['product_code'];
        }
        // 
        if (empty($_POST['product_slug'])) {
            $error['product_slug'] = "Không được để trống trường này !";
        } else {
            $product_slug = $_POST['product_slug'];
        }
        //
        if (empty($_POST['product_price_new'])) {
            $error['product_price_new'] = "Không được để trống trường này !";
        } else {
            $product_price_new = $_POST['product_price_new'];
        }
        // 
        if (empty($_POST['product_qty'])) {
            $error['product_qty'] = "Không được để trống trường này !";
        } else {
            $product_qty = $_POST['product_qty'];
        }
        // 
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống trường này !";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        // 
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Không được để trống trường này !";
        } else {
            $product_content = $_POST['product_content'];
        }
        // 
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "Không được để trống trường này !";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }
        // 
        if (empty($_POST['brand'])) {
            $error['brand'] = "Không được để trống trường này !";
        } else {
            $brand = $_POST['brand'];
        }
        // 
        if (empty($_POST['product_type'])) {
            $product_type = $_POST['product_type'];
        }

        // check upload img
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // ktra type và size
            $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            if (!is_img($file_type, $file_size)) {
                $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
            } else {
                $product_thumb = upload_img('public/images/product/', $file_type);
            }
        } else {
            $error['upload'] = "Bạn chưa Upload tệp ảnh !";
        }


        ///////
        if (empty($error)) {
            // $product_thumb = upload_img('public/images/product/', $file_type);
            $data = array(
                'product_title' => $product_title,
                'product_code' => $product_code,
                'product_slug' => $product_slug,
                'product_thumb' => $product_thumb,
                'product_price_new' => $product_price_new,
                'product_desc' => $product_desc,
                'product_content' => $product_content,
                'parent_cat' => $parent_cat,
                'brand' => $brand,
                'product_type' => $product_type,
                'product_status' => 'pending',
                'creator' => $_SESSION['user_login'],
                'created_date' => date("Y-m-d"),

            );
            add_product($data);
            $success['add'] = "Thêm mới thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=products&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        }

    }
    // if (isset($_POST['btn_upload'])) {
    //     if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    //         // kiểm tra type và size
    //         $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    //         $file_size = $_FILES['file']['size'];
    //         if (!is_img($file_type, $file_size)) {
    //             $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
    //         } else {
    //             $product_thumb = upload_img('public/images/product/', $file_type);
    //         }
    //     } else {
    //         $error['upload'] = "Bạn chưa chọn tệp ảnh !";
    //     }
    //     print_r($product_thumb);
    // }
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
            $list_search_product = search_product($keyword);
            $count = count($list_search_product);
            $data['list_search_product'] = $list_search_product;
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
                $list_product_id = $_POST['checkItem'];
            }
            ;
            // kiểm tra chọn tác vụ
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'product_status' => 'approved',

                        );
                        foreach ($list_product_id as $product_id) {
                            update_product_status($data, $product_id);
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
                            'product_status' => 'pending',

                        );
                        foreach ($list_product_id as $product_id) {
                            update_product_status($data, $product_id);
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
                            'product_status' => 'trash',

                        );
                        foreach ($list_product_id as $product_id) {
                            update_product_status($data, $product_id);
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
    global $error, $product_title, $product_desc, $product_slug, $product_code, $product_content,
    $product_price_new, $product_price_old, $product_qty, $product_status, $product_thumb, $success;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        ////// validation
        //
        if (empty($_POST['product_title'])) {
            $error['product_title'] = "Không được để trống trường này !";
        } else {
            $product_title = $_POST['product_title'];
        }
        //
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "Không được để trống trường này !";
        } else {
            $product_code = $_POST['product_code'];
        }
        // 
        if (empty($_POST['product_slug'])) {
            $error['product_slug'] = "Không được để trống trường này !";
        } else {
            $product_slug = $_POST['product_slug'];
        }
        //
        if (empty($_POST['product_price_new'])) {
            $error['product_price_new'] = "Không được để trống trường này !";
        } else {
            $product_price_new = $_POST['product_price_new'];
        }
        //
        if (empty($_POST['product_price_old'])) {
            $error['product_price_old'] = "Không được để trống trường này !";
        } else {
            $product_price_old = $_POST['product_price_old'];
        }
        // 
        if (empty($_POST['product_qty'])) {
            $error['product_qty'] = "Không được để trống trường này !";
        } else {
            $product_qty = $_POST['product_qty'];
        }
        // 
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Không được để trống trường này !";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        // 
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Không được để trống trường này !";
        } else {
            $product_content = $_POST['product_content'];
        }
        // 
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "Không được để trống trường này !";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }
        // 
        if (empty($_POST['brand'])) {
            $error['brand'] = "Không được để trống trường này !";
        } else {
            $brand = $_POST['brand'];
        }
        // 
        if (!empty($_POST['product_type'])) {
            $product_type = $_POST['product_type'];
        }
        // check upload img
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            // ktra type và size
            $file_type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $file_size = $_FILES['file']['size'];
            if (!is_img($file_type, $file_size)) {
                $error['upload'] = "Kích thước hoặc kiểu ảnh không phù hợp !";
            } else {
                $product_id = $_GET['product_id'];
                $old_thumb = get_product_img('product_thumb', $product_id);
                if (!empty($old_thumb)) {
                    delete_img($old_thumb);
                    $product_thumb = upload_img('public/images/product/', $file_type);
                } else {
                    $product_thumb = upload_img('public/images/product/', $file_type);
                }
            }
        } else {
            $product_id = $_GET['product_id'];
            $old_thumb = get_product_img('product_thumb', $product_id);
        }

        ///////
        if (empty($error)) {
            $data = array(
                'product_title' => $product_title,
                'product_code' => $product_code,
                'product_slug' => $product_slug,
                'product_thumb' => $product_thumb,
                'product_price_new' => $product_price_new,
                'product_price_old' => $product_price_old,
                'product_qty' => $product_qty,
                'product_desc' => $product_desc,
                'product_content' => $product_content,
                'parent_cat' => $parent_cat,
                'brand' => $brand,
                'product_type' =>  $product_type,
                'editor' => $_SESSION['user_login'],
                'edit_date' => date("Y-m-d"),

            );
            $product_id = $_GET['product_id'];
            update_product($data, $product_id);
            $success['update'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=products&action=index'>"; // cách 1 (chuyển hướng tới trang login) 
        }

    }
    $product_id = $_GET['product_id'];
    $info_product = get_info_product_by_product_id($product_id);
    $data['info_product'] = $info_product;
    load_view('update', $data);
}

///////////////////////////////////////////////////////////////////////////////  delete
function deleteAction()
{
    $product_id = $_GET['product_id'];
    delete_product($product_id);
    if (isset($_GET['keyword'])) {
        load_view('search');
    } else {
        load_view('index');
    }
}
/////////////////////////////////////////////////////////////////////////////// select 
function select_brandAction()
{
    $select_brand = '<option value="">-- Chọn thương hiệu --</option>' 
    ;

    if (!empty($_POST['parent_cat'])) {
        $cat_title = $_POST['parent_cat'];
        $list_brand = array();
        $data_cat = db_fetch_array('SELECT* FROM `tbl_product_cat`');
        $list_cat = data_tree($data_cat, 0);
        foreach ($list_cat as $cat) {
            if ($cat_title == $cat['cat_title']) {
                $cat_id = $cat['cat_id'];
                foreach ($list_cat as $cat_child) {
                    if ($cat_child['parent_id'] == $cat_id) {
                        $list_brand[] = $cat_child['cat_title'];
                    }
                }
            }
        }
    }
    foreach ($list_brand as $brand) {
        $select_brand .= '
                <option value="' . $brand . '">' . $brand . '</option>
        ';
    }
    // }
    echo $select_brand;
    // echo "thằng chó rách";
}
function select_typeAction()
{
    $select_type = '<option value="">-- Chọn mục sản phẩm --</option>';
    if (!empty($_POST['type'])) {
        $cat_title = $_POST['type'];
        $list_type = array();
        $data_cat = db_fetch_array('SELECT* FROM `tbl_product_cat`');
        $list_cat = data_tree($data_cat, 0);
        foreach ($list_cat as $cat) {
            if ($cat_title == $cat['cat_title']) {
                $cat_id = $cat['cat_id'];
                foreach ($list_cat as $cat_child) {
                    if ($cat_child['parent_id'] == $cat_id) {
                        $list_type[] = $cat_child['cat_title'];
                    }
                }
            }
        }
        foreach ($list_type as $type) {
            $select_type .= '
                <option value="' . $type . '">' . $type . '</option>
        ';
        }
    }
    echo $select_type;
}
