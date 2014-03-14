<!DOCTYPE html>
<?php
session_start();
	session_destroy();
	echo header("Location: html.pamja.php");
?>