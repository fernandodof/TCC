<?php

session_start();
session_destroy();
unset($_SESSION);
setcookie("PHPSESSID", "", time() - 61200, "/");
header("Location: index");
