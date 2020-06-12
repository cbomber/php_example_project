<?php

class UserEntity {

    public $id;
    public $username;
    public $password;

    public function __construct(array $data){
        if(isset($data['UserID'])){
            $this->id = $data['UserID'];
        }

        $this->username = $data['Username'];
        $this->password = $data['Password'];
    }
    
}