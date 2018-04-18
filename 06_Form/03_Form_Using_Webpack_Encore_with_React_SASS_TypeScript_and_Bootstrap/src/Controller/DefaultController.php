<?php
// src/Controller/DefaultController.php
  namespace App\Controller;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
  use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
  use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class DefaultController extends Controller {
    public function index() {
      return $this->render('default/index.html.twig');
    }
}