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
                    <h3 id="index" class="fl-left">Chỉnh sửa chi tiết thông tin khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="customer_name" class="form-lable">Tên khách hàng:</label>
                        <input type="text" class="form-control" name="customer_name" id="customer_name"
                            value="<?php echo $info_customer['customer_name']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('customer_name') ?>

                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
                            value="<?php echo $info_customer['email']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('email') ?>

                        <label for="tel" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" name="phone_number" id="tel"
                            placeholder="Viet Nam phone-number" value="<?php echo $info_customer['phone_number']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('phone_number') ?>

                        <label for="address" class="form-label">Địa chỉ:</label>
                        <textarea class="form-control" name="address" id="address"
                            placeholder="Your address ..."><?php echo $info_customer['address']; ?></textarea>
                        <!-- //phần thông báo  --><?php echo form_error('address') ?>

                        <label for="num_order" class="form-lable">Số đơn hàng:</label>
                        <input type="text" class="form-control" name="num_order" id="num_order"
                            value="<?php echo $info_customer['num_order']; ?>" readonly="readonly">
                        <!-- //phần thông báo  --><?php echo form_error('num_order') ?>

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