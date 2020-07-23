<?php

define('IN_MOBILE', true);
require '../framework/bootstrap.inc.php';
require IA_ROOT . '/addons/weixuexiao/api.php';
$api = new api();
$do = $_GET['do'];
$api->$do();
EXIT($api->$do());
