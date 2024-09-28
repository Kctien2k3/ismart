<?php
/////////// thêm vào giỏ hàng
function add_cart($product_id) {
    // lấy thông tin sản phẩm khi được thêm vào giỏ hàng
    $product_id = $_GET['product_id'];
    $item = get_info_product_by_product_id($product_id);
    // show_array($item);
    // thêm thông tin vào giỏ hàng
    $qty = 1;
    if (isset($_SESSION['cart']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
        $qty = $_SESSION['cart']['buy'][$product_id]['qty'] + 1;
    }
    $_SESSION['cart']['buy'][$product_id] = array(
        'product_id' => $item['product_id'],
        'product_thumb' => $item['product_thumb'],
        'product_title' => $item['product_title'],
        'product_price' => $item['product_price_new'],
        'product_code' => $item['product_code'],
        'qty' => $qty,
        'sub_total' => $item['product_price_new'] * $qty,
    );
    // show_array($_SESSION['cart']);
    update_info_cart();
}

function update_info_cart() {
    if (isset($_SESSION['cart'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['product_qty'];
            $total += $item['sub_total'];
        }
    
        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total
        );
    }
}

function get_list_by_cart() {
    
    if (isset($_SESSION['cart']['buy'])) {
        return $_SESSION['cart']['buy'];
        foreach ($_SESSION['cart']['buy'] as &$item) {
            $item['url_delete_cart'] = "?mod=cart&acion=delete_cart&product_id={$item['product_id']}";
            // $item['url'] = "?mod=product&action=detail_product&product_id={$item['product_id']}";

        }
        return $_SESSION['cart']['buy'];
    }
    return false;
}

// function get_list_product_by_cat_id($cat_id) {
//     global $list_product;
//     $result = array();
//     foreach ($list_product as $item) {
//         if ($item['cat_id'] == $cat_id) {
//             $item['url'] = "?mod=product&action=detail_product&product_id={$item['product_id']}";
//             $result = $item;
//         }
//     }
//     return $result;
// }

function delete_cart($product_id) {
    if (isset($_SESSION['cart'])) {
        if (!empty($product_id)) {
            unset($_SESSION['cart']['buy'][$product_id]);
            update_info_cart();
        }else {
            unset($_SESSION['cart']);
        }
    }
}

function get_total_cart() {
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

function update_cart($qty) {
    foreach ($qty as $product_id => $new_qty) {
        $_SESSION['cart']['buy'][$product_id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$product_id]['sub_total'] = $new_qty * $_SESSION['cart']['buy'][$product_id]['price'];
    }
    update_info_cart();
}

