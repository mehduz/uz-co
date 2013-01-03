<?php
class Uz_Service_HTTP_Request{
	
	protected $currentModule;
	protected $currentAction;
	
	public function getCurrentModule()
	{
		return $this->$currentModule;
	}
	public function getCurrentAction()
	{
		return $this->$currentAction;	
	}
	
	
}