<?php
$list_cat_0 = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = 0");
$list_product = db_fetch_array("SELECT * FROM `tbl_products` ORDER BY `sold_product` DESC");
$list_best_selling = array_slice($list_product, 0, 8);
?>
<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php if (!empty($list_cat_0)) { ?>
                <ul class="list-item">
                    <?php foreach ($list_cat_0 as $cat_0) {
                        $list_cat_1 = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = '{$cat_0['cat_id']}'");
                        ?>
                        <li>
                            <a href="?page=category_product" title=""><?php echo $cat_0['cat_title']; ?></a>
                            <?php if (!empty($list_cat_1)) { ?>
                                <ul class="sub-menu">
                                    <?php foreach ($list_cat_1 as $cat_1) {
                                        $list_cat_2 = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = '{$cat_1['cat_id']}'");
                                        ?>
                                        <li>
                                            <a href="?page=category_product" title=""><?php echo $cat_1['cat_title']; ?></a>
                                            <?php if (!empty($list_cat_2)) { ?>
                                                <ul class="sub-menu">
                                                    <?php foreach ($list_cat_2 as $cat_2) { ?>
                                                        <li>
                                                            <a href="?page=category_product" title=""><?php echo $cat_2['cat_title']; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <?php if (!empty($list_best_selling)) { ?>
                <ul class="list-item">
                    <?php foreach ($list_best_selling as $best_selling) { ?>
                        <li class="clearfix">
                            <a href="?mod=products&action=detail_product&product_id=<?php echo $best_selling['product_id']; ?>" title="" class="thumb fl-left">
                                <img src="admin/<?php echo $best_selling['product_thumb']; ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="?mod=products&action=detail_product&product_id=<?php echo $best_selling['product_id']; ?>" title="" class="product-name"><?php echo $best_selling['product_title']; ?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($best_selling['product_price_new']); ?></span>
                                    <span class="old"><?php echo currency_format($best_selling['product_price_old']); ?></span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>