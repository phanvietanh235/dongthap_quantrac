<?php
include "../config.php"
?>
<?php
if (isset($_POST['ma'])) {
    /*---- Update Loại hình Doanh nghiệp ----*/
    $query = 'UPDATE "LoaiHinhDoanhNghiep" ';
    $query .= 'SET "ten" =' . "'" . $_POST["ten_loaihinh"] . "'" . ', ';
    $query .= '"moTa" =' . "'" . $_POST["mota"] . "'" . ', ';
    $query .= '"canCuPhapLy" =' . "'" . $_POST["cancu_phaply"] . "'";
    $query .= ' WHERE id =' . $_POST["ma"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Loại hình Doanh nghiệp ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "LoaiHinhDoanhNghiep" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["ten_loaihinh"] . "'" .
        ',' . "'" . $_POST["mota"] . "'" . ',' . "'" . $_POST["cancu_phaply"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "LoaiHinhDoanhNghiep"(
                             "id", "ten", "moTa", "canCuPhapLy") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
