<html>
<head lang="ja">
    <meta charset="UTF-8"/>
</head>
<body>
<div>選択した年月のカレンダーを表示します</div>
<form action="./Calendar" method="post">
<?php
    ini_set('display_errors', 1);

    $year = "0";
    $month = "0";
    $setFlg = False;

    if (isset($_POST["year"]) && isset($_POST["month"])){
        //年月がPOSTされている場合、年月を保持する。
        $year = $_POST["year"];
        $month = $_POST["month"];
        $setFlg = True;
    }else{
        //年月がPOSTされていない場合、システムの年月を初期表示用に保持する。
        $nowDate = new DateTime("now");
        $year = $nowDate->format("Y");
        $month = $nowDate->format("m");
    }
?>

<select name="year">
<?php
    $date = new DateTime("now");

    //現在の前後10年分の年を設定する。
    $date->modify("-5 year");
    for ($i = 0; $i<= 10; $i++){

        //初期選択値判定
        $select = "";
        if ($date->format("Y") === $year){
            $select = " selected";
        }
        echo "<option value=\"".$date->format("Y")."\"".$select.">".$date->format("Y")."</option>\n";
        $date->modify("+1 year");
    }
?>
</select>
年
<select name="month">
<?php
    //12カ月分の値を設定する。
    for ($i=1; $i <= 12; $i++){

        //初期選択値判定
        $select = "";
        if (str_pad($i,2,"0", STR_PAD_LEFT) === $month){
            $select = " selected";
        }
        echo "<option value=\"".str_pad($i,2,"0", STR_PAD_LEFT)."\"".$select.">".$i."</option>\n";
    }
?>
</select>
月
<input type="submit" value="表示">
</form>
<?php

    require_once('Calendar.php');

    //年月がPOSTされている場合、該当月のカレンダーを表示する
    if($setFlg && checkdate($month, "01", $year)){
        $calendar = new Calendar;
        $calendar->dispMonth($year, $month);
    }
?>

</body>

</html>