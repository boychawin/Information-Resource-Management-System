<?php

define('DB_NAME', 'u458562086_db_user');

define("DB_USER", "u458562086_root");

define("DB_PASS", "");

define("DB_HOST", "localhost");

$db_con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$db_con->set_charset("utf8");

date_default_timezone_set('Asia/Bangkok');