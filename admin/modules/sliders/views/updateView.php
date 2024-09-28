<?php
get_header();
echo form_success('update');

?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa chi tiết thông tin slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="slider_title">Tên slider:</label>
                        <input type="text" class="form-control" name="slider_title" id="slider_title"
                            value="<?php echo $info_slider['slider_title']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('slider_title') ?>

                        <label for="product-code">link:</label>
                        <input type="text" class="form-control" name="slider_link" id="product-code"
                            value="<?php echo $info_slider['slider_link']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('slider_link') ?>

                        <label for="slug" class="form-lable">Slug ( Friendly_url ):</label>
                        <input type="text" class="form-control" name="slider_slug" id="slug"
                            value="<?php echo $info_slider['slider_slug']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('slider_slug') ?>



                        <label for="desc" class="mt-3">Mô tả:</label>
                        <textarea name="slider_desc" class="ckeditor form-control"
                            id="editor"><?php echo $info_slider['slider_desc']; ?></textarea>
                        <!-- //phần thông báo  --><?php echo form_error('slider_desc') ?>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#editor'))
                                .catch(error => {
                                    console.error(error);
                                });

                        </script>

                        <label for="slider_ordinal" class="form-lable mt-3">Thứ tự:</label>
                        <div class="col-3"><input type="number" class="form-control" name="slider_ordinal"
                                id="slider_ordinal" value="<?php echo $info_slider['slider_ordinal']; ?>"></div>
                        <!-- //phần thông báo  --><?php echo form_error('slider_ordinal') ?>

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
                        <img id="upload-image" class="rounded upload-img" src="<?php if (!empty($info_slider['slider_thumb'])) {
                            echo $info_slider['slider_thumb'];
                        } else {
                            echo 'public/images/img-thumb.png';
                        } ?>">
                        <!-- //phần thông báo  --><?php echo form_error('upload') ?>


                        <button type="submit" class="btn btn-primary mt-5" name="btn_update" id="btn-submit">Thêm
                            mới</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>