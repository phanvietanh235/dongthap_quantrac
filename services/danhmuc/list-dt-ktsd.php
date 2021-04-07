<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$name_dt_ktsd = $_POST["name_dt_ktsd"];

$querry_data = 'SELECT * FROM "DoiTuongKTSD"';
$querry_data .= ' WHERE ';
$querry_data .= '"tenDoiTuongKTSD" IS NULL OR "tenDoiTuongKTSD" ILIKE ' . "'%" . $name_dt_ktsd . "%'";

$result = pg_query($tiengiang_db, $querry_data);
if (!$result) {
    echo "Không có dữ liệu.\n";
    exit;
}

/*** Chuyển định dạng từ Array sang Json ***/
$data = array();
while ($row = pg_fetch_assoc($result)) {
    $data[] = $row;
}

$jsonData = json_encode($data);
$original_data = json_decode($jsonData, true);
$option = array();
foreach ($original_data as $key => $value) {
    $option[] = array(
        "ma" => $value['id'],
        "ten" => $value['tenDoiTuongKTSD'],
        "mota" => $value['moTa']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
