<?php 
get_header();
echo form_success('update');

?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?" title="" id="add-new" class="fl-left">Trang chủ</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php
        get_sidebar('users');
        ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="display-name" class="form-label">Tên hiển thị:</label>
                        <!-- //phần thông báo  --><?php echo form_error('fullname')?>
                        <input type="text" class="form-control" name="fullname" id="display-name" value="<?php echo $info_user['fullname']; ?>">

                        <label for="username" class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" name="username" id="username" value="<?php echo $info_user['username']?>" placeholder="admin" readonly="readonly">

                        <label for="email" class="form-label">Email:</label>
                        <!-- //phần thông báo  --><?php echo form_error('email')?>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo $info_user['email']?>">

                        <label for="tel" class="form-label">Số điện thoại:</label>
                        <!-- //phần thông báo  --><?php echo form_error('phone_number')?>
                        <input type="tel" class="form-control" name="phone_number" id="tel" value="<?php echo $info_user['phone_number']?>">

                        <label for="address" class="form-label">Địa chỉ:</label>
                        <!-- //phần thông báo  --><?php echo form_error('address')?>
                        <textarea class="form-control" name="address" id="address"><?php echo $info_user['address']?></textarea>
                        <!-- //phần thông báo  --><?php echo form_error('update')?>

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
                        <img id="upload-image" class="rounded upload-img" src="<?php if(!empty($info_user['avatar'])){ 
                            echo $info_user['avatar'];
                        }else { 
                            echo 'public/images/img-thumb.png';
                            } ?>">

                        
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