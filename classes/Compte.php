<?php
	class COMPTE($data)
	{
		var $email;
		var $password;
		var $pseudo;
		var $nb_posts;

		public function __construct($pseudo = NULL, $email = NULL, $password = NULL, $nb_posts = NULL)
		{
			if (!is_null($pseudo) && !is_null($email) && !is_null($nb_posts) && !is_null($password))
			{
				$this->pseudo = $pseudo;
				$this->email = $email;
				$this->nb_posts = $nb_posts;
				$this->password = $password;
			}
		}

		// CHANGEMENT DES INFOS DE L'UTILISATEUR
		public function changer_son_pseudo($pseudo)
		{
			// $this->pseudo = Récupérer le pseudo dans une variable
		}

		public function changer_son_email($email)
		{
			// $this->email = Récupérer le email dans une variable
		}

		public function changer_son_password($password)
		{
			// $this->password = Récupérer le password dans une variable
		}

		public function augmenter_le_nb_de_posts($nb_posts)
		{
			//$this->nb_posts
		}


		// MISE A JOUR DE LA BASE DE DONNEES
		public function MAJ_BDD_pseudo($pseudo)
		{
			
		}
		
		public function MAJ_BDD_email($email)
		{
			
		}
		
		public function MAJ_BDD_password($password)
		{
			
		}
		
		public function MAJ_BDD_nb_de_posts($nb_posts)
		{
			
		}
	}
	
	public function MissingException($text)
	{
		echo $text;
	}

	spl_autoload_register(function($COMPTE)
	{
		include $COMPTE.'php';
		throw new MissingException("Impossible de charger $COMPTE.");
	});



	// Connexion à la base de données            
	// Le dernier argument sert à ce que toutes les chaines de caractères 
	// en entrée et sortie de MySql soit dans le codage UTF-8
	self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
	array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
	self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	


	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}


	// On admet que $db est un objet PDO.
	$request = $db->query('SELECT id, nom, experience, pointvierestant FROM aventurier');

	while ($donnees = $request->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.
	{
	$perso = new Aventurier($donnees);

	echo $perso->nom(), ' a ', $perso->experience(), ' d\'expérience et ', $perso->pointdevierestant(), ' de vie, ';

	}

?>