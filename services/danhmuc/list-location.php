<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$name_location = $_POST["name_location"];

$querry_data = 'SELECT location.*, LT.name "LoaiDiaDanh" FROM "Location" location
                    LEFT JOIN "LocationType" LT on location.locationtypeid = LT.id';
$querry_data .= ' WHERE ';
$querry_data .= 'location."name" IS NULL OR location."name" ILIKE ' . "'%" . $name_location . "%'";

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
        "type_location" => $value['LoaiDiaDanh']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>
