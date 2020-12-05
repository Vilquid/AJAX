<?php
	class User
	{
		$email = " ";
		// $password = "";
		$pseudo = " ";
		$id = 0;

		public function __construct($data)
		{
			$this->pseudo = $data["pseudo"];
			$this->email = $data["email"];
			$this->id = $data["id"];
			// $this->password = $data["password"];
		}
	}
?>