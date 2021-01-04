<?php
class UserManager
{

	private $_bdd = null;
	private $_password_crypt_option = [
		'cost' => 12
	];

	public function __construct()
	{
		$this->_bdd = new PDO("mysql:host=localhost;dbname=ouahjax", "ouahjax", "");
        $this->_bdd->exec("SET NAMES utf8;");
	}

	public function emailExist($email)
	{
		$resquest = $this->_bdd->prepare("SELECT count(email) as exist FROM `users` WHERE email like ? GROUP BY email");
		$resquest->execute([$email]);
		$result = $resquest->fetch(PDO::FETCH_ASSOC);
		return isset($result['exist']) ? true : false;
	}

	public function pseudoExist($pseudo)
	{
		$request = $this->_bdd->prepare("SELECT count(pseudo) as exist FROM `users` WHERE pseudo like ? GROUP BY pseudo");
		$request->execute([$pseudo]);
		$result = $request->fetch(PDO::FETCH_ASSOC);
		return isset($result['exist']) ? true : false;
	}


	public function getUserClientById($id) {
		$request = $this->_bdd->prepare("SELECT id, pseudo, photo, date_creation FROM users WHERE id = ?");
		$request->execute([$id]);
		$data = $request->fetch(PDO::FETCH_ASSOC);
		if ($data) {
			return new UserClient($data);
		} else {
			return null;
		}
	}

	public function getUserEmail($id){
		$request = $this->_bdd->prepare("SELECT email FROM users WHERE id = ?");
		$request->execute([$id]);
		$data = $request->fetch(PDO::FETCH_ASSOC);
		if ($data) {
			return $data['email'];
		} else {
			return null;
		}
	}

	public function getPseudoById($id) {
		$request = $this->_bdd->prepare("SELECT pseudo FROM users WHERE id = ?");
		$request->execute([$id]);
		$data = $request->fetch(PDO::FETCH_ASSOC);
		if ($data) {
			return $data['pseudo'];
		} else {
			return '';
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
		$hash_password = password_hash($password,PASSWORD_BCRYPT,$this->_password_crypt_option);
		$a = $this->emailExist($email);
		$b = $this->pseudoExist($pseudo);

		if ($a == false && $b == false)
		{
			$request = $this->_bdd->prepare("INSERT INTO `users` (pseudo, email, `password`) VALUES (?, ?, ?);");
			$request->execute([$pseudo, $email, $hash_password]);
			if ($request->errorInfo()[0] == 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function connexion($email, $password)
	{
		$request = $this->_bdd->prepare("SELECT id, password FROM users WHERE email= ?;");
		$request->execute([$email]);
		$data = $request->fetch(PDO::FETCH_ASSOC);
		if($data){
			if(password_verify($password, $data['password'])){
				return $data['id'];
			}
		}else{
			return 0;
		}
	}

	public function getNombreMembre(){
		$request = $this->_bdd->prepare("SELECT count(id) as nb FROM users;");
		$request->execute();
		$data = $request->fetch(PDO::FETCH_ASSOC);
		return $data['nb'];
	}

	public function changePhoto($user_id, $photo_bin){
		$request = $this->_bdd->prepare("UPDATE users SET photo = ? WHERE id = ?");
		$request->execute([$photo_bin, $user_id]);
	}
}
