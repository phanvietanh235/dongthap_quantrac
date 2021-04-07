<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$name_standard = $_POST["name_standard"];
$name_para = $_POST["name_para"];
$name_analysis_method = $_POST["name_analysis_method"];

$querry_data = 'SELECT standard_para.*, para.name "ThongSo", standard.name "QuyChuan", 
                        purpose.name "MucDich", unit.name "DonVi"
                FROM "StandardParameter" standard_para
                LEFT JOIN "Parameter" para on standard_para.parameterid = para.id
                LEFT JOIN "Standard" standard on standard_para.standardid = standard.id
                LEFT JOIN "Purpose" purpose on standard_para.purposeid = purpose.id
                LEFT JOIN "Unit" unit on standard_para.unitid = unit.id';
$querry_data .= ' WHERE ';
$querry_data .= '(standard.name IS NULL OR standard.name ILIKE ' . "'%" . $name_standard . "%') AND ";
$querry_data .= '(para.name IS NULL OR para.name ILIKE ' . "'%" . $name_para . "%') AND ";
$querry_data .= '(standard_para.analysismethod IS NULL OR standard_para.analysismethod ILIKE '
                . "'%" . $name_analysis_method . "%')";

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
        "standard" => $value['QuyChuan'],
        "para" => $value['ThongSo'],
        "unit" => $value['DonVi'],
        "max" => $value['maxvalue'],
        "min" => $value['minvalue'],
        "purpose" => $value['MucDich'],
        "ana_method" => $value['analysismethod']
    );
}

$final_data = json_encode($option);
echo $final_data;
?>

