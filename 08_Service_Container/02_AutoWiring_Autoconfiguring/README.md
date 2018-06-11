# Purpose of the Demo - 02 Autowiring Autoconfiguring

We will create a **Basic Service** and change its configuration. 

---------------------------------------------------------------------------------------

We will take as a starting point [01 Basic Service](../01_Basic_Service/):

---------------------------------------------------------------------------------------

# Phases of the Demo
1. [Continue Project](#1continue-project)
2. [Change the configuration our services - Autowiring](#2change-the-configuration-our-services---autowiring)
3. [Change the configuration our services - Autoconfiguring](#2change-the-configuration-our-services---autoconfiguring)

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Twig Component](https://twig.symfony.com/doc/2.x/), `composer require twig`
* [Logging with Monolog](https://symfony.com/doc/current/logging.html), `composer require symfony/monolog-bundle`

# Basic Service

--------------------------------------------------------------------------------------------

## 1.Continue Project

--------------------------------------------------------------------------------------------

1. Copy the content of demo [01 Basic Service](../01_Basic_Service/), without folder [vendor](../01_Basic_Service/vendor/).

2. Installs **Composer** and its dependencies from the previous phase: 

```bash
composer update
```

--------------------------------------------------------------------------------------------

## 2.Change the configuration our services - Autowiring

--------------------------------------------------------------------------------------------

1. First we can view the default configuration for the services into [config/services.yaml](./config/services.yaml).

_[config/services.yaml](./config/services.yaml)_
```yaml
# Put parameters here that don't need to change on each machine where the app is deployed
# https://symfony.com/doc/current/best_practices/configuration.html#application-related-configuration
parameters:

services:
    # default configuration for services in *this* file
    _defaults:
        autowire: true      # Automatically injects dependencies in your services.
        autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
        public: false       # Allows optimizing the container by removing unused services; this also means
                            # fetching services directly from the container via $container->get() won't work.
                            # The best practice is to be explicit about your dependencies anyway.
```

> We can also see the configuration of a service by executing the following command, `php bin/console debug:container "App\Service\Greeting"` for the service **"App\Service\Greeting"**

```bash
php bin/console debug:container "App\Service\Greeting"
```

> We will see something like that.

```bash
Information for Service "App\Service\Greeting"
==============================================

 ---------------- ----------------------
  Option           Value
 ---------------- ----------------------
  Service ID       App\Service\Greeting
  Class            App\Service\Greeting
  Tags             -
  Public           no
  Synthetic        no
  Lazy             no
  Shared           yes
  Abstract         no
  Autowired        yes
  Autoconfigured   yes
 ---------------- ----------------------
```

2. Let's change the default configuration of the **autowire**.

_[config/services.yml](./config/services.yml)_
```diff
services:
    # default configuration for services in *this* file
    _defaults:
--      autowire: true      # Automatically injects dependencies in your services.    
++      autowire: false     # Automatically injects dependencies in your services.
        autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
        public: false       # Allows optimizing the container by removing unused services; this also means
                            # fetching services directly from the container via $container->get() won't work.
                            # The best practice is to be explicit about your dependencies anyway.
                            # ...                            
```

3. And we will execute the `php bin/console debug:container "App\Service\Greeting"` command to see how this service changes.

```bash
php bin/console debug:container "App\Service\Greeting"
```

> We will see something like that.

```bash
Information for Service "App\Service\Greeting"
==============================================

 ---------------- ----------------------
  Option           Value
 ---------------- ----------------------
  Service ID       App\Service\Greeting
  Class            App\Service\Greeting
  Tags             -
  Public           no
  Synthetic        no
  Lazy             no
  Shared           yes
  Abstract         no
  Autowired        no
  Autoconfigured   yes
 ---------------- ----------------------
```

4. If we run `php bin/console server:run` and go to **[http://127.0.0.1:8000/twig/?name=Robert](http://127.0.0.1:8000/twig/?name=Robert)**, we will get the next error:

| **Too few arguments to function App\Controller\BlogController::__construct(), 0 passed in C:\Users\Creativos6_\Desktop\s4\Symfony-4-by-Samples\08_Service_Container\02_AutoWiring_Autoconfiguring\var\cache\dev\ContainerD33Zblr\getBlogControllerService.php on line 13 and exactly 1 expected** |
|----------------|

> Now it is neccesary add the dependencies inside [config/services.yml](./config/services.yml), so that:

_[config/services.yml](./config/services.yml)_
```diff
    # controllers are imported separately to make sure services can be injected
    # as action arguments even if you don't extend any base controller class
    App\Controller\:
        resource: '../src/Controller'
        tags: ['controller.service_arguments']

++  App\Controller\BlogController: ['@App\Service\Greeting']
++  App\Service\Greeting: ['@monolog.logger']    
    # add more service definitions when explicit configuration is needed
    # please note that last definitions always *replace* previous ones                         
```

5. Let's go back to the url **[http://127.0.0.1:8000/twig/?name=Robert](http://127.0.0.1:8000/twig/?name=Robert)**.

> No error should be shown.


--------------------------------------------------------------------------------------------

## 3.Change the configuration our services - Autoconfiguring

--------------------------------------------------------------------------------------------

1. Create a new Service in [src/Security/ExploreVoter.php](./src/Security/ExploreVoter.php).

_[src/Security/ExploreVoter.php](./src/Security/ExploreVoter.php)_
```php
<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

class ExampleVoter implements VoterInterface
{

    public function vote(TokenInterface $token, $subject, array $attributes)
    {
        // TODO: Implement vote() method.
    }
}
```

2. Execute the command `php bin/console debug:container "App\Security\ExampleVoter"` to view its configuration.

```bash
php bin/console debug:container "App\Security\ExampleVoter"
```

```bash
Information for Service "App\Security\ExampleVoter"
===================================================

 ---------------- ---------------------------
  Option           Value
 ---------------- ---------------------------
  Service ID       App\Security\ExampleVoter
  Class            App\Security\ExampleVoter
  Tags             -
  Public           no
  Synthetic        no
  Lazy             no
  Shared           yes
  Abstract         no
  Autowired        yes
  Autoconfigured   yes
 ---------------- ---------------------------
```

3. Change the default value of **Autowire** in [config/services.yml](./config/services.yml).

_[config/services.yml](./config/services.yml)_
```diff
services:
    # default configuration for services in *this* file
    _defaults:
--      autowire: false     # Automatically injects dependencies in your services.
++      autowire: true      # Automatically injects dependencies in your services.    
        autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
        public: false       # Allows optimizing the container by removing unused services; this also means
                            # fetching services directly from the container via $container->get() won't work.
                            # The best practice is to be explicit about your dependencies anyway.
                            # ...                            
```

4. Execute the command `php bin/console debug:container "App\Security\ExampleVoter"` to view the new configuration.

```bash
php bin/console debug:container "App\Security\ExampleVoter"
```

```bash
Information for Service "App\Security\ExampleVoter"
===================================================

 ---------------- ---------------------------
  Option           Value
 ---------------- ---------------------------
  Service ID       App\Security\ExampleVoter
  Class            App\Security\ExampleVoter
  Tags             security.examplevoter
  Public           no
  Synthetic        no
  Lazy             no
  Shared           yes
  Abstract         no
  Autowired        yes
  Autoconfigured   yes
 ---------------- ---------------------------
 ```

5. Change the default value of **autoconfigure** in [config/services.yml](./config/services.yml).

_[config/services.yml](./config/services.yml)_
```diff
services:
    # default configuration for services in *this* file
    _defaults:
        autowire: true      # Automatically injects dependencies in your services.    
--      autoconfigure: true  # Automatically registers your services as commands, event subscribers, etc.
++      autoconfigure: false # Automatically registers your services as commands, event subscribers, etc.        
        public: false       # Allows optimizing the container by removing unused services; this also means
                            # fetching services directly from the container via $container->get() won't work.
                            # The best practice is to be explicit about your dependencies anyway.
                            # ...                            
```

6. Execute the command `php bin/console debug:container "App\Security\ExampleVoter"` to view the new configuration.

```bash
php bin/console debug:container "App\Security\ExampleVoter"
```

```bash
Information for Service "App\Security\ExampleVoter"
===================================================

 ---------------- ---------------------------
  Option           Value
 ---------------- ---------------------------
  Service ID       App\Security\ExampleVoter
  Class            App\Security\ExampleVoter
  Tags             -
  Public           no
  Synthetic        no
  Lazy             no
  Shared           yes
  Abstract         no
  Autowired        yes
  Autoconfigured   no
 ---------------- ---------------------------
 ```