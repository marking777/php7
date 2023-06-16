<?php
session_start();
foreach($_SESSION['gegevens'] as $value){
    echo $value.' <br/>';
}
?>