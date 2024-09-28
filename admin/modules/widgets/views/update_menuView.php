<?php
get_header();
echo form_success('update');
//
$page_category = get_list_page();
//
$data_product_category = get_list_product_cat();
$product_category = data_tree($data_product_category, 0);
//
$data_post_category = get_list_post_cat();
$post_category = data_tree($data_post_category, 0);
//
$list_menu = get_list_menu();
?>
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section-detail clearfix">
                <div id="list-menu" class="fl-left">
                <h3 id="index">Chỉnh sửa chi tiết menu</h3>

                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title" class="form-label">Tên menu</label>
                            <input type="text" name="menu_title" class="form-control" id="title"
                                value="<?php echo $info_menu['menu_title']; ?>">
                            <!-- //phần thông báo  --><?php echo form_error('menu_title') ?>

                        </div>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <label for="url-static" class="form-label">Đường dẫn tĩnh</label>
                            <input type="text" name="menu_url_static" class="form-control" id="url-static"
                                value="<?php echo $info_menu['menu_url_static']; ?>">
                            <p>Chuỗi đường dẫn tĩnh cho menu</p>
                            <!-- //phần thông báo  --><?php echo form_error('menu_url_static') ?>

                        </div>
                        <div class="form-group clearfix">
                            <label class="form-label">Trang</label>
                            <select class="form-control" name="page_category">
                                <option value="0">-- Chọn --</option>
                                <?php
                                foreach ($page_category as $page_cat) {
                                    ?>
                                    <option <?php if (!empty($info_menu['page_category']) && $info_menu['page_category'] == $page_cat['title'])
                                        echo "selected = 'selected'" ?>
                                            value="<?php echo $page_cat['title']; ?>"><?php echo $page_cat['title']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p>Trang liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label class="form-label">Danh mục sản phẩm</label>
                            <select class="form-control" name="product_category">
                                <option value="0">-- Chọn --</option>
                                <?php
                                foreach ($product_category as $product_cat) {
                                    ?>
                                    <option <?php if (!empty($info_menu['product_category']) && $info_menu['product_category'] == $product_cat['cat_title'])
                                        echo "selected = 'selected'" ?> value="<?php echo $product_cat['cat_title']; ?>">
                                        <?php echo str_repeat('--', $product_cat['level']) . ' ' . $product_cat['cat_title']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p>Danh mục sản phẩm liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label class="form-label">Danh mục bài viết</label>
                            <select class="form-control" name="post_category">
                                <option value="0">-- Chọn --</option>
                                <?php
                                foreach ($post_category as $post_cat) {
                                    ?>
                                    <option <?php if (!empty($info_menu['post_category']) && $info_menu['post_category'] == $post_cat['cat_title'])
                                        echo "selected = 'selected'" ?> value="<?php echo $post_cat['cat_title']; ?>">
                                        <?php echo str_repeat('--', $post_cat['level']) . ' ' . $post_cat['cat_title']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p>Danh mục bài viết liên kết đến menu</p>
                        </div>
                        <!-- <div class="form-group clearfix">
                            <label class="form-label">Danh mục cha</label>
                            <select class="form-control" name="parent_id">
                                <option value="0">-- Chọn --</option>
                            </select>
                            <p>Danh mục sản phẩm liên kết đến menu</p>
                        </div> -->
                        <div class="form-group">
                            <label class="form-label" for="menu-order">Thứ tự</label>
                            <input class="form-control" type="text" name="menu_order" id="menu-order" value="<?php echo $info_menu['menu_order']; ?>">
                            <!-- //phần thông báo  --><?php echo form_error('menu_order') ?>

                        </div>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="btn_update" id="btn-save-list">Cập nhật
                                danh
                                mục</button>
                        </div>
                    </form>
                </div>
                <div id="category-menu" class="fl-right">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách Menu</h3>
                    <a href="?mod=widgets&controller=menu&action=menu" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
                    <div class="actions">
                        <select name="post_status">
                            <option value="0">Tác vụ</option>
                            <option value="delete">Xóa vĩnh viễn</option>
                        </select>
                        <button type="submit" name="sm_block_status" id="sm-block-status">Áp dụng</button>
                    </div>
                    <div class="table-responsive">
                    <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Đường dẫn tĩnh</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Trang</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Danh mục sản phẩm</span>
                                    </td>
                                    <td style="text-align: center;"><span class="thead-text">Danh mục bài viết</span>
                                    </td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </thead>
                            <?php if (!empty($list_menu)) {
                                $t = 0;
                                ?>
                                <tbody>
                                    <?php foreach ($list_menu as $menu) {
                                        $t++;
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem[]" class="checkItem"
                                                    value="<?php echo $menu['menu_id']; ?>"></td>
                                            <td><span class="tbody-text"><?php echo $t; ?></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=widgets&controller=menu&action=update_menu&menu_id=<?php echo $menu['menu_id']; ?>"
                                                        title=""><?php echo $menu['menu_title'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=widgets&controller=menu&action=update_menu&menu_id=<?php echo $menu['menu_id']; ?>"
                                                            title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                aria-hidden="true"></i></a>
                                                    </li>
                                                    <li><a href="?mod=widgets&controller=menu&action=delete_menu&menu_id=<?php echo $menu['menu_id']; ?>"
                                                            title="Xóa" class="delete"><i class="fa fa-trash"
                                                                aria-hidden="true"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td style="text-align: center;"><span
                                                    class="tbody-text"><?php echo $menu['menu_url_static']; ?></span></td>
                                            <td style="text-align: center;"><span
                                                    class="tbody-text"><?php echo $menu['page_category']; ?></span></td>
                                            <td style="text-align: center;"><span
                                                    class="tbody-text"><?php echo $menu['product_category']; ?></span></td>
                                            <td style="text-align: center;"><span
                                                    class="tbody-text"><?php echo $menu['post_category']; ?></span></td>

                                            <td style="text-align: center;"><span
                                                    class="tbody-text"><?php echo $menu['menu_order']; ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            <?php } ?>
                            <!-- <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Đường dẫn tĩnh</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Trang</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Danh mục sản phẩm</span>
                                    </td>
                                    <td style="text-align: center;"><span class="thead-text">Danh mục bài viết</span>
                                    </td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </tfoot> -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>