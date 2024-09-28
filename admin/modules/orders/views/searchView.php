<?php 
get_header();
$list_order = get_list_order();
// 
$total_all = db_num_rows("SELECT * FROM `tbl_orders`");
$total_success = db_num_rows("SELECT * FROM `tbl_orders` WHERE `order_status` = 'success'");
$total_pending = db_num_rows("SELECT * FROM `tbl_orders` WHERE `order_status` = 'pending'");
$total_delivering = db_num_rows("SELECT * FROM `tbl_orders` WHERE `order_status` = 'delivering'");
?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                    <!-- <a href="?mod=pages&action=add" title="" id="add-new" class="fl-left">Thêm mới</a> -->
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left p-0">
                            <li class="all"><a href="?mod=orders&action=index">Tất cả <span class="count">(<?php echo $total_all; ?>)</span></a> |</li>
                            <li class="publish"><p href="">Thành công <span class="count">(<?php echo $total_success; ?>) |</span></p></li>
                            <li class="pending"><p href="">Đang vận chuyển <span class="count">(<?php echo $total_pending; ?>) |</span></p></li>
                            <li class="trash"><p href="">Chờ duyệt <span class="count">(<?php echo $total_delivering; ?>)</span></p></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                           <input type="hidden" name="mod" value="orders">
                           <input type="hidden" name="action" value="search">

                           <input type="text" name="keyword" id="s" placeholder="Search ...">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                            <!-- //phần thông báo  --><?php echo form_error('search')?>
                            <!-- //phần thông báo  --><?php echo form_text('search')?>
                        </form>
                    </div>
                <form method="POST" action="?mod=orders&action=apply_status" class="form-actions">
                    <div class="actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option <?php if(isset($_POST['actions']) && $_POST['actions'] == 1) "selected = 'selected'"?> value="1">Xóa vĩnh viễn</option>
                                
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
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số sản phẩm</span></td>
                                    <td><span class="thead-text">Tổng giá</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                            </thead>
                            <?php if (!empty($list_search_order)) {
                                $t = 0;
                            ?>
                            <tbody>
                                <?php 
                                foreach ($list_search_order as $order) {
                                    $t ++;
                                ?> 
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $order['order_id']; ?>"></td>
                                    <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                    <td><span class="tbody-text"><?php echo $order['order_code']; ?></span></td>
                                    <td class="">
                                        <div class="tb-title fl-left">
                                            <a href="?mod=orders&action=update&order_id=<?php echo $order['order_id']?>" title=""><?php echo $order['customer_name']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=orders&action=update&order_id=<?php echo $order['order_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=orders&action=delete&order_id=<?php echo $order['order_id']?>" title="Xóa" onclick="return confirm('Bạn có chắc thực hiện thao tác này?')" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $order['num_product']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order['total_price']; ?></span></td>
                                    <td><span class="tbody-text <?php echo status_color($order['order_status']); ?>"><?php echo $order['order_status']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $order['created_date']; ?></span></td>
                                    <td><a href="?mod=orders&action=detail_order&order_id=<?php echo $order['order_id']?>">Chi tiết</a></td>

                                </tr>
                                <?php }?>
                            </tbody>
                            <?php }else {
                                $error['order'] = "Không có bản ghi nào!";
                                ?>
                                    <p class="error"><?php echo  $error['order']?> </p>
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