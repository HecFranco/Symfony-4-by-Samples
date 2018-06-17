---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 04_LexikJWTAuthenticationBundle`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Security Component](https://symfony.com/doc/4.0/components/security.html), `composer require symfony/security`
* [symfony/orm-pack](), using the next command to install it `composer require symfony/orm-pack`, ORM package to install the Doctrine package.
* [](), `composer require symfony/web-server-bundle`
* [Var-dumper Component](https://symfony.com/doc/current/components/var_dumper.html), `composer require var-dumper`
* [Validator Component](https://symfony.com/doc/current/components/validator.html), `composer require validator`
* [Twig Component](https://twig.symfony.com/doc/2.x/), `composer require twig`
* [Twig Extension Component](https://symfony.com/doc/current/templating/twig_extension.html), `composer require twig/extensions`
* [Asset component](https://symfony.com/doc/current/components/asset.html), `composer require symfony/asset`

## Sources

### Extras

* [xdebug](https://xdebug.org/download.php), php extension for debug the code.(Note: [How to configure xdebug with WAMP](https://stackoverflow.com/questions/8712462/how-to-configure-xdebug-with-wamp?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa))
* [lexik-jwt-authentication-sandbox](https://github.com/chalasr/lexik-jwt-authentication-sandbox/tree/flex)
* [COMO CONSTRUIR UN RESTFUL API CON SYMFONY 4 + JWT](https://www.franciscougalde.com/2018/02/19/como-construir-un-restful-api-con-symfony-4-jwt-parte-1/)
* [fjugaldev/my_kanban using LexikJWTAuthenticationBundle](https://github.com/fjugaldev/my_kanban)

### Bundles

* [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle), using the next command to install it `composer require lexik/jwt-authentication-bundle`.
* [lcobucci/jwt](https://github.com/lcobucci/jwt), using the next command to install it `composer require lcobucci/jwt`, complementary library for use with lexik / jwt-authentication-bundle to provide many more encoders for json web tokens to generate.
* [jms/serializer-bundle](https://github.com/schmittjoh/JMSSerializerBundle), using the next command to install it `composer require jms/serializer-bundle`, Bundle that allows us to serialize our output data in a customized format (xml, json, among others). 
> This, (jms/serializer-bundle), is a contributed package, to be able to use it you have to allow Symfony Flex to use it, if we have not done it before `composer config extra.symfony.allow-contrib true`.
* [friendsofsymfony/rest-bundle](https://github.com/FriendsOfSymfony/FOSRest), using the next command to install it `composer require friendsofsymfony/rest-bundle`. 
* [sensio/framework-extra-bundle](https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html), using the next command to install it `composer require sensio/framework-extra-bundle`. 
* [nelmio/api-doc-bundle](https://symfony.com/doc/master/bundles/NelmioApiDocBundle/index.html), using the next command to install it `composer require sensio/framework-extra-bundle`, Bundle to generate documentation of our RESTful API. 
* [JWTRefreshTokenBundle](https://github.com/gesdinet/JWTRefreshTokenBundle),

_[config/bundles.php](./config/bundles.php)_
```diff
<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
++  Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle::class => ['all' => true],
];
```

_[.env](./.env)_
```diff
###> doctrine/doctrine-bundle ###
# Format described at http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# Configure your db driver and server_version in config/packages/doctrine.yaml
# DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
++ DATABASE_URL=mysql://root:@127.0.0.1:3306/LexikJWTAuthenticationBundle_test
###< doctrine/doctrine-bundle ###
```

```bash
php bin/console doctrine:database:create
```

_[src/Entity/User.php](./src/Entity/User.php)_
```php
<?php
 
namespace App\Entity;
 
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation as Serializer;
 
/**
 * User
 *
 * @ORM\Table(name="user");
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository");
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    /**
     * @ORM\Column(name="name", type="string", length=150)
     */
    protected $name;
 
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $email;
 
    /**
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    protected $username;
 
    protected $salt;
 
    /**
     * @ORM\Column(name="password", type="string", length=255)
     * @Serializer\Exclude()
     */
    protected $password;
 
    /**
     * @var string
     */
    protected $plainPassword;
 
    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="json_array")
     */
    protected $roles = [];
 
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;
 
    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;
 
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Board", mappedBy="user")
     */
    protected $boards;
 
    public function __construct()
    {
        $this->boards = new ArrayCollection();
    }
 
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
 
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
 
    /**
     * @param mixed $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
 
        return $this;
    }
 
    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
 
        return $this;
    }
 
    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
 
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }
 
    /**
     * @param mixed $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;
 
        return $this;
    }
 
    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }
 
    /**
     * @param mixed $password
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;
 
        return $this;
    }
 
    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }
 
    /**
     * @param $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
 
        $this->password = null;
    }
 
    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
 
        return $this;
    }
 
    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return ["ROLE_USER"];
    }
 
    public function getSalt() {}
 
    public function eraseCredentials() {}
 
    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
 
    /**
     * @param mixed $createdAt
     * @return self
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
 
        return $this;
    }
 
    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
 
    /**
     * @param mixed $updatedAt
     * @return self
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
 
        return $this;
    }
 
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $dateTimeNow = new DateTime('now');
        $this->setUpdatedAt($dateTimeNow);
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt($dateTimeNow);
        }
    }
 
    /**
     * @return mixed
     */
    public function getBoards()
    {
        return $this->boards->toArray();
    }
 
}
```

```bash
php bin/console doctrine:schema:update --force
```

Generate the SSH keys :

```bash
mkdir -p config/jwt # For Symfony4, no need of the -p option
openssl genrsa -out config/jwt/private.pem -aes256 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

_[.env](./.env)_
```diff
###> lexik/jwt-authentication-bundle ###
# Key paths should be relative to the project directory
JWT_PRIVATE_KEY_PATH=config/jwt/private.pem
JWT_PUBLIC_KEY_PATH=config/jwt/public.pem
JWT_PASSPHRASE=mykanban
JWT_TOKENTTL=3600
###< lexik/jwt-authentication-bundle ###
```

_[config/packages/lexik_jwt_authenticantion.yaml](./config/packages/lexik_jwt_authenticantion.yaml)_
```diff
lexik_jwt_authentication:
    private_key_path: '%kernel.project_dir%/%env(JWT_PRIVATE_KEY_PATH)%'
    public_key_path:  '%kernel.project_dir%/%env(JWT_PUBLIC_KEY_PATH)%'
    pass_phrase:      '%env(JWT_PASSPHRASE)%'
    token_ttl:        '%env(JWT_TOKENTTL)%'
    encoder:
        service: lexik_jwt_authentication.encoder.lcobucci
        signature_algorithm: RS512
```

_[config/packages/security.yaml](./config/packages/security.yaml)_
```diff
security: 
++  encoders:    
++      App\Entity\User:
++          algorithm: sha512             
    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    providers:
--      in_memory: { memory: ~ }
++      api_user_provider:
++          entity:
++              class: App\Entity\User
++              property: username   
    firewalls:
--      dev:
--          pattern: ^/(_(profiler|wdt)|css|images|js)/
--          security: false
--      main:
--          anonymous: true            
            # activate different ways to authenticate

            # http_basic: true
            # https://symfony.com/doc/current/security.html#a-configuring-how-your-users-will-authenticate

            # form_login: true
            # https://symfony.com/doc/current/security/form_login_setup.html
++      login:
++          pattern:  ^/api/login
++          stateless: true
++          anonymous: true
++          form_login:
++              check_path: /api/login_check
++              success_handler: lexik_jwt_authentication.handler.authentication_success
++              failure_handler: lexik_jwt_authentication.handler.authentication_failure
++              require_previous_session: false
++      api:
++          pattern:  ^/api/v1
++          stateless: true
++          anonymous: false
++          provider: api_user_provider
++          guard:
++              authenticators:
++                  - lexik_jwt_authentication.jwt_token_authenticator
    # Easy way to control access for large sections of your site
    # Note: Only the *first* access control that matches will be used
    access_control:
        # - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }   
++      - { path: ^/api/login_check, roles: IS_AUTHENTICATED_ANONYMOUSLY }
++      - { path: ^/api/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
++      - { path: ^/api/register, roles: IS_AUTHENTICATED_ANONYMOUSLY }
++      - { path: ^/api/v1,       roles: IS_AUTHENTICATED_FULLY }
```

_[config/packages/nelmio_api_doc.yaml](./config/packages/nelmio_api_doc.yaml)_
```yaml
nelmio_api_doc:
    documentation:
        info:
            title: My Kanban API
            description: Este es el RESTful API de My Kanban
            version: 1.0.0
    routes: # to filter documented routes
        path_patterns:
            - ^/api(?!/doc$) # Accepts routes under /api except /api/doc
```

_[config/routes.yaml](./config/routes.yaml)_
```yaml
app.swagger_ui:
    path: /api/doc
    methods: GET
    defaults: { _controller: nelmio_api_doc.controller.swagger_ui }
```

## Creation of API services (endpoints)

```bash
user:
 - register: POST /api/register
 - login: POST /api/login_check
 
board:
 - add: POST /api/v1/board
 - edit: PUT /api/v1/board
 - delete: DELETE /api/v1/board/{id}
 - list: GET /api/v1/board
 - list-item: GET /api/v1/board/{id}
 
task:
 - add: POST /api/v1/task
 - edit: PUT /api/v1/task
 - delete: DELETE /api/v1/task/{id}
```

_[src/Controller/ApiController.php](./src/Controller/ApiController.php)_
```php
<?php
/**
 * ApiController.php
 *
 * API Controller
 *
 * @category   Controller
 * @package    MyKanban
 * @author     Francisco Ugalde
 * @copyright  2018 www.franciscougalde.com
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 */
 
namespace App\Controller;
 
use App\Entity\Board;
use App\Entity\Task;
use App\Entity\User;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
 
/**
 * Class ApiController
 *
 * @Route("/api")
 */
class ApiController extends FOSRestController
{
    // USER URI's
 
    /**
     * @Rest\Post("/login_check", name="user_login_check")
     *
     * @SWG\Response(
     *     response=200,
     *     description="User was logged in successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not logged in successfully"
     * )
     *
     * @SWG\Parameter(
     *     name="_username",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={
     *     }
     * )
     *
     * @SWG\Parameter(
     *     name="_password",
     *     in="body",
     *     type="string",
     *     description="The password",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="User")
     */
    public function getLoginCheckAction() {}
 
    /**
     * @Rest\Post("/register", name="user_register")
     *
     * @SWG\Response(
     *     response=201,
     *     description="User was successfully registered"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="User was not successfully registered"
     * )
     *
     * @SWG\Parameter(
     *     name="_name",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="_email",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="_username",
     *     in="body",
     *     type="string",
     *     description="The username",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="_password",
     *     in="query",
     *     type="string",
     *     description="The password"
     * )
     *
     * @SWG\Tag(name="User")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
 
        $user = [];
        $message = "";
 
        try {
            $code = 200;
            $error = false;
 
            $name = $request->request->get('_name');
            $email = $request->request->get('_email');
            $username = $request->request->get('_username');
            $password = $request->request->get('_password');
 
            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setUsername($username);
            $user->setPlainPassword($password);
            $user->setPassword($encoder->encodePassword($user, $password));
 
            $em->persist($user);
            $em->flush();
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to register the user - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $user : $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
 
    // BOARD URI's
 
    /**
     * @Rest\Get("/v1/board.{_format}", name="board_list_all", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Gets all boards for current logged user."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to get all user boards."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="query",
     *     type="string",
     *     description="The board ID"
     * )
     *
     *
     * @SWG\Tag(name="Board")
     */
    public function getAllBoardAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $boards = [];
        $message = "";
 
        try {
            $code = 200;
            $error = false;
 
            $userId = $this->getUser()->getId();
            $boards = $em->getRepository("App:Board")->findBy([
                "user" => $userId,
            ]);
 
            if (is_null($boards)) {
                $boards = [];
            }
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get all Boards - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $boards : $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
 
    /**
     * @Rest\Get("/v1/board/{id}.{_format}", name="board_list", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Gets board info based on passed ID parameter."
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="The board with the passed ID parameter was not found or doesn't exist."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The board ID"
     * )
     *
     *
     * @SWG\Tag(name="Board")
     */
    public function getBoardAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $board = [];
        $message = "";
 
        try {
            $code = 200;
            $error = false;
 
            $board_id = $id;
            $board = $em->getRepository("App:Board")->find($board_id);
 
            if (is_null($board)) {
                $code = 500;
                $error = true;
                $message = "The board does not exist";
            }
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to get the current Board - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $board : $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
    /**
     * @Rest\Post("/v1/board.{_format}", name="board_add", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=201,
     *     description="Board was added successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error was occurred trying to add new board"
     * )
     *
     * @SWG\Parameter(
     *     name="name",
     *     in="body",
     *     type="string",
     *     description="The board name",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="Board")
     */
    public function addBoardAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $board = [];
        $message = "";
 
        try {
           $code = 201;
           $error = false;
           $name = $request->request->get("name", null);
           $user = $this->getUser();
 
           if (!is_null($name)) {
               $board = new Board();
               $board->setName($name);
               $board->setUser($user);
 
               $em->persist($board);
               $em->flush();
 
           } else {
               $code = 500;
               $error = true;
               $message = "An error has occurred trying to add new board - Error: You must to provide a board name";
           }
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to add new board - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 201 ? $board : $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
    /**
     * @Rest\Put("/v1/board/{id}.{_format}", name="board_edit", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="The board was edited successfully."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to edit the board."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The board ID"
     * )
     *
     * @SWG\Parameter(
     *     name="name",
     *     in="body",
     *     type="string",
     *     description="The board name",
     *     schema={}
     * )
     *
     *
     * @SWG\Tag(name="Board")
     */
    public function editBoardAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $board = [];
        $message = "";
 
        try {
            $code = 200;
            $error = false;
            $name = $request->request->get("name", null);
            $board = $em->getRepository("App:Board")->find($id);
 
            if (!is_null($name) && !is_null($board)) {
                $board->setName($name);
 
                $em->persist($board);
                $em->flush();
 
            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to add new board - Error: You must to provide a board name or the board id does not exist";
            }
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to edit the current board - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $board : $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
    /**
     * @Rest\Delete("/v1/board/{id}.{_format}", name="board_remove", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Board was successfully removed"
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="An error was occurred trying to remove the board"
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The board ID"
     * )
     *
     * @SWG\Tag(name="Board")
     */
    public function deleteBoardAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
 
        try {
            $code = 200;
            $error = false;
            $board = $em->getRepository("App:Board")->find($id);
 
            if (!is_null($board)) {
                $em->remove($board);
                $em->flush();
 
                $message = "The board was removed successfully!";
 
            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to remove the currrent board - Error: The board id does not exist";
            }
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to remove the current board - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
    // TASK URI's
    /**
     * @Rest\Post("/v1/task.{_format}", name="task_add", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=201,
     *     description="Task was added successfully"
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error was occurred trying to add new task"
     * )
     *
     * @SWG\Parameter(
     *     name="title",
     *     in="body",
     *     type="string",
     *     description="The task title",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="description",
     *     in="body",
     *     type="string",
     *     description="The task description",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="status",
     *     in="body",
     *     type="string",
     *     description="The task status. Allowed values: Backlog, Working, Done",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="priority",
     *     in="body",
     *     type="string",
     *     description="The task priority. Allowed values: High, Medium, Low",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="board_id",
     *     in="body",
     *     type="string",
     *     description="The board id of the new task",
     *     schema={}
     * )
     *
     * @SWG\Tag(name="Task")
     */
    public function addTaskAction(Request $request) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $task = [];
        $message = "";
 
        try {
            $code = 201;
            $error = false;
            $title = $request->request->get("title", null);
            $description = $request->request->get("description", null);
            $status = $request->request->get("status", null);
            $priority = $request->request->get("priority", null);
            $boardId= $request->request->get("board_id", null);
 
            if (!is_null($title) && !is_null($description) && !is_null($status) && !is_null($priority) && !is_null($boardId)) {
                $task = new Task();
                $board = $em->getRepository("App:Board")->find($boardId);
                $task->setBoard($board);
                $task->setTitle($title);
                $task->setDescription($description);
                $task->setStatus($status);
                $task->setPriority($priority);
 
                $em->persist($task);
                $em->flush();
 
            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to add new task - Error: You must to provide all the required fields";
            }
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to add new task - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 201 ? $task : $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
    /**
     * @Rest\Put("/v1/task/{id}.{_format}", name="task_edit", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="The task was edited successfully."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to edit the task."
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The task ID"
     * )
     *
     * @SWG\Parameter(
     *     name="title",
     *     in="body",
     *     type="string",
     *     description="The task title",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="description",
     *     in="body",
     *     type="string",
     *     description="The task description",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="status",
     *     in="body",
     *     type="string",
     *     description="The task status. Allowed values: Backlog, Working, Done",
     *     schema={}
     * )
     *
     * @SWG\Parameter(
     *     name="priority",
     *     in="body",
     *     type="string",
     *     description="The task priority. Allowed values: High, Medium, Low",
     *     schema={}
     * )
     *
     *
     * @SWG\Tag(name="Task")
     */
    public function editTaskAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
        $task = [];
        $message = "";
 
        try {
            $code = 200;
            $error = false;
            $title = $request->request->get("title", null);
            $description = $request->request->get("description", null);
            $status = $request->request->get("status", null);
            $priority = $request->request->get("priority", null);
            $task = $em->getRepository("App:Task")->find($id);
 
            if (!is_null($task)) {
                if (!is_null($title)) {
                    $task->setTitle($title);
                }
 
                if (!is_null($description)) {
                    $task->setDescription($description);
                }
 
                if (!is_null($status)) {
                    $task->setStatus($status);
                }
 
                if (!is_null($priority)) {
                    $task->setPriority($priority);
                }
 
                $em->persist($task);
                $em->flush();
 
            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to edit the current task - Error: The task id does not exist";
            }
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to edit the current task - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $code == 200 ? $task : $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
    /**
     * @Rest\Delete("/v1/task/{id}.{_format}", name="task_remove", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Task was successfully removed"
     * )
     *
     * @SWG\Response(
     *     response=400,
     *     description="An error was occurred trying to remove the task"
     * )
     *
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="string",
     *     description="The board ID"
     * )
     *
     * @SWG\Tag(name="Task")
     */
    public function deleteTaskAction(Request $request, $id) {
        $serializer = $this->get('jms_serializer');
        $em = $this->getDoctrine()->getManager();
 
        try {
            $code = 200;
            $error = false;
            $task = $em->getRepository("App:Task")->find($id);
 
            if (!is_null($task)) {
                $em->remove($task);
                $em->flush();
 
                $message = "The task was removed successfully!";
 
            } else {
                $code = 500;
                $error = true;
                $message = "An error has occurred trying to remove the currrent task - Error: The task id does not exist";
            }
 
        } catch (Exception $ex) {
            $code = 500;
            $error = true;
            $message = "An error has occurred trying to remove the current task - Error: {$ex->getMessage()}";
        }
 
        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $message,
        ];
 
        return new Response($serializer->serialize($response, "json"));
    }
    /**
     * @Route("/v1/", name="api")
     */
    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->getUsername()));
    }
 
}
```