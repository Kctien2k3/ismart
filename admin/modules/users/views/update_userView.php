<?php
get_header();
echo form_success('update');

?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
                <div class="clearfix">
                    <a href="?mod=users&controller=team&action=index" title="" id="add-new" class="fl-left">Trang quản trị</a>
                    <h2 id="index" class="fl-left">Chỉnh sửa tài khoản quản lý</h2>
                </div>
            </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('admin');
        ?>
        <div id="content" class="fl-right">
            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="display-name" class="form-label">Họ và tên:</label>
                        <!-- //phần thông báo  --><?php echo form_error('fullname') ?>
                        <input type="text" class="form-control" name="fullname" id="display-name"
                            placeholder="Your fullname" value="<?php echo $info_user_id['fullname']; ?>">

                        <label for="usernam" class="form-label">Tên đăng nhập:</label>
                        <!-- //phần thông báo  --><?php echo form_error('username') ?>
                        <input type="text" class="form-control" name="username" id="usernam"
                            placeholder="Your username" value="<?php echo $info_user_id['username']; ?>">

                        <label for="email" class="form-label">Email:</label>
                        <!-- //phần thông báo  --><?php echo form_error('email') ?>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo $info_user_id['email']; ?>">

                        <label for="tel" class="form-label">Số điện thoại:</label>
                        <!-- //phần thông báo  --><?php echo form_error('phone_number') ?>
                        <input type="tel" class="form-control" name="phone_number" id="tel"
                            placeholder="Viet Nam phone-number" value="<?php echo $info_user_id['phone_number']; ?>">

                        <label for="address" class="form-label">Địa chỉ:</label>
                        <!-- //phần thông báo  --><?php echo form_error('address') ?>
                        <textarea class="form-control" name="address" id="address"
                            placeholder="Your address ..."><?php echo $info_user_id['address']; ?></textarea>



                        <label for="thumbnail" class="form-lable">Ảnh đại diện</label>
                        <!-- //phần thông báo  --><?php echo form_error('upload') ?>
                        <div class="clearfix col-6 mb-3">
                            <div class="fl-left">
                                <input type="file" class="form-control" name="file" onchange="show_upload_image()">
                            </div>
                            <!-- ## -->
                            <div class="fl-right">
                                <!-- <input type="submit" class="form-control" name="btn_upload" value="Upload"
                                    id="btn-upload-thumb"> -->
                            </div>
                        </div>
                        <!-- hiển thị hình ảnh  -->
                        <img id="upload-image" class="rounded upload-img" src="<?php if(!empty($info_user_id['avatar'])) {
                            echo $info_user_id['avatar'];
                            }else {
                                echo 'public/images/img-thumb.png';
                            } ?>">
 
                        <label for="role" class="mt-3">Phân quyền</label>
                        <!-- //phần thông báo  --><?php echo form_error('role') ?>
                        <select name="role" id="">
                        <option value="0">--Chọn--</option>
                            <option <?php 
                            if (!empty($info_user_id['role']) && $info_user_id['role'] == '1')
                                echo "selected = 'selected'"; ?>
                                value="1">1</option>
                            <option <?php if (!empty($info_user_id['role']) && $info_user_id['role'] == '2')
                                echo "selected = 'selected'"; ?>
                                value="2">2</option>
                            <option <?php if (!empty($info_user_id['role']) && $info_user_id['role'] == '3')
                                echo "selected = 'selected'"; ?>
                                value="3">3</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-5" name="btn_update" id="btn-submit">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>