<?php
get_header();
echo form_success('add');
$list_category = get_list_page();

?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">chỉnh sửa chi tiết trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title" class="form-lable">Tiêu đề:</label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="<?php echo $info_page['title'] ?>">
                        <!-- //phần thông báo  --><?php echo form_error('title') ?>

                        <label for="title" class="form-lable">Slug ( Friendly_url ):</label>
                        <input type="text" class="form-control" name="slug" id="slug"
                            value="<?php echo $info_page['slug'] ?>">
                        <!-- //phần thông báo  --><?php echo form_error('slug') ?>


                        <label for="editor" class="form-lable">Mô tả:</label>

                        <textarea name="content" class="ckeditor form-control"
                            id="editor"><?php echo $info_page['content'] ?></textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#editor'))
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                        <!-- //phần thông báo  --><?php echo form_error('content') ?>


                        <label for="" class="form-lable mt-3">Danh mục:</label>
                        <select name="category" id="category">
                            <option value="0">--Danh mục--</option>
                            <?php
                            foreach ($list_category as $cat) {
                                ?>
                                <option <?php if (!empty($cat['title']) && $cat['title'] == $info_page['category'])
                                    echo "selected = 'selected'; " ?> value="<?php echo $cat['title']?>"><?php echo $cat['title']; ?></option>
                            <?php } ?>
                        </select>
                        <!-- //phần thông báo  --><?php echo form_error('category') ?>


                        <button type="submit" class="btn btn-primary mt-5" name="btn_update" id="btn-submit">Cập
                            nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>