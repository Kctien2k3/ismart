<?php
get_header();
echo form_success('add');
$parent_cat = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = 0");
$data_cat = get_list_product_cat();
$list_cat = data_tree($data_cat, 0);

?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="product-name">Tên sản phẩm:</label>
                        <input type="text" class="form-control" name="product_title" id="product-name">
                        <!-- //phần thông báo  --><?php echo form_error('product_title') ?>

                        <label for="product-code">Mã sản phẩm:</label>
                        <input type="text" class="form-control" name="product_code" id="product-code">
                        <!-- //phần thông báo  --><?php echo form_error('product_code') ?>

                        <label for="slug" class="form-lable">Slug ( Friendly_url ):</label>
                        <input type="text" class="form-control" name="product_slug" id="slug">
                        <!-- //phần thông báo  --><?php echo form_error('product_slug') ?>

                        <label for="price">Giá sản phẩm:</label>
                        <input type="text" class="form-control" name="product_price_new" id="price">
                        <!-- //phần thông báo  --><?php echo form_error('product_price_new') ?>

                        <label for="price">số lượng:</label>
                        <div class="col-3"><input type="number" class="form-control" name="product_qty" id="price">
                        </div>
                        <!-- //phần thông báo  --><?php echo form_error('product_qty') ?>

                        <label for="desc" class="mt-3">Mô tả ngắn:</label>
                        <textarea name="product_desc" class="ckeditor form-control" id="editor"></textarea>
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
                                id="desc"></textarea></div>
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
                                <input type="file" class="form-control" name="file" onchange="show_upload_image()">
                            </div>
                            <div class="fl-right">
                                <!-- <input type="submit" class="form-control" name="btn_upload" value="Upload" id="btn-upload-thumb"> -->
                            </div>
                        </div>
                        <!-- hiển thị hình ảnh  -->
                        <img id="upload-image" class="rounded upload-img" src="public/<?php if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
                            echo 'images/product/' . $_FILES['file']['name'];
                        } else {
                            echo 'public/images/img-thumb.png';
                        } ?>">
                        <!-- //phần thông báo  --><?php echo form_error('upload') ?>




                        <label for="cat" class="form-lable mt-3">Danh mục sản phẩm:</label>
                        <select name="parent_cat" id="cat" class="select-parent-cat">
                            <option value="0">--Chọn danh mục--</option>
                            <?php
                            foreach ($parent_cat as $cat) {
                                ?>
                                <option value="<?php echo $cat['cat_title'] ?>"><?php echo $cat['cat_title'] ?></option>
                            <?php } ?>
                        </select>
                        <!-- //phần thông báo  --><?php echo form_error('parent_cat') ?>


                        <?php echo form_error('parent_cat')?> 
                        <label>Thương hiệu</label>
                        <select name="brand" id="select-brand" class="select-brand">
                            <option value="">-- Chọn thương hiệu --</option>
                        </select>
                         <!-- //phần thông báo  --><?php echo form_error('brand')?> 


                        <label>Loại sản phẩm</label>
                        <select name="product_type" id="select-type" class="select-type">
                            <option value="">-- Chọn loại sản phẩm --</option>                           
                        </select>
                         <!-- //phần thông báo  --><?php echo form_error('product_type')?> 


                        <button type="submit" class="btn btn-primary mt-5" name="btn_add" id="btn-submit">Thêm
                            mới</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>