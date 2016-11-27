<?php
/**
 * Created by PhpStorm.
 * User: Huanli Wang
 * Date: 26/11/2016
 * Time: 12:30
 */
    session_start();
    session_destroy();

    header("location: login.php");
?>