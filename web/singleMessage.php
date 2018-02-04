<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';
require_once '../src/Message.php';
require_once 'isLogged.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['messageId']) 
        && is_numeric($_GET['messageId']) && !empty($_GET['status'])
        && !empty($_GET['user'])) {
    
    $messageId = $_GET['messageId'];
    $status = $_GET['status'];
    $user = $_GET['user'];
}
$title = 'Twitter - Message';

require_once 'header.php';
?>
<center>
    <br>
    <table>
    <tbody>
    <tr>
        <td>
            <form action="userBoard.php" method="post" role="form">
                <button type="submit" value="userBoard" class="btn btn-block">Strona użytkownika</button>
            </form>
        </td>
        <td>&nbsp;</td>
        <td>
            <form action="messagePage.php" method="post" role="form">
                <button type="submit" value="messagePage" class="btn btn-block">Wysłane / Odebrane</button>
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
</center>

<?php
if ($isLogged) {
    $message = Message::loadMessageById($conn, $messageId);
    switch ($status) {
        case 'send':
            echo '<h4>Wiadomość wysłana: </h4>';
            $messageReceiverId = $message ->getMessageReceiverId();
            $text = $message ->getText();
            $creationDate = $message ->getCreationDate();
            $loadeduser = User::loadUserById($conn, $messageReceiverId);
            $usernameReceiver = $loadeduser ->getUsername();
            $_SESSION['getUserId'] = $messageReceiverId;
            echo "Odbiorca: $usernameReceiver<br>";
            echo "Data utworzenia: $creationDate<br>";
            echo "Początek wiadomości: <a href=\"singleMessage.php?messageId=$messageId&status=send&user=$usernameReceiver\">$text</a><br><br>";
            break;
        case 'received':
            echo '<h4>Wiadomość otrzymana: </h4>';
            $messageSenderId = $message ->getMessageSenderId();
            $text = $message ->getText();
            $creationDate = $message ->getCreationDate();
            $isRead = $message ->setIsRead($conn, 1);
            $message ->saveToDB($conn);
            $loadeduser = User::loadUserById($conn, $messageSenderId);
            $usernameSender = $loadeduser ->getUsername();
            $_SESSION['getUserId'] = $messageSenderId;
            echo "Nadawca: $usernameSender<br>";
            echo "Data utworzenia: $creationDate<br>";
            echo "Początek wiadomości: <a href=\"singleMessage.php?messageId=$messageId&status=received&user=$usernameSender\">$text</a><br><br>";
            break;
    }
}
?>
    <form action="sendMessage.php" method="post" role="form">
        <div class="form-group">
            <button type="submit" value="reply" class="btn btn-primary">Odpowiedz</button>
        </div>
    </form>

<?php
require_once 'footer.php';
