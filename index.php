<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg user
if (!isset($_SESSION["user"])) {
    header("location:login.php");
} else {
    header("location:list-user.php");
}
include "navbar.php";
?>