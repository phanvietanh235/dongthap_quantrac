<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$ma_lvs = $_POST["ma_lvs"];

$querry_data = 'SELECT * FROM "Basin"';
$querry_data .= ' WHERE ';
$querry_data .= '("riverid" IS NULL OR "riverid" ILIKE ' . "'%" . $ma_lvs . "%') AND ";
if ($_POST["name_lvs"] == "all") {
    $querry_data .= '(1=1)';
} else {
    $querry_data .= '(';
    $basin_option = $_POST["name_lvs"];
    foreach ($basin_option as $i => $value) {
        if ($i > 0) {
            $querry_data .= ' OR ';
        }
        $querry_data .= 'id = ' . "'" . (int)$value . "' ";
    }
    $querry_data .= ')';
}

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
        "riverid" => $value['riverid'],
        "ten" => $value['name'],
        "surfaceareanwt" => $value['surfaceareanwt'],
        "capacity" => $value['capacity'],
        "netcapacity" => $value['netcapacity'],
        "deadcapacity" => $value['deadcapacity'],
        "deadwaterlevel" => $value['deadwaterlevel'],
        "beginning" => $value['beginning'],
        "termini" => $value['termini']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>

