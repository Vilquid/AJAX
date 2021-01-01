<?php
class UserClient
{
    /**
     * Classe User avec les informations clients
     **/
    const DEFAULTPHOTO = 'https://icons.iconarchive.com/icons/papirus-team/papirus-status/64/avatar-default-icon.png';

    private $_id=0;
    private $_pseudo='';
    private $_photo='';
    private $_date_creation='';

    public function setId($id) {$this->_id=$id;}
    public function getId() {return $this->_id;}
    public function setPseudo($pseudo) {$this->_pseudo=$pseudo;}
    public function getPseudo() {return $this->_pseudo;}
    public function setPhoto($photo) {$this->_photo=$photo;}
    public function getPhoto() {return $this->_photo;}
    public function setDate_creation($date_creation) {$this->_date_creation=$date_creation;}
    public function getDate_creation() {return $this->_date_creation;}

    private function hydrate($data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            $this->$method($value);
        }
    }

    public function __construct($data){
        $this->hydrate($data);
    }

    public function getRealPhoto(){
        if($this->_photo){
            return 'data:image/png;base64,'.base64_encode($this->_photo);
        }else{
            return self::DEFAULTPHOTO;
        }
    }
}
