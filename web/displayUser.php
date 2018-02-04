<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';
require_once 'isLogged.php';
$isSetId = FALSE;
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['getUserId'])
        && !empty($_GET['getUsername'])) {
    
    $isSetId = TRUE;
    $user2 = User::loadUserById($conn, $_GET['getUserId']);
}
$title = 'Twitter - Display User';
require_once 'header.php';
?>
<center>
    <br>
    <table>
        <tbody>
        <tr>
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
<br>
    <form action="sendMessage.php" method="post" role="form">
    <div class="form-group">
        <label for="">Użytkownik:
            <?php  
            if ($isSetId) {
                echo $user2->getUsername(); 
            }
            ?></label>
    </div>                
    <button type="submit" name="id" class="btn btn-info"
        <?php  
        if ($isSetId) {
            echo 'value=' . $user2->getId(); 
        }
        ?>>Wyślij wiadomość do:
        <?php
        if ($isLogged) {
            echo $user2->getUsername();
        }
        ?>

    </button>
</form>
    <br>

<br>
</center>
<?php
if ($isLogged && $isSetId) {
    $tweetsTable = Tweet::loadAllTweetsByUserId($conn, $user2->getId());
    foreach ($tweetsTable as $value) {
        $id = $value ->getId();
        $userId = $value ->getUserId();
        $text = $value ->getText();
        $creationDate = $value ->getCreationDate();
        $loadeduser = User::loadUserById($conn, $userId);
        $username = $loadeduser ->getUsername();
        echo "Użytkownik: $username<br>";
        echo "Data utworzenia: $creationDate<br>";
        echo "Treść: <a href=\"postBoard.php?postId=$id\">$text</a><br>";
        $commentsTable = Comment::loadAllCommentByPostId($conn, $id);
        $nrOfComments = count($commentsTable);
        echo 'Liczba komentarzy: ' . $nrOfComments . '<br><br>';
    }
}
require_once 'footer.php';
