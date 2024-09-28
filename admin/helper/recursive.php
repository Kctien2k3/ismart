<?php 
//////// hiện thị danh mục đa cấp
function data_tree($data, $parent_id = 1, $level = 0) {
    $result = [];
    //duyệt dữ liệu
    foreach ($data as $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            // unset($data[$item['cat_id']]);
            // duyệt mảng con 
            $child = data_tree($data, $item['cat_id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}
