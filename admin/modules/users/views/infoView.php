<?php 
get_header();
?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?" title="" id="add-new" class="fl-left">Trang chủ</a>
            <h3 id="index" class="fl-left">Thông tin tài khoản</h3>
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
                        <img class="rounded-circle thumbnail mb-4" src="<?php if (!empty($info_user['avatar'])) {echo $info_user['avatar'];}else {echo 'public/images/img-thumb.png'; }?>" alt="">
                        <label for="display-name">Tên hiển thị</label>
                        <input type="text" name="fullname" id="display-name" value="<?php echo $info_user['fullname']; ?>" readonly="readonly">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="fullname" value="<?php echo $info_user['username']?>" placeholder="admin" readonly="readonly">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo $info_user['email']?>" readonly="readonly">
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="phone_number" id="tel" value="<?php echo $info_user['phone_number']?>" readonly="readonly">
                        <label for="address">Địa chỉ</label>    
                        <textarea name="address" id="address" readonly="readonly"><?php echo $info_user['address']?></textarea>
                        <!-- <button type="submit" name="btn_update" id="btn-submit">Cập nhật</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
get_footer();
?>