<?php

function construct() {
//    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction() {
load_view('index');
}

/////////////////////////////////////////////////////// detail product
function detail_productAction() {
    $product_id = $_GET['product_id'];
    $info_product = get_info_product_by_product_id($product_id);
    $data['info_product'] = $info_product;
    load_view('detail_product', $data);
}