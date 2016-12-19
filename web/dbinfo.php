<?php
/**
 * Created by PhpStorm.
 * User: Huanli
 * Date: 24/11/2016
 * Time: 09:39
 */
global $username, $password, $host, $db;
//$username = 'cs4400_Team_56';
//$password = 'Ysvq2Jc5';
//$host = 'academic-mysql.cc.gatech.edu';
$username = 'root';
$password = 'root';
$host = 'http://54.88.105.173/phpmyadmin/';

$db = mysqli_connect($host, $username, $password, $username);
if (!$db) {
    die('Could not connect: ' . mysqli_error());
}
//echo 'Connected successfully';
//$query = "SELECT UName FROM USER ORDER BY UName";
//$result= mysqli_query($db, $query);
//$count = mysqli_num_rows($result);
//echo "<div name=\"course\" id=\"course\">";
//while ($arr = mysqli_fetch_array($result))
//{
//    echo "<p value='$arr[UName]'>".$arr["UName"]."</p>";
//}
//echo "</div>";
//mysqli_close($db);
?>