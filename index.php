<?php
    use MyApp\Log\Logger;
    require_once 'vendor/autoload.php';
    
    $smarty = new Smarty();

    $smarty->template_dir = './tpl/';
    $smarty->compile_dir  = './smarty/compile/';
    $smarty->config_dir   = './smarty/config/';
    $smarty->cache_dir    = './smarty/cache/';

    $nextPage = $_POST['NextPage'];

    session_start();

    if(!isset($_SESSION['id'])){
        if ($nextPage === "Login"){
            require_once('./form/login/login.php');
        }else{
            $smarty->display('login.tpl');
        }
    }else{
        echo $_SESSION['id'];
        $smarty->assign('name', $_SESSION['id']);
        $smarty->display('top.tpl');
    }

?>