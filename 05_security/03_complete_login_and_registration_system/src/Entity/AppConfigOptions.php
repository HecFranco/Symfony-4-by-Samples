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
	public function setAppConfig (AppConfig $appConfig) { $this->appConfig = $appConfig; return $this; }
	public function getAppConfig() { return $this->appConfig; } 
/**************************************************************************************************************/
/* option *****************************************************************************************************/
	private $option;
	public function setOption($option) { $this->option = $option; return $this; }
	public function getOption() { return $this->option; }
/**************************************************************************************************************/
}