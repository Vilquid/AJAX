<?php
	class User
	{
		private $_email = "";
		private $_pseudo = "";
		private $_id = 0;
		private $_password = "";

		public function hydrate(array $data)
		{
			foreach ($data as $key => $value)
			{
				// On récupère le nom du setter correspondant à l'attribut.
				$method = 'set_' . $key;
	
				// Si le setter correspondant existe.
				if (method_exists($this, $method))
				{
					$this->$method($value);
				}
			}
		}

		public function __construct(array $data)
		{
			$this->hydrate($data);
		}

		public function set_pseudo($data)
		{
			$this->_pseudo = $data["pseudo"];
		}

		public function set_password($data)
		{
			$this->_password = $data["password"];
		}

		public function set_email($data)
		{
			$this->_email = $data["email"];
		}

		public function set_id($data)
		{
			$this->_id = $data["id"];
		}

		public function get_pseudo()
		{
			return $this->_pseudo;
		}

		public function get_password()
		{
			return $this->_password;
		}

		public function get_email()
		{
			return $this->_email;
		}

		public function get_id()
		{
			return $this->_id;
		}
	}
?>