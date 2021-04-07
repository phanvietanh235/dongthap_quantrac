<?php
include "../config.php"
?>
<?php
if (isset($_POST['madoanhnghiep'])) {
    /*---- Update Doanh nghiệp ----*/
    $query = 'UPDATE "Enterprise" ';
    $query .= 'SET "name"=' . "'" . $_POST["ten_doanhnghiep"] . "'" . ', ';
    $query .= '"address"=' . "'" . $_POST["diachi_doanhnghiep"] . "'" . ', ';
    $query .= '"phone"=' . "'" . $_POST["sodienthoai"] . "'" . ', ';
    $query .= '"type"=' . "'" . $_POST["loai_doanhnghiep"] . "'" . ', ';
    $query .= '"tin"=' . "'" . $_POST["masothue"] . "'" . ', ';
    $query .= '"fax"=' . "'" . $_POST["fax"] . "'" . ', ';
    $query .= '"email"=' . "'" . $_POST["email"] . "'" . ', ';
    $query .= '"accountNumber"=' . "'" . $_POST["sotaikhoan"] . "'" . ', ';
    $query .= '"active"=' . "'" . $_POST["tinhtrang_doanhnghiep"] . "'" . ', ';
    $query .= '"employees"=' . "'" . $_POST["soluong_nhanvien"] . "'" . ', ';
    $query .= '"totalInvestment"=' . "'" . $_POST["tongvon"] . "'" . ', ';
    $query .= '"profession"=' . "'" . $_POST["nganhnghe"] . "'" . ', ';
    $query .= '"agent"=' . "'" . $_POST["nguoidaidien"] . "'" . ', ';
    $query .= '"title"=' . "'" . $_POST["chucdanh"] . "'";
    $query .= ' WHERE id=' . $_POST["madoanhnghiep"];

    $result = pg_query($tiengiang_db, $query);
    if (!$result) {
        echo "error";
        exit;
    }
} else {
    /*---- Insert Doanh nghiệp ----*/
    /*** Luôn Restart để tìm ID mới nhất ***/
    $max_count_select = pg_query($tiengiang_db, 'SELECT id FROM "Enterprise" ORDER BY id DESC LIMIT 1');
    $max_arr = array();
    while ($row = pg_fetch_assoc($max_count_select)) {
        $max_arr[] = $row;
    }
    /*** Lấy giá trị max + 1 = ID  ***/
    $max_count = $max_arr[0]['id'] + 1;

    $querry_values_code = '(' . "'" . $max_count . "'" . ',' . "'" . $_POST["ten_doanhnghiep"] . "'" .
        ',' . "'" . $_POST["diachi_doanhnghiep"] . "'" . ',' . "'" . $_POST["sodienthoai"] . "'" .
        ',' . "'" . $_POST["loai_doanhnghiep"] . "'" . ',' . "'" . $_POST["masothue"] . "'" .
        ',' . "'" . $_POST["fax"] . "'" . ',' . "'" . $_POST["email"] . "'" .
        ',' . "'" . $_POST["sotaikhoan"] . "'" . ',' . "'" . $_POST["tinhtrang_doanhnghiep"] . "'" .
        ',' . "'" . $_POST["soluong_nhanvien"] . "'" . ',' . "'" . $_POST["tongvon"] . "'" .
        ',' . "'" . $_POST["nganhnghe"] . "'" . ',' . "'" . $_POST["nguoidaidien"] . "'" .
        ',' . "'" . $_POST["chucdanh"] . "'" . ')';

    $querry_insert_code = 'INSERT INTO "Enterprise"(
                             "id", "name", "address", "phone", "type", "tin", "fax", 
                             "email", "accountNumber", "active", "employees", "totalInvestment", 
                             "profession", "agent", "title") VALUES' . $querry_values_code;

    $result_insert = pg_query($tiengiang_db, $querry_insert_code);
    if (!$result_insert) {
        echo "error";
        exit;
    }
}
?>
