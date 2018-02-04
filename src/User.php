
<?php
class User {
    private $id;
    private $username;
    private $hashPass;
    private $email;
    
    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashPass = "";
    }
        
    public function setUsername($newUsername) {
        if (!empty($newUsername)) {
            $this->username = $newUsername;
            return $this;
        } else {
            return NULL;
        }
    }
    
    public function setPassword($newPassword) {
        if (!empty($newPassword)) {
            $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $this->hashPass = $newHashedPassword;
            return $this;
        } else {
            return NULL;
        }
    }
    
    public function setEmail($newEmail) {
        //TO DO walidacja: regex email validation
        if (!empty($newEmail)) {
            $this->email = $newEmail;
            return $this;
        } else {
            return NULL;
        }
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getUsername() {
        return $this->username;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getPassword() {
        return $this->hashPass;
    }
    
    public function saveToDB(mysqli $connection){
        if($this->id == -1){
            //Saving new user to DB
            $sql = "INSERT INTO Users(username, email, hash_pass)
                    VALUES ('$this->username', '$this->email', '$this->hashPass')";
            $result = $connection->query($sql);
                if($result == true){
                    $this->id = $connection->insert_id;
                    return true;
                }
        } else{
            $sql = "UPDATE Users SET username='$this->username',
                                    email='$this->email',
                                    hash_pass='$this->hashPass'
                                    WHERE id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                return true;
            }
        }
        return false;
    }
    
    static public function loadUserById(mysqli $connection, $id){
        $sql = "SELECT * FROM Users WHERE id=$id";
        
        $result = $connection->query($sql);
            if($result == true && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
            
        }
        return null;
    }
    
    static public function loadAllUsers(mysqli $connection){
        $sql = "SELECT * FROM Users";
        $ret = [];
        $result = $connection->query($sql);
        if($result == true && $result->num_rows != 0){
            foreach($result as $row){
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashPass = $row['hash_pass'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
                }
        }
        return $ret;
    }
    
    public function delete(mysqli $connection){
        if($this->id != -1){
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);
            if($result == true){
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
}
