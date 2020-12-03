<?php
	class COMPTE
	{

		
		public function __construct($pseudo = NULL, $email = NULL)
		{
			if (!is_null($pseudo) && !is_null($email))
			{
				// Si aucun de $m, $c et $i sont nuls,
				// c'est forcement qu'on les a fournis
				// donc on retombe sur le constructeur à 3 arguments
				$this->pseudo = $pseudo;
				$this->email = $email;
			}
		}
	}
	
	public function MissingException($text)
	{
		echo $text;
	}

	spl_autoload_register(function($COMPTE))
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
		die('Erreur : ' . $e->getMessage());
	}
?>