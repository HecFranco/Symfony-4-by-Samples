<?php
/* Namespace **************************************************************************************************/
    namespace App\Entity;
/* Añadimos el VALIDADOR **************************************************************************************/
	use Symfony\Component\Validator\Constraints as Assert;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;	
/**************************************************************************************************************/
class AppConfig {
/* Listamos Opciones Asociadas ********************************************************************************/	
	private $appConfigOptionsList;
	public function getAppConfigOptionsList() { return $this->appConfigOptionsList; }
	public function addAppConfigOptionsList(AppConfigOptions $appConfigOptionsList) { $this->appConfigOptionsList[] = $appConfigOptionsList; return $this; } 
	public function removeAppConfigOptionsList(AppConfigOptions $appConfigOptionsList) { $this->appConfigOptionsList->removeElement($appConfigOptionsList); }
/**************************************************************************************************************/
/* CONSTRUCTOR ************************************************************************************************/
	// Un ArrayCollection es una implementación de colección que se ajusta a la matriz PHP normal.    
	public function __construct() {	
		$this->appConfigOptionsList = new ArrayCollection(); 		
	}
/* Id de la Tabla *********************************************************************************************/
    private $id;
    public function getId() { return $this->id; }
/**************************************************************************************************************/
/* option *****************************************************************************************************/
    private $option;
	public function setOption (AppConfigOptions $option =null) { $this->option = $option; /*return $this;*/ }
	public function getOption() { return $this->option; } 
/**************************************************************************************************************/
/* name *******************************************************************************************************/
	private $name;
	public function setName($name) { $this->name = $name; /*return $this;*/ }
	public function getName() { return $this->name; }
/**************************************************************************************************************/
}