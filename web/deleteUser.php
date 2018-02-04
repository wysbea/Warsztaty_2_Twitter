<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once 'isLogged.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteUser'])) {
    
    if (!empty($_POST['deleteUser'])) {
        $deleteUser = trim($_POST['deleteUser']);
        switch ($deleteUser) {
            case 'no':
                header("Location: userBoard.php");
                break;
            case 'yes':
                echo $user->getId();
                if ($user->delete($conn)) {
                    header("Location: ../index.php");
                    echo 'Konto usuniete';
                } else {
                    echo 'Nie udało się';
                }
                break;                
        }
    } else {
        echo 'Spróbuj jeszcze raz';
    } 
} 
$title = 'Twitter - Delete User';
require_once 'header.php';
?>

<!doctype html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter - Skasuj użytkownika</title>
    <link rel="stylesheet" media="screen" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    <center>
        <br>
            <form action="" method="post" role="form">
                <legend>Czy na pewno usunąć <?php echo $user->getUsername();?>?</legend>
                <button type="submit" value="yes" name="deleteUser" class="btn btn-danger">Tak</button>
                <button type="submit" value="no" name="deleteUser" class="btn btn-primary">Nie</button>
            </form>
    </center>
<?php
require_once 'footer.php';
