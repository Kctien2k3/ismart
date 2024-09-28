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
// function searchAction()
// {
//     global $error, $text;
//     if (isset($_GET['btn_search'])) {
//         $error = array();
//         $text = array();
//         $keyword = addslashes($_GET['keyword']);
//         if (empty($keyword)) {
//             $error['search'] = "Yêu cầu nhập dữ liệu vào ô trống !";
//             load_view('index');
//         } else {
//             $list_search_order = search_order($keyword);
//             $count = count($list_search_order);
//             $data['list_search_order'] = $list_search_order;
//             if ($count < 0) {
//                 $error['search'] = "Không tìm thấy kết quả với từ khóa: '" . $keyword . "'";
//                 load_view('search', $data);
//             } else {
//                 $text['search'] = "Tìm thấy " . $count . " kết quả với từ khóa '" . $keyword . "'";
//                 load_view('search', $data);
//             }
//         }
//     }
// }

/////////////////////////////////////////////////////////////////////////////// apply status
// function apply_statusAction()
// {
//     global $error, $data;
//     // kiểm tra button
//     if (isset($_POST['sm_action'])) {
//         $error = array();
//         // kiểm tra phân quyền
//         if (is_login() && check_role($_SESSION['user_login']) == 1) {
//             // đẩy post_id vào mảng
//             if (!empty($_POST['checkItem'])) {
//                 $list_menu_id = $_POST['checkItem'];
//             }
//             ;
//             // kiểm tra chọn tác vụ
//             if (!empty($_POST['actions'])) {
//                 // chọn tác vụ = 1
//                 if ($_POST['actions'] == 1) {
//                     // kiểm tra checkItem
//                     if (isset($_POST['checkItem'])) {
//                         foreach ($list_menu_id as $menu_id) {
//                             menu_delete($menu_id);
//                         }
//                     } else {
//                         $error['apply'] = "Bạn chưa chọn đối tượng cần áp dụng !";
//                     }
//                 }
//             } else {
//                 $error['apply'] = "Bạn chưa chọn tác vụ !";
//             }
//         } else {
//             $error['apply'] = "Tài khoản này của bạn không có quyền thực hiện chức năng này !";
//         }
//     }
//     redirect('?mod=widgets&controller=menu&action=menu');

// }



