<?php

    require_once __DIR__ ."/../MultiBalanceStatus/Model/MBSAPI.php";

    $data = @$_GET['data'] ?? null;
    $url = @$_GET['url'] ?? null;
    $flg = @$_GET['t'] ?? null; //debug

    if($data === null && $url === null) {
        echo "NULL";
        exit;
    }else if($data !== null){
        //
        $MBS = new MBSAPI($data);
        $res = json_decode($MBS->get());
        if($res->status === 'error') {
            echo 'ERROR!! :' .$res->message;
            exit();
        }
        $url = $res->data;
        if($flg === null)
            header('Location: ' .$url);
        else
            echo '<img src="' .$url .'">';
    }else if($url !== null) {
        // url
        if($flg === null)
            header('Location: ' .$url);
        else
            echo '<a href="' .$url .'">' .$url .'</a>';
    }



?>
