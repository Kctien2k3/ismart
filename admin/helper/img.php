<?php 
////////////////// File upload images
function upload_img($dir, $type){
    //tạo thư mục và đường dẫn lưu file
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';
    $target_dir = $dir;
    // $target_file = $target_dir.basename($_FILES['file']['name']);
    $target_file = $target_dir.$_FILES['file']['name'];
    // kiểm tra file đã tồn tại trên hệ thống
    if (file_exists($target_file)){
        $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        $new_file_name = $file_name."-copy.";
        $new_target_file = $target_dir.$new_file_name.$type;
        $k = 1; 
        while (file_exists($new_target_file)) {
            $new_file_name = $file_name."-copy({$k}).";
            $k ++;
            $new_target_file = $target_dir.$new_file_name.$type;
        }
        $target_file = $new_target_file;
    }
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        return $target_file;
    }
    return false;

}

/////////////// delete_img
function delete_img($url) {
    if (file_exists($url)) {
        if (unlink($url)) {
            return true; // Xóa thành công
        } else {
            return false; // Lỗi khi xóa
        }
    } else {
        return true; // File không tồn tại, coi như đã xóa thành công
    }
}