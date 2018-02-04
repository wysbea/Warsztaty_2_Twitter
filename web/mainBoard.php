<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once 'isLogged.php';
$switch = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['text'])) {
    
    $text = trim($_POST['text']); 
    
    if (!empty($_POST['text'])) {
        $tweet = new Tweet();
        $tweet ->setUserId($conn, $id);
        $tweet ->setCreationDate();
        $isExist = $tweet ->setText($text);
        
        if ($isExist == null) {
            $switch = 1;
        } else {            
            $tweet ->saveToDB($conn);
        }
    } else {
        $switch = 2;
    }
}
$title = 'Twitter - Home';
require_once 'header.php';
switch ($switch) {
    case 1:
        echo 'Za długi wpis';
        break;
    case 2:
        echo 'Przesłano puste pole';
        break;                   
}
?>
<center><br>
    <table>
        <tbody>
        <tr>
            <td>
                <form action="userBoard.php" method="post" role="form">
                    <button type="submit" value="userBoard" name="userBoard" class="btn btn-block">
                        <?php
                        if ($isLogged) {
                            echo $user->getUsername() . ' - Strona użytkownika';
                        }
                        ?>
                    </button>
                </form>
            </td>
            <td>&nbsp;&nbsp;</td>
            <td>
                <form action="logOut.php" method="post" role="form">
                    <button type="submit" value="logOut" name="logOut" class="btn btn-primary">Wyloguj się</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>
<form action="" method="post" role="form">
<br>
    <div class="form-group">
        <label for="">Witaj na Twitterze
            <?php 
            if ($isLogged) {
                echo $user->getUsername() . '!';
            }
            ?>  Zaczynamy?</label>
        <input type="text" class="form-control" name="text" id="name"
               placeholder="Maksymalny tekst 140 znaków">

    </div>

    <button type="submit" value="addTweet" class="btn btn-info">Wyślij wiadomość</button>
</form>
    <br>


<br>
</center>
<?php
if ($isLogged) {
    $tweetsTable = Tweet::loadAllTweets($conn);
    foreach ($tweetsTable as $value) {
        $id = $value ->getId();
        $userId = $value ->getUserId();
        $text = $value ->getText();
        $creationDate = $value ->getCreationDate();
        $loadeduser = User::loadUserById($conn, $userId);
        $username = $loadeduser ->getUsername();
        echo "Użytkownik: <a href=\"displayUser.php?getUserId=$userId&getUsername=$username\">$username</a><br>";
        echo "Data utworzenia: $creationDate<br>";
        echo "Początek wiadomości: <a href=\"postBoard.php?postId=$id\">$text</a><br><br>";
    }
}
require_once 'footer.php';
