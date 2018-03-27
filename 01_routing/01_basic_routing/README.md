# Purpose of the Demo - Basic Routing

1. Create a little web using **Basic Routing**.

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 01_basic_routing`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* Server Component, `composer require server --dev`

# Basic Routing

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton 01_basic_routing
```

2. In the next step we will access the project folder using:

```bash
cd 01_basic_routing
```

3. To work easly, we need install the **server component** of **Symfony** for its, we will launch the console command:

```bash
composer require server -dev
```

4. Now, you can view the result of demo when write in the terminal the console command:

```bash
php bin/console server:run
```

5. After, we will created the **homepage**, this is a **static page** that no need information, then we will have not to send info for the routing. Now, we will can created the routing into [/config/routes.yaml](/config/routes.yaml).

_[/config/routes.yaml](/config/routes.yaml)_
```yml
homepage:
    path: /
    controller: App\Controller\HomeController::index
```

This routing points to the `index` method located in the `HomeController` controller, [src/controller/HomeController.php](src/controller/HomeController.php).

6. The **method index** (`public function index(){}`) will be this:

_[src/controller/HomeController.php](src/controller/HomeController.php)_
```php
<?php
// src/Controller/DefaultController.php
/* We indicate the namespace of the Bundle ********************************************************************/
    namespace App\Controller;
/* BASIC CONTROLLER COMPONENTS ********************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Allow Router
    use Symfony\Component\HttpFoundation\Response;                  // Allows you to execute Response
/**************************************************************************************************************/
class HomeController {
    public function index() {
        return new Response('<h1>News Daily Mirror !</h1>');
    }
}
```

**Note**: It is very important, if we are using the **object Response** we must use the next line `use Symfony\Component\HttpFoundation\Response;` in the **controller**.

7. Now, we will modified the method index into [src/controller/HomeController.php](src/controller/HomeController.php), for can use **variable** in our routing.

_[src/controller/HomeController.php](src/controller/HomeController.php)_
```diff
class HomeController {
    public function index() {
        //...
++        $section_array = array('life','sport','ecconomy');
++        $view_page = '<h1>News Daily Mirror !</h1>';
++        foreach($section_array as $key=>$value){
++            $view_page = $view_page.'<a href="/news/'.$value.'">'.$value.'</a><br>';
++        }
--        return new Response('<h1>News Daily Mirror !</h1>');
++        return new Response($view_page);
    }
}
```

8. The **routing system** offers much more interesting possibilities than those of the previous section. Many routes contain one or more variables, also called **placeholders**. In this example we will created the next routing:

_[/config/routes.yaml](/config/routes.yaml)_
```yml
viewSection:
    path: /news/{section}
    controller: App\Controller\newsController::viewSection
```

9. We can now create the method inside the controller [src/controller/newsController.php](src/controller/newsController.php) that requires a variable.

_[src/controller/newsController.php](src/controller/newsController.php)_
```php
<?php
// src/Controller/DefaultController.php
/* We indicate the namespace of the Bundle ********************************************************************/
    namespace App\Controller;
/* BASIC CONTROLLER COMPONENTS ********************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Allow Router
    use Symfony\Component\HttpFoundation\Response;                  // Allows you to execute Response
/**************************************************************************************************************/
class newsController {
    public function viewSection($section) {
        $view_page = '<h1>News about '.$section.'</h1><br>'.
        '<a href="/">return home</a>';
        return new Response($view_page);
    }
}
```
