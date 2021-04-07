<?php
include "../config.php"
?>
<?php
$conn_id = ftp_connect($ftp_server) or die("could not connect to $ftp_server");
if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
    echo "conectd as $ftp_username@$ftp_server\n";
} else {
    echo "could not connect as $ftp_username\n";
}

if (isset($_POST['id_gp'])) {
    $cur_count = $_POST['id_gp'];
    ftp_mkdir($conn_id, $cur_count);
} else {
    $cur_count_select = pg_query($tiengiang_db, 'SELECT id FROM "ThongTinCP_XT" 
                            ORDER BY id DESC LIMIT 1');
    $cur_arr = array();
    while ($row = pg_fetch_assoc($cur_count_select)) {
        $cur_arr[] = $row;
    }
    /*** Lấy giá trị cur = ID ***/
    $cur_count = $cur_arr[0]['id'];
    /*** Tạo Folder ***/
    ftp_mkdir($conn_id, $cur_count);
}
ftp_chdir($conn_id, "\\");

$file = $_FILES["uploaded_qp_xt"]["name"];
$remote_file_path = $cur_count . "/" . $file;
ftp_put($conn_id, $remote_file_path, $_FILES["uploaded_qp_xt"]["tmp_name"], FTP_ASCII);
ftp_close($conn_id);
?>
