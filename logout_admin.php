<?php
session_start();
session_unset();
session_destroy();
header("Location: login_admin.php"); // Cookie tetap ada
exit;
?>
