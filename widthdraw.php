<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="img/x-icon" alt="Porapipat" href="/images/favicon2.png">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,300&family=Kanit:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,800;1,400;1,500;1,600;1,800&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400&display=swap" rel="stylesheet">

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/f2f09dd513.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/styles.css">

    <title>ถอนเงิน</title>
</head>

<body>
    <center>
        <div class="table-set">
            <?php
            session_start();
            $money = $_POST["withdraw"];
            // $current = array("1000" => 10, "500" => 20, "100" => 30);
            $current = $_SESSION["money"];
            $oldcurrent = $current;
            $moneyWidthdraw = array("1000" => 0, "500" => 0, "100" => 0);


            if ($money > 0 && $money % 100 == 0) {
                if (floor($money / "1000") > $current["1000"]) {
                    $money -= $current["1000"] * "1000";
                    $moneyWidthdraw["1000"] = $current["1000"];
                    $current["1000"] = 0;
                    // print "1000 : " . $moneyWidthdraw["1000"] . ", change: $money <BR>";
                } else {
                    $moneyWidthdraw["1000"] = floor($money / "1000");
                    $current["1000"] -= $moneyWidthdraw["1000"];
                    $money = $money % "1000";
                    // print "1000 : " . $moneyWidthdraw["1000"] . ", change: $money <BR>";
                }

                if (floor($money / "500") > $current["500"]) {
                    $money -= $current["500"] * "500";
                    $moneyWidthdraw["500"] = $current["500"];
                    $current["500"] = 0;
                    // print "500 : " . $moneyWidthdraw["500"] . ", change: $money <BR>";
                } else {
                    $moneyWidthdraw["500"] = floor($money / "500");
                    $current["500"] -= $moneyWidthdraw["500"];
                    $money = $money % "500";
                    // print "500 : " . $moneyWidthdraw["500"] . ", change: $money <BR>";
                }

                if (floor($money / 100) > $current["100"]) {
                    $current = $_SESSION["money"];
                    print "<h2>เงินในตู้ไม่พอ</h2>";
                } else {
                    echo "
                        <table class='table table-bordered'>
                        <label style='right: 0px; border-radius: 30px;'>เงินที่ออกมา</label>
                        <thead>
                            <tr>
                                <th>ธนบัตร</th>
                                <th>จำนวน</th>
                            </tr>
                        </thead>
                        <tbody>
                        ";
                    $moneyWidthdraw["100"] = floor($money / 100);
                    $current["100"] -= $moneyWidthdraw["100"];
                    $money = $money % 100;
                    $_SESSION["money"] = $current;
                    foreach ($moneyWidthdraw as $key => $value) {
                        if ($value > 0) {
                            echo "<tr>";
                            echo "<th scope='row'>$key</th>";
                            echo "<td>$value ใบ</td>";
                            echo "</tr>";
                        }
                    }
                    echo "</tbody></table>";
                }
            } else {
                print "<h2>กรอกเงินไม่ถูกต้อง</h2>";
            }

            echo "
            <br>
            <table class='table table-bordered'>
                <label style='right: 0px; border-radius: 30px;'>เงินที่เหลือ</label>
                <thead>
                    <tr>
                       <th>ธนบัตร</th>
                       <th>เหลือ</th>
                       <th>จาก</th>
                 </tr>
                </thead>
                <tbody>
            ";

            foreach ($current as $key => $value) {
                echo "<tr>";
                echo "<th scope='row'>$key</th>";
                echo "<td>$value ใบ</td>";
                echo "<td>" . $oldcurrent[$key] . " ใบ</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
            ?>

        </div>
        <a href="./index.php"><input type="submit" style="width: 300px" value="กลับหน้ากดเงิน"></a>
    </center>
</body>

</html>