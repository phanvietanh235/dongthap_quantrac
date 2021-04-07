<?php
include "config.php";
?>
<?php
header('Content-Type: application/json');
/*** Querry StandardParameter ***/
$querry_option = 'SELECT "standParam".*,
                    "unit".name "UnitName",
                    "param".name "paramName",
                    "param".code "paramCode",
                    "purpose".name "purposeName",
                    "stand".name "standName"

                    FROM "StandardParameter" "standParam"
                    LEFT JOIN "Unit" "unit" ON "unit".id = "standParam"."unitid"
                    LEFT JOIN "Purpose" "purpose" ON "purpose".id = "standParam"."purposeid"
                    LEFT JOIN "Standard" "stand" ON "stand".id = "standParam"."standardid"
                    LEFT JOIN "Parameter" "param" ON "param".id = "standParam"."parameterid"';
$result = pg_query($tiengiang_db, $querry_option);
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
        'id' => $value['id'],
        'standardID' => $value['standardid'],
        'standardName' => $value['standName'],
        'parameterid' => $value['parameterid'],
        'parameterCode' => $value['paramCode'],
        'parameterName' => $value['paramName'],
        'unitid' => $value['unitid'],
        'unitName' => $value['UnitName'],
        'purposeid' => $value['purposeid'],
        'purposeName' => $value['purposeName'],
        'min_value' => $value['minvalue'],
        'max_value' => $value['maxvalue'],
        'analysismethod' => $value['analysismethod']
    );
}

$final_std_para = $option;
// echo json_encode($option);
?>
