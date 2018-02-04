<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';
require_once '../src/Message.php';
require_once 'isLogged.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id']) && !empty($_SESSION['id'])) {
    
    $_SESSION['user2id'] = $_POST['id'];
    
    if ($_POST['id'] == $_SESSION['id']) {        
        header("Location: errorMessage.php");
    }
}
$isSend = FALSE;
$isError = FALSE;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message']) && $isLogged
        && isset($_SESSION['user2id'])) {
    
    $text = trim($_POST['message']);
    $messageReceiverId = $_SESSION['user2id']; 
    $messageSenderId = $_SESSION['id'];
        
    if (!empty($_POST['message']) && !empty($_SESSION['user2id'])) {
        $message = new Message();
        $message ->setCreationDate();
        $message ->setMessageReceiverId($conn, $messageReceiverId);
        $message ->setMessageSenderId($conn, $messageSenderId);
        if ($message ->setText($text) == NULL) {
            $isError = TRUE;
        } else {
            if ($message ->saveToDB($conn) === TRUE) {
                $isSend = TRUE;
            }
            $isError = TRUE;
        }
        
    } 
}
$title = 'Twitter - Message';
require_once 'header.php';
?>
    <center>
        <?php
        if ($isSend) {
            echo 'Wysłano';
        } elseif ($isError) {
            echo 'Zbyt długi tekst';
        }
        ?>
        <form action="" method="post" role="form">
            <div class="form-group">
                <label for="">Napisz wiadomość</label>
                <input type="text" class="form-control" name="message" id="message" placeholder="Wiadomość maksymalnie 140 znaków">
            </div>
            <button type="submit" value="send" class="btn btn-success">Wyślij</button>
        </form><br>

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
</center>

<?php
require_once 'footer.php';
