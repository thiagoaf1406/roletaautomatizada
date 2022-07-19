<?php
include '../classes/config.php';
session_start();
session_destroy();

header("Location: ".ADMIN);
?>