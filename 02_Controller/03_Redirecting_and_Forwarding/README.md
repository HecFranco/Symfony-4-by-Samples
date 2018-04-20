# Purpose of the Demo - 03 Redirecting and Forwarding

We will create a **Basic Controller** using the **forward()**. 

It is usually very useful to have in the command of the object [Request](https://symfony.com/doc/current/introduction/http_fundamentals.html#requests-and-responses-in-http) associated with the user's request, especially when working with forms. To make **Symfony** pass this object automatically as the controller's argument, use the following code:

---------------------------------------------------------------------------------------

We will take as a starting point [02 Basic Controller Using Object Request](../01_Basic_Controller_Using_object_Request/):

---------------------------------------------------------------------------------------

# Sources
* [controller.html, Redirecting](https://symfony.com/doc/current/controller.html#redirecting)

# Phases of the Demo
1. [Continue Project](#1continue-project)
2. [Adding Redirect](#2AddingRedirect)

# Summary Symfony component`s to use

* [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev`
* [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`

# Redirecting and Forwarding

--------------------------------------------------------------------------------------------

## 1.Continue Project

--------------------------------------------------------------------------------------------

1. Copy the content of demo [02 Basic Controller Using Object Request](../01_Basic_Controller_Using_object_Request/), without folder [vendor](../01_Basic_Controller/vendor/).

2. Installs **Composer** and its dependencies from the previous phase: 

```bash
composer install
```

2. 1. Installs **Webpack** and its dependencies from the previous phase: 

```bash
npm install
```

--------------------------------------------------------------------------------------------

## 2.Adding Redirect

--------------------------------------------------------------------------------------------

Although a controller can do anything, most controllers always handle the same basic tasks. These tasks, such as **redirect** to another page, **process Templates** and **basic services**, are easy to manage in Symfony.

For use this functions you need add next **Symfony Components**:

```php
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
```

and extends the class 

```php
class DemoController extends Controller 
```

If you want to use another page, use the `redirect()` method to redirect to an external page:

_[./src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```diff
<?php
// src/Controller/ControllerController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
++ use Symfony\Component\HttpFoundation\RedirectResponse;
++ use Symfony\Bundle\FrameworkBundle\Controller\Controller;

-- class DemoController {
++ class DemoController extends Controller {  
  public function showControllerWithVariable(request $request, $slug) {
    var_dump($request);die();
    return new Response('Controller example with variable value $ slug:'.$slug);
  }
  public function showControllerWithVariableDefault(request $request, $firstName, $lastName, $color="green") {
    return new Response('Example of controller with three variables, two per route: '.$firstName.' Y '.$lastName.', and one by default.'.$color);

  } 
++  public function exampleControllerRedirectExternalUrl() {
++    // Redirect to an external url
++    return $this->redirect('http://symfony.com/doc');
++  }   
}
```

The `generateUrl()` method is just an auxiliary function that generates the URL of a certain route. For more information, see the routing demos [here](../../01_Routing). 

**IMPORTANT**: It's neccesary add the components `Symfony\Component\HttpFoundation\RedirectResponse` and `Symfony\Bundle\FrameworkBundle\Controller\Controller` typing the lines `use Symfony\Component\HttpFoundation\RedirectResponse;` and `use Symfony\Bundle\FrameworkBundle\Controller\Controller;`. In addition, you must **extends** the **controller** change the line `class DemoController {` for `class DemoController extends Controller {`.

_[./src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```diff
<?php
// src/Controller/ControllerController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemoController extends Controller {
  public function showControllerWithVariable(request $request, $slug) {
    var_dump($request);die();
    return new Response('Controller example with variable value $ slug:'.$slug);
  }
  public function showControllerWithVariableDefault(request $request, $firstName, $lastName, $color="green") {
    return new Response('Example of controller with three variables, two per route: '.$firstName.' Y '.$lastName.', and one by default.'.$color);

  } 
  public function exampleControllerRedirectExternalUrl() {
    // Redirect to an external url
    return $this->redirect('http://symfony.com/doc');
  } 
++  public function exampleControllerRedirectInternalUrl() {
++    // The generateUrl() method is just an auxiliary method that generates the URL for a particular route:
++    $url = $this->generateUrl('example_controller_with_variable', array('slug' => 'hello'));
++    return $this->redirectToRoute($url);
++  }
}
```

_[./src/Resources/config/routing/demo.yml](./src/Resources/config/routing/demo.yml)_
```diff
example_controller_with_variable:
    path: /example-controller-with-variable/{slug}
    controller: App\Controller\DemoController::showControllerWithVariable
example_controller_with_variable_default:
    path: example-controller-with-variable-default/{firstName}/{lastName}
    controller: App\Controller\DemoController::showControllerWithVariableDefault
#    defaults:
#        color: green
++ example_controller_redirect_external_url:
++     path: /exampleControllerRedirectExternalUrl/
++     controller: App\Controller\DemoController::exampleControllerRedirectExternalUrl
++ example_controller_redirect_internal_url_generateUrl:    
++     path: /exampleControllerRedirectInternalUrl_generateUrl/
++     controller: App\Controller\DemoController::exampleControllerRedirectInternalUrl_generateUrl     
++ example_controller_redirect_internal_url_redirectToRoute:    
++     path: /exampleControllerRedirectInternalUrl_redirectToRoute/
++     controller: App\Controller\DemoController::exampleControllerRedirectInternalUrl_redirectToRoute
```