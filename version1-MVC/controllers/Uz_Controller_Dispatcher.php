<?php
class Uz_Controller_Dispatcher{
	protected static $application_namespace;
	const CLASS_NOT_FOUND='Pas de classe trouvée dans l\'espace de noms';


	public static final function init($application_namespace){
		static::$application_namespace=$application_namespace;
	}

	public final static function dispatch(){
		$controller_name=static::$application_namespace.'_Controller_'.ucfirst(Uz_Service_HTTP_Request::getCurrentModule()).'_'.ucfirst(Uz_Service_HTTP_Request::getCurrentAction());
		$controller=new $controller_name();
	}
}
?>
