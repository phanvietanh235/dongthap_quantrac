<?php
    session_start()
?>

<?php
    require_once("services/config.php");
    if (isset($_POST["btn_submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        /*---- Make Clear Input ----*/
        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        if ($username == "" || $password =="") {
            echo "username hoặc password bạn không được để trống!";
        } else {
            $sql = 'select * from users where username ='."'".$username."'".'and password ='."'".$password."'";
            $query = pg_query($tiengiang_db, $sql);
            $num_rows = pg_num_rows($query);
            if ($num_rows == 0) {
                echo "<script>alert('Tên đăng nhập hoặc Mật khẩu không đúng !')</script>";
            } else {
                while ($row = pg_fetch_assoc($query)) {
                    $_SESSION['userid'] = $row["id"];
                    $_SESSION['username'] = $row["username"];
                    $_SESSION["fullname"] = $row["fullname"];
                    $_SESSION["permision"] = $row["permision"];
                }

                /* Điều hướng User */
                if ($_SESSION["permision"] == "user") {
                    header('Location: map.php');
                } else {
                    header('Location: index.php');
                }
                // header('Location: index.php');
            }
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <title>Chất lượng môi trường Đồng Tháp</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/SoTNMT.ico">

    <!-- plugins css -->
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="vendors/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />

    <!-- core css -->
    <link href="assets/css/ei-icon.css" rel="stylesheet">
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
</head>

<body>
    <div class="app">
        <div class="authentication">
            <div class="sign-in-2">
                <div class="container-fluid no-pdd-horizon bg" style="background-image: url('')">
                    <div class="row">
                        <div class="col-md-10 mr-auto ml-auto">
                            <div class="row">
                                <div class="mr-auto ml-auto full-height height-100 d-flex align-items-center">
                                    <div class="vertical-align full-height">
                                        <div class="table-cell">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="pdd-horizon-30 pdd-vertical-30">
                                                        <div class="mrg-btm-30">
                                                            <img class="img-responsive" src="assets/images/monre_logo.png"
                                                                 style="display: block; margin-left: auto; margin-right: auto;">
                                                            <h2 class="no-mrg-vertical text-bold text-center">SỞ TÀI NGUYÊN MÔI TRƯỜNG TỈNH ĐỒNG THÁP</h2>
                                                            <h2 class="no-mrg-vertical text-bold text-info text-center">HỆ THỐNG CHẤT LƯỢNG MÔI TRƯỜNG</h2>
                                                        </div>
                                                        <h5 class="no-mrg-vertical text-bold text-center mrg-btm-5">ĐĂNG NHẬP HỆ THỐNG</h5>
                                                        <form method="post" action="login.php">
                                                            <div class="form-group">
                                                                <input type="text" name="username" class="form-control" placeholder="Tài khoản">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                                                            </div>
                                                            <div class="mrg-top-20 text-right">
                                                                <button type="submit" name="btn_submit" class="btn btn-info">Đăng nhập</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/vendor.js"></script>
    <!-- <script src="assets/js/app.js"></script> -->
</body>
</html>
