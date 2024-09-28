<?php
get_header();
echo form_success('update_cat');
// recursive 
$data_cat = db_fetch_array("SELECT * FROM `tbl_post_cat`");
$list_cat = data_tree($data_cat, 0);

?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Chỉnh sửa chi tiết Danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title" class="form-lable">Tên danh mục:</label>
                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $info_cat['cat_title']; ?>"> 
                        <!-- //phần thông báo  --><?php echo form_error('title') ?>

                        <label for="slug" class="form-lable">Slug ( Friendly_url ):</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="<?php echo $info_cat['cat_slug']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('slug') ?>

                        <label for="cat" class="form-lable mt-3">Danh mục cha:</label>
                        <select name="parent_id">
                            <option <?php if (!empty($_POST['parent_id']) && $_POST['parent_id'] = 0)
                                echo "selected = 'selected'"; ?> value="0">Danh mục cha</option>
                            <?php
                            if (!empty($list_cat)) {
                                foreach ($list_cat as $cat) {
                                    ?>
                                    <option <?php if (!empty($info_cat['parent_id']) && $info_cat['parent_id'] == $cat['cat_id'])
                                        echo "selected = 'selected'"; ?> value="<?php echo $cat['cat_id'] ?>">
                                        <?php echo str_repeat('--', $cat['level']). ' ' . $cat['cat_title']; ?></option>
                                <?php }
                            } ?>
                        </select>
                        <!-- //phần thông báo  --><?php echo form_error('parent_id') ?>


                        
                        <button type="submit" class="btn btn-primary mt-5" name="btn_update" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>