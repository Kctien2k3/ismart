<?php
get_header();
echo form_success('add');
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
                    <!-- <h3 id="index">Thêm mới menu</h3> -->

                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title" class="form-label">Tên menu</label>
                            <input type="text" name="menu_title" class="form-control" id="title">
                            <!-- //phần thông báo  --><?php echo form_error('menu_title') ?>

                        </div>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <label for="url-static" class="form-label">Đường dẫn tĩnh</label>
                            <input type="text" name="menu_url_static" class="form-control" id="url-static">
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
                                    <option value="<?php echo $page_cat['title']; ?>"><?php echo $page_cat['title']; ?>
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
                                    <option value="<?php echo $product_cat['cat_title']; ?>">
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
                                    <option value="<?php echo $post_cat['cat_title']; ?>">
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
                            <input class="form-control" type="text" name="menu_order" id="menu-order">
                            <!-- //phần thông báo  --><?php echo form_error('menu_order') ?>

                        </div>
                        <p class='mess_error'></p>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="btn_add" id="btn-save-list">Lưu danh
                                mục</button>
                        </div>
                    </form>
                </div>
                <div id="category-menu" class="fl-right">
                    <h3 id="index">Danh sách Menu</h3>
                    <form method="POST" action="?mod=widgets&controller=menu&action=apply_status" class="form-actions">
                    <div class="actions">
                        <select name="actions">
                            <option value="0">Tác vụ</option>
                            <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 1)
                                "selected = 'selected'" ?> value="1">Xóa vĩnh viễn</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                            <!-- //phần thông báo  --><?php echo form_error('apply') ?>
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>