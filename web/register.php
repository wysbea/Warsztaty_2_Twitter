<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';


$switch = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])
        && isset($_POST['password']) && isset($_POST['username'])
        && isset($_POST['repeatPassword'])) {
    
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $repeatPassword = trim($_POST['repeatPassword']);
    
    if (!empty($_POST['email']) && !empty($_POST['password'])
            && !empty($_POST['username']) && !empty($_POST['repeatPassword'])) {
        
        if ($password == $repeatPassword) {
         
            $newUser = new User();
            $newUser ->setUsername($username);
            $newUser ->setPassword($password);
            $newUser ->setEmail($email);
            $isExist = $newUser ->saveToDB($conn);
            if ($isExist == null) {
                $switch = 1;
            } else {             
                $_SESSION['id'] = $newUser ->getId();
                header("Location: mainBoard.php");
            }            
        } else {
            $switch = 2;            
        }
    } else {
        $switch = 3;        
    } 
} 
$title = 'Twitter - New User';
require_once 'header.php';
switch ($switch) {
    case 1:
        echo 'Email się powtarza';
        break;
    case 2:
        echo 'Podane hasła nie zgadzają się';
        break;
    case 3:
        echo 'Wypełnij wszystkie pola lub zaloguj się ponownie';
        break;                    
}
?>
<form action="" method="post" role="form">
    <br>
    <legend>Utwórz konto</legend>
    <div class="form-group">
        <label for="">Nazwa użytkownika</label>
        <input type="text" class="form-control" name="username" id="email"
               placeholder="Nazwa użytkownika">
    </div>
    <div class="form-group">
        <label for="">Adres e-mail</label>
        <input type="email" class="form-control" name="email" id="email"
               placeholder="email@email.com">
    </div>
    <div class="form-group">
        <label for="">Hasło</label>
        <input type="password" class="form-control" name="password" id="email"
               placeholder="Hasło">
        <input type="password" class="form-control" name="repeatPassword" id="email"
               placeholder="Powtórz hasło">
    </div>
    <center><button type="submit" value="register" name="register" class="btn btn-primary">Zarejestruj się</button></center>

</form>
</br>
<form action="login.php" method="post" role="form">
    <center><button type="submit" value="login" name="login" class="btn btn-danger">Zaloguj się</button></center>
</form>
            
<?php
require_once 'footer.php';
