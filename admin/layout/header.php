<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý ISMART</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>
        <!-- link bootstrap cdn -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
        <!-- ////// -->
        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <!-- <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script> -->
        <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
        <script src="public/js/app.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?mod=pages&action=index" title="" id="logo" class="fl-left pb-0 pt-2">ADMIN</a>
                        <ul id="main-menu" class="fl-left mb-0 p-0">
                            <li>
                                <a href="?mod=pages&action=index" title="">Trang</a>
                                <ul class="sub-menu p-0">
                                    <li>
                                        <a href="?mod=pages&action=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=pages&action=index" title="">Danh sách trang</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=posts&action=index" title="">Bài viết</a>
                                <ul class="sub-menu p-0">
                                    <li>
                                        <a href="?mod=posts&action=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=posts&action=index" title="">Danh sách bài viết</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=posts&controller=category&action=list_cat" title="">Danh mục bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=products&action=index" title="">Sản phẩm</a>
                                <ul class="sub-menu p-0">
                                    <li>
                                        <a href="?mod=products&action=add" title="">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=products&action=index" title="">Danh sách sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=products&controller=category&action=list_cat" title="">Danh mục sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=orders&action=index" title="">Bán hàng</a>
                                <ul class="sub-menu p-0">
                                    <li>
                                        <a href="?mod=orders&action=index" title="">Danh sách đơn hàng</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=orders&controller=customer&action=list_customer" title="">Danh sách khách hàng</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=widgets&controller=menu&action=menu" title="">Menu</a>
                            </li>
                        </ul>
                        <div id="dropdown-user" class="dropdown dropdown-extended fl-right font">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div id="thumb-circl" class="fl-left">
                                    <img class="thumbnail-2 rounded img-thumbnail" src="<?php 
                                    $avatar = info_user('avatar'); 
                                    if (!empty($avatar)) {
                                        echo $avatar;                                    
                                    }else {
                                        echo 'public/images/img-admin.png';
                                    }
                                    ?>">
                                </div>
                                <h3 id="account" class="fl-right h6 m-0"><?php echo get_info_account('fullname');?></h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?mod=users&action=info" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                <li><a href="?mod=users&action=logout" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                </div>