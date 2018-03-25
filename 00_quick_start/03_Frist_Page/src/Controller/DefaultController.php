<?php
// src/Controller/DefaultController.php
/* We indicate the namespace of the Bundle ********************************************************************/
    namespace App\Controller;
/* BASIC CONTROLLER COMPONENTS ********************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
    use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
/**************************************************************************************************************/
class DefaultController {
/* HOME METHOD ************************************************************************************************/
    public function index() {
        return new Response('Mi primera pagina en Symfony!');
    }
/**************************************************************************************************************/
}