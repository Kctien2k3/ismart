<?php

function construct()
{
    //    echo "Dùng chung, load đầu tiên";
    load_model('index');
}

///////////////////////////////////////////////////////////////////////////////  list-add 
function menuAction()
{
    global $error, $success, $menu_title, $menu_url_static, $page_category, $product_category, $post_category, $menu_order;
    if (isset($_POST['btn_add'])) {
        $error = array();
        $success = array();
        ///// validation
        //
        if (empty($_POST['menu_title'])) {
            $error['menu_title'] = "Không được để trống trường này !";
        }else {
            $menu_title = $_POST['menu_title'];
        }
        //
        if (empty($_POST['menu_url_static'])) {
            $error['menu_url_static'] = "Không được để trống trường này !";
        }else {
            $menu_url_static = $_POST['menu_url_static'];
        }
        //
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "Không được để trống trường này !";
        }else {
            $menu_order = $_POST['menu_order'];
        }
        // 
            $page_category = $_POST['page_category'];
        //
            $product_category = $_POST['product_category'];  
        //     
            $post_category = $_POST['post_category'];   
         

        ////
        if (empty($error)) {
            $data = array(
                'menu_title' => $menu_title, 
                'menu_url_static' => $menu_url_static, 
                'page_category' => $page_category, 
                'product_category' => $product_category, 
                'post_category' => $post_category, 
                'menu_order' => $menu_order
            );
            add_menu($data);
            $success['add'] = "Thêm mới thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=widgets&controller=menu&action=menu'>"; // cách 1 (chuyển hướng tới trang login) 
        }

    }
    load_view('menu');
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
                $list_menu_id = $_POST['checkItem'];
            }
            ;
            // kiểm tra chọn tác vụ
            if (!empty($_POST['actions'])) {
                // chọn tác vụ = 1
                if ($_POST['actions'] == 1) {
                    // kiểm tra checkItem
                    if (isset($_POST['checkItem'])) {
                        foreach ($list_menu_id as $menu_id) {
                            menu_delete($menu_id);
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
    redirect('?mod=widgets&controller=menu&action=menu');

}
/////////////////////////////////////////////////////////////////////////////// udpate
function update_menuAction()
{
    global $error, $success, $menu_title, $menu_url_static, $page_category, $product_category, $post_category, $menu_order;
    if (isset($_POST['btn_update'])) {
        $error = array();
        $success = array();
        ///// validation
        //
        if (empty($_POST['menu_title'])) {
            $error['menu_title'] = "Không được để trống trường này !";
        }else {
            $menu_title = $_POST['menu_title'];
        }
        //
        if (empty($_POST['menu_url_static'])) {
            $error['menu_url_static'] = "Không được để trống trường này !";
        }else {
            $menu_url_static = $_POST['menu_url_static'];
        }
        //
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "Không được để trống trường này !";
        }else {
            $menu_order = $_POST['menu_order'];
        }
        // 
            $page_category = $_POST['page_category'];
        //
            $product_category = $_POST['product_category'];  
        //     
            $post_category = $_POST['post_category'];   
         

        ////
        if (empty($error)) {
            $data = array(
                'menu_title' => $menu_title, 
                'menu_url_static' => $menu_url_static, 
                'page_category' => $page_category, 
                'product_category' => $product_category, 
                'post_category' => $post_category, 
                'menu_order' => $menu_order
            );
            $menu_id = $_GET['menu_id'];
            update_menu($data, $menu_id);
            $success['update'] = "Cập nhật thành công";
            echo "<meta http-equiv='refresh' content='2;url=?mod=widgets&controller=menu&action=menu'>"; // cách 1 (chuyển hướng tới trang login) 
        }

    }
    $menu_id = $_GET['menu_id'];
    $info_menu = get_info_menu($menu_id);
    $data['info_menu'] = $info_menu;
    load_view('update_menu', $data);
}

/////////////////////////////////////////////////////////////////////////////// udpate
function delete_menuAction() {
    $menu_id = $_GET['menu_id'];
    menu_delete($menu_id);
    redirect('?mod=widgets&controller=menu&action=menu');
}
