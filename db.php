<?php
$conn = new mysqli("localhost","root","","billing_simple");

if($conn->connect_error){
    die("DB Error");
}
?>