<?php
    include "../config.php"
?>
<?php
    if (isset($_POST['id_gp'])) {
        $idgp = $_POST['id_gp'];
    } else {
        $cur_count_select = pg_query($tiengiang_db, 'SELECT id FROM "ThongTinCP_TD" ORDER BY id DESC LIMIT 1');
    $cur_arr = array();
    while ($row = pg_fetch_assoc($cur_count_select)) {
        $cur_arr[] = $row;
    }
    /*** Lấy giá trị cur = ID ***/
        $idgp = $cur_arr[0]['id'] + 1;
    }

    $targetfolder = "upload-files/".$idgp.'/';
    mkdir($targetfolder);
    $targetfolder = $targetfolder . basename($_FILES['uploaded_qp_td']['name']);
    $file_type = $_FILES['uploaded_qp_td']['type'];
    if ($file_type == "application/pdf") {
        if (move_uploaded_file($_FILES['uploaded_qp_td']['tmp_name'], $targetfolder)) {
            echo "success";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
?>
