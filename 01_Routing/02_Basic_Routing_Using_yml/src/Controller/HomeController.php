<?php
// src/Controller/DefaultController.php
/* We indicate the namespace of the Bundle ********************************************************************/
    namespace App\Controller;
/* BASIC CONTROLLER COMPONENTS ********************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
    use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
/**************************************************************************************************************/
class HomeController {
    public function index() {
        $section_array = array('life','sport','ecconomy');
        $view_page = '<h1>News Daily Mirror !</h1>';
        foreach($section_array as $key=>$value){
            $view_page = $view_page.'<a href="/news/'.$value.'">'.$value.'</a><br>';
        }
        // return new Response('<h1>News Daily Mirror !</h1>');
        return new Response($view_page);
    }
/**************************************************************************************************************/
}