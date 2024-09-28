<?php
get_header();
$list_users = db_fetch_array("SELECT * FROM `tbl_users`");
$list_posts = db_fetch_array("SELECT * FROM `tbl_posts`");
$list_products = db_fetch_array("SELECT * FROM `tbl_products`");
$list_sliders = db_fetch_array("SELECT * FROM `tbl_sliders`");
// 
$total_all = db_num_rows("SELECT * FROM `tbl_users`") + 
db_num_rows("SELECT * FROM `tbl_posts`") + 
db_num_rows("SELECT * FROM `tbl_products`") + 
db_num_rows("SELECT * FROM `tbl_sliders`");
$total_approved = db_num_rows("SELECT * FROM `tbl_users` WHERE `status` = 'approved'") + 
db_num_rows("SELECT * FROM `tbl_posts` WHERE `status` = 'approved'") + 
db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'approved'") + 
db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'approved'");
$total_pending = db_num_rows("SELECT * FROM `tbl_users` WHERE `status` = 'pending'") +
db_num_rows("SELECT * FROM `tbl_posts` WHERE `status` = 'pending'") +
db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'pending'") +
db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'pending'");
$total_trash = db_num_rows("SELECT * FROM `tbl_users` WHERE `status` = 'trash'") +
db_num_rows("SELECT * FROM `tbl_posts` WHERE `status` = 'trash'") +
db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'trash'")+ 
db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'trash'");
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách media</h3>
                    <!-- <a href="?mod=pages&action=add" title="" id="add-new" class="fl-left">Thêm mới</a> -->
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left p-0">
                            <li class="all"><a href="?mod=medias&action=index">Tất cả <span
                                        class="count">(<?php echo $total_all; ?>)</span></a> |</li>
                            <li class="publish">
                                <p href="">Đã đăng <span class="count">(<?php echo $total_approved; ?>) |</span></p>
                            </li>
                            <li class="pending">
                                <p href="">Chờ xét duyệt <span class="count">(<?php echo $total_pending; ?>) |</span>
                                </p>
                            </li>
                            <li class="trash">
                                <p href="">Thùng rác <span class="count">(<?php echo $total_trash; ?>)</span></p>
                            </li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <!-- <input type="hidden" name="mod" value="pages">
                            <input type="hidden" name="action" value="search">

                            <input type="text" name="keyword" id="s" placeholder="Search ...">
                            <input type="submit" name="btn_search" value="Tìm kiếm"> -->
                            <!-- //phần thông báo  --><?php echo form_error('search') ?>
                            <!-- //phần thông báo  --><?php echo form_text('search') ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=pages&action=apply_status" class="form-actions">
                        <div class="actions">
                            <!-- <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 1)
                                    "selected = 'selected'" ?> value="1">Phê duyệt</option>
                                    <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 2)
                                    "selected = 'selected'" ?> value="2">Chờ duyệt</option>
                                    <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 3)
                                    "selected = 'selected'" ?> value="3">Bỏ vào thủng rác</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng"> -->
                                <!-- //phần thông báo  --><?php echo form_error('apply') ?>

                        </div>
                        <div class="table-responsive">
                            <!-- <button type="button" class="btn btn-outline-info form-control">Trang quản trị</button> -->
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên file</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian tạo</span></td>
                                        <td><span class="thead-text">Người sửa</span></td>
                                        <td><span class="thead-text">Thời gian sửa</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_users)) {
                                    $t = 0;
                                    ?>
                                    <tbody>
                                        <?php
                                        foreach ($list_users as $user) {
                                            $t++;
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem"
                                                        value="<?php echo $user['user_id']; ?>"></td>
                                                <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                                <td class="text-center"><img class="rounded thumbnail" src="<?php if (!empty($user['avatar'])) {
                                                    echo $user['avatar'];
                                                } else {
                                                    echo 'http://via.placeholder.com/80X80';
                                                } ?>" alt=""></td>
                                                <td class="">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=users&action=update&user_id=<?php echo $user['user_id'] ?>"
                                                            title=""><?php echo $user['fullname']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=users&action=update&user_id=<?php echo $user['user_id'] ?>"
                                                                title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=users&controller=team&action=delete_user&user_id=<?php echo $user['user_id'] ?>"
                                                                onclick="return confirm('Bạn có chắc thực hiện thao tác này?')"
                                                                title="Xóa" class="delete"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span
                                                        class="tbody-text <?php echo status_color($user['status']); ?>"><?php echo $user['status']; ?></span>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $user['creator']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $user['created_at']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $user['editor']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $user['edit_date']; ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } else {
                                    $error['page'] = "Không có bản ghi nào!";
                                    ?>
                                    <p class="error"><?php echo $error['page'] ?> </p>
                                    <?php
                                } ?>
                                <!-- ////////////////////////////////////////////////////////////////////////////////////// POSTS  -->
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên file</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian tạo</span></td>
                                        <td><span class="thead-text">Người sửa</span></td>
                                        <td><span class="thead-text">Thời gian sửa</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_posts)) {
                                    $t = 0;
                                    ?>
                                    <tbody>
                                        <?php
                                        foreach ($list_posts as $post) {
                                            $t++;
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem"
                                                        value="<?php echo $post['post_id']; ?>"></td>
                                                <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                                <td class="text-center"><img class="rounded thumbnail" src="<?php if (!empty($post['thumbnail'])) {
                                                    echo $post['thumbnail'];
                                                } else {
                                                    echo 'http://via.placeholder.com/80X80';
                                                } ?>" alt=""></td>
                                                <td class="">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=posts&action=update&post_id=<?php echo $post['post_id'] ?>"
                                                            title=""><?php echo $post['title']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=posts&action=update&post_id=<?php echo $post['post_id'] ?>"
                                                                title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=posts&action=delete&post_id=<?php echo $post['post_id'] ?>"
                                                                onclick="return confirm('Bạn có chắc thực hiện thao tác này?')"
                                                                title="Xóa" class="delete"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span
                                                        class="tbody-text <?php echo status_color($post['status']); ?>"><?php echo $post['status']; ?></span>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $post['creator']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $post['created_date']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $post['editor']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $post['edit_date']; ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } else {
                                    $error['page'] = "Không có bản ghi nào!";
                                    ?>
                                    <p class="error"><?php echo $error['page'] ?> </p>
                                    <?php
                                } ?>
                                <!-- ////////////////////////////////////////////////////////////////////////////////////// PRODUCTS  -->
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên file</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian tạo</span></td>
                                        <td><span class="thead-text">Người sửa</span></td>
                                        <td><span class="thead-text">Thời gian sửa</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_products)) {
                                    $t = 0;
                                    ?>
                                    <tbody>
                                        <?php
                                        foreach ($list_products as $product) {
                                            $t++;
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem"
                                                        value="<?php echo $product['product_id']; ?>"></td>
                                                <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                                <td class="text-center"><img class="rounded thumbnail" src="<?php if (!empty($product['product_thumb'])) {
                                                    echo $product['product_thumb'];
                                                } else {
                                                    echo 'http://via.placeholder.com/80X80';
                                                } ?>" alt=""></td>
                                                <td class="">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=products&action=update&product_id=<?php echo $product['product_id'] ?>"
                                                            title=""><?php echo $product['product_title']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=products&action=update&product_id=<?php echo $product['product_id'] ?>"
                                                                title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=products&action=delete&product_id=<?php echo $product['product_id'] ?>"
                                                                onclick="return confirm('Bạn có chắc thực hiện thao tác này?')"
                                                                title="Xóa" class="delete"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span
                                                        class="tbody-text <?php echo status_color($product['product_status']); ?>"><?php echo $product['product_status']; ?></span>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $product['creator']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $product['created_date']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $product['editor']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $product['edit_date']; ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } else {
                                    $error['page'] = "Không có bản ghi nào!";
                                    ?>
                                    <p class="error"><?php echo $error['page'] ?> </p>
                                    <?php
                                } ?>
                                <!-- ////////////////////////////////////////////////////////////////////////////////////// PRODUCTS  -->
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên file</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian tạo</span></td>
                                        <td><span class="thead-text">Người sửa</span></td>
                                        <td><span class="thead-text">Thời gian sửa</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_sliders)) {
                                    $t = 0;
                                    ?>
                                    <tbody>
                                        <?php
                                        foreach ($list_sliders as $slider) {
                                            $t++;
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem"
                                                        value="<?php echo $slider['slider_id']; ?>"></td>
                                                <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                                <td class="text-center"><img class="rounded thumbnail" src="<?php if (!empty($slider['slider_thumb'])) {
                                                    echo $slider['slider_thumb'];
                                                } else {
                                                    echo 'http://via.placeholder.com/80X80';
                                                } ?>" alt=""></td>
                                                <td class="">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=sliders&action=update&slider_id=<?php echo $slider['slider_id'] ?>"
                                                            title=""><?php echo $slider['slider_title']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=sliders&action=update&slider_id=<?php echo $slider['slider_id'] ?>"
                                                                title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=sliders&action=delete&slider_id=<?php echo $slider['slider_id'] ?>"
                                                                onclick="return confirm('Bạn có chắc thực hiện thao tác này?')"
                                                                title="Xóa" class="delete"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span
                                                        class="tbody-text <?php echo status_color($slider['slider_status']); ?>"><?php echo $slider['slider_status']; ?></span>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $slider['creator']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $slider['created_date']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $slider['editor']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $slider['edit_date']; ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                <?php } else {
                                    $error['page'] = "Không có bản ghi nào!";
                                    ?>
                                    <p class="error"><?php echo $error['page'] ?> </p>
                                    <?php
                                } ?>


                            </table>
                        </div>
                </div>
                </form>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title="">
                                << /a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>