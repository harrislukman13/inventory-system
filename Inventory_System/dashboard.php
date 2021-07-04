<?php
session_start();

require_once "authCookieSessionValidate.php";

if(!$isLoggedIn) {
    header("Location: ./");
}
?>
<style>
.member-dashboard {
    padding: 40px;
    background: #D2EDD5;
    color: #555;
    border-radius: 4px;
    display: inline-block;
}

.member-dashboard a {
    color: #09F;
    text-decoration: none;
}
</style>
<title>Ammar Zaqwan 202808 Lab 8</title>
<div class="member-dashboard">
    You have Successfully logged in!. <a href="logout.php">Logout</a>
</div>
