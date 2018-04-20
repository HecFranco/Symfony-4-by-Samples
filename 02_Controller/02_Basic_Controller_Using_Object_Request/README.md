# Purpose of the Demo - 02 Basic Controller Using Object Request

We will create a **Basic Controller** using the **Object Request**. 

It is usually very useful to have in the command of the object [Request](https://symfony.com/doc/current/introduction/http_fundamentals.html#requests-and-responses-in-http) associated with the user's request, especially when working with forms. To make **Symfony** pass this object automatically as the controller's argument, use the following code:

---------------------------------------------------------------------------------------

We will take as a starting point [01 Basic Controller](../01_Basic_Controller/):

---------------------------------------------------------------------------------------

# Phases of the Demo
1. [Continue Project](#1continue-project)
2. [Adding Object Request](#2adding_object_request)

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 01_Basic_Controller`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`

# Basic Controller

--------------------------------------------------------------------------------------------

## 1.Continue Project

--------------------------------------------------------------------------------------------

1. Copy the content of demo [01 Basic Controller](../01_Basic_Controller/), without folder [vendor](../01_Basic_Controller/vendor/).

2. Installs **Composer** and its dependencies from the previous phase: 

```bash
composer install
```

2. 1. Installs **Webpack** and its dependencies from the previous phase: 

```bash
npm install
```

--------------------------------------------------------------------------------------------

## 2.Adding Object Request

--------------------------------------------------------------------------------------------

1. Do next changes into [./src/Controller/DemoController.php](./src/Controller/DemoController.php).

_[./src/Controller/DemoController.php](./src/Controller/DemoController.php)_
```diff
<?php
// src/Controller/ControllerController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
++ use Symfony\Component\HttpFoundation\Request;

-- class DemoController {
++ class DemoController {
--  public function showControllerWithVariable($slug) {
++  public function showControllerWithVariable(request $request, $slug) {  
    return new Response('Controller example with variable value $ slug:'.$slug);
  }
--  public function showControllerWithVariableDefault($firstName, $lastName, $color) {
++  public function showControllerWithVariableDefault(request $request, $firstName, $lastName, $color) {  
    return new Response('Example of controller with three variables, two per route: '.$firstName.' Y '.$lastName.', and one by default.'.$color);
  }    
}
```

When we have it we can see the changes in: **[http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez] (http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez) **

! [Test_Controller_Controller_show_Controller_With_Variable_Default](../../99_Readme_Resources/02_Controller/01_Basic_Controller/basic-controller-variable-default.jpg)

This change does not affect the operation of the **controller**. In the next section, we explain the **helpers** or useful methods that the base class of the controller puts at your disposal. These methods are only shortcuts to more easily use the Symfony kernel functionalities. A good way to learn these kernel functionalities in practice is to see the source code of that base class in the file **use Symfony\Bundle\FrameworkBundle\Controller\Controller**.