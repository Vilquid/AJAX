<?php
class ElementSujet{
    /**
     * Fait pour la liste des sujets sur la page sujets et sur l'accueil
     */
    
     private $_id = 0;
     private $_titre = '';
     private $_message = '';
     private $_user_id = 0;
     private $_date_post = '';
     private $_forum_id = 0;
    
    public function getId(){return $this->_id;}
    public function setId($id){$this->_id=$id;}
    public function getTitre(){
        return htmlspecialchars($this->_titre);
    }
    public function setTitre($titre){$this->_titre=$titre;}
    public function getMessage(){
        return htmlspecialchars($this->_message);
    }
    public function setMessage($message){$this->_message=$message;}
    public function getUser_id(){return $this->_user_id;}
    public function setUser_id($user_id){$this->_user_id=$user_id;}
    public function getDate_post(){return $this->_date_post;}
    public function setDate_post($date_post){$this->_date_post=$date_post;}
    public function getForum_id(){return $this->_forum_id;}
    public function setForum_id($forum_id){$this->_forum_id=$forum_id;}

     private function hydrate($data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            $this->$method($value);
        }
    }

    public function __construct($data){
        $this->hydrate($data);
    }
}