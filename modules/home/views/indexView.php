<?php
get_header();
$list_product = db_fetch_array("SELECT * FROM `tbl_products`");
// $list_product_phone = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_cat` = '{$}'");
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="public/images/slider-01.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_product)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_product as $product) { ?>
                                <li>
                                    <a href="?mod=products&action=detail_product&product_id=<?php echo $product['product_id']; ?>"
                                        title="" class="thumb">
                                        <img src="admin/<?php if (!empty($product['product_thumb'])) {
                                            echo $product['product_thumb'];
                                        } else {
                                            echo "/public/images/logo.png";
                                        } ?>">
                                    </a>
                                    <a href="?page=detail_product" title=""
                                        class="product-name"><?php echo $product['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product['product_price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($product['product_price_old']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?mod=cart&action=add_cart&product_id=<?php echo $product['product_id']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?page=checkout" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_product)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_product as $product) { ?>
                                <li>
                                    <a href="?page=detail_product" title="" class="thumb">
                                        <img src="public/images/img-pro-16.png">
                                    </a>
                                    <a href="?page=detail_product" title="" class="product-name">Motorola Moto G5S Plus</a>
                                    <div class="price">
                                        <span class="new">6.990.000đđ</span>
                                        <span class="old">8.990.000đđ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_product)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_product as $product) { ?>
                                <li>
                                    <a href="?page=detail_product" title="" class="thumb">
                                        <img src="admin/<?php if (!empty($product['product_thumb'])) {
                                            echo $product['product_thumb'];
                                        } else {
                                            echo "/public/images/logo.png";
                                        } ?>">
                                    </a>
                                    <a href="?page=detail_product" title=""
                                        class="product-name"><?php echo $product['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product['product_price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($product['product_price_old']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?page=checkout" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_product)) { ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_product as $product) { ?>
                                <li>
                                    <a href="?page=detail_product" title="" class="thumb">
                                        <img src="admin/<?php if (!empty($product['product_thumb'])) {
                                            echo $product['product_thumb'];
                                        } else {
                                            echo "/public/images/logo.png";
                                        } ?>">
                                    </a>
                                    <a href="?page=detail_product" title=""
                                        class="product-name"><?php echo $product['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product['product_price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($product['product_price_old']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?page=checkout" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
?>