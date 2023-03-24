<?php
//start
session_start();
//destroy (free)
session_destroy();
//toward the index file
header("location:../index.php");
//exit
exit;
?>
