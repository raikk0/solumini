<?php

require './config/conn.php';
$page = @$_GET['page'] ?: "home";
$action = @$_GET['action'] ?: "index";

$page .= 'Controller';

require_once 'controller/'.$page.'.php';
$obj = new $page();
$obj->$action();
?>