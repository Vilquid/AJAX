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

	public function getPhotoByMessageID($id_message)
	{
		$request = $this->_bdd->prepare("SELECT photo FROM users, messages WHERE users.id = messages.id_user AND messages.id = ?;");
		$request->execute([$id_message]);
		$data = $request->fetch(PDO::FETCH_ASSOC);
		if($data)
		{
			return $data["photo"];
		}
		else
		{
			return null;
		}
	}
	
	public function addUser($pseudo, $email, $password)
	{
		$a = $this->emailExist($email);
		$b = $this->pseudoExist($pseudo);

		if ($a == false && $b == false)
		{
			$request = $this->_bdd->prepare("INSERT INTO `users` (pseudo, email, `password`) VALUES (?, ?, ?);");
			$request->execute([$pseudo, $email, $password]);
			if($request->errorInfo()[0] == 00000){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}