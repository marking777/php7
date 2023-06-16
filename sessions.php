<?php
$naam = "marouane";
$email = "p@gmail.com";
session_start();
$mijnarray = [$naam ,$email];
$_SESSION['gegevens']= $mijnarray;
?>  