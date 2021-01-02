<?php
/**
 * Manager qui gère les informations relatives au forum
 */
class ForumManager{
    private $_bdd = null;

    public function __construct()
	{
		$this->_bdd = new PDO("mysql:host=localhost;dbname=ouahjax", "ouahjax", "");
    }
    
    public function getNombreForum(){
        $request = $this->_bdd->prepare("SELECT count(id) as nb FROM forums;");
		$request->execute();
		$data = $request->fetch(PDO::FETCH_ASSOC);
		return $data['nb'];
    }

    public function getNombreSujet(){
        $request = $this->_bdd->prepare("SELECT count(id) as nb FROM sujets;");
		$request->execute();
		$data = $request->fetch(PDO::FETCH_ASSOC);
		return $data['nb'];
    }

    public function getRandomSujet($nb){
        $request = $this->_bdd->prepare("SELECT * FROM `sujets` ORDER BY RAND() LIMIT $nb");
        $request->execute();
        $data = $request->fetchAll(PDO::FETCH_ASSOC);
        $ret = [];
        for($i = 0; $i < count($data); $i++) {
            $ret[$i] = new ElementSujet($data[$i]);
        }
        if(count($data)){
            return $ret;
        }else{
            return null;
        }
    }

    public function getNombreReponses($id){
        $request = $this->_bdd->prepare("SELECT count(id) AS nb FROM `messages` WHERE id_sujet = ?");
        $request->execute([$id]);
        $data = $request->fetch(PDO::FETCH_ASSOC);
        if($data){
            return $data['nb'];
        }else{
            return 0;
        }
    }

    public function getLastPost($sujet_id){
        $request = $this->_bdd->prepare("SELECT id_user, date FROM messages WHERE id_sujet = ?");
        $request->execute([$sujet_id]);
        return $request->fetch(PDO::FETCH_ASSOC);
    }
}