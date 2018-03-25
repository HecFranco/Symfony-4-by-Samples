
# Summary Symfony component`s to use

* Server Component, `composer require server --dev`
* Twig Component, `composer require twig`
* Doctrine Component, `composer require doctrine maker`
* Form Componente, `composer require form`
* Security Component, `composer require security`
* Validator Component, `composer require validator`

# Summary Console command`s to be used

* `php bin/console doctrine:database:create`
* `php bin/console doctrine:schema:update --force`
* `php bin/console doctrine:migrations:diff`
* `php bin/console doctrine:migrations:migrate`

# Register Form

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton 01_register_form
```

2. Install all component of summary the this demo, see [here]()

3. The database connection information is stored as an environment variable called `DATABASE_URL`. For development, you can find and customize this inside [.env](.env):

_[.env](.env)_
```diff
# .env
###> doctrine/doctrine-bundle ###
# Format described at http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# Configure your db driver and server_version in config/packages/doctrine.yaml
# DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
++ DATABASE_URL=mysql://root:@127.0.0.1:3306/symfony-4-by-samples
++ # db_user: root
++ # db_password: 
++ # db_name: symfony_4_test
# to use sqlite:
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/app.db"
###< doctrine/doctrine-bundle ###
```

(Source: [https://symfony.com/doc/current/doctrine.html#configuring-the-database](https://symfony.com/doc/current/doctrine.html#configuring-the-database))

4. In console lunch the command `php bin/console doctrine:database:create`. Now you have your data base created in your local server.

5. Create your entity file for manage your users in [src/Entity/User.php](src/Entity/User.php).

_[src/Entity/User.php](src/Entity/User.php)_
```php
<?php
// src/Entity/User.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
class User implements UserInterface {
    private $id;
    public function geId() { return $this->id; }
    private $email;
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }    
    private $username;
    public function getUsername() { return $this->username; }
    public function setUsername($username) { $this->username = $username; }    
    private $plainPassword;
    public function getPlainPassword() { return $this->plainPassword; }
    public function setPlainPassword($password) { $this->plainPassword = $password; }    
    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     */
    private $password;
    public function getPassword() { return $this->password; }
    public function setPassword($password) { $this->password = $password; }
    /* other necessary methods ***********************************************************************************/
    public function getSalt() {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }
    // other methods, including security methods like getRoles()
    public function getRoles() { return array('ROLE_USER'); }    
    // ... and eraseCredentials()
    public function eraseCredentials() { }    
}
```

(Source: [http://symfony.com/doc/current/doctrine/registration_form.html](http://symfony.com/doc/current/doctrine/registration_form.html))


6. If you want to use XML instead of `yaml`, add `type: yml` and `dir: '%kernel.project_dir%/config/doctrine'` to the entity mappings in your [config/packages/doctrine.yaml](config/packages/doctrine.yaml) file.

_[config/packages/doctrine.yaml](config/packages/doctrine.yaml)_
```yml
doctrine:
    # ...
    orm:
        # ...
        mappings:
            App:
                is_bundle: false
                # type: annotation
                type: yml
                # dir: '%kernel.project_dir%/src/Entity'
                dir: '%kernel.project_dir%/config/doctrine'
                prefix: 'App\Entity'
                alias: App
```

(Source: [https://symfony.com/doc/current/doctrine.html](https://symfony.com/doc/current/doctrine.html))

7. Define our mapping yaml's file [config/doctrine/User.orm.yml](config/doctrine/User.orm.yml).

_[config/doctrine/User.orm.yml](config/doctrine/User.orm.yml)_
```yml
# config/doctrine/Product.orm.yml
App\Entity\User:
    type: entity
    repositoryClass: App\Repository\UserRepository
    table: user    
    id:
        id:
            type: integer
            generator: { strategy: AUTO }
    fields:
        email:
            type: string
            length: 255
            unique: true
        username:
            type: string
            length: 50
            nullable: true
            unique: true
        plainPassword:
            type: text
            length: 4096             
        password:
            type: string
            length: 64  
```

8. Now can create our table in the localhost using the console command `php bin/console doctrine:schema:update --force`.

9. Next, create the form for the User entity in [src/Form/UserType.php](src/Form/UserType.php).

_[src/Form/UserType.php](src/Form/UserType.php)_
```php
<?php
// src/Form/UserType.php
namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            /* I will used termsAccepted like checkbox *******************************************************/
            ->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false,
                'constraints' => new IsTrue(),
            ))
            /*************************************************************************************************/
        ;
    }
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
```

(Source: [http://symfony.com/doc/current/doctrine/registration_form.html#create-a-form-for-the-entity](http://symfony.com/doc/current/doctrine/registration_form.html#create-a-form-for-the-entity))

10. We can use a system of validation in the entity add next configuration in [config/packages/framework.yaml](config/packages/framework.yaml).

_[config/packages/framework.yaml](config/packages/framework.yaml)_
```yml
framework:
    ####################################################################################################################
    # To define type of validation `yaml` we will use 
    # validation: { enabled: true }
    # To define type of validation `anotation` we will use 
    # validation: { enable_annotations: true }
    validation: { enabled: true }
    ####################################################################################################################
```

11. Validation is a very common task in web applications. Data entered in forms needs to be validated. Data also needs to be validated before it is written into a database or passed to a web service.

In applications using Symfony Flex, run this command to install the validator before using it:

```bash
composer require validator
```

After, we will defined the configuration of validation in [config/packages/validator/validation.yml](config/packages/validator/validation.yml)

_[config/packages/validator/validation.yml](config/packages/validator/validation.yml)_
```yml
# https://symfony.com/doc/current/validation.html#basic-constraints
App\Entity\User:
    constraints:
        - Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity: email
    properties:
        email:
            - Email:
                message: El email "{{ value }}" no es válido.
                checkMX: true
            - NotBlank: ~
        username:
            - NotBlank: ~               
            - Length:
                min: 5
                max: 50
                minMessage: 'Your first name must be at least {{ limit }} characters long'
                maxMessage: 'Your first name cannot be longer than {{ limit }} characters'            
        password:
            - NotBlank: ~              
        plainPassword:
            - NotBlank: ~ 
```

(Source: [https://symfony.com/doc/current/validation.html#content_wrapper](https://symfony.com/doc/current/validation.html#content_wrapper))

12. Next, you need a controller to handle the form rendering and submission. If the form is submitted, the controller performs the validation and saves the data into the database in [src/Controller/RegistrationController.php](src/Controller/RegistrationController.php).

_[src/Controller/RegistrationController.php](src/Controller/RegistrationController.php)_
```php
<?php
// src/Controller/RegistrationController.php
namespace App\Controller;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class RegistrationController extends Controller {
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            return $this->redirectToRoute('home');
        }
        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}
```

13. Whether your users are stored in security.yaml, in a database or somewhere else, you'll want to encode their passwords. The most suitable algorithm to use is bcrypt:

(Source: [https://symfony.com/doc/current/security.html#c-encoding-the-user-s-password](https://symfony.com/doc/current/security.html#c-encoding-the-user-s-password))

_[config/packages/security.yaml](config/packages/security.yaml)_
```yml
security:
    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    encoders:
        App\Entity\User: 
            algorithm: bcrypt
            cost: 4 # Number of times the password will be encrypted        
    ##################################################################################################
```

Of course, your users' passwords now need to be encoded with this exact algorithm. For hardcoded users, you can use the built-in command:

```bash
php bin/console security:encode-password
```

14. Symfony creates an instance of RequestMatcher for each access_control entry, which determines whether or not a given access control should be used on this request. The following access_control options are used for matching:

(Source: [https://symfony.com/doc/current/security/access_control.html#matching-options](https://symfony.com/doc/current/security/access_control.html#matching-options))

_[config/packages/security.yaml](config/packages/security.yaml)_
```yml
security:
    ##################################################################################################
    access_control:
        # - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }    
        # ^/login puede entrar cualquier usuario (ANÓNIMO)
        - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY}
        - { path: ^/register, roles: IS_AUTHENTICATED_ANONYMOUSLY}
        - { path: ^/, roles: [ROLE_USER, ROLE_ADMIN]}   
```

15. We will use the routing type **yaml**, for them we configure the type of routing in [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](config/routes.yaml)_
```yml
#index:
#    path: /
#    controller: App\Controller\DefaultController::index
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
routing_distributed:
    # loads routes from the given routing file stored in some bundle
    resource: '..\src\Resources\config\routing.yml' 
    type: yaml
```

Next step is defined our folder with routing files of our app in [src/Resources/config/routing.yml](src/Resources/config/routing.yml)

_[src/Resources/config/routing.yml](src/Resources/config/routing.yml)_
```yml
app_routing_folder:
    # loads routes from the given routing file stored in some bundle
    resource: 'routing\' 
    type: directory
```

_[src/Resources/config/routing/userRegistration.yml](src/Resources/config/routing/userRegistration.yml)_
```yml
user_registration:
    path: /register/
    controller: App\Controller\RegistrationController::register
```

15. If you're returning HTML from your controller, you'll probably want to render a template. Fortunately, Symfony comes with Twig: a templating language that's easy, powerful and actually quite fun.

First, install Twig:

```bash
composer require twig
```

Now we will created our template with **Twig** in [templates/registration/register.html.twig](templates/registration/register.html.twig)

_[templates/registration/register.html.twig](templates/registration/register.html.twig)_
```html
{# templates/registration/register.html.twig #}

{{ form_start(form) }}
    {{ form_row(form.username) }}
    {{ form_row(form.email) }}
    {{ form_row(form.plainPassword.first) }}
    {{ form_row(form.plainPassword.second) }}

    <button type="submit">Register!</button>
{{ form_end(form) }}
```

(Source: [https://symfony.com/doc/current/page_creation.html#rendering-a-template](https://symfony.com/doc/current/page_creation.html#rendering-a-template))

16. Finally you can view the result of demo when write in the terminal the command console:

```bash
php bin/console server:run
```