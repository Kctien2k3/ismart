<?php
function currency_format($number, $suffix = 'đ'){
    return number_format($number).$suffix;
}

function status_color($status){
    if(!empty($status) && $status == 'approved' || $status == 'success'){
        echo 'text-success btn btn-outline-success';
    } else if(!empty($status) && $status == 'pending'){
        echo 'text-warning btn btn-outline-warning';
    } else{
        echo 'text-danger btn btn-outline-danger';
    }
}