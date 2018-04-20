<?php
// src/Controller/ControllerController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DemoController {
  public function showControllerWithVariable(request $request, $slug) {
    var_dump($request);die();
    return new Response('Controller example with variable value $ slug:'.$slug);
  }
  public function showControllerWithVariableDefault(request $request, $firstName, $lastName, $color="green") {
    return new Response('Example of controller with three variables, two per route: '.$firstName.' Y '.$lastName.', and one by default.'.$color);

  }    
}