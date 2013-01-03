<?php
class Uz_View_Template
{
	protected $phtml_file;
	
	public function __construct($file=null, array $values=null, $render=false)
	{
		if($file!==null){
			$this->defineTemplate($file);
			if($values!==null){
				$this->assign($values);
				if($render===true){
					$this->render();
				}
			}		
		}
	}

	public final function defineTemplate($file)
	{
		$this->phtml_file=$file;
	}

	/*pour parametrer le template, il manque juste les variables faut qu'on y réfléchisse (genre nb de menus, nb de sous menus, nb sections, etc)*/
	public final function assign(array $values)
	{
		foreach($values as $key=>$val){
			$this->$key=$val;
	}

	public function render()
	{
		/*on bufferise la sortie*/
		try{
			ob_implicit_flush(false);
			ob_start();
			include $this->phtml_file;
			ob_end_flush();
		} catch(Exception $e){
			ob_end_clean();
		}	
	}

}
?>
