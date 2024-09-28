<?php 
get_header();
$list_pages = get_list_page();
// 
$total_all = db_num_rows("SELECT * FROM `tbl_pages`");
$total_approved = db_num_rows("SELECT * FROM `tbl_pages` WHERE `status` = 'approved'");
$total_pending = db_num_rows("SELECT * FROM `tbl_pages` WHERE `status` = 'pending'");
$total_trash = db_num_rows("SELECT * FROM `tbl_pages` WHERE `status` = 'trash'");
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách trang</h3>
                    <a href="?mod=pages&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left p-0">
                            <li class="all"><a href="?mod=pages&action=index">Tất cả <span class="count">(<?php echo $total_all; ?>)</span></a> |</li>
                            <li class="publish"><p href="">Đã đăng <span class="count">(<?php echo $total_approved; ?>) |</span></p></li>
                            <li class="pending"><p href="">Chờ xét duyệt <span class="count">(<?php echo $total_pending; ?>) |</span></p></li>
                            <li class="trash"><p href="">Thùng rác <span class="count">(<?php echo $total_trash; ?>)</span></p></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                           <input type="hidden" name="mod" value="pages">
                           <input type="hidden" name="action" value="search">

                           <input type="text" name="keyword" id="s" placeholder="Search ...">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                            <!-- //phần thông báo  --><?php echo form_error('search')?>
                            <!-- //phần thông báo  --><?php echo form_text('search')?>
                        </form>
                    </div>
                <form method="POST" action="?mod=pages&action=apply_status" class="form-actions">
                    <div class="actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option <?php if(isset($_POST['actions']) && $_POST['actions'] == 1) "selected = 'selected'"?> value="1">Phê duyệt</option>
                                <option <?php if(isset($_POST['actions']) && $_POST['actions'] == 2) "selected = 'selected'"?> value="2">Chờ duyệt</option>
                                <option <?php if(isset($_POST['actions']) && $_POST['actions'] == 3) "selected = 'selected'"?> value="3">Bỏ vào thủng rác</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                            <!-- //phần thông báo  --><?php echo form_error('apply')?>

                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <?php if (!empty($list_pages)) {
                                $t = 0;
                            ?>
                            <tbody>
                                <?php 
                                foreach ($list_pages as $page) {
                                    $t ++;
                                ?> 
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $page['page_id']; ?>"></td>
                                    <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="?mod=pages&action=update&page_id=<?php echo $page['page_id']?>" title=""><?php echo $page['title']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=pages&action=update&page_id=<?php echo $page['page_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=pages&action=delete&page_id=<?php echo $page['page_id']?>" onclick="return confirm('Bạn có chắc thực hiện thao tác này?')" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $page['category']; ?></span></td>
                                    <td><span class="tbody-text <?php echo status_color($page['status']); ?>"><?php echo $page['status']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $page['creator']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $page['created_date']; ?></span></td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <?php }else {
                                $error['page'] = "Không có bản ghi nào!";
                                ?>
                                    <p class="error"><?php echo  $error['page']?> </p>
                                <?php
                            }?>
                            
                        </table>
                    </div>
                </div>
                </form>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
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