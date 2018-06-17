# Purpose of the Demo - 01 Basic Template

We will do an installation from the beginning where we will include **Twig**.

# Phases of the Demo
1. [Project creation and ready](#1project-creation-and-ready)
2. 

---------------------------------------------------------------------------------------

* We will create the project through the command of the console:`composer create-project symfony/skeleton 01_Basic_Template`

---------------------------------------------------------------------------------------

# Summary of Symfony components to use

* Server Component, `composer require server --dev`
* Twig Component, `composer require twig`
* Asset Component, `composer require symfony/asset`


# 01 Basic Template

--------------------------------------------------------------------------------------------

## 1.Project Creation and Ready

--------------------------------------------------------------------------------------------

1. We create our project using the commands of the console: 

```bash
composer create-project symfony/skeleton 01_Basic_Template
```

2. In the next step, we will access the project folder using:

```bash
cd 01_Basic_Template
```

> It is also necessary to install the components: [Server Component](https://symfony.com/doc/current/setup.html), `composer require server --dev` and [Profiler Component](https://symfony.com/doc/current/profiler.html), `composer require --dev profiler`.

3. We will create the **Controller**, [src/Controller/DefaultController.php](src/Controller/DefaultController.php), which will manage the view with the following content.

_[src/Controller/DefaultController.php](src/Controller/DefaultController.php)_
```php
<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller{
    public function index(Request $request): Response  {
        return $this->render('default/index.html.twig');
    }
}
```

4. For this **Demo**, we will use a **yaml** routing, for this we configure it in [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](config/routes.yaml)_
```yml
# Importante en los archivos con la extensión .yaml cada sangría es igual a 4 espacios !!!!
index:
    path: /
    controller: App\Controller\DefaultController::index
```

5. For the view we will use **Twig**, so we will install your component using the following command:

```bash
composer require twig
```

6. Now, we will create our template with **Twig** in [templates/default/index.html.twig](templates/default/index.html.twig).

_[templates/default/index.html.twig](templates/default/index.html.twig)_
```html
{% extends 'base.html.twig' %}
{% block body %}