# Purpose of the demonstration - First page

We will make our first page in a **Symfony Project 4** from scratch.

---------------------------------------------------------------------------------------

* We will create the project through the command of the console: `composer create-project symfony/skeleton 03_Frist_Page`

---------------------------------------------------------------------------------------

# Summary of Symfony components to use

* Server Component,`composer require server --dev`

# First page

1. We will create our project using the command of the console:

```bash
composer create-project symfony/skeleton 03_Frist_Page
```

2. In the next step, we will access the project folder using:

```bash
cd 03_Frist_Page
```

3. Next, we will install the symfony server component using the console command:

```bash
composer require server --dev
```

4. We will create an access path using the **yaml** format. For this, we will enter the file **/config/routes.yaml**. Once inside we will indicate the path (what we will have to put in the url to access this page) and the controller [src/Controller/DefaultController.php](src/Controller/DefaultController.php).
If we put `/` we are indicating that it is the default route, the main page of our application.

_[/config/routes.yaml](/config/routes.yaml)_
```yml
# config/routes.yaml
# the "app_frist_index" route name is not important yet
index:
    # default route
    path: /
    controller: App\Controller\DefaultController::index
```

5. Then, we will create the driver [src/Controller/DefaultController.php] (src/Controller/DefaultController.php) in charge of displaying the data of the new page. The controller will have a class called `DefaultController` that will contain the method indicated in the route.

To create the new controller we will execute the console command:

```bash
php bin/console make:controller DefaultController
```

This command will have generated the file [/src/Controller/DefaultController.php](/src/Controller/DefaultController.php).

_[/src/Controller/DefaultController.php](/src/Controller/DefaultController.php)_
```php
<?php
// src/Controller/DefaultController.php
/* We indicate the namespace of the Bundle ********************************************************************/
    namespace App\Controller;
/* BASIC CONTROLLER COMPONENTS ********************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
    use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
/**************************************************************************************************************/
class DefaultController {
/* HOME METHOD ************************************************************************************************/
    public function index() {
        return new Response('Mi primera pagina en Symfony!');
    }
/**************************************************************************************************************/
}
```

4. Now, we must write, to start the server, in the console the command:

```bash
php bin/console server:run
```

5. Finally, you will have to click on the following link [127.0.0.1:8000](127.0.0.1:8000) to see your installation project.
