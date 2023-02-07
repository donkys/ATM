<?php
session_start();
if (isset($_GET['reset'])) {
    unset($_SESSION["money"]);
}

if (!isset($_SESSION["money"])) {
    $_SESSION["money"] = array("1000" => 10, "500" => 20, "100" => 30);
    $current = $_SESSION["money"];
} else {
    $current = $_SESSION["money"];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@200;400;500;600;700&family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,300&family=Kanit:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,800;1,400;1,500;1,600;1,800&family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- CSS File -->
    <link rel="stylesheet" href="./css/styles.css">

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/38de8073b8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://kit.fontawesome.com/38de8073b8.css" crossorigin="anonymous">

    <title>Withdraw</title>
</head>

<body>
    <br>
    <div class="row">
        <div class="col col-lg-1 col-md-0 col-sm-0" ></div>
        <div class="col col-lg-5 col-md-12 col-sm-12">
            <div class="square">
                <span class="second-square">
                    <form action="index.php" method="GET">
                        <label style="background-color: #00425A;">
                            <i class="fa-solid fa-money-check fa-1x"></i> MONEY</i>
                        </label>
                        <?php
                        $amount = ($current["1000"] * 1000 + $current["500"] * 500 + $current["100"] * 100);
                        echo "
                        <table class='table table-striped' style='border-width:4px'>
                            <thead>
                                <tr>
                                    <th>ธนบัตร</th>
                                    <th>เหลือ</th>
                                </tr>
                            </thead>
                            <tbody>
                ";

                        foreach ($current as $key => $value) {
                            echo "<tr>";
                            echo "<th scope='row'>$key</th>";
                            echo "<td>$value ใบ</td>";
                            echo "</tr>";
                        }
                        echo "
                            </tbody>
                                <tfoot>
                                    <td colspan='2' bgcolor='#3C84AB'>
                                    <font size='4px' color='white'><b> รวม </b>" . $amount . " บาท
                                    </td>
                                </tfoot>
                            </table>";
                        ?>
                        <input type="hidden" name="reset" value="1">
                        <input type="submit" class="reset" value="ค่าเริ่มต้น">
                    </form>
                </span>
            </div>
        </div>
        <div class="col col-lg-5 col-md-12 col-sm-12">
            <div class="square">
                <span class="second-square">
                    <form action="widthdraw.php" method="post">
                        <label> <i class="fa-solid fa-credit-card fa-1x"></i> Widthdraw </i></label>
                        <input type="number" name="withdraw" placeholder="จำนวนเงิน" min="100" max="<?php echo $amount; ?>" step="100">
                        <table width=100%>
                            <tr>
                                <td width=30%><input type="reset" value="Reset"></td>
                                <td width=70%><input type="submit" value="ถอนเงิน"></td>
                            </tr>
                        </table>
                    </form>
                </span>
            </div>
        </div>
        <div class="col col-lg-1 col-md-0 col-sm-0"></div>
    </div>

</body>

</html>