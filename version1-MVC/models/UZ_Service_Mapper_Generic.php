<?php
abstract class UZ_Service_Mapper_Generic{
	protected static $cnx;
	protected static $protocol;// dans conf
	protected static $host; //dans conf
	protected static $db_name;//dans conf
	protected static $user;// dans conf
	protected static $pass;// dans conf
	protected static $req;
	protected static $values;
	protected static $ptypes;
	const CONNEXION_ERROR='Erreur lors de la connexion à la base de données : ';
	
	public static function init($configuration ){ //$conf tabl associatif a vec clé= nomattribut de la class
		static::$protocol=$configuration['protocol'];
		static::$host=$configuration['host'];
		static::$db_name=$configuration['db_name'];
		static::$user=$configuration['user'];
		static::$pass=$configuration['pass'];
	}
	
	public static function __construct($data=array()){
		// UZ_Service_Profiler->start()
		static::openConnexion();
		
		//ici on fait la requete 
		$this->request($data);
		
		static::closeConnexion();
		// UZ_Service_Profiler->show()
		
		
	}
	


	
public static function getURL(){
	return static::$protocol.'host='.static::$host.';dbname='.static::$db_name;
	
}
	
public static function openConnexion(){
		$options=array(PDO::ATTR_PERSITAENT=> true);
		try
		{
			
			static::$cnx= new PDO(static::getURL(),static::$user,static::$pass ,$options) ;// une connexion
			return static::$cnx;
		}
		catch(PDOException $e)
		{
			throw UZ_Exception(CONNEXION_ERROR);
		}
	
} 

public static function closeConnexion(){
static::$cnx = null;
}

abstract protected function request($data=array()){
	
	
}


}