<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function index(Request $request): Response  {
        $message = "Hello World";
        $message_2 = "Hello World from Message_2";
        return $this->render('default/index.html.twig', 
            array(
                'message'=>$message,
                'message_2'=>$message_2
            )
        );
    }
}