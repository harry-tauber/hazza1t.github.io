<?php
// Start the session (even this file needs this).
session_start();
// Destroy the session (everything gets wiped).
session_destroy();
header("Location: login.php")
?>
