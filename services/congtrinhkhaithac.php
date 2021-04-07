<?php
include "config.php";
?>
<?php
header('Content-Type: application/json');
/*** Kiểm tra biến searchTerm có tồn tại hay không ***/
if (!isset($_GET['searchTerm'])) {
    $querry_option_ct_ktsd = 'SELECT * FROM "CT_KTSD" WHERE "ma_loaicongtrinh" ='."'6'".' 
                            ORDER BY "tenCongTrinh" ASC';
    $result = pg_query($tiengiang_db, $querry_option_ct_ktsd);
    if (!$result) {
        echo "Không có dữ liệu";
    }

    $final_data = [];
    while ($row = pg_fetch_assoc($result)) {
        $final_data[] = array(
            "id" => $row['id'],
            "text" => $row['tenCongTrinh'] /* ." -- ".$row['termini'] */
        );
    }
} else {
    $search = $_GET['searchTerm'];
    $querry_option_ct_ktsd = 'SELECT * FROM "CT_KTSD" 
                            WHERE "ma_loaicongtrinh" ='."'6'".' AND Lower(name)
                            LIKE Lower(' . "'" . '%' . $search . '%' . "'" . ') 
                            ORDER BY "tenCongTrinh" ASC';
    $result = pg_query($tiengiang_db, $querry_option_ct_ktsd);
    if (!$result) {
        echo "Không có dữ liệu";
    }
    $final_data = [];
    if (pg_num_rows($result) != 0) {
        while ($row = pg_fetch_assoc($result)) {
            $final_data[] = array(
                "id" => $row['id'],
                "text" => $row['tenCongTrinh'] /* ." -- ".$row['termini'] */
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
