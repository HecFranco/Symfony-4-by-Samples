# Purpose of the Demo - Login Form

We will created a **Login Form** that requires a username or email and password. 

# Phases of the Demo

1. [Project Creation](#1project-creation)
2. [Database Configuration](#2database-configuration)
3. [Creating the User Entity](#3creating-the-user-entity)
4. [Configure Security to load from your Entity](#4configure-security-to-load-from-your-entity)
5. [Creating the SecurityController and its Routing](#5creating-the-securitycontroller-and-its-routing)
6. [Templates](#6templates)
7. [Result](#7result)

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 02_login_form`

---------------------------------------------------------------------------------------

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

# Login Form

--------------------------------------------------------------------------------------------

## 1.Project Creation

--------------------------------------------------------------------------------------------

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton 02_login_form
```

2. In the next step we will access the project folder using:

```bash
cd 02_login_form
```

--------------------------------------------------------------------------------------------

## 2.Database Configuration

--------------------------------------------------------------------------------------------

1. We will installed **Doctrine Component** to manage the database of project using the command:

```bash
composer require doctrine maker
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

## 4.Configure Security to load from your Entity

--------------------------------------------------------------------------------------------

1. Now that you have a **User** entity that **implements UserInterface**, you just need to tell Symfony's security system about it in security.yaml.

2. First, we will indicated the encoder that we will used into [config/packages/security.yaml](config/packages/security.yaml).

_[config/packages/security.yaml](config/packages/security.yaml)_
```yml
# config/packages/security.yaml
security:
    # https://symfony.com/doc/current/security.html#where-do-users-come-from-user-providers
    encoders:
        App\Entity\User: 
            algorithm: bcrypt
            cost: 4 # Number of times the password will be encrypted     
# ...
# ....................................................DEFINIMOS EL SISTEMA DE ENCRIPTACIÓN QUE SE USARÁ #
```

3. Then, we will designate which user provider we will have into [config/packages/security.yaml](config/packages/security.yaml).

_[config/packages/security.yaml](config/packages/security.yaml)_
```yml
# ...
# PROVEEDOR DE USUARIOS................................................................................ #
# https://symfony.com/doc/current/security.html#b-configuring-how-users-are-loaded
# https://symfony.com/doc/current/security/entity_provider.html#configure-security-to-load-from-your-entity    
    providers:
        # in_memory: { memory: ~ }
        our_db_provider:
            entity:
                class: App\Entity\User
                property: username
# ................................................................................PROVEEDOR DE USUARIOS #

```

4. Next, we will indicate the firewalls configuration into [config/packages/security.yaml](config/packages/security.yaml).

_[config/packages/security.yaml](config/packages/security.yaml)_
```yml
# FIREWALLS ........................................................................................... #
# ...
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            anonymous: ~
            # pattern:    ^/
            http_basic: ~
            provider: our_db_provider
# ...
            form_login:
                login_path: /login
                check_path: /login_check
# ...
            logout:
                path: /logout
                target: /
                success_handler: ~
                invalidate_session: true
```

5. For other hand, **Symfony** creates an instance of RequestMatcher for each `access_control` entry, which determines whether or not a given access control should be used on this request. The following `access_control` options are used for matching:

(Source: [https://symfony.com/doc/current/security/access_control.html#matching-options](https://symfony.com/doc/current/security/access_control.html#matching-options))

_[config/packages/security.yaml](config/packages/security.yaml)_
```yml
# ........................................................................................... FIREWALLS #
    # activate different ways to authenticate
    # https://symfony.com/doc/current/security.html#a-configuring-how-your-users-will-authenticate
    #http_basic: ~
    # https://symfony.com/doc/current/security/form_login_setup.html
    # form_login: ~
    access_control:
        # https://symfony.com/doc/current/security/access_control.html#content_wrapper
        # ^/login can be any user (ANONYMOUS)
        - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY}
        - { path: ^/register, roles: IS_AUTHENTICATED_ANONYMOUSLY}
        - { path: ^/, roles: [ROLE_USER, ROLE_ADMIN]} 
```

(Source: [https://symfony.com/doc/current/security/entity_provider.html#configure-security-to-load-from-your-entity](https://symfony.com/doc/current/security/entity_provider.html#configure-security-to-load-from-your-entity))
(Source: [https://symfony.com/doc/current/security/access_control.html#content_wrapper](https://symfony.com/doc/current/security/access_control.html#content_wrapper))

--------------------------------------------------------------------------------------------

## 5.Creating the SecurityController and its Routing

--------------------------------------------------------------------------------------------

1. Next, we need a controller to handle the form rendering and submission. If the form is submitted, the controller performs the validation the user into the database in [src/Controller/SecurityController.php](src/Controller/SecurityController.php).

_[src/Controller/SecurityController.php](src/Controller/SecurityController.php)_
```php
<?php
// src/Controller/SecurityController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class SecurityController extends Controller {
    public function login(Request $request, AuthenticationUtils $authenticationUtils) {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
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
    controller: App\Controller\RegistrationController::register
```

--------------------------------------------------------------------------------------------

## 6.Templates

--------------------------------------------------------------------------------------------

1. If you're returning HTML from your controller, you'll probably want to render a template. Fortunately, Symfony comes with **Twig**: a templating language that's easy, powerful and actually quite fun.

First, install Twig:

```bash
composer require twig
```

Now we will created our template with **Twig** in [templates/security/login.html.twig](templates/security/login.html.twig).

_[templates/security/login.html.twig](templates/security/login.html.twig)_
```html
{# templates/security/login.html.twig #}
{# ... you will probably extend your base template, like base.html.twig #}
{% if error %}
    <div>{{ error.messageKey|trans(error.messageData, 'security') }}</div>
{% endif %}
<form action="{{ path('login') }}" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="_username" value="{{ last_username }}" />

    <label for="password">Password:</label>
    <input type="password" id="password" name="_password" />
    {#
        If you want to control the URL the user
        is redirected to on success (more details below)
        <input type="hidden" name="_target_path" value="/account" />
    #}
    <button type="submit">login</button>
</form>
```

(Source: [https://symfony.com/doc/current/page_creation.html#rendering-a-template](https://symfony.com/doc/current/page_creation.html#rendering-a-template))

--------------------------------------------------------------------------------------------

## 7.Result

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

# EXTRA

--------------------------------------------------------------------------------------------

## How to Add "Remember Me" Login Functionality

--------------------------------------------------------------------------------------------

1. To add **Remember Me** option in the login form, we will modified the firewalls configuration into [config/packages/security.yaml](config/packages/security.yaml).

_[config/packages/security.yaml](config/packages/security.yaml)_
```diff
# ...
    firewalls:
# ...
        main:
            form_login:
                login_path: /login
                check_path: /login_check
# ...
++            remember_me:
++                secret:   '%kernel.secret%'
++                lifetime: 604800 # 1 week in seconds
++                path:     /
# ...
            logout:
                path: /logout
                target: /
                success_handler: ~
                invalidate_session: true
```

2. And the **template** **form login** into [templates/security/login.html.twig](templates/security/login.html.twig).

_[templates/security/login.html.twig](templates/security/login.html.twig)_
```html
{# templates/security/login.html.twig #}
{# ... you will probably extend your base template, like base.html.twig #}
{% if error %}
    <div>{{ error.messageKey|trans(error.messageData, 'security') }}</div>
{% endif %}
<form action="{{ path('login') }}" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="_username" value="{{ last_username }}" />

    <label for="password">Password:</label>
    <input type="password" id="password" name="_password" />
    {#
        If you want to control the URL the user
        is redirected to on success (more details below)
        <input type="hidden" name="_target_path" value="/account" />
    #}
    <button type="submit">login</button>
</form>
```

(Source: [https://symfony.com/doc/master/security/remember_me.html#content_wrapper](https://symfony.com/doc/master/security/remember_me.html#content_wrapper))