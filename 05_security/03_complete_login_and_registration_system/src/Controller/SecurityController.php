<?php
// src/Controller/RegistrationController.php
/* We indicate the namespace of the Bundle ********************************************************************/
namespace App\Controller;
/* Symfony Components ****************************************************************************************/
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Allow Router
    use Symfony\Component\HttpFoundation\Response;                  // Allows you to execute the Response method    
    // Neccesary to use UserPasswordEncoderInterface into the function login
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;  
    // Neccesary to use AuthenticationUtils into the function login 
    use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
    // Neccesary to create the 'session' object'
    use Symfony\Component\HttpFoundation\Session\Session;
/* Forms *****************************************************************************************************/
    use App\Form\UserType;
/*************************************************************************************************************/    
/* Entity ****************************************************************************************************/    
    use App\Entity\User;
    use App\Entity\AppConfig;    
/*************************************************************************************************************/
class SecurityController extends Controller {

    private $session;
    public function __construct(){ $this->session = new Session(); }
    
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        /* Initial Charge ************************************************************************************/
            $em = $this->getDoctrine()->getManager();
            $userLogged = $this->getUser();
            $controllerName = "Register" ;
        /*****************************************************************************************************/
        /* Position the Repositories  ************************************************************************/
            $appConfig_repo = $em->getRepository(AppConfig::class);  
        /*****************************************************************************************************/
        /* Queries *******************************************************************************************/
            $appConfig = $appConfig_repo->findAll(); 
        /*****************************************************************************************************/        
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRole('ROLE_USER');
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->forward('App\Controller\SecurityController::sendEmailRegister', array(
                'name' => $user->getUsername(),
                'sendToEmail' => $user->getEmail(),
                'sendFromEmail' => $user->getEmail()
            ));
            return $this->redirectToRoute('user_login');
        }
        return $this->render(
            'security/register.html.twig',
            array(
                'form' => $form->createView(),
                'appConfig'=>$appConfig,
                'controllerName'=>$controllerName
            )
        );
    }
    public function login(Request $request, AuthenticationUtils $authenticationUtils) {
    /* Initial Charge ************************************************************************************/
        $em = $this->getDoctrine()->getManager();
        $userLogged = $this->getUser();
        $controllerName = "Register" ;        
    /*****************************************************************************************************/
    /* Position the Repositories  ************************************************************************/
        $appConfig_repo = $em->getRepository(AppConfig::class);  
    /*****************************************************************************************************/
    /* Queries *******************************************************************************************/
        $appConfig = $appConfig_repo->findAll(); 
    /*****************************************************************************************************/         
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $this->session->getFlashBag()->add('error', $error);
        return $this->render('security/login.html.twig', 
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
                'appConfig'=>$appConfig,
                'controllerName'=>$controllerName
            )
        );
    }
    public function logout() {
        return $this->redirect($this->generateUrl('user_logout'));
    }
    public function userNickExist (Request $request) {
        /* Initial Charge ************************************************************************************/
            $em = $this->getDoctrine()->getManager();
            $userLogged = $this->getUser();
        /*****************************************************************************************************/
		/* Position the Repositories  ************************************************************************/
            $user_repo = $em->getRepository(User::class);   
        /*****************************************************************************************************/
        /* Queries *******************************************************************************************/
            $username = $request->get('username');
            $user_exist = $user_repo->findOneBy(array('username'=>$username)); 
        /*****************************************************************************************************/
        return new Response(json_encode($user_exist)); // we encode the answer in JSON
    }
    public function userEmailExist (Request $request) {
        /* Initial Charge ************************************************************************************/
            $em = $this->getDoctrine()->getManager();
            $userLogged = $this->getUser();
        /*****************************************************************************************************/
		/* Position the Repositories  ************************************************************************/
            $user_repo = $em->getRepository(User::class);   
        /*****************************************************************************************************/
        /* Position the Repositories  ************************************************************************/
            $email = $request->get('email');
            $user_exist = $user_repo->findOneBy(array('email'=>$email)); 
        /*****************************************************************************************************/
        return new Response(json_encode($user_exist)); // we encode the answer in JSON
    }
    public function sendEmailRegister(Request $request, /*$name, $sendToEmail, $sendFromEmail, */\Swift_Mailer $mailer) {
        $name = 'hector'; 
        $sendToEmail = 'hector.franco.aceituno@gmail.com';
        $sendFromEmail = 'hector.franco.aceituno@gmail.com';
        // https://symfony.com/doc/current/email.html
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom($sendFromEmail)
            ->setTo($sendToEmail)
            ->setBody(
                $this->renderView(
                    // templates/emails/registration.html.twig
                    'emails/registration.html.twig',
                    array('name' => $name)
                ),
                'text/html'
            )
            /*
            * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        if( $mailer->send($message) ){
            echo "Mensaje enviado correctamente";
        } else {
            echo "Mensaje fallido";
        }
        // $mailer->send($message);
        return new Response('
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="UTF-8">
                <title></title>
            </head>
            <body>
            <h1>Email Send</h1>
            </body>
        </html>');
    }
}