<?php
include "../config.php"
?>
<?php
header('Content-Type:application/json');
$name_loaihinh = $_POST["name_loaihinh"];

$querry_data = 'SELECT * FROM "ObservationType"';
$querry_data .= ' WHERE ';
$querry_data .= '"name" IS NULL OR "name" ILIKE ' . "'%" . $name_loaihinh . "%'";

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
        "parent_id" => $value['parentid'],
        "ten_parent" => get_parent($value['parentid'], $original_data),
        "code" => $value['code']
    );
}

$final_data = json_encode($option);
echo $final_data;

/*** Get Parent Name ***/
function get_parent($id_loaitram, $original_data)
{
    foreach ($original_data as $key => $value) {
        if ($id_loaitram == $value['id']) {
            return $value['name'];
        }
    }
}
?>

