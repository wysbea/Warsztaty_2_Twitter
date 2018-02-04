<?php
$isLogged = FALSE;
if (!empty($_SESSION['id'])) {
    
    $isLogged = TRUE;
    $id = $_SESSION['id'];
    $user = User::loadUserById($conn, $id);
    
} else {
    header("Location: login.php");
}
