<?php
// src/Controller/DefaultController.php
/* Symfony Components ****************************************************************************************/
    namespace App\Controller;
/* Symfony Components ****************************************************************************************/
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Allow Router
    use Symfony\Component\HttpFoundation\Response;                  // Allows you to execute the Response method
/*************************************************************************************************************/
class HomeController extends Controller {
    public function index() {
        //return new Response('Wellcome to Homepage');
        return $this->render('base.html.twig');        
    }
/*************************************************************************************************************/
}