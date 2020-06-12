<?php 

class UserMapper extends db {

    public function getUserByUsername(string $username){
        
        $params = array();

        $sql = "SELECT * FROM users WHERE Username = :user";
        $query = $this->prepare($sql);

        if($query->execute(["user" => $username]) && $query->rowCount()>0) {
            return new UserEntity($query->fetch(PDO::FETCH_ASSOC));
        } 
        
    }

}