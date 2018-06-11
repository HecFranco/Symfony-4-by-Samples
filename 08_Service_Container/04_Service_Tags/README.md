# Purpose of the Demo - 03 Public and Private Services

We will create a **Service** and change its configuration. 

---------------------------------------------------------------------------------------

We will take as a starting point [03 Public or Private Services](../03_Public_or_Private_Services/):

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

1. Copy the content of demo [03 Public or Private Services](../03_Public_or_Private_Services/), without folder [vendor](../03_Public_or_Private_Services/vendor/).

2. Installs **Composer** and its dependencies from the previous phase: 

```bash
composer update
```

--------------------------------------------------------------------------------------------

## 2.Services Tags

--------------------------------------------------------------------------------------------

1. 

_[src/Command/HelloCommand.php](./src/Command/HelloCommand.php)_
```php
<?php

namespace App\Command;

use App\Service\Greeting;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloCommand extends Command
{
    /**
     * @var Greeting
     */
    private $greeting;

    public function __construct(Greeting $greeting)
    {
        $this->greeting = $greeting;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:say-hello')
            ->setDescription('Says hello to the user')
            ->addArgument('name', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $output->writeln([
            'Hello from the app',
            '==================',
            ''
        ]);
        $output->writeln($this->greeting->greet($name));
    }
}
```


```bash
php bin/console debug:container 'App\Command\HelloCommand'
```

```bash
Information for Service "App\Command\HelloCommand"
==================================================

 ---------------- --------------------------
  Option           Value
 ---------------- --------------------------
  Service ID       App\Command\HelloCommand
  Class            App\Command\HelloCommand
  Tags             console.command
  Public           no
  Synthetic        no
  Lazy             no
  Shared           yes
  Abstract         no
  Autowired        yes
  Autoconfigured   yes
 ---------------- --------------------------
 ```

```bash
php bin/console
```

```bash
...
Available commands:
  about                   Displays information about the current project
  help                    Displays help for a command
  list                    Lists commands
 app
  app:say-hello           Says hello to the user
 assets
  assets:install          Installs bundles web assets under a public directory
... 
```

 ```bash
php bin/console app:say-hello John
```

```bash
Hello from the app
==================

Hello John
```