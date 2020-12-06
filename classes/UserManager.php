<?php
class UserManager{

    private $_bdd=null;

    public function __construct(){
        $this->_bdd = new PDO("mysql:host=localhost;dbname=ouahjax","ouahjax","");
    }

    public function emailExist($email){
        $resquest = $this->_bdd->prepare("SELECT count(email) as exist FROM `users` WHERE email like ? GROUP BY email");
        $resquest->execute([$email]);
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

// modifier user ma pour (ajoueter une fonc addUser qui permet d'ajouter un utilisateur à la bdd penser que l'on peut ajouter un password)