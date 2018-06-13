<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
  // http://127.0.0.1:8000/twig/?name=Robert
  public function twig(Request $request)
  {
    $name = $request->get('name');
    $message = "Hello my friend {$name}";
    return $this->render('base.html.twig', [ 
      'message' => $message,
      'number' => -5,
      'published_at' => new \DateTime()] );
  }   
}