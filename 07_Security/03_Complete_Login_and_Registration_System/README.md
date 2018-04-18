# Purpose of the Demo - Complete Login and Registration System

We will create a **Complete Login and Registration System** that requires a username, email and password. It will also allow you to add a check box required for the record.

The password will be encrypted and together with the rest of the collected data stored in the database.

The system will differentiate between **First User** and the rest, allowing you to configure the level of security and registration.

# Phases of the Demo
1. []()


---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 03_Complete_Login_and_Registration_System`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* Server Component, `composer require server --dev`
* Profiler Component, `composer require --dev profiler`
* Apache-Pack Component, `composer require symfony/apache-pack`
(Source: [https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules](https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules))
* Var-dumper Component, `composer require var-dumper`
(Source: [https://symfony.com/doc/current/components/var_dumper.html](https://symfony.com/doc/current/components/var_dumper.html))
* Debug-Bundle Component, `composer require debug --dev`
(Source: [https://symfony.com/doc/current/components/debug.html](https://symfony.com/doc/current/components/debug.html))
* Twig Component, `composer require twig`
* Doctrine Component, `composer require doctrine/doctrine-bundle`
* Form Componente, `composer require form`
* Security Component, `composer require security`
* Validator Component, `composer require validator`
* Mailer Component, `composer require mailer`
`composer require debug --dev`
* Check Requirements for Running Symfony Component, `composer require symfony/requirements-checker` 
 (Source: [https://symfony.com/doc/current/reference/requirements.html](https://symfony.com/doc/current/reference/requirements.html))

# Summary Console command`s to be used

* `php bin/console doctrine:database:create`
* `php bin/console doctrine:schema:update --force`
* `php bin/console doctrine:migrations:diff`
* `php bin/console doctrine:migrations:migrate`

# Complete Login and Registration System

--------------------------------------------------------------------------------------------

## 1.Project Creation

--------------------------------------------------------------------------------------------

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton 03_Complete_Login_and_Registration_System
```

2. In the next step we will access the project folder using:

```bash
cd 03_Complete_Login_and_Registration_System
```

3. It is necessary to install the **server component**, to use our **Server Local**, through the console command:

```bash
composer require server --dev
```

4. Now, you will be able to view the result of demo when write in the terminal the command console:

```bash
php bin/console server:run
```

--------------------------------------------------------------------------------------------

## 2.Database Configuration

--------------------------------------------------------------------------------------------

1. We will installed **Doctrine Component** to manage the database of project using the command:

```bash
composer require doctrine/doctrine-bundle
```

2. To configurate the database connection, we will modified the environment variable called `DATABASE_URL`. For then, we you can find and customize this inside [.env](.env):

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

3. In console lunch the command `php bin/console doctrine:database:create`. Now you have your data base created in your local server.

4. If you want to use XML instead of `yaml`, add `type: yml` and `dir: '%kernel.project_dir%/config/doctrine'` to the entity mappings in your [config/packages/doctrine.yaml](config/packages/doctrine.yaml) file.

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

--------------------------------------------------------------------------------------------

## 3.Creating the User Entity

--------------------------------------------------------------------------------------------

1. Create your entity file for manage your users in [src/Entity/User.php](src/Entity/User.php).

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
    private $isActive;
    public function __construct()     {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }
    /* other necessary methods ***********************************************************************************/
    public function getSalt() {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }
    // other methods, including security methods like getRoles()
	private $role;
	public function setRole($role) { $this->role = $role; return $this; }
	public function getRole() { return $this->role; }
	public function getRoles(){ return array('ROLE_USER','ROLE ADMIN'); }
    // ... and eraseCredentials()
    public function eraseCredentials() { }
    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->role,
            // see section on salt below
            // $this->salt,
        ));
    }
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }    
}
```

**Note**: before we must install the necessary **security component** to use `Symfony\Component\Security\Core\User\UserInterface`, for this we will execute the following command in the console:

```bash
composer require security
```

(Source: [http://symfony.com/doc/current/doctrine/registration_form.html](http://symfony.com/doc/current/doctrine/registration_form.html))

2. Define our mapping yaml's file [config/doctrine/User.orm.yml](config/doctrine/User.orm.yml).

_[config/doctrine/User.orm.yml](config/doctrine/User.orm.yml)_
```yml
# config/doctrine/User.orm.yml
App\Entity\User:
    type: entity
    #repositoryClass: App\Repository\UserRepository
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
            column: plain_password
        password:
            type: string
            length: 64
        isActive:
            type: boolean
            nullable: false
            options:
                default: '0'
            column: is_active
        role:
            type: json_array
            nullable: false
            length: null
            options:
                fixed: false 
```

3. Now can create our table in the localhost using the console command `php bin/console doctrine:schema:update --force`.

--------------------------------------------------------------------------------------------

## 4.Creating the User Form and Validation System

--------------------------------------------------------------------------------------------

1. Frist, we will install the **Form Componente** of **Symfony** using the command console:

```bash
composer require form
```

2. Next, create the form for the User entity in [src/Form/UserType.php](src/Form/UserType.php).

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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType {
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
            ->add('submit',SubmitType::class)
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

3. In applications using Symfony Flex, run this command to install the **validator component** before using it:

```bash
composer require validator
```
 
4. We can use a system of validation in the entity add next configuration in [config/packages/framework.yaml](config/packages/framework.yaml).

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

5. Validation is a very common task in web applications. Data entered in forms needs to be validated. Data also needs to be validated before it is written into a database or passed to a web service.

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

--------------------------------------------------------------------------------------------

## 5.Security System

--------------------------------------------------------------------------------------------

1. To encode the password it is necessary to install the security component:

```bash
composer require security
```

**Note** : This componente must be install.

2. Of course, your users' passwords now need to be encoded with this exact algorithm. For hardcoded users, you can use the built-in command:

```bash
php bin/console security:encode-password
```

3. Whether your users are stored in [config/packages/security.yaml](config/packages/security.yaml), in a database or somewhere else, you'll want to encode their passwords. The most suitable algorithm to use is bcrypt:

(Source: [https://symfony.com/doc/current/security.html#c-encoding-the-user-s-password](https://symfony.com/doc/current/security.html#c-encoding-the-user-s-password))

_[config/packages/security.yaml](config/packages/security.yaml)_
```yml
security:
    # Encoder Configuration ##########################################################################
    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    encoders:
        App\Entity\User: 
            algorithm: bcrypt
            cost: 4 # Number of times the password will be encrypted        
    ##################################################################################################
    #...
```

4. Symfony creates an instance of RequestMatcher for each access_control entry, which determines whether or not a given access control should be used on this request. The following access_control options are used for matching:

(Source: [https://symfony.com/doc/current/security/access_control.html#matching-options](https://symfony.com/doc/current/security/access_control.html#matching-options))

_[config/packages/security.yaml](config/packages/security.yaml)_
```yml
security:
    #...
    # acces controll ##################################################################################
    # access as anonymous user, 'IS_AUTHENTICATED_ANONYMOUSLY', only to 'login' and 'registration'
    access_control:
        # - { path: ^/admin, roles: ROLE_ADMIN }
        # - { path: ^/profile, roles: ROLE_USER }    
        # ^/login puede entrar cualquier usuario (ANÓNIMO)
        - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY}
        - { path: ^/register, roles: IS_AUTHENTICATED_ANONYMOUSLY}
        - { path: ^/, roles: [ROLE_USER, ROLE_ADMIN]}
    ################################################################################################## 
```

--------------------------------------------------------------------------------------------

## 6.Creating the RegistrationController and its Routing

--------------------------------------------------------------------------------------------

1. Next, you need a controller to handle the form rendering and submission. If the form is submitted, the controller performs the validation and saves the data into the database in [src/Controller/RegistrationController.php](src/Controller/RegistrationController.php).

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
            $user->setRole('ROLE_USER');
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

2. We will use the routing type **yaml**, for them we configure the type of routing in [config/routes.yaml](config/routes.yaml).

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
    controller: App\Controller\SecurityController::register
```

--------------------------------------------------------------------------------------------

## 7.Template

--------------------------------------------------------------------------------------------

1. If you're returning HTML from your controller, you'll probably want to render a template. Fortunately, Symfony comes with Twig: a templating language that's easy, powerful and actually quite fun.

First, install Twig:

```bash
composer require twig
```

Now we will created our template with **Twig** in [templates/registration/register.html.twig](templates/registration/register.html.twig)

_[templates/registration/register.html.twig](templates/registration/register.html.twig)_
```html
{# templates/registration/register.html.twig #}
{% extends 'base.html.twig' %}
{% block body %}
    {{ form_start(form) }}
        {{ form_row(form.username) }}
        {{ form_row(form.email) }}
        {{ form_row(form.plainPassword.first) }}
        {{ form_row(form.plainPassword.second) }}
        {{ form_row(form.termsAccepted) }}
        {{ form_row(form.submit) }}        
    {{ form_end(form) }}
{% endblock %}
```

(Source: [https://symfony.com/doc/current/page_creation.html#rendering-a-template](https://symfony.com/doc/current/page_creation.html#rendering-a-template))

--------------------------------------------------------------------------------------------

## 8.Install WebpackEncore and configuration of Bootstrap and Sass

--------------------------------------------------------------------------------------------

1. How we need to reference the entries, **js** [build/app.js](build/app.js) and **css** [build/app.css](build/app.css), within the template we will install the **Asset Component** using the console command:

```bash
composer require symfony/asset
```

2. Next, we will add to the base template [templates/base.html.twig](templates/base.html.twig), the links to our entries **js** and **css**.

_[templates/base.html.twig](templates/base.html.twig)_
```diff
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        {% block stylesheets %}
++        {# add next line .............................................................................. #}
++            <link rel="stylesheet" href="{{ asset('build/app.css') }}">
++        {# add add previous line line ................................................................. #}        
        {% endblock %}
    </head>
    <body>
        {% block body %}{% endblock %}
        {% block javascripts %}
++        {# add next line .............................................................................. #}
++            <script src="{{ asset('build/app.js') }}"></script>
++        {# add add previous line line ................................................................. #}         
        {% endblock %}
    </body>
</html>
```

3. We are using **Symfony Flex** for the project, so we will initialize our project for **Webpack Encore** through:

```bash
composer require encore
```

4. Before, you need to make sure you have **Node.js** installed, otherwise you can access [https://nodejs.org/en/](https://nodejs.org/es/) and download it for your installation.

5. Next, we will install **Npm.js**, using the command:

```bash
npm install @symfony/webpack-encore --save-dev
```

This component will generate a file [webpack.config.js](webpack.config.js), and add the directories [assets/](assets/) and [node_modules/](node_modules/) to [.gitignore](.gitignore) .

6. After configuring the compilation process in **Webpack**, so that the system recognizes the result of the compilation process of the static files.

For before, you must add the dependencies that we need when we use **SASS** with the following command.

```bash
npm add sass-loader node-sass --dev
```

7. Next we will configure the file [webpack.config.js](webpack.config.js) with the following directives.

_[webpack.config.js](webpack.config.js)_
```diff
    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
++   .addEntry('app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')
++   .addStyleEntry('css/app', './assets/css/app.scss')
    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()
++    .enableSassLoader()
```

To activate **Sass-Loader**, which is the **SASS Reader**, and indicate the location of the inputs and outputs of the components **js** and **css**. Indicating `.addEntry ('js/app', './assets/js/app.js')` for the compilation of **js** and `.addStyleEntry (' css/app ',' ./assets/css/app.scss') `for the **css**.

8. In the next step, we will create our stylesheet [assets/css/app.scss](assets/css/app.scss) using **SASS**. This sheet will be transpiled to **CSS**.

_[assets/css/app.scss](assets/css/app.scss)_
```scss
//////////////////////////////// COMPLETED
$acceVerde: #84a640;
$acceAzul: #396696;
h1 {
    color: $acceVerde;
    s {
        color: $acceAzul;
    }
}
```

9. Next, we add this line `import '../css/app.scss';` in [assets/js/app.js](assets/js/app.js) to be able to compile **Sass** in **css**.

_[assets/js/app.js](assets/js/app.js)_
```js
import '../css/app.scss';
```

10. Now, we can access [http://127.0.0.1:8000](http://127.0.0.1:8000) again expecting to see our changes in the template, but we will find two **404 errors** corresponding to the files [assets/css/app.css](assets/css/app.css) and [assets/js/app.js](assets/js/app.js) that we just included in our base template.

To correct the errors, we must execute the following command that will generate the files from those created in the folders  [assets/css/app.css](assets/css/app.css) and [assets/js/app.js](assets/js/app.js).

```bash
npm run watch
```

**Note:** If we launch a `npm run dev -watch` thread, the system will recognize the changes we make to the files and will regenerate the files that are linked in our template so that the changes are available.

11. Now we can launch the server again using `php bin/console server:run` and access [http://127.0.0.1:8000](http://127.0.0.1:8000) to see the changes referred to in [assets/css/app.scss](assets/css/app.scss).

12. To import **Bootstrap** in our project we will only have to execute.

```bash
npm install bootstrap --save
```





//////////////////////////////////////////////////////






```bash
npm add jquery
```

to install **Jquery**, and



to install **Bootstrap-Sass** in its version 3.

13. Additionally in this demo we will install the library **popper.js** using the command:

```bash
npm add popper.js
```

with it we will generate the windows with floating information.

3. Next we will configure the file [webpack.config.js](webpack.config.js) with the following directives. And we will uncomment the following line of the file [webpack.config.js](webpack.config.js) to facilitate **jQuery** to **Bootstrap**.

_[webpack.config.js](webpack.config.js)_
```diff
    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
++ .autoProvidejQuery()
```

4. In the next step, we will modify our stylesheet [assets/css/app.scss](assets/css/app.scss) by importing the **Bootstrap** library. 

_[assets/css/app.scss](assets/css/app.scss)_
```diff
++ @import '~bootstrap-sass/assets/stylesheets/bootstrap';
$acceVerde: #84a640;
$acceAzul: #396696;
h1 {
    color: $acceVerde;
    s {
        color: $acceAzul;
    }
}
```

**Nota**: Esta hoja será compilada a **CSS**.

--------------------------------------------------------------------------------------------

## 9.Result 

--------------------------------------------------------------------------------------------

1. To be able to see the result, it is necessary to install the server component through the console command:

```bash
composer require server --dev
```

2. Now, you can view the result of demo when write in the terminal the command console:

```bash
php bin/console server:run
```

3. Finally, you will have to click on the following link [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register) to see your installation project.

--------------------------------------------------------------------------------------------

## 10.Configuring a Web Server

--------------------------------------------------------------------------------------------

* Apache-Pack Component, `composer require symfony/apache-pack`
(Source: [https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules](https://symfony.com/doc/current/setup/web_server_configuration.html#adding-rewrite-rules))