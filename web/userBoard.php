<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';

require_once 'isLogged.php';
$title = 'Twitter - User Board';
require_once 'header.php';
?>
    <center>
        <br>
    <table>
        <tbody>
        <tr>
            <td>
                <form action="messagePage.php" method="post" role="form">
                    <button type="submit" value="messagePage" class="btn btn-block">Wysłane / Odebrane</button>
                </form>
            </td>
            <td>&nbsp;</td>
            <td>
                <form action="editProfile.php" method="post" role="form">
                    <button type="submit" value="editProfile" class="btn btn-block">Edytuj profil</button>
                </form>
            </td>
            <td>&nbsp;</td>
            <td>
                <form action="mainBoard.php" method="post" role="form">
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
        <div class="form-group">
            <label for="" id="center"><h2>Co chcesz teraz zrobić <?php echo $user->getUsername();?>?</h2></label>
        </div></center>
    <br>
    <h4><b>Twoje wiadomości:</b></h4>

<?php
if ($isLogged) {
    $tweetsTable = Tweet::loadAllTweetsByUserId($conn, $_SESSION['id']);
    foreach ($tweetsTable as $value) {
        $id = $value ->getId();
        $userId = $value ->getUserId();
        $text = $value ->getText();
        $creationDate = $value ->getCreationDate();
        $loadeduser = User::loadUserById($conn, $userId);
        $username = $loadeduser ->getUsername();
        echo "Użytkownik: $username<br>";
        echo "Data utworzenia: $creationDate<br>";
        echo "Początek wiadomości: <a href=\"postBoard.php?postId=$id\">$text</a><br>";
        $commentsTable = Comment::loadAllCommentByPostId($conn, $id);
        $nrOfComments = count($commentsTable);
        echo 'Liczba komentarzy: ' . $nrOfComments . '<br><br>';
    }
}

require_once 'footer.php';
