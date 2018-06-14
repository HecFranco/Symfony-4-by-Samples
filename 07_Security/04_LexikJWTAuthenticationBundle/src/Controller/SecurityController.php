<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\User;

class SecurityController extends Controller
{
  public function signup(Request $request, UserPasswordEncoderInterface $encoder)
  {  
    // Entity manager
    $firstName = $request->get("firstName", null);
    $lastName = $request->get("lastName", null);
    $email = $request->get("email", null);
    $password = $request->get("password", null);

    // Validate Email
    $emailConstraint = new Assert\Email();
    $emailConstraint->message = "This email is not valid !!";
    $validate_email = $this->get("validator")->validate($email, $emailConstraint);   

    $em = $this->getDoctrine()->getManager();
    $user = new User($email);
    $user->setPlainPassword($password);
    $user->setPassword($encoder->encodePassword($user, $password));
    $user->setUsername($email);
    $user->setEmail($email);
    $em->persist($user);
    $em->flush();
    return new Response(sprintf('User %s successfully created', $user->getUsername()));
  }
  public function api()
  {
    return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
  }
}