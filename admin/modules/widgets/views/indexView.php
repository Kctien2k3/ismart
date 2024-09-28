<?php 
get_header();
// $list_pages = get_list_page();
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
                    <h3 id="index" class="fl-left">Danh sách khối giao diện</h3>
                    <a href="?mod=widgets&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left p-0">
                            <li class="all"><a href="?mod=widgets&action=index">Tất cả <span class="count">(<?php echo $total_all; ?>)</span></a> |</li>
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
                <form method="POST" action="?mod=widgets&action=apply_status" class="form-actions">
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
                                    <td><span class="thead-text">Tên khối</span></td>
                                    <td><span class="thead-text">Mã khối</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">1</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Thông tin footer</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">info_footer</span></td>
                                    <td><span class="tbody-text">Admin</span></td>
                                    <td><span class="tbody-text">12-07-2016</span></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">1</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Thông tin footer</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">info_footer</span></td>
                                    <td><span class="tbody-text">Admin</span></td>
                                    <td><span class="tbody-text">12-07-2016</span></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">1</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Thông tin footer</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">info_footer</span></td>
                                    <td><span class="tbody-text">Admin</span></td>
                                    <td><span class="tbody-text">12-07-2016</span></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">1</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">Thông tin footer</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">info_footer</span></td>
                                    <td><span class="tbody-text">Admin</span></td>
                                    <td><span class="tbody-text">12-07-2016</span></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Tên khối</span></td>
                                    <td><span class="tfoot-text">Mã khối</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
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
