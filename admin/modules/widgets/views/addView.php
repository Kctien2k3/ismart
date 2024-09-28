<?php
get_header();
echo form_success('add');

?>
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm khối</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="title" class="form-label">Tên khối</label>
                        <input type="text" class="form-control" name="title" id="title">
                        <label for="title" class="form-label">Mã khối</label>
                        <input type="text" class="form-control" name="slug" id="slug">
                        <label for="desc" class="form-label">Nội dung khối</label>
                        <textarea name="desc" id="desc" class="ckeditor form-control"></textarea>
                        <button type="submit" class="btn btn-primary" name="btn-submit" id="btn-submit">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>