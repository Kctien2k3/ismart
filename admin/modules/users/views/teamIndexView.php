<?php
get_header();
/// tổng số bản ghi
$total_all = db_num_rows("SELECT * FROM `tbl_users`");
/// tổng số bản ghi đã được phê duyệt
$total_approved = db_num_rows("SELECT * FROM `tbl_users` WHERE `status` = 'approved'");
/// tổng số bản ghi chờ phê duyệt
$total_pending = db_num_rows("SELECT * FROM `tbl_users` WHERE `status` = 'pending'");
/// tổng số bản ghi ở thùng rác
$total_trash = db_num_rows("SELECT * FROM `tbl_users` WHERE `status` = 'trash'");

/// lấy danh sách các user
$list_user = get_list_user();

?>
<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=index" title="" id="add-new" class="fl-left">Trang quản trị</a>
            <h3 id="index" class="fl-left">Nhóm quản trị</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('admin'); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left p-0">
                            <li class="all"><a href="?mod=users&controller=team&action=index">Tất cả <span class="count">(<?php echo $total_all; ?>)</span></a> |</li>
                            <li class="publish"><p href="">Đã phê duyệt <span class="count">(<?php echo $total_approved; ?>)</span></p></li>
                            <li class="pending"><p href="">Chờ xét duyệt <span class="count">(<?php echo $total_pending; ?>)</span></p></li>
                            <li class="trash"><p href="">Thùng rác <span class="count">(<?php echo $total_trash; ?>)</span></p></li>
                        </ul>
                        <form method="GET" action="" class="form-s fl-right">
                            <input type="hidden" name="mod" value="users">
                            <input type="hidden" name="controller" value="team">
                            <input type="hidden" name="action" value="search"> 
                            <input type="text" name="keyword" id="s" placeholder="Search ..." value="<?php echo set_value('keyword'); ?>">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                            <!-- //phần thông báo  --><?php echo form_error('search')?>
                            <!-- //phần thông báo  --><?php echo form_text('search')?>
                        </form>
                    </div>
               <form method="POST" action="?mod=users&controller=team&action=apply_user">
                    <div class="actions">
                        <div class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 1) "selected = 'selected'"?> value="1">Phê duyệt</option>
                                <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 2) "selected = 'selected'"?> value="2">Chờ duyệt</option>
                                <option <?php if (isset($_POST['actions']) && $_POST['actions'] == 3) "selected = 'selected'"?> value="3">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                            <!-- //phần thông báo  --><?php echo form_error('apply')?>
                        </div>  
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Ảnh đại diện</span></td>
                                    <td><span class="thead-text">Tên đăng nhập</span></td>
                                    <td><span class="thead-text">Họ và Tên</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Hoạt động</span></td>
                                    <td><span class="thead-text">Ngày đăng ký</span></td>
                                    <td><span class="thead-text">Phân quyền</span></td>
                                </tr>
                            </thead>
                            <?php if (!empty($list_user)) {
                            $t = 0;
                            ?>
                            <tbody>
                                <?php foreach ($list_user as $user) {
                                    $t ++;
                                    ?>
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $user['user_id']; ?>"></td>
                                    <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                    <td class="text-center"><img class="rounded thumbnail" src="<?php if(!empty($user['avatar'])) {
                                        echo $user['avatar'];
                                    }else {
                                        echo 'http://via.placeholder.com/80X80';
                                    }?>" alt=""></td>
                                    <td class="">
                                        <div class="fl-left">
                                            <a href="?mod=users&controller=team&action=info_user&user_id=<?php echo $user['user_id']; ?>" title=""><?php echo $user['username']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right p-0">
                                            <li><a href="?mod=users&controller=team&action=update_user&user_id=<?php echo $user['user_id']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil"
                                                        aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=users&controller=team&action=delete_user&user_id=<?php echo $user['user_id']; ?>" title="Xóa" onclick="return confirm('Bạn có chắc thực hiện thao tác này?')" class="delete"><i class="fa fa-trash"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    
                                    <td><span class="tbody-text"><?php echo $user['fullname']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['email']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['phone_number']; ?></span></td>
                                    <td><span class="tbody-text <?php echo status_color($user['status']); ?>"><?php echo $user['status']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['active']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['created_at']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $user['role']; ?></span></td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <?php }else {
                                $error['admin'] = "Không có bản ghi nào!";
                                ?>
                                    <p class="error"><?php echo  $error['admin']?> </p>
                                <?php
                            }?>
                        </table>
                    </div>
                </form>
                </div>
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