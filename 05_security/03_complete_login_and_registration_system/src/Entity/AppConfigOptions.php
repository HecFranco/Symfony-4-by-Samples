<?php
/* Namespace **************************************************************************************************/
    namespace App\Entity;
/* Añadimos el VALIDADOR **************************************************************************************/
	use Symfony\Component\Validator\Constraints as Assert;
	use Doctrine\Common\Collections\ArrayCollection;
	use Doctrine\Common\Collections\Collection;	
/**************************************************************************************************************/
class AppConfigOptions {
/* Id de la Tabla *********************************************************************************************/
    private $id;
    public function getId() { return $this->id; }
/**************************************************************************************************************/
/* appConfig **************************************************************************************************/
    private $appConfig;
	public function setAppConfig (AppConfig $appConfig =null) { $this->appConfig = $appConfig; /*return $this; */}
	public function getAppConfig() { return $this->appConfig; } 
/**************************************************************************************************************/
/* name *******************************************************************************************************/
	private $name;
	public function setName($name) { $this->name = $name; /*return $this;*/ }
	public function getName() { return $this->name; }
/**************************************************************************************************************/
}