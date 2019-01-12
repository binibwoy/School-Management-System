<?php
session_start();
session_destroy();
header("Location:index.php?err=5");
?>
