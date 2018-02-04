<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';
require_once '../src/Message.php';
require_once 'isLogged.php';
$title = 'Twitter - Error Message';
require_once 'header.php';
?>

<center>
    <br>
Nie możesz wysłać wiadomości do siebie
    <br>
    <br>
    <table>
        <tbody>
        <tr>
            <td><form action="mainBoard.php" method="post" role="form">
                    <button type="submit" value="mainBoard" class="btn btn-success">Home</button>
                </form>
            </td>
            <td>&nbsp;</td>
            <td>
                <form action="logOut.php" method="post" role="form">
                    <button type="submit" value="logOut" name="logOut" class="btn btn-primary">Wyloguj się</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>
<br>
</center>

<?php
require_once 'footer.php';
