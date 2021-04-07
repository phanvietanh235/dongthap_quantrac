<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$name_quychuan = $_POST["name_quychuan"];
$symbol_quychuan = $_POST["symbol_quychuan"];
$loaihinh = $_POST["loaihinh"];

$querry_data = 'SELECT standard.*, obstyle.name "LoaiHinh" FROM "Standard" standard';
$querry_data .= ' LEFT JOIN "ObservationType" obstyle ON standard.obstypeid = obstyle.id';
$querry_data .= ' WHERE ';
$querry_data .= '(standard."name" IS NULL OR standard."name" ILIKE ' . "'%" . $name_quychuan . "%') AND ";
$querry_data .= '(standard."symbol" IS NULL OR standard."symbol" ILIKE ' . "'%" . $symbol_quychuan . "%') AND ";
if ($loaihinh == "none") {
    $querry_data .= '(1=1)';
} else {
    $querry_data .= '(standard."obstypeid" ='.$loaihinh.')';
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
    if ($value['dateoflssue'] != null) {
        $ngaybanhanh = explode("-", $value['dateoflssue']);
        $ngaybanhanh_new = $ngaybanhanh[2]."/".$ngaybanhanh[1]."/".$ngaybanhanh[0];
    } else {
        $ngaybanhanh_new = "";
    }

    $option[] = array(
        "ma" => $value['id'],
        "ten" => $value['name'],
        "symbol" => $value['symbol'],
        "obstypeid" => $value['obstypeid'],
        "loaihinh" => $value['LoaiHinh'],
        "dateoflssue" => $ngaybanhanh_new,
        "organization" => $value['organization']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>

