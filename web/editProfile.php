<?php
session_start();
require_once '../src/connection.php';
require_once '../src/User.php';
require_once 'isLogged.php';
$switch = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])
        && isset($_POST['password']) && isset($_POST['username'])
        && isset($_POST['repeatPassword']) && is_numeric($_SESSION['id']) && !empty($_SESSION['id'])) {
    
    if (!empty($_POST['email']) && !empty($_POST['password'])
            && !empty($_POST['username']) && !empty($_POST['repeatPassword'])) {
        
        $newPassword = trim($_POST['password']);
        $newRepeatPassword = trim($_POST['repeatPassword']);
        $newUsername = trim($_POST['username']);
        $newEmail = trim($_POST['email']);
        
        if ($newPassword == $newRepeatPassword ) {
            $editUser = User::loadUserById($conn, $id);
            $editUser ->setUsername($newUsername);
            $editUser ->setPassword($newPassword);
            $editUser ->setEmail($newEmail);
            $isExist = $editUser ->saveToDB($conn);
            if ($isExist == null) {
                $switch = 1;
            } else {
                $_SESSION['id'] = $editUser ->getId();
                header("Location: userBoard.php");
            }
        } else {
            $switch = 2;           
        }
        
    } else {
        $switch = 3;        
    } 
} 
$title = 'Twitter - Edit Profile';
require_once 'header.php';
?>

<?php
switch ($switch) {
    case 1:
        echo 'Email się powtarza';
        break;
    case 2:
        echo 'Podane hasła nie są identyczne';
        break;
    case 3:
        echo 'Wypełnij wszystkie pola lub zaloguj się ponownie';
        break;                    
}
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
        <form action="" method="post" role="form">
            <legend><?php echo $user->getUsername(); ?> </br>Tutaj zmienisz swoje dane</legend>
            <div class="form-group">
                <label for="">Nowa nazwa użytkownika</label>
                <input type="text" class="form-control" name="username" id="email" value='<?php echo $user->getUsername(); ?>'>
            </div>
            <div class="form-group">
                <label for="">Nowy adres e-mail</label>
                <input type="email" class="form-control" name="email" id="email" value='<?php echo $user->getEmail(); ?>'>
            </div>
            <div class="form-group">
                <br>
                <label for="">Nowe hasło</label>
                <input type="password" class="form-control" name="password" id="email" placeholder="Nowe hasło"><br>
                <input type="password" class="form-control" name="repeatPassword" id="email" placeholder="Powtórz nowe hasło">
            </div>
            <button type="submit" value="editProfile" class="btn btn-info">Zapisz dane</button>
        </form>
        <br>
        <form action="deleteUser.php" method="post" role="form">
            <button type="submit" value="deleteUser" class="btn btn-danger">Usuń konto</button>
        </form>
    </center>
<?php
require_once 'footer.php';
