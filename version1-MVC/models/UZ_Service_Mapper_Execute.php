<?php
abstract class UZ_Service_Mapper_Execute extends UZ_Service_Mapper_Generic{
	
	const ERROR_PREPARE='ERREUR lors de la préparation de la requete';
	const ERROR_EXECUTE='ERREUR lors de l\'exectuion de la requete';
	const ERROR_BIND='ERREUR lors de l\'affectation d\'un parametre';
	
	
	
	public function request($data=array())
	{//data contient param 
		setValues($data);
		$stmt=$cnx->prepare($this->$req);
		if($stmt===null)
		{
			throw UZ_Exception(ERROR_PREPARE);	
		}
		foreach($this->$values as $field=>$value)
		{
			$type= static::$ptype[$field];
			
			$res=$stmt->bindValue($field,$value,$type);
			if($res===false)
			{
				throw UZ_Excetpion(ERROR_BIND);
			}
			
		}
		if($stmt->execute()===false)
		{
			throw UZ_Exception(ERROR_EXECUTE);
		}
		
		$this->actionAfterExecute($stmt);
	}
	
	
	public function setValues($ata=array())
	{
		$this->$values=$data;
	}
	abstract protected function actionAfterExecute($stmt);
}