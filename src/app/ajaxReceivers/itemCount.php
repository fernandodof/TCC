<?php
session_start();
if (isset($_SESSION['itemCount'])) {
    echo $_SESSION['itemCount'];
}