<?php
get_header();
echo form_success('reset');

?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?" title="" id="add-new" class="fl-left">Trang chủ</a>
            <h3 id="index" class="fl-left">Đổi mật khẩu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('users');
        ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="old-pass" class="form-lable">Mật khẩu cũ</label>
                        <!-- //phần thông báo  --><?php echo form_error('pass_old') ?>
                        <input type="password" class="form-control" name="pass_old" id="pass-old">

                        <label for="new-pass" class="form-lable">Mật khẩu mới</label>
                        <!-- //phần thông báo  --><?php echo form_error('pass_new') ?>
                        <input type="password" class="form-control" name="pass_new" id="pass-new">

                        <label for="confirm-pass" class="form-lable">Xác nhận mật khẩu</label>
                        <!-- //phần thông báo  --><?php echo form_error('confirm_pass') ?>
                        <input type="password" class="form-control" name="confirm_pass" id="confirm-pass">

                        <button type="submit" class="btn btn-primary mt-5" name="btn_reset" id="btn-submit">Đổi mật
                            khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>