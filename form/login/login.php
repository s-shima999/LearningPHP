<?php

use MyApp\Log\Logger;

    ini_set('display_errors', 1);

    session_destroy();

    //入力値チェック
    if ((isset($_POST["id"]) === false) or (isset($_POST["passwd"]) === false)){

        echo "ID または パスワードが入力されていません。";
        return;
    }

    session_start();
    $_SESSION['id'] = $_POST["id"];
    $_SESSION['name'] = $_POST["passwd"];

    Logger::Information("ログインに成功しました。");
    
//    http_response_code(301);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ./");

   exit;

