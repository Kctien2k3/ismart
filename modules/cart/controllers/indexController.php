<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
   
    load_view('index');
}

function add_cartAction() {
    $product_id = (int)$_GET['product_id'];
    add_cart($product_id);
    redirect('?mod=cart&action=index');
}

function delete_cartAction() {
    $product_id = (int)$_GET['product_id'];
    delete_cart($product_id);
    redirect('?mod=cart&action=index');

}

function update_cartAction() {
    $product_id = (int)$_GET['product_id'];
    // update_cart($product_id);
    $qty = $_POST['qty'];
    $item = get_info_product_by_product_id($product_id);
    if (isset($_SESSION['cart']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
        // cập nhật số lượng 
        $_SESSION['cart']['buy'][$product_id]['qty'] = $qty;
        // cập nhật số tiền thanh toán
        $sub_total = $qty * $item['product_price_new'];
        $_SESSION['cart']['buy'][$product_id]['sub_total'] =  $sub_total;
        // cập nhật
        update_info_cart();
        $infor_cart = get_info_cart();
        $total = $infor_cart['total'];
        $data = array(
            'sub_total'=> currency_format($sub_total),
            'total' => currency_format($total),
        );
        echo json_encode($data);
    }

    redirect('?mod=cart&action=index');
}


