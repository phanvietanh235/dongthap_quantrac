<?php
    /* $tiengiang_db = pg_connect("host=10.151.45.15
            port=5432
            dbname=tnn_tiengiang
            user=postgres
            password=lamnhung1501"
    );
    $tiengiang_db = pg_connect("host=localhost
            port=5432
            dbname=tiengiang_tnn
            user=postgres
            password=0888365051"
    ); */
    $tiengiang_db = pg_connect("host=localhost
            port=5432
            dbname=dongthap_test
            user=postgres
            password=postgres"
    );
    if (!$tiengiang_db) {
        echo "Kết nối thất bại.\n";
        exit;
    }

    /*---- FTP Config ----*/
    $ftp_server = "10.151.45.15";
    $ftp_username = "administrator";
    $ftp_password = "Sciren@654321";
