<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$name_dvql = $_POST["name_dvql"];

$querry_data = 'SELECT * FROM "DonViQuanLy"';
$querry_data .= ' WHERE ';
$querry_data .= '"name" IS NULL OR "name" ILIKE ' . "'%" . $name_dvql . "%'";

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
        "ten" => $value['name'],
        "mota" => $value['description']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
