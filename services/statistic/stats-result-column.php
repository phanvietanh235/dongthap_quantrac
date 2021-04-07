<?php
    include "../config.php";
    include "../standard-parameter.php";
?>

<?php
    header('Content-Type: application/json');
    $thongso = $_POST["thongso"];
    $station_text = explode("),", $_POST["station_text"]);
    $station = $_POST["station"];

    $columns = array();
    $arr = array();
    /* Station */
    for ($i = 0; $i < count($station_text); $i++) {
        $thongso_arr = array();
        /* Thông số */
        for ($k = 0; $k < count($thongso); $k++) {
            $std_key = $thongso[$k];
            for ($j = 0; $j < count($final_std_para); $j++) {
                if ($std_key == $final_std_para[$j]["id"]) {
                    $unit = $final_std_para[$j]["unitName"] != '' ? " đơn vị: ".$final_std_para[$j]["unitName"] : "";
                    $param = $final_std_para[$j]["parameterCode"].$unit;
                    $width = 100/(count($station) * count($thongso));
                    $thongso_arr[] = array(
                        'title' => $param,
                        'field' => $station[$i]."_".$thongso[$k],
                        "hozAlign" => "center",
                        "width" => $width."%",
                    );
                }
            }
        }

        $arr[] = array(
            "title" => $station_text[$i],
            "hozAlign" => "center",
            "columns" => $thongso_arr
        );
    }

    $time = array(
        "title" => "Thời gian",
        "field" => 'time',
        "hozAlign" => "center",
        "frozen" => true,
        "width" => 150
    );

    $columns = array($time);
    for ($i = 0; $i < count($arr); $i++) {
        array_push($columns, $arr[$i]);
    }
    echo json_encode($columns);
?>
