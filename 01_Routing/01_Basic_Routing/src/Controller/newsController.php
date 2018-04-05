<?php
// src/Controller/DefaultController.php
/* We indicate the namespace of the Bundle ********************************************************************/
    namespace App\Controller;
/* BASIC CONTROLLER COMPONENTS ********************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Allow Router
    use Symfony\Component\HttpFoundation\Response;                  // Allows you to execute Response
/**************************************************************************************************************/
class newsController {
    public function viewSection($section) {
        $view_page = '<h1>News about '.$section.'</h1><br>'.
        '<a href="/">return home</a>';
        return new Response($view_page);
    }
}