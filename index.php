<?php

require_once 'src/connection.php';
session_start();



$isLogOut = FALSE;
if (isset($_SESSION['logOut']) && !empty($_SESSION['logOut'])) {
    if ($_SESSION['logOut'] == 'logOut') {
        $isLogOut = TRUE;
    }
}
$title = 'Twitter';
require_once 'web/header.php';
?>

    <center>
        <form action="web/login.php" method="post" role="form" id="center">
        <?php
        if ($isLogOut) {
            echo 'Zostałeś pomyślnie wylogowany<br>';
        }
        ?>
<br>
        <legend>Witaj na Twitterze</legend>
            <br>
        <button type="submit" value="login" class="btn btn-primary">Mam już konto</button>
    </form>
        <br>
    <br>
    <form action="web/register.php" method="post" role="form" id="center">
        <button type="submit" value="register" class="btn btn-primary">Nie mam jeszcze konta</button>
    </form>
    </center>
<?php
require_once 'web/footer.php';