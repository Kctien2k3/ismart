<?php
get_header();
echo form_success('update');
$parent_cat = $info_product['parent_cat'];
$product_type = $info_product['product_type'];
$brand = $info_product['brand'];

$list_parent_cat = db_fetch_array('SELECT* FROM `tbl_product_cat` WHERE `parent_id` = 0');
$list_brands = db_fetch_array("SELECT DISTINCT `brand` FROM `tbl_products` WHERE `parent_cat` = '{$parent_cat}'");
$list_product_types = db_fetch_array("SELECT DISTINCT `product_type` FROM `tbl_products` WHERE `product_type` = '{$product_type}'");
// show_array($list_brands);

?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa chi tiết sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="product_title" id="product-name"
                            value="<?php echo $info_product['product_title']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('product_title') ?>

                        <label for="product-code">Mã sản phẩm:</label>
                        <input type="text" class="form-control" name="product_code" id="product-code"
                            value="<?php echo $info_product['product_code']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('product_code') ?>

                        <label for="slug" class="form-lable">Slug ( Friendly_url ):</label>
                        <input type="text" class="form-control" name="product_slug" id="slug"
                            value="<?php echo $info_product['product_slug']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('product_slug') ?>

                        <label for="price">Giá mới:</label>
                        <input type="text" class="form-control" name="product_price_new" id="price"
                            value="<?php echo $info_product['product_price_new']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('product_price_new') ?>

                        <label for="price">Giá cũ:</label>
                        <input type="text" class="form-control" name="product_price_old" id="price"
                            value="<?php echo $info_product['product_price_old']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('product_price_old') ?>

                        <label for="price">số lượng:</label>
                        <div class="col-3"><input type="number" class="form-control" name="product_qty" id="price"
                                value="<?php echo $info_product['product_qty']; ?>"></div>
                        <!-- //phần thông báo  --><?php echo form_error('product_qty') ?>

                        <label for="desc" class="mt-3">Mô tả ngắn:</label>
                        <textarea name="product_desc" class="ckeditor form-control"
                            id="editor"><?php echo $info_product['product_desc']; ?></textarea>
                        <!-- //phần thông báo  --><?php echo form_error('product_desc') ?>
                        <!-- <script>
                            ClassicEditor
                                .create(document.querySelector('#editor'))
                                .catch(error => {
                                    console.error(error);
                                });
                            
                        </script> -->
                        <label for="desc">Chi tiết sản phẩm:</label>
                        <div class="col-10"><textarea name="product_content" class="ckeditor form-control"
                                id="desc"><?php echo $info_product['product_content']; ?></textarea></div>
                        <!-- //phần thông báo  --><?php echo form_error('product_content') ?>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#desc'))
                                .catch(error => {
                                    console.error(error);
                                });

                        </script>


                        <label for="thumbnail" class="form-lable mt-4">Hình ảnh:</label>
                        <div class="clearfix col-6 mb-3">
                            <div class="fl-left">
                                <input type="file" id="upload-thumb" class="form-control" name="file" onchange="show_upload_image()">
                            </div>
                            <div class="fl-right">
                                <!-- <input type="submit" class="form-control" name="btn_upload" value="Upload" id="btn-upload-thumb"> -->
                            </div>
                        </div>
                        <!-- hiển thị hình ảnh  -->
                        <img id="upload-image" class="rounded upload-img" src="<?php if (!empty($info_product['product_thumb'])) {
                            echo $info_product['product_thumb'];
                        } else {
                            echo 'public/images/img-thumb.png';
                        } ?>">
                        <!-- //phần thông báo  --><?php echo form_error('upload') ?>



                        <label for="cat" class="form-lable mt-3">Danh mục sản phẩm:</label>
                        <select name="parent_cat" id="cat" class="select-parent-cat">
                            <option value="">-- Chọn danh mục --</option>
                            <?php if (!empty($list_parent_cat))
                                foreach ($list_parent_cat as $cat) {
                                    ?>
                                    <option <?php if (!empty($info_product['parent_cat']) && $info_product['parent_cat'] == $cat['cat_title'])
                                        echo "selected='selected'"; ?>
                                        value="<?php echo $cat['cat_title'] ?>"><?php echo $cat['cat_title'] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <!-- //phần thông báo  --><?php echo form_error('category') ?>


                        <?php echo form_error('parent_cat') ?>
                        <label>Thương hiệu</label>
                        <select name="brand" id="select-brand" class="select-brand">
                            <option value="">-- Chọn thương hiệu --</option>
                            <?php if (!empty($list_brands))
                                foreach ($list_brands as $item) {
                                    ?>
                                    <option <?php if (!empty($info_product['brand']) && $info_product['brand'] == $item['brand'])
                                        echo "selected='selected'"; ?>
                                        value="<?php echo $item['brand'] ?>"><?php echo $item['brand'] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <!-- //phần thông báo  --><?php echo form_error('brand') ?>


                        <label>Loại sản phẩm</label>
                        <select name="product_type" id="select-type" class="select-type">
                            <option value="">-- Chọn loại sản phẩm --</option>
                            <?php if (!empty($list_product_types))
                                foreach ($list_product_types as $item) {
                                    ?>
                                    <option <?php if (!empty($info_product['product_type']) && $info_product['product_type'] == $item['product_type'])
                                        echo "selected='selected'"; ?> value="<?php echo $item['product_type'] ?>">
                                        <?php echo $item['product_type'] ?>
                                    </option>
                                    <?php
                                }
                            ?>
                        </select>
                        <!-- //phần thông báo  --><?php echo form_error('product_type') ?>



                        <button type="submit" class="btn btn-primary mt-5" name="btn_update" id="btn-submit">Cập
                            nhật</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>