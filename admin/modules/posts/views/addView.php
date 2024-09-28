<?php
get_header();
echo form_success('add');
$data_cat = db_fetch_array("SELECT * FROM `tbl_post_cat`");
$list_cat = data_tree($data_cat, 0);

?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm mới bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="title" class="form-lable">Tiêu đề:</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <!-- //phần thông báo  --><?php echo form_error('title') ?>

                        <label for="slug" class="form-lable">Slug ( Friendly_url ):</label>
                        <input type="text" class="form-control" name="slug" id="slug">
                        <!-- //phần thông báo  --><?php echo form_error('slug') ?>


                        <label for="content" class="form-lable">Nội dung bài viết:</label>
                        <textarea name="content" class="ckeditor form-control" id="editor"></textarea>
                        <!-- //phần thông báo  --><?php echo form_error('content') ?>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#editor'))
                                .catch(error => {
                                    console.error(error);
                                });
                            
                        </script>

                        <label for="editor" class="form-lable mt-4">Mô tả bài viết:</label>
                        <textarea name="desc" class="ckeditor form-control" id="desc"></textarea>
                        <!-- //phần thông báo  --><?php echo form_error('desc') ?>
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
                                <input type="file" class="form-control" name="file">
                            </div>
                            <div class="fl-right">
                                <!-- <input type="submit" class="form-control" name="btn_upload" value="Upload" id="btn-upload-thumb"> -->
                            </div>
                        </div>
                        <!-- hiển thị hình ảnh  -->
                        <img id="upload-image" class="rounded upload-img" src="public/<?php if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
                                    echo 'images/post/' . $_FILES['file']['name'];
                        }else { 
                            echo 'public/images/img-thumb.png';
                            } ?>">
                        <!-- //phần thông báo  --><?php echo form_error('upload') ?>

                        

                        <label for="cat" class="form-lable mt-3">Danh mục cha:</label>
                        <select name="parent_cat" id="cat">
                            <option value="0">--Chọn danh mục--</option>
                            <?php
                            if (!empty($list_cat)) {
                                foreach ($list_cat as $cat) { ?>
                                    <option <?php if (!empty($_POST['parent_id']) && $_POST['parent_id'] == $cat['cat_id'])
                                        echo "selected = 'selected'"; ?> value="<?php echo $cat['cat_title']; ?>">
                                        <?php echo str_repeat('--', $cat['level']) . ' ' . $cat['cat_title']; ?></option>
                                <?php }
                            } ?>
                        </select>
                        <!-- //phần thông báo  --><?php echo form_error('category') ?>

                        
                        <button type="submit" class="btn btn-primary mt-5" name="btn_add" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>