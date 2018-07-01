# Purpose of the Demo - 04 Using the Debug System and Dump

We will create a ** **. 

> 

# Phases of the Demo
1. [Project Creation](#1project-creation)
2. 

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 04_Using_the_Debug_System_and_Dump`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`
* [Twig Component](https://twig.symfony.com/doc/2.x/), `composer require twig`
* [Debug Component](http://symfony.com/doc/current/components/debug.html), `composer require symfony/debug`
* [Debug Bundle](https://packagist.org/packages/symfony/debug-bundle), `composer require symfony/debug-bundle`
* [VarDumper Component](https://symfony.com/doc/current/components/var_dumper.html), `composer require symfony/var-dumper`

# Basic Service

--------------------------------------------------------------------------------------------

## 1.Project Creation

--------------------------------------------------------------------------------------------

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton 04_Using_the_Debug_System_and_Dump
```

2. In the next step we will access the project folder using:

```bash
cd 04_Using_the_Debug_System_and_Dump
```

3. Execute `composer update` to install the dependencies defined into [composer.json](./composer.json):

```bash
composer update
```

4. It is necessary to install the **server component**, to use our **Server Local**, through the console command:

```bash
composer require server --dev
```

5. Now, you will be able to view the result of demo when write in the terminal the command console:

```bash
php bin/console server:run
```

--------------------------------------------------------------------------------------------

## 2.Install the components

--------------------------------------------------------------------------------------------


[Server Component](https://symfony.com/doc/current/setup.html), using the command 
```bash
composer require server --dev
```
[Profiler Component](https://symfony.com/doc/current/profiler.html), 
```bash
```
composer require --dev profiler
[Twig Component](https://twig.symfony.com/doc/2.x/), 
```bash
composer require twig
```
[Debug Component](http://symfony.com/doc/current/components/debug.html),
```bash
composer require symfony/debug
```
[Debug Bundle](https://packagist.org/packages/symfony/debug-bundle),
```bash
composer require symfony/debug-bundle
```
[VarDumper Component](https://symfony.com/doc/current/components/var_dumper.html),
```bash
composer require symfony/var-dumper
```

--------------------------------------------------------------------------------------------

## 3.Testing the example

--------------------------------------------------------------------------------------------

_[config/routes.yaml](./config/routes.yaml)_
```yml
#index:
#    path: /
#    controller: App\Controller\DefaultController::index
# config/routes.yaml

# the "app_lucky_number" route name is not important yet
app_lucky_number:
    path: /lucky/number
    controller: App\Controller\LuckyController::number
```

_[src/Controller/LuckyController.php](./src/Controller/LuckyController.php)_
```php
<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', array(
            'number' => $number,
        ));
    }
}
```

_[templates/lucky/number.html.twig](./templates/lucky/number.html.twig)_
```html
{# templates/lucky/number.html.twig #}
{% extends 'base.html.twig' %}

{% block body %}
<h1>Your lucky number is {{ dump(number) }}</h1>
{{ dump() }}

{% endblock %}
```