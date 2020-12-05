<?php
class UserManager{

    private $_bdd=null;

    public function __construct(){
        $this->_bdd = new PDO("mysql:host=localhost;dbname=ouahjax","ouahjax","");
    }

    public function emailExist($mail){
        $resquest = $this->_bdd->prepare("SELECT count(mail) as exist FROM `users` WHERE mail like ? GROUP BY mail");
        $resquest->execute([$mail]);
        $result = $resquest->fetch(PDO::FETCH_ASSOC);
        return isset($result['exist'])?true:false;
    }

    public function pseudoExist($pseudo){
        $request = $this->_bdd->prepare("SELECT count(pseudo) as exist FROM `users` WHERE pseudo like ? GROUP BY pseudo");
        $request->execute([$pseudo]);
        $result = $request->fetch(PDO::FETCH_ASSOC);
        return isset($result['exist'])?true:false;
    }

    public function getUserById($id){
        $request = $this->_bdd->prepare("SELECT id, pseudo, email FROM users WHERE id = ?");
        $request->execute([$id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if($data){
            return new User($data);
        }else{
            return null;
        }
    }
}