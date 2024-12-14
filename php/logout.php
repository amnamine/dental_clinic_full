<?php
session_start();

// Destroy the session to log the user out
session_unset();
session_destroy();

// Redirect to the homepage after logging out
header('Location: ../index.php');
exit();
?>