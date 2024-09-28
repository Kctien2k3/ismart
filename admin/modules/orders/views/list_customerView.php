<?php 
get_header();
$list_customer = get_list_customer();
// 
$total_all = db_num_rows("SELECT * FROM `tbl_customer`");
$total_oders = db_num_rows("SELECT `num_order` FROM `tbl_customer`");

?>
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                    <!-- <a href="?mod=pages&action=add" title="" id="add-new" class="fl-left">Thêm mới</a> -->
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left p-0">
                            <li class="all"><a href="?mod=orders&controller=customer&action=list_customer">Tất cả <span class="count">(<?php echo $total_all; ?>)</span> |</a></li>
                            <!-- <li class="all"><p href="">Tổng số đơn hàng <span class="count">(<?php ?>)</span></p></li> -->
                        </ul>
                        <form method="GET" class="form-s fl-right">
                           <input type="hidden" name="mod" value="orders">
                           <input type="hidden" name="controller" value="customer">
                           <input type="hidden" name="action" value="search">

                           <input type="text" name="keyword" id="s" placeholder="Search ...">
                            <input type="submit" name="btn_search" value="Tìm kiếm">
                            <!-- //phần thông báo  --><?php echo form_error('search')?>
                            <!-- //phần thông báo  --><?php echo form_text('search')?>
                        </form>
                    </div>
                <form method="POST" action="?mod=orders&controller=customer&action=apply_status" class="form-actions">
                    <div class="actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <option <?php if(isset($_POST['actions']) && $_POST['actions'] == 1) "selected = 'selected'"?> value="1">Xóa vĩnh viễn</option>
                                
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">
                            <!-- //phần thông báo <?php echo form_error('apply')?> -->

                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Họ và tên</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Email</span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Số đơn hàng</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <?php if (!empty($list_customer)) {
                                $t = 0;
                            ?>
                            <tbody>
                                <?php 
                                foreach ($list_customer as $customer) {
                                    $t ++;
                                ?> 
                                <tr>
                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $customer['customer_id']; ?>"></td>
                                    <td><span class="tbody-text"><?php echo $t; ?></h3></span>
                                    <td class="">
                                        <div class="tb-title fl-left">
                                            <a href="?mod=orders&controller=customer&action=update&customer_id=<?php echo $customer['customer_id']?>" title=""><?php echo $customer['customer_name']; ?></a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="?mod=orders&controller=customer&action=update&customer_id=<?php echo $customer['customer_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="?mod=orders&controller=customer&action=delete&customer_id=<?php echo $customer['customer_id']?>" title="Xóa" class="delete" onclick="return confirm('Bạn có chắc thực hiện thao tác này?')"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text"><?php echo $customer['phone_number']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $customer['email']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $customer['address']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $customer['num_order']; ?></span></td>
                                    <td><span class="tbody-text"><?php echo $customer['created_date']; ?></span></td>

                                </tr>
                                <?php }?>
                            </tbody>
                            <?php }else {
                                $error['customer'] = "Không có bản ghi nào!";
                                ?>
                                    <p class="error"><?php echo  $error['customer']?> </p>
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