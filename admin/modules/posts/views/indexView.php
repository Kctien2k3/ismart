<?php
get_header();
$list_post = get_list_post();
// 
$total_all = db_num_rows("SELECT * FROM `tbl_posts`");
$total_approved = db_num_rows("SELECT * FROM `tbl_posts` WHERE `status` = 'approved'");
$total_pending = db_num_rows("SELECT * FROM `tbl_posts` WHERE `status` = 'pending'");
$total_trash = db_num_rows("SELECT * FROM `tbl_posts` WHERE `status` = 'trash'");
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách bài viết</h3>
                    <a href="?mod=posts&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left p-0">
                            <li class="all"><a href="?mod=posts&action=index">Tất cả <span
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
                            <input type="hidden" name="mod" value="posts">
                            <input type="hidden" name="action" value="search">

                            <input type="text" name="keyword" id="s" placeholder="Search ...">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                            <!-- //phần thông báo  --><?php echo form_error('search') ?>
                            <!-- //phần thông báo  --><?php echo form_text('search') ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=posts&action=apply_status" class="form-actions">
                        <div class="actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 1)
                                    "selected = 'selected'" ?> value="1">Phê duyệt</option>
                                    <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 2)
                                    "selected = 'selected'" ?> value="2">Chờ duyệt</option>
                                    <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 3)
                                    "selected = 'selected'" ?> value="3">Bỏ vào thủng rác</option>
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
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Ngày tạo</span></td>
                                        <td><span class="thead-text">Người sửa</span></td>
                                        <td><span class="thead-text">ngày sửa</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_post)) {
                                    $t = 0;
                                    ?>
                                    <tbody>
                                        <?php foreach ($list_post as $post) {
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
                                                        <a href="?mod=posts&action=update&post_id=<?php echo $post['post_id']; ?>"
                                                            title=""><?php echo $post['title']; ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=posts&action=update&post_id=<?php echo $post['post_id']; ?>"
                                                                title="Sửa" class="edit"><i class="fa fa-pencil"
                                                                    aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=posts&action=delete&post_id=<?php echo $post['post_id']; ?>"
                                                                title="Xóa" onclick="return confirm('Bạn có chắc thực hiện thao tác này?')" class="delete"><i class="fa fa-trash"
                                                                    aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $post['parent_cat']; ?></span></td>
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
                                    $error['post'] = "Không có bản ghi nào!";
                                    ?>
                                    <p class="error"><?php echo $error['post'] ?> </p>
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