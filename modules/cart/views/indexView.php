<?php
get_header();
// show_array($_SESSION['cart']['buy'])
$list_cart = get_list_by_cart();
$total = get_total_cart();
// show_array($list_cart);
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Sản phẩm làm đẹp da</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php if (!empty($list_cart)) { ?>

            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <form action="?mod=cart&action=update_cart" method="POST">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_cart as $cart) { ?>
                                <tr>
                                    <td><?php echo $cart['product_code']; ?></td>
                                    <td>
                                        <a href="" title="" class="thumb">
                                            <img src="admin/<?php if (!empty($cart['product_thumb'])) {
                                                echo $cart['product_thumb'];
                                            } else {
                                                echo "/public/images/logo.png";
                                            } ?>">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="" title="" class="name-product"><?php echo $cart['product_title']; ?></a>
                                    </td>
                                    <td><?php echo currency_format($cart['product_price']); ?></td>
                                    <td>
                                        <input type="number" min="1" max="10" data-id="<?php echo $cart['product_id'] ?>" name="qty[<?php echo $item['product_id']; ?>]" value="<?php echo $cart['qty']; ?>"
                                            class="num-order">
                                    </td>   
                                    <td><?php echo currency_format($cart['sub_total']); ?></td>
                                    <td>
                                        <a href="?mod=cart&action=delete_cart&product_id=<?php echo $cart['product_id'] ?>"
                                            title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($total);?></span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <!-- <a href="" title="" id="update-cart">Cập nhật giỏ hàng</a> -->
                                            <a href="?page=checkout" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng
                        <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.
                    </p>
                    <a href="?page=home" title="" id="buy-more">Mua tiếp</a><br />
                    <a href="" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        <?php } else { ?>
            <p>Không có sản phẩm nào trong giỏ hàng</p>
        <?php } ?>
    </div>
</div>
<?php
get_footer(); ?>