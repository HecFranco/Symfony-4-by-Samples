<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

 use App\Service\Greeting;

class BlogController extends AbstractController
{
  private $greeting;
  public function __construct(Greeting $greeting)
  {
    $this->greeting = $greeting;
  }  
  public function response(Request $request)
  {
    $name = $request->get('name');
    return new Response(
      '<html><body>New Name: '.$name.'</body></html>'
    );
  }
  public function twig(Request $request)
  {
    $name = $request->get('name');
    $message = $this->greeting->greet( $name );
    return $this->render('base.html.twig', [ 'message' => $message  ] );
  }   
}