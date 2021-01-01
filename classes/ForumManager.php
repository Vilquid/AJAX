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
}