<?php
session_start();

require_once '../src/connection.php';
require_once '../src/User.php';

unset ($_SESSION['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])
        && isset($_POST['password'])) {
    
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        
        $sql = "SELECT * FROM Users WHERE email = '$email'"; 
        $query = $conn->query($sql);
        
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $hash_pass = $row['hash_pass'];
            $checkPassword = password_verify($password, $hash_pass);
            
            if ($checkPassword) {
                $_SESSION['id'] = $row['id'];
                unset ($_SESSION['logOut']);
                header("Location: mainBoard.php");
            } else {
                $badPass = 'wrongPass';
            }
            
        } else {
            $badPass = 'wrongEmail';
        }
    } elseif (isset($_POST['register'])) {
        header("Location: register.php");
    } elseif (isset($_POST['mainPage'])) {
        header("Location: ../index.php");
    } else {
        $badPass = 'completeData';
    }
} elseif (isset($_POST['register'])) {
    header("Location: register.php");
} else {    
    $badPass = 'noData';
} 
$title = 'Twitter - Log In';
require_once 'header.php';
?>

<center>
<?php

if (!empty($badPass)) {                
    switch ($badPass) {
        case 'wrongPass':
            echo '<h3>Błędne wprowadzone hasło</h3>';
            break;
        case 'wrongEmail':
            echo '<h3>Błednie wprowadzony login. Spróbuj jeszcze raz.</h3>';
            break;
        case 'completeData':
            echo '<h3>Brak wszystkich danych</h3>';
            break;
        case 'noData':
            echo '<h3>Zaloguj się do Twittera</h3>';
            break;                   
    }
}  
?>


<form action="" method="post" role="form">
    <legend>Podaj dane</legend>
    <div class="form-group">
        <label for="">Adres e-mail</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="email@email.com">
    </div>
    <div class="form-group">
        <label for="">Hasło</label>
        <input type="password" class="form-control" name="password" id="email" placeholder="Password">
    </div>
    <button type="submit" value="login" class="btn btn-danger">Zaloguj się</button></form><br>


    <table>
        <t>
            <td>
                <form action="register.php" method="post" role="form">
                    <button type="submit" value="register" name="register" class="btn btn-primary">Rejestracja</button>
                </form>
            </td>
            <td> &nbsp;</td>
            <td>
                <form action="../index.php" method="post" role="form">
                    <button type="submit" value="mainPage" name="mainPage" class="btn btn-success">Home</button>
                </form>
            </td>
        </t>
    </table>
</form>
</center>

<?php
require_once 'footer.php';
