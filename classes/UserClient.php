<?php
class UserClient
{
    /**
     * Classe User avec les informations clients
     **/
    private $id=0;
    private $pseudo='';
    private $photo='';
    private $date_creation='';

    public function setId($id) {$this->id=$id;}
    public function getId() {return $this->id;}
    public function setPseudo($pseudo) {$this->pseudo=$pseudo;}
    public function getPseudo() {return $this->pseudo;}
    public function setPhoto($photo) {$this->photo=$photo;}
    public function getPhoto() {return $this->photo;}
    public function setDate_creation($date_creation) {$this->date_creation=$date_creation;}
    public function getDate_creation() {return $this->date_creation;}

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
