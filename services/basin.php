<?php
include "config.php";
?>
<?php
header('Content-Type: application/json');
/*** Kiểm tra biến searchTerm có tồn tại hay không ***/
if (!isset($_GET['searchTerm'])) {
    $querry_option_basin = 'SELECT * FROM "Basin" ORDER BY name ASC';
    $result = pg_query($tiengiang_db, $querry_option_basin);
    if (!$result) {
        echo "Không có dữ liệu";
    }

    $final_data = [];
    while ($row = pg_fetch_assoc($result)) {
        $final_data[] = array(
            "id" => $row['id'],
            "text" => $row['name'] /* ." -- ".$row['termini'] */
        );
    }
} else {
    $search = $_GET['searchTerm'];
    /*** Nếu biến searchTerm có tồn tại thì thêm điều kiện Like ***/
    $querry_option_basin = 'SELECT * FROM "Basin" 
                                WHERE Lower(name) 
                                LIKE Lower(' . "'" . '%' . $search . '%' . "'" . ') 
                                ORDER BY name ASC';
    $result = pg_query($tiengiang_db, $querry_option_basin);
    if (!$result) {
        echo "Không có dữ liệu";
    }
    $final_data = [];
    if (pg_num_rows($result) != 0) {
        while ($row = pg_fetch_assoc($result)) {
            $final_data[] = array(
                "id" => $row['id'],
                "text" => $row['name'] /* ." -- ".$row['termini'] */
            );
        }
    } else {
        $final_data[] = array(
            "id" => "0",
            "text" => "Không tìm thấy dữ liệu"
        );
    }
}

echo json_encode($final_data);
?>
