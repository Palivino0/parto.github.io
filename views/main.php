<?php
$page = @$_GET['page'];
switch ($page) {
    case 'dashboard' : include('dashboard.php'); break;
    case 'All' : include('All.php'); break;
    case 'ange' : include('ange.php'); break;
    case 'tharcis' : include('tharcis.php'); break;
    case 'kizito' : include('kizito.php'); break;
    case 'dominique' : include('dominique.php'); break;
    case 'vincent' : include('vincent.php'); break;
    case 'joseph' : include('joseph.php'); break;
    case 'ant' : include('ant.php'); break;

    default: include('dashboard.php');break;
}