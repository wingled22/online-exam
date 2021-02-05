<?php
session_start();
session_unset(); 
session_destroy();
if (!isset($_SESSION['instructor_id'])) {
 	header('location:index.php');
 } 