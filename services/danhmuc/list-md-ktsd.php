<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$name_md_ktsd = $_POST["name_md_ktsd"];

$querry_data = 'SELECT * FROM "MucDichKTSD"';
$querry_data .= ' WHERE ';
$querry_data .= '"mucDich" IS NULL OR "mucDich" ILIKE ' . "'%" . $name_md_ktsd . "%'";

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
        "ten" => $value['mucDich'],
        "mota" => $value['moTa'],
        "type_md_ktsd" => $value['type_mucdich']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
