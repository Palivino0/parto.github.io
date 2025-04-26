<?php
include('functions.php');

function lien($page = '',$p = ''){
    $result = "home.php";
    if (!empty($page)){
        $result = "?page=".$page;
        if (!empty($p)) {
            $result.= "&PATRO=".sha1('PATRO')."&pto=".sha1("patro")."&".$p;
        }
    }
    return $result;
}

function input($name){
    $result = '';

    if (isset($_POST[$name])) {
        $result = htmlspecialchars(trim($_POST[$name]));
    } 

    return $result;
}
