# Propósito de la demostración - Primera página

Realizaremos nuestra primera página en un **Proyecto Symfony 4** desde cero.

---------------------------------------------------------------------------------------

* Crearemos el proyecto a través del comando de la consola: `composer create-project symfony/skeleton 03_Frist_Page`

---------------------------------------------------------------------------------------

# Resumen de los componentes de Symfony para usar

* Componente del servidor,`composer require server --dev`

# Primera Página

1. Crearemos nuestro proyecto usando el comando de la consola: 

```bash
composer create-project symfony/skeleton 03_Frist_Page
```

2. En el siguiente paso, vamos a acceder a la carpeta del proyecto usando:

```bash
cd 03_Frist_Page
```

3. Luego, instalaremos el componente del servidor de Symfony usando el comando de la consola:

```bash
composer require server --dev
```

4. Crearemos una ruta de acceso usando el formato **yaml**. Para ello, entraremos al archivo **/config/routes.yaml**. Una vez dentro indicaremos el path (lo que tendremos que poner en la url para acceder a esta página) y el controlador [src/Controller/DefaultController.php](src/Controller/DefaultController.php).
Si ponemos `/`’` estamos indicando que sea la ruta por defecto, la página principal de nuestra aplicación

_[/config/routes.yaml](/config/routes.yaml)_
```yml
# config/routes.yaml
# the "app_frist_index" route name is not important yet
index:
    # ruta por defecto
    path: /
    controller: App\Controller\DefaultController::index
```

5. Después, crearemos el controlador [src/Controller/DefaultController.php](src/Controller/DefaultController.php) encargado de mostrar los datos de la nueva página. El controlador tendrá una clase llamada `DefaultController` que contendrá el método indicado en la ruta.

Para crear el nuevo controlador ejecutaremos el comando de consola:

```bash
php bin/console make:controller DefaultController
```

Este comando habrá generado el archivo [/src/Controller/DefaultController.php](/src/Controller/DefaultController.php).

_[/src/Controller/DefaultController.php](/src/Controller/DefaultController.php)_
```php
<?php
// src/Controller/DefaultController.php
/* Indicamos el namespace del Bundle                     ******************************************************/
    namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
    use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
/**************************************************************************************************************/
class DefaultController {
/* MÉTODO INICIO **********************************************************************************************/
    public function index() {
        return new Response('Mi primera pagina en Symfony!');
    }
/**************************************************************************************************************/
}
```

4. Ahora, debemos escribir, para iniciar el servidor, en la consola el comando:

```bash
php bin/console server:run
```

5. Finalmente, tendrá que hacer clic en el siguiente enlace [http://127.0.0.1:8000](http://127.0.0.1:8000) para ver su proyecto de instalación.