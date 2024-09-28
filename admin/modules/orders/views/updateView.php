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
                    <h3 id="index" class="fl-left">Chỉnh sửa chi tiết đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <label for="order_code" class="form-lable">Mã đơn hàng:</label>
                        <input type="text" class="form-control" name="order_code" id="order_code"
                            value="<?php echo $info_order['order_code']; ?>" readonly="readonly">

                        <label for="customer_name" class="form-lable">Tên khách hàng:</label>
                        <input type="text" class="form-control" name="customer_name" id="customer_name"
                            value="<?php echo $info_order['customer_name']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('customer_name') ?>

                        <label for="num_product" class="form-lable">Số sản phẩm:</label>
                        <div class="col-2 mb-3"><input type="number" class="form-control" name="num_product"
                                id="num_product" value="<?php echo $info_order['num_product']; ?>"></div>
                        <!-- //phần thông báo  --><?php echo form_error('num_product') ?>

                        <label for="total_price" class="form-lable">Tổng giá:</label>
                        <input type="text" class="form-control" name="total_price" id="total_price"
                            value="<?php echo $info_order['total_price']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('total_price') ?>

                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"
                            value="<?php echo $info_order['email']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('email') ?>

                        <label for="tel" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" name="phone_number" id="tel"
                            placeholder="Viet Nam phone-number" value="<?php echo $info_order['phone_number']; ?>">
                        <!-- //phần thông báo  --><?php echo form_error('phone_number') ?>

                        <label for="address" class="form-label">Địa chỉ:</label>
                        <textarea class="form-control" name="address" id="address"
                            placeholder="Your address ..."><?php echo $info_order['address']; ?></textarea>
                        <!-- //phần thông báo  --><?php echo form_error('address') ?>


                        <label for="cat" class="form-lable mt-3">Hình thức thanh toán:</label>
                        <select name="payment_method" id="cat">
                            <option value="0">-- Chọn hình thức thanh toán --</option>
                            <option <?php if (!empty($info_order['payment_method']) && $info_order['payment_method'] == 'Thanh toán tại cửa hàng')
                                echo "selected='selected'"; ?> value='1'>Thanh toán tại cửa hàng</option>
                            <option <?php if (!empty($info_order['payment_method']) && $info_order['payment_method'] == 'Thanh toán tại nhà') 
                                echo "selected='selected'"; ?> value='2'>Thanh toán tại nhà</option>
                            <option <?php if (!empty($info_order['payment_method']) && $info_order['payment_method'] == 'Thanh toán bằng ví điện tử')
                                echo "selected='selected'"; ?> value='3'>Thanh toán bằng ví điện tử</option>
                        </select>
                        <!-- //phần thông báo  --><?php echo form_error('category') ?>

                        <label for="cat" class="form-lable mt-3">Trạng thái đơn hàng:</label>
                        <select name="order_status" id="cat">
                            <option value="0">-- Trạng thái đơn hàng --</option>
                            <option <?php if (!empty($info_order['order_status']) && $info_order['order_status'] == 'success')
                                echo "selected='selected'"; ?> value='1'>Thành công</option>
                            <option <?php if (!empty($info_order['order_status']) && $info_order['order_status'] == 'pending') 
                                echo "selected='selected'"; ?> value='2'>Chờ duyệt</option>
                            <option <?php if (!empty($info_order['order_status']) && $info_order['order_status'] == 'delivering')
                                echo "selected='selected'"; ?> value='3'>Đang vận chuyển</option>
                        </select>

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