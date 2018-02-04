<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';
require_once 'isLogged.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['postId'])) {
    
    $_SESSION['postId'] = $_GET['postId'];
    $postId = $_GET['postId'];
}
$switch = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['text']) && $isLogged) {
    
    $newText = trim($_POST['text']);
    $postId = $_SESSION['postId'];
    
    if (!empty($_POST['text'])) {
        $comment = new Comment();
        $comment ->setCreationDate();
        $comment ->setPostId($conn, $postId);
        $comment ->setUserId($conn, $id);
        $isExist = $comment ->setText($newText);
        
        if ($isExist == null) {
            $switch = 1;
        } else {            
            $comment ->saveToDB($conn);
        }
    } 
}
$title = 'Twitter - Post Board';
require_once 'header.php';
?>
<center>
    <br>
    <table>
        <tr>
            <td>
                <form action="mainBoard.php" method="post" role="form">
                    <button type="submit" value="mainBoard" class="btn btn-success">Home</button>
                </form>
            </td>
            <td>&nbsp;</td>
            <td>
                <form action="userBoard.php" method="post" role="form">
                    <button type="submit" value="userBoard" class="btn btn-block">Strona użytkownika</button>
                </form>
            </td>
            <td>&nbsp;</td>
            <td>
                <form action="logOut.php" method="post" role="form">
                    <button type="submit" value="logOut" name="logOut" class="btn btn-primary">Wyloguj się</button>
                </form>
            </td>
        </tr>
    </table>
</center>

<?php
if ($isLogged) {
    $tweet = Tweet::loadTweetById($conn, $postId);
    $id = $tweet ->getId();
    $userId = $tweet ->getUserId();
    $text = $tweet ->getText();
    $creationDate = $tweet ->getCreationDate();
    $loadeduser = User::loadUserById($conn, $userId);
    $username = $loadeduser ->getUsername();
    echo "<h4>Wiadomości: </h4>";
    echo "Użytkownik: $username<br>";
    echo "Data utworzenia: $creationDate<br>";
    echo "Początek wiadomości:$text<br><br>";
    switch ($switch) {
        case 1:
            echo '<b>Za długi komentarz!</b>';
            break;
    }
    echo "<br><h4>Komentarze: </h4>";
    $commentsTable = Comment::loadAllCommentByPostId($conn, $_SESSION['postId']);
    foreach ($commentsTable as $value) {
        $id = $value ->getId();
        $userId = $value ->getUserId();
        $text = $value ->getText();
        $creationDate = $value ->getCreationDate();
        $loadeduser = User::loadUserById($conn, $userId);
        $username = $loadeduser ->getUsername();
        echo "Użytkownik: $username<br>";
        echo "Data utworzenia: $creationDate<br>";
        echo "Początek wiadomości: $text<br><br>";
    }                
}
?>

<form action="" method="post" role="form">
    <div class="form-group">
    <input type="text" class="form-control" name="text" id="name" placeholder="Komentarz maksymalnie 60 znaków"><br>
    <button type="submit" value="addComment" class="btn btn-primary">Dodaj komentarz</button>
    </div>                 
</form>

<?php
echo "<a href=\"mainBoard.php\">Przejdź do strony głównej</a><br><br>";
require_once 'footer.php';
?>
