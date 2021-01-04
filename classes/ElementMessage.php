<?php
class ElementMessage{
    /**
     * Fait pour la liste des messages sur la page post
     */
    
     private $_id = 0;
     private $_id_sujet = 0;
     private $_message = '';
     private $_id_user = 0;
     private $_date = '';
     private $_id_parent = 0;

    
    public function getId(){return $this->_id;}
    public function setId($id){$this->_id=$id;}
    public function getMessage(){
        return htmlspecialchars($this->_message);
    }
    public function setMessage($message){$this->_message=$message;}
    public function getId_user(){return $this->_id_user;}
    public function setId_user($id_user){$this->_id_user=$id_user;}
    public function getDate(){return $this->_date;}
    public function setDate($date){$this->_date=$date;}
    public function getId_sujet(){return $this->_id_sujet;}
    public function setId_sujet($id_sujet){$this->_id_sujet=$id_sujet;}
    public function getId_parent(){return $this->_id_parent;}
    public function setId_parent($id_parent){$this->_id_parent=$id_parent;}

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