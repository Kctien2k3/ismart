<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Form</title>
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/login.css" rel="stylesheet" type="text/css" />
    <!-- link bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <!-- ////// -->
</head>

<body class="bg-primary">
    <div id="wp-form-login" class="bg-light">
        <h1>Đăng Nhập</h1>
        <form id="form_login" action="" enctype="multipart/form-data" method="POST" class="p-5">
            <input type="text" class="form-control" name="username" value="" placeholder="Your Username" id="username">
            <!-- alert error  --><?php echo form_error('username'); ?>
            <input type="password" class="form-control" name="password" value="" placeholder="--------" id="password">
            <!-- alert error  --><?php echo form_error('password'); ?>
            <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me"> <label
                class="form-check-label" for="remember_me">Ghi Nhớ Phiên Đăng Nhập</label>
            <input type="submit" class="btn btn-primary" name="btn_login" value="Login Now!" id="login-button">
            <!-- alert error  --><?php echo form_error('account'); ?>
        </form>
        <h6 style="color:#4fa327">Site Administrator</h6>
        <!-- <a href="<?php echo base_url("?mod=users&action=lost_pass") ?>" id="lost-pass">forgot your password!</a>
        <a href="<?php echo base_url("?mod=users&action=reg") ?>" id="lost-pass">|| sign up</a> -->
    </div>
</body>

</html>