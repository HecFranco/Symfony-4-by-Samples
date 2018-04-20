<?php
// src/Controller/ControllerController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemoController extends Controller {
  public function showControllerWithVariable(request $request, $slug) {
    return new Response('Controller example with variable value $ slug:'.$slug);
  }
  public function showControllerWithVariableDefault(request $request, $firstName, $lastName, $color="green") {
    return new Response('Example of controller with three variables, two per route: '.$firstName.' Y '.$lastName.', and one by default.'.$color);

  } 
  public function exampleControllerRedirectExternalUrl() {
    // Redirect to an external url
    return $this->redirect('http://symfony.com/doc');
  } 
  public function exampleControllerRedirectInternalUrl_generateUrl() {
    // The generateUrl() method is just an auxiliary method that generates the URL for a particular route:
    $url = $this->generateUrl('example_controller_with_variable', array('slug' => 'hello'));
    return $this->redirect($url);
  }   
  public function exampleControllerRedirectInternalUrl_redirectToRoute() {
    return $this->redirectToRoute('example_controller_with_variable', array('slug' => 'hello'));
  } 
}