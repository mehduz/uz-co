<?php
// commentaire UZ
abstract class Uz_Bootstrap{

	protected static $application_namespace;
	protected static $application_path;
	protected static $framework_namespace;
	protected static $framework_path;
	protected static $error_controller;


	public static function init($application_namespace, $application_path){
		//C'est le bootstrap de l'application qui donne ces informations
		static::$application_namespace=$application_namespace;
		static::$application_path=$application_path;
		
		//Le reste se calcule
		$current_file=__FILE__;
		$walking=explode('/',$current_file); /*retourne un tableau de chaines*/
		$file=array_pop($walking); /*retourne la derniere valeur du tableau, et la retire*/
		$path=implode('/',$walking); /*créer une chaine avec le séparateur '/'*/
		static::$framework_namespace=$namespace; /*attention il faut instancier cette variable*/
		static::$framework_path=$path;
	}

	public static function run(){
		try{
			//Mise en place de l'environnement
			static::setEnvironnement();
			//Verification des ACL et modification de la requête en conséquence
			static::check();
			//Lancement de l'action qui renvoit directement au client si besoin
			Uz_Controller_Dispatcher::dispatch();
		}catch(Exception $e){
			static::error();
		}
	}
	
	public static function setEnvironnement()
	{
		//On rend l'autoloader disponible
		Uz_Autoloader::init(array(static::$framework_namespace=>$framework_path, static::$application_namespace=>static::$application_path),static::$framework_namespace,array());
		//On construit la session
		Uz_Service_HTTP_Session::build();
		//On recupere la requete dans cet objet
		Uz_Service_HTTP_Request::build();
		Uz_Controller_Dispatcher::init(static::$application_namespace);
		Uz_Mapper_Generic::init(static::configureDb());
		
	}
	protected abstract function check();
	protected abstract function configureDb();
	protected abstract function error();		
}
?>
