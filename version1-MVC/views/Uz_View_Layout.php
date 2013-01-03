<?php
class Uz_View_Layout{
	protected $views=array();
	protected $phtml_file;

	public function __construct($file=null, array $views=null, $context=null, $build=true)
	{
		if($file!==null){
			$this->defineTemplate($file);
			if($context!==null){
				$this->assign($context);
				if($views!==null){
					$this->setViews($views);
					if($buid){
					$this->build;
					}
				}
			}
		}
	}

	public final function defineTemplate($file){
		$this->phtml_file=$file;
	}

	public final function addView($name, Uz_View_Template $view){
		$this->views[$name]=$view;
	}

	public final function setViews(array $views){
		$this->views=$views;
	}

	/*pour les parametres qu'on aura choisi(comme la volumétrie, etc, ou autre), pas obligatoire, cf constructeur*/
	public final function assign(array $values){
		foreach($values as $key=>$val){
			$this->key=$val;
		}
	}

	public final function build()
	{
		try{
			ob_implicit_flush(false);
			ob_start();
			include $this->phtml_file;
			/*Envoie le contenu du tampon de sortie (s'il existe) et éteint la tamporisation de sortie.*/
			ob_end_flush();
		}catch(Exception $e){
			/*Détruit les données du tampon de sortie et éteint la tamporisation de sortie*/
			ob_end_clean();
		}
	}

	public final function render($name){
		$this->views[$name]->render();
	}
}
?>
