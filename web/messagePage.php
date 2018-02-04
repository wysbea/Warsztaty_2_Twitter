<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';
require_once '../src/Message.php';
require_once 'isLogged.php';
$title = 'Twitter - Messages';
require_once 'header.php';
?>
<br>
<center>
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
    $sendMessageTable = Message::loadAllSendMessageByUserId($conn, $user->getId());
    echo '<h2>Wysłane: </h2>';
    foreach ($sendMessageTable as $value) {
        $messageId = $value ->getId();
        $messageReceiverId = $value ->getMessageReceiverId();
        $text = $value ->getText();
        $creationDate = $value ->getCreationDate();
        $isRead = $value ->getIsRead();
        $loadeduser = User::loadUserById($conn, $messageReceiverId);
        $usernameReceiver = $loadeduser ->getUsername();
        if ($isRead == 0) {
            echo '<b>';
        }
        echo "Odbiorca: $usernameReceiver<br>";
        echo "Data utworzenia: $creationDate<br>";
        if (strlen($text) > 30) {
            $text = substr($text, 0, 30) . "... ";
        }
        echo "Początek wiadomości: <a href=\"singleMessage.php?messageId=$messageId&status=send&user=$usernameReceiver\">$text</a><br><br>";
        if ($isRead == 0) {
            echo '</b>';
        }
    }
    $receivedMessageTable = Message::loadAllReceiveMessageByUserId($conn, $user->getId());
    echo '<h2>Odebrane: </h2>';
    foreach ($receivedMessageTable as $value) {
        $messageId = $value ->getId();
        $messageSenderId = $value ->getMessageSenderId();
        $text = $value ->getText();
        $creationDate = $value ->getCreationDate();
        $isRead = $value ->getIsRead();
        $loadeduser = User::loadUserById($conn, $messageSenderId);
        $usernameSender = $loadeduser ->getUsername();
        if ($isRead == 0) {
            echo '<b>';
        }
        echo "Nadawca: $usernameSender<br>";
        echo "Data utworzenia: $creationDate<br>";
        if (strlen($text) > 30) {
            $text = substr($text, 0, 30) . "... ";
        }
        echo "Początek wiadomości: <a href=\"singleMessage.php?messageId=$messageId&status=received&user=$usernameSender\">$text</a><br><br>";
        if ($isRead == 0) {
            echo '</b>';
        }
    }
}
require_once 'footer.php';
