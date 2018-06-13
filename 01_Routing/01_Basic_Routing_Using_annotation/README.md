# Purpose of the Demo - Basic Routing Using Annotation

We will created a little web using **Basic Routing** using the **yml** routing type.

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 02_Basic_Routing_Using_annotation`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* Server Component, `composer require server --dev`

# Command Console

* `php bin/console debug:router`

# Basic Routing

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton 02_Basic_Routing_Using_annotation
```

2. In the next step we will access the project folder using:

```bash
cd 01_Basic_Routing_Using_annotation
```

3. To work easly, we need install the **server component** of **Symfony** for its, we will launch the console command:

```bash
composer require server -dev
```

4. Now, you can view the result of demo when write in the terminal the console command:

```bash
php bin/console server:run
```

5. First, install the annotations package:

```bash
composer require annotations
```

6. After, we will created the **homepage**, this is a **static page** that no need information, then we will have not to send info for the routing. 

Now, we will can created our controller, [src/controller/HomeController.php](src/controller/HomeController.php), and its **method index** (`public function index(){}`) which will be this:

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
    /**
     *
     * @Route("/", name="index")
     */    
    public function index() {
        return new Response('<h1>News Daily Mirror !</h1>');
    }
}
```

This routing points to the `index` method located in the `HomeController` controller, [src/controller/HomeController.php](src/controller/HomeController.php).

**Note**: It is very important, if we are using the **object Response** we must use the next line `use Symfony\Component\HttpFoundation\Response;` in the **controller**.

7. Now you can launch the server by typing the console command `php bin / cosnole server: run` and see the results of the page in [http://127.0.0.1:8000](http://127.0.0.1:8000).

8. Now, we will modified the method index into [src/controller/HomeController.php](src/controller/HomeController.php), for can use **variable** in our routing.

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

The **routing system** offers much more interesting possibilities than those of the previous section. Many routes contain one or more variables, also called **placeholders**. In this example we will created the next routing:

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
    /**
     *
     * @Route("/news/{section}", name="viewSection")
     */       
    public function viewSection($section) {
        $view_page = '<h1>News about '.$section.'</h1><br>'.
        '<a href="/">return home</a>';
        return new Response($view_page);
    }
}
```

10. Now you can launch the server by typing the console command `php bin / cosnole server: run` and see the results of the page in [http://127.0.0.1:8000](http://127.0.0.1:8000).