<?php
get_header();
$list_product = db_fetch_array("SELECT * FROM `tbl_products`");
?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img id="zoom" width="350px" height="280px"
                                    src="admin/<?php echo $info_product['product_thumb']; ?>"
                                    data-zoom-image="admin/<?php echo $info_product['product_thumb']; ?>" />
                            </a>
                            <div id="list-thumb">
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                                <a href=""
                                    data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg"
                                    data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                    <img id="zoom"
                                        src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                </a>
                            </div>
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="admin/<?php echo $info_product['product_thumb']; ?>" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name"><?php echo $info_product['product_title']; ?></h3>
                            <div class="desc">
                                <p><?php echo $info_product['product_desc']; ?></p>

                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status"><?php if ($info_product['sold_product'] >= $info_product['num_product']) {
                                    echo "Hết hàng";
                                } else {
                                    echo "Còn hàng";
                                } ?></span>
                            </div>
                            <p class="price"><?php echo currency_format($info_product['product_price_new']); ?></p>
                            <div id="num-order-wp">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" name="num-order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <a href="?mod=cart&action=add_cart&product_id=<?php echo $info_product['product_id']; ?>" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                        </div>
                    </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <p><?php echo $info_product['product_content']; ?></p>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
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
                                        <a href="?mod=cart&action=add_cart" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
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