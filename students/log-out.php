<?php
session_start();
session_unset(); 
session_destroy();
if (!isset($_SESSION['student_id'])) {
 	header('location:index.php');
 } 