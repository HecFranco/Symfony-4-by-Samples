<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller{
    public function index(Request $request): Response  {
        //$em = $this->getDoctrine()->getManager();
        return $this->render('default/index.html.twig');
    }
}