<?php
/**
 * Created by PhpStorm.
 * User: Huanli Wang
 * Date: 26/11/2016
 * Time: 12:28
 */
if (!isset($_SESSION['login_user'])) {
    header("location: login.php");
}