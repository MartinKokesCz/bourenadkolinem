<?php

define("DB_USER", "root");
define("DB_SERVER", "localhost");
define("DB_PASSWORD", "");
define("DB_NAME", "hra");

$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($con, "SET NAMES 'utf8'");
mysqli_query($con, "SET CHARACTER SET utf8");
mysqli_query($con, "SET SESSION collation_connection = 'utf8_unicode_ci'");
?>