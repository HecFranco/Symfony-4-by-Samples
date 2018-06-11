# Purpose of the Demo - 05 Manual Service Wiring, Parameter Binding

We will create a **Service** and change its configuration. 

---------------------------------------------------------------------------------------

We will take as a starting point [04 Service Tags](../04_Service_Tags/):

---------------------------------------------------------------------------------------

# Phases of the Demo
1. [Continue Project](#1continue-project)
2. //...

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

1. Copy the content of demo [04 Service Tags](../04_Service_Tags/), without folder [vendor](../04_Service_Tags/vendor/).

2. Installs **Composer** and its dependencies from the previous phase: 

```bash
composer update
```

--------------------------------------------------------------------------------------------

## 2.Manual Service Wiring, Parameter Binding

--------------------------------------------------------------------------------------------

_[src/Service/Greeting.php](./src/Service/Greeting.php)_
```diff
<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class Greeting
{
  private $logger;
++ private $message;
-- public function __construct(LoggerInterface $logger)
++ public function __construct(LoggerInterface $logger, string $message)
  {
    $this->logger = $logger;
++  $this->message = $message;   
  }    
  public function greet(string $name): string
  {
    $this->logger->info("Greeted $name");
--  return "Hello $name";
++  return "{$this->message} $name";
  }
}
```

_[config/services.yaml](./config/services.yaml)_
```diff
    # ...
    # App\Controller\BlogController: ['@App\Service\Greeting']
    # App\Service\Greeting: ['@monolog.logger']  
++  App\Service\Greeting:
++      arguments:
++          $message: 'Hello from Service'
--  app.greeting:
++  # app.greeting:
--      public: true
++      # public: true
--      alias: App\Service\Greeting
++      # alias: App\Service\Greeting
    #... 
```

[http://127.0.0.1/twig/?name=Robert](http://127.0.0.1/twig/?name=Robert)

View the message in viewport : **Hello from Service Robert**

_[config/services.yaml](./config/services.yaml)_
```diff
# Put parameters here that don't need to change on each machine where the app is deployed
# https://symfony.com/doc/current/best_practices/configuration.html#application-related-configuration
parameters:
++  hello_message: 'Hello from Service'
services:
    # ...
    # App\Controller\BlogController: ['@App\Service\Greeting']
    # App\Service\Greeting: ['@monolog.logger']  
    App\Service\Greeting:
        arguments:
--          $message: 'Hello from Service'
++          # $message: 'Hello from Service'
++          $message: '%hello_message%'
    # app.greeting:
        # public: true
        # alias: App\Service\Greeting
    #... 
```

[http://127.0.0.1/twig/?name=Robert](http://127.0.0.1/twig/?name=Robert) View the message in viewport : **Hello from Service Robert**

_[config/services.yaml](./config/services.yaml)_
```diff
# Put parameters here that don't need to change on each machine where the app is deployed
# https://symfony.com/doc/current/best_practices/configuration.html#application-related-configuration
parameters:
    hello_message: 'Hello from Service'
services:
    # default configuration for services in *this* file
    _defaults:
        autowire: true      # Automatically injects dependencies in your services.
        autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
        public: false       # Allows optimizing the container by removing unused services; this also means
                            # fetching services directly from the container via $container->get() won't work.
                            # The best practice is to be explicit about your dependencies anyway.
++      bind:
++          $message: '%hello_message%'                                    
    # ...
    # App\Controller\BlogController: ['@App\Service\Greeting']
    # App\Service\Greeting: ['@monolog.logger']  
    App\Service\Greeting:
        arguments:
            # $message: 'Hello from Service'
--          $message: '%hello_message%'            
++          # $message: '%hello_message%'
    # app.greeting:
        # public: true
        # alias: App\Service\Greeting
    #... 
```

[http://127.0.0.1/twig/?name=Robert](http://127.0.0.1/twig/?name=Robert) View the message in viewport : **Hello from Service Robert**

_[config/services.yaml](./config/services.yaml)_
```diff
# Put parameters here that don't need to change on each machine where the app is deployed
# https://symfony.com/doc/current/best_practices/configuration.html#application-related-configuration
parameters:
    hello_message: 'Hello from Service'
services:
    # default configuration for services in *this* file
    _defaults:
        autowire: true      # Automatically injects dependencies in your services.
        autoconfigure: true # Automatically registers your services as commands, event subscribers, etc.
        public: false       # Allows optimizing the container by removing unused services; this also means
                            # fetching services directly from the container via $container->get() won't work.
                            # The best practice is to be explicit about your dependencies anyway.
        bind:
            $message: '%hello_message%' 
++          App\Service\SomeInterface: '@some_service'
    # ...
    # App\Controller\BlogController: ['@App\Service\Greeting']
    # App\Service\Greeting: ['@monolog.logger']  
    App\Service\Greeting:
        arguments:
            # $message: 'Hello from Service'
            # $message: '%hello_message%'
    # app.greeting:
        # public: true
        # alias: App\Service\Greeting
    #... 
```

_[src/Service/Greeting.php](./src/Service/Greeting.php)_
```diff
<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class Greeting
{
  private $logger;
  private $message;
-- public function __construct(LoggerInterface $logger, string $message)
++ public function __construct(LoggerInterface $logger, string $message, SoemInterface $interface)
  {
    $this->logger = $logger;
    $this->message = $message;   
  }    
  public function greet(string $name): string
  {
    $this->logger->info("Greeted $name");
    return "{$this->message} $name";
  }
}
```