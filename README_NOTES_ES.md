SYMFONY 4
=========

INDICE
------

1. [Requisitos Previos](#1requisitos-previos)
    1. [Instalación del Servidor Local](#11instalación-del-servidor-local)
        1. [Configurar php.ini](#111configurar-phpini)
    2. [Instalación de Composer](#12instalación-de-composer)
2. [Iniciando el proyecto](#2iniciando-el-proyecto)
    1. [Instalar Nuevo Proyecto](#21instalar-nuevo-proyecto)
    2. [Añadir un sistema de repositorios Git al proyecto](#22añadir-un-sistema-de-repositorios-git-al-proyecto)
3. [Primeros Pasos Symfony 4](#3primeros-pasos-symfony-4)
    1. [Añadir nueva página a la ruta](#31añadir-nueva-página-a-la-ruta)
    2. [Crear un nuevo Controlador PHP](#32crear-un-nuevo-controlador-php)
    3. [Anotaciones](#33anotaciones)
4. [Crear Primera Página Symfony 4](#4crear-primera-página-symfony-4)
5. [Routing](#5routing)
    1. [Variables obligatorias y opcionales](#51variables-obligatorias-y-opcionales)
    2. [Argumentos del controlador](#52argumentos-del-controlador)
    3. [Añadir Requisitos](#53añadir-requisitos)
    4. [Listar las rutas](#54listar-las-rutas)
    5. [Rutas Avanzadas](#55rutas-avanzadas)
        1. [Ejemplo de Ruta Avanzada Mediante Anotación](#511ejemplo-de-ruta-avanzada-mediante-anotación)
        2. [Ejemplo Ruta Avanzada Mediante YAML](#552ejemplo-ruta-avanzada-mediante-yaml)
        3. [Ejemplo Avanzado de Enrutamiento](#553ejemplo-avanzado-de-enrutamiento)
        4. [Referencias Externas de Rutas](#554referencias-externas-de-rutas)
    6. [Routing Distribuido](#56routing-distribuido)
6. [Controller](#6controller)
    1. [Parámetros de la Ruta](#61parámetros-de-la-ruta)
    2. [Request como argumento del controlador](#62request-como-argumento-del-controlador)
    3. [Redirigiendo](#63redirigiendo)
    4. [Reenviando](#64reenviando)
    5. [Procesando Plantillas](#65procesando-plantillas)
    6. [Accediendo a otros servicios](#66accediendo-a-otros-servicios)
    7. [Error 404](#67error-404)
    8. [Sesión](#68sesión)
    9. [Mensajes Flash](#69mensajes-flash)
    10. [Objeto Response](#610objeto-response)
    11. [Objeto Request](#611objeto-request)
7. [Persistencia](#7persistencia)
    1. [¿Qué es Doctrine?](#71qué-es-doctrine)
    2. [Instalación y Configuración](#72instalación-y-configuración)
        1. [Instalación](#721instalación)
        2. [Configuración](#722configuración)
    3. [Ejemplo Sencillo](#73ejemplo-sencillo)
        1. [Configuración de la base de datos como UTF-8](#731configuración-de-la-base-de-datos-como-utf-8)
        2. [Configuración del Tipo de Mapeo de las Entidades (Anotación o yaml)](#732configuración-del-tipo-de-mapeo-de-las-entidades-anotación-o-yaml)
        3. [Creando una clase Entity](#733creando-una-clase-entity)
        4. [Añadiendo información al mapeo](#734añadiendo-información-al-mapeo)
            1. [Ejemplo con Anotaciones, no recomendable](#7341ejemplo-con-anotaciones-no-recomendable)
            2. [Ejemplo con YAML, recomendable](#7342ejemplo-con-yaml-recomendable)
        5. [Generando Setters y Getters](#735generando-setters-y-getters)
        6. [Creando tablas en la Base de datos](#736creando-tablas-en-la-base-de-datos)
            1. [Alternativa](#7361alternativa)
        7. [Persistencia en la Base de datos](#737persistencia-en-la-base-de-datos)
    4. [Buscando Objetos](#74buscando-objetos)
        1. [Buscando Objetos, DQL](#741buscando-objetos-dql)
        2. [Repositorios](#742repositorios)
            1. [Anotación](#7421anotación)
            2. [Yaml](#7422yaml)
            3. [Repository](#7423repository)
            4. [Controlador y Routing](#7424controlador-y-routing)
    5. [Actualizando un Objeto](#75actualizando-un-objeto)
    6. [Eliminando un Objeto](#76eliminando-un-objeto)
    7. [Relaciones y asociaciones de Entidades](#77relaciones-y-asociaciones-de-entidades)
        1. [Mapeando Relaciones](#771mapeando-relaciones)
    8. [Lifecycle Callbacks](#76lifecycle-callbacks)
    9. [Tipos de datos](#77tipos-de-datos)<br>

----------------------------------------------------------------------------------------------------------

[EXTRAS](#extras)<br>
[Gramática](#gramática)<br>
[Routing](#routing)<br>
[Controller](#controller)<br>

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

# 1.Requisitos Previos

1. **Servidor local, APACHE**
2. **PHP**
3. **Composer** 
4. **IDE o editor de Texto**

<table>
    <td>
        <tr>
        	<strong>NOTA IMPORTANTE</strong> : Asegúrese de estar usando PHP 7.1, para ello. Para ello la instalación de composer debió realizarse sobre <strong>PHP 7.1.</strong>. Si no se realizó así o se duda, desinstalar y reinstalar nuevamente.
        </td>
    </tr>
</table>

## 1.1.Instalación del Servidor Local

* Empezando a instalar un servidor local en [WAMP](http://www.wampserver.com/en/).
* Descargamos el instalable desde su página web. Según la versión de vuestro Windows, seleccionaremos una u otra opción.
* Ejecutamos el instalador. Selecciona la carpeta de instalación (normalmente [c:/wamp64/](c:/wamp64/)).
* Para iniciar el [WAMP](http://www.wampserver.com/en/), podemos hacerlo desde el menú de Inicio -> Todos los programas -> WampServer -> Start WampServer. 

Seguramente os aparezca un aviso de seguridad. Podéis decir que Sí, y se abrirá el programa. Podréis comprobar que se ejecuta correctamente al ver en la parte derecha de la barra de inicio, un icono con una W mayúscula. La cual aparecerá primero en rojo, pasará a naranja y finalmente se quedará en verde. Eso significa que todos los servicios se han iniciado correctamente.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 1.1.1.Configurar php.ini

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 1.2.Instalación de Composer

Para la instalación en Windows descargaremos [Composer](https://getcomposer.org/download/) del enlace y lo instalaremos siguiendo los pasos que se indiquen.

Para comprobar su correcta instalación es mejor que cerreis el terminal si lo tenéis abierto, lo volváis a ejecutar y pongais lo siguiente en el terminal:

```bash 
composer -v
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

# 2.Iniciando el proyecto

## 2.1.Instalar Nuevo Proyecto

Para instalar un nuevo proyecto ejecutaremos dentro de la consola el comando:

* `composer create-project symfony/skeleton Symfony-4-Test` para una instalación básica, se recomienda esta instalación por su ligereza.
* `composer create-project symfony/website-skeleton Symfony-4-Test` si queremos una instalación completa.

En nuestro caso al querer una instalación básica ejecutaremos el comando:

```bash
composer create-project symfony/skeleton my-project
```

A continuación, instalaremos el **componente server** dentro de la carpeta del proyecto. Usaremos el comando `cd Symfony-4-Test`, para acceder a la carpeta dónde se instaló, y ejecutaremos el comando `composer require server --dev` para instalarlo.

Finalmente lanzamos `php bin/console server:run` para iniciar el servidor.

### Sistema de lanzamiento del servidor alternativo

Otra forma de lanzar nuestro proyecto, sin utilizar el **componente server**, es lanzar dentro de la carpeta del proyecto el comando 

```bash
php -S 127.0.0.1:8000 -t public
```

Ahora podremos probar nuestra aplicación básica haciendo click en ​[http://127.0.0.1:8000](http://127.0.0.1:8000)

![](readme/captures/01-test_fristPage.jpg)


----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------


## 2.2.Añadir un sistema de repositorios Git al proyecto

**Git** es un software de control de versiones diseñado por Linus Torvalds, pensando en la eficiencia y la confiabilidad del mantenimiento de versiones de aplicaciones cuando éstas tienen un gran número de archivos de código fuente. Su propósito es llevar registro de los cambios en archivos de computadora y coordinar el trabajo que varias personas realizan sobre archivos compartidos.
Al principio, Git se pensó como un motor de bajo nivel sobre el cual otros pudieran escribir la interfaz de usuario o front end como Cogito o StGIT. Sin embargo, Git se ha convertido desde entonces en un sistema de control de versiones con funcionalidad plena. Hay algunos proyectos de mucha relevancia que ya usan Git, en particular, el grupo de programación del núcleo Linux.
El mantenimiento del software Git está actualmente supervisado por Junio Hamano, quien recibe contribuciones al código de alrededor de 280 programadores.

Para Windows tendremos que descargar el instalador desde la página web: [https://github.com/git-for-windows/git/releases/tag/v2.16.1.windows.4](https://github.com/git-for-windows/git/releases/tag/v2.16.1.windows.4)

```bash
git status
git add .
```

Una vez tengamos la cuenta lo que tendremos que hacer es acceder desde la consola de comandos a la carpeta de nuestro proyecto y allí configuraremos Git con el correo con el que hayamos creado la cuenta de Git.
Luego crearemos el primer **commit**, el **repositorio remoto** y subiremos todos los **archivos** a la rama principal.

```bash
git config user.email "tuemaul@dominio.com"
git commit -m "Commit inicial"
git remote add Symfony https://github.com/HecFranco/Symfony-4-Test.git
git push Symfony master
```

o modificando el archivo [/.git/config](/.git/config)

_[/.git/config](/.git/config)_

```diff
[core]
	repositoryformatversion = 0
	filemode = true
	bare = false
	logallrefupdates = true
++[user]
++	email = hector.franco.aceituno@gmail.com
++[remote "Symfony"]
++	url = https://github.com/HecFranco/Symfony-4-Test.git
++	fetch = +refs/heads/*:refs/remotes/Symfony/*
```

Una vez hayamos realizado algún cambio en nuestro repositorio local indicaremos que queremos añadir todos los archivos a Git mediante **add** .
Lo siguiente será hacer el **commit** añadiendo un mensaje explicando lo que se ha realizado.
Por último haremos un **push** para subir todos los cambios a la rama principal.

```bash
git add .
git commit -m "Primer Commit"
git push Symfony-4-Test master
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

---------------------------------------------------------------------------------------------------------- 

# 3.Primeros Pasos Symfony 4

En este tema nos vamos a centrar en conocer cómo funciona la estructura de Symfony, como están estructurados los proyectos y sus diferentes carpetas, el patrón **MVC (Model, View, Controller)** también conocido como modelo vista controlador. Este patrón nos ayudará a tener una estructura más limpia y ordenada así como conseguir una abstracción entre unas capas y otras.

En la segunda mitad del tema veremos la forma de **crear nuevas páginas** en nuestra aplicación así como las distintas **anotaciones** que podemos usar y su funcionalidad.

Si abrimos la carpeta del proyecto podremos encontrar la siguiente estructura de carpetas que a su vez está dividida en otras subcarpetas, esta es una estructura predefinida de Symfony pero si queremos podemos adaptarla a nuestras necesidades.
* **bin:** en este directorio reside el ejecutable de consola, que nos vale  para invocar las utilidades del cliente desde nuestro terminal.
* **config:** en este directorio podemos configurar las rutas, los servicios  y los bundles.
* **public:** aquí guardamos los archivos web.
* **src:** nos servirá para poner el código fuente de la aplicación.
    * **Controller:** en esta carpeta añadiremos los archivos de los  controladores.
* **var:** es el directorio temporal, aquí se almacenan los archivos de caché, log, sesión, etc.
    * **cache:** donde almacenamos los archivos de caché.
    * **log:**log: donde pondremos los archivos de log.
* **vendor:** contiene las librerías externas que utilicemos así como el core de Symfony, es el directorio que utiliza Composer para mantener las
 dependencias.
    * **psr:** librerías de php.
    * **composer:** core de Composer.
    * **symfony:** core de Symfony.

### Estructura de Archivos

<pre>
	my-project 
	|-bin/
	|	|-console
	|-config/
	|	|-bundles.php
	|	|-packages/
	|	|-routes.yml
	|	|-services.yaml
	|-public/
	|	|-index.php
	|-src/
	|	|-Controller/
	|	|-Kernel.php
	|-symfony.lock
</pre>

A la hora de crear una nueva página en nuestra web tenemos que realizar dos cosas:
* Añadir nueva página a la **ruta:** tenemos un archivo llamado routes.yaml donde se indican todas las rutas de nuestra web (a donde podemos navegar).
* Crear un nuevo **controlador** php: este controlador tendrá lo que va a mostrar la nueva página.

Cuando lo tengamos podremos ver los cambios en: **[http://localhost:8000/](http://localhost:8000/)**

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

---------------------------------------------------------------------------------------------------------- 

## 3.1.Añadir nueva página a la ruta

El archivo **routes.yaml** podemos encontrarlo en la ruta **/config/routes.yaml**, una vez dentro indicaremos la nueva ruta y el path (lo que tendremos que poner en la url para acceder a esta página).
Si ponemos ‘/’ estamos indicando que sea la ruta por defecto, la página principal de nuestra aplicación

_[/config/routes.yaml](/config/routes.yaml)_

```yml
# config/routes.yaml
# the "app_frist_index" route name is not important yet
frist_page:
    # ruta por defecto
    path: /
    controller: App\Controller\TestFristController::fristPage
frist_page_print_variable:
    # ruta definida
    path: /test-frist-page
    controller: App\Controller\TestFristController::fristPageNumber
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

---------------------------------------------------------------------------------------------------------- 

## 3.2.Crear un nuevo Controlador PHP

La siguiente y última parte será crear el Controlador encargado de mostrar los datos de la nueva página, dentro de la clase crearemos un método que ha sido el que hemos indicado que se va a ejecutar en la ruta (inicio).

_[/src/Controller/TestFristController.php](/src/Controller/TestFristController.php)_

```php
<?php
// src/Controller/TestFristController.php
/* Indicamos el namespace del Bundle                     ******************************************************/
    namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
    use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
/**************************************************************************************************************/
class TestFristController {
/* MÉTODO INICIO **********************************************************************************************/
    public function fristPage() {
        return new Response('Mi primera pagina en Symfony!');
    }    
/* MÉTODO NUMBER **********************************************************************************************/
    public function fristPageNumber() {
        $number = mt_rand(0, 100);
        return new Response(
            '<html><body>Frist number: '.$number.'</body></html>'
        );
    }
/**************************************************************************************************************/
}
```

Cuando lo tengamos podremos ver los cambios en: 

**[http://localhost:8000/](http://localhost:8000/)**

![Test_Frist_Controller_Frist_Page](readme/captures/Test_Frist_Controller_Frist_Page.jpg)

**[http://localhost:8000/frist-page](http://localhost:8000/test-frist-page)**

![Test_Frist_Controller_Frist_Page_Number](readme/captures/Test_Frist_Controller_Frist_Page_Number.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

---------------------------------------------------------------------------------------------------------- 

## 3.3.Anotaciones

Las anotaciones son pequeños textos que nos permiten indicar ciertas configuraciones o datos que la aplicación puede leer e interpretar cuando se ejecuta.

Se ponen mediante `@` y hay muchos tipos distintos:

* **@Route**, Con esta anotación podemos especificar la ruta sin necesidad de añadirla a [/config/routes.yaml](/config/routes.yaml). Si usamos el ejemplo anterior con la anotación **@Route** simplemente tendríamos que indicar lo siguiente:

```php
<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class TestFristController {
    /**
     * @Route("/")
     */
    public function inicio() {
        return new Response('Mi primera pagina en Symfony!');
    }
}
```

* **@Inject**, Marca una propiedad o parámetro para **inyectar** como dependencia.

```php
<?php
use JMS\DiExtraBundle\Annotation\Inject;
class Controller {
    /**
     * @Inject
     */
    private $session;
}
```

* **@InjectParams**, Esta marca los **parámetros de un método** para inyección de dependencias.


```php
<?php
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
/**
 * @Service
 */
class Listener {
    /**
     * @InjectParams({
     * "em" = @Inject("doctrine.entity_manager")
     * })
     */
    public function __construct(EntityManager $em, Session $session) {
        // ...
    }
}
```

* **@Service**, Marca una clase como un **Servicio**.

```php
<?php
use JMS\DiExtraBundle\Annotation\Service;
/**
 * @Service("some.service.id", parent="another.service.id", public=false)
 */
class Listener {
}
```

* **@Tag**, Añade una etiqueta al **Servicio**

```php
<?php
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
/**
 * @Service
 * @Tag("doctrine.event_listener", attributes = {"event" = "postGenerateSchema", lazy=true})
 */
class Listener {
    // ...
}
```

* **@Observe**, Automáticamente registra un método como **escucha** de un determinado evento.

```php
<?php
use JMS\DiExtraBundle\Annotation\Observe;
use JMS\DiExtraBundle\Annotation\Service;
/**
 * @Service
 */
class RequestListener {
    /**
     * @Observe("kernel.request", priority = 255)
     */
    public function onKernelRequest() {
        // ...
    }
}

```

* **@Validator**, Automáticamente registra la clase como **restricción de validación** para el componente Validador.


```php
<?php
use JMS\DiExtraBundle\Annotation\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
/**
 * @Validator("my_alias")
 */
class MyValidator extends ConstraintValidator {
}
class MyConstraint extends Constraint {
    public function validatedBy() {
        return 'my_alias';
    }
}
```

* **@FormType**, Automáticamente registra la clase suministrada como un tipo form en el componente Form de Symfony.

```php
<?php
use JMS\DiExtraBundle\Annotation\FormType;
use Symfony\Component\Form\AbstractType;
/**
 * @FormType
 */
class MyFormType extends AbstractType {
    // ...
    public function getName() {
        return 'my_form';
    }
}
// Controller.php
$form = $this->formFactory->create('my_form');

```

* **@DoctrineListener** o **@DoctrineMongoDBListener**,Automáticamente, registra la clase dada como un escucha para el ORM de Doctrine o el ODM del MongoDB de Doctrine.

```php
<?php
use JMS\DiExtraBundle\Annotation\DoctrineListener;
/**
 * @DoctrineListener(
 * events = {"prePersist", "preUpdate"},
 * connection = "default",
 * lazy = true,
 * priority = 0,
 * )
 * /
class MyListener {
    // ...
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

---------------------------------------------------------------------------------------------------------- 

# 4.Crear Primera Página Symfony 4

(Fuente: [page_creation.html](https://symfony.com/doc/current/page_creation.html), documentación oficial)

<table>
    <td>
        <tr>
            <strong>NOTA IMPORTANTE</strong> : Si queremos usar el motor de plantillas <strong>TWIG</strong> será necesario previamente instalarlo, mediante el siguiente comando de consola: 
            <div class="highlight highlight-source-shell">
                <pre>composer require twig</pre>
            </div>
            Este creará una nueva carpeta llamada <strong>/templates</strong>, dónde se alojarán las plantillas <strong>TWIG</strong>.
            Además es necesario que el controlador extendienda de <strong>Controller</strong> base.
        </td>
    </tr>
</table>

**Estructura de Archivos**

<pre>
my-project 
    |-bin/
    |	|-console
    |-config/
    |	|-bundles.php
    |	|-packages/
    |	|-routes.yml
    |	|-services.yaml
    |-public/
    |	|-index.php
    |-src/
    |	|-Controller/
    |	|-Kernel.php
    |-templates/
    |-var/
    |	|-cache/  
    |	|-log/             
    |-symfony.lock
</pre>

_[/config/routes.yaml](/config/routes.yaml)_

```yml
# the "frist_page" route name is not important yet
frist_page:
    # ruta por defecto
    path: /
    controller: App\Controller\TestFristController::fristPage
frist_page_print_variable:
    # ruta definida
    path: /test-frist-page
    controller: App\Controller\TestFristController::fristPageNumber
frist_page_print_with_Twig:
    # ruta definida
    path: /test-frist-with-Twig
    controller: App\Controller\TestFristController::fristPageNumberUsingTwig     
```

_[/src/Controller/TestFristController.php](/src/Controller/TestFristController.php)_

```php
<?php
// src/Controller/FristController.php
/* Indicamos el namespace del Bundle                     ******************************************************/
    namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
    use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;       // Permite extender el controlador
    // Para usar Twig es necesario extender el controlador
/**************************************************************************************************************/
class TestFristController extends Controller{
/* MÉTODO INICIO **********************************************************************************************/
    public function fristPage() {
        return new Response('Mi primera pagina en Symfony!');
    }    
/* MÉTODO NUMBER **********************************************************************************************/
    public function fristPageNumber() {
        $number = mt_rand(0, 100);
        return new Response(
            '<html><body>Frist number: '.$number.'</body></html>'
        );
    }
/**************************************************************************************************************/
/* MÉTODO NUMBER USING TWIG ***********************************************************************************/
    // Para usar TWIG necesitamos extender el controlador.
    public function fristPageNumberUsingTwig() {
        $number = mt_rand(0, 100);
        // templates/test/number.html.twig
        return $this->render('test/testNumber.html.twig', array(
            'number' => $number,
        ));
    }
/**************************************************************************************************************/
}
```

Para utilizar **TWIG** es necesario instalar previamente su componente, para ello lanzar el comando consola `composer require twig`.

_[/templates/test/testNumber.html.twig](/templates/test/testNumber.html.twig)_

```twig
{# templates/test/testNumber.html.twig #}
<h1>Your frist number is {{ number }}</h1>
```

Cuando lo tengamos podremos ver los cambios en: **[http://localhost:8000/test-frist-with-Twig](http://localhost:8000/test-frist-with-Twig)**

![Test_Frist_Controller_Frist_Page_Number_Using_Twig](readme/captures/Test_Frist_Controller_Frist_Page_Number_Using_Twig.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

---------------------------------------------------------------------------------------------------------- 

# 5.Routing

El sistema de enrutamiento ofrece unas posibilidades mucho más interesantes que las de la sección anterior. Muchas rutas contienen una o más variables, también llamados **placeholders**:

_[/config/routes.yaml](/config/routes.yaml)_

```yml
example_routing_with_variable:
    path: /example-with-variable/{slug}
    controller: App\Controller\TestRoutingController::showRoutingWithVariable
```

_[/src/Controller/TestRoutingController.php](/src/Controller/TestRoutingController.php)_

```php
//..
/* MÉTODO CONTROLADOR CON VARIABLE ****************************************************************************/
    public function showRoutingWithVariable($slug) {
        return new Response('Ejemplo de routing con valor de variable $slug: '.$slug);
    }
/**************************************************************************************************************/

//..
```

El patrón de esta ruta se cumple para cualquier URL que empiece por **/example-with-variable/** y después contenga cualquier valor. Ese valor variable se almacena en una variable llamada **slug** (sin las llaves { y }) y se pasa al controlador.

En otras palabras, si la URL es **/example-with-variable/hello_world**, el controlador dispone de una variable **$slug** cuyo valor es **hello_world**. Esta variable es la que utilizará por ejemplo el controlador para buscar en la base de datos el artículo solicitado.

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-with-variable/hello_world](http://127.0.0.1:8000/example-with-variable/hello_world)**

![Test_Routing_Controller_show_Routing_With_Variable](readme/captures/Test_Routing_Controller_show_Routing_With_Variable.jpg)

Si pruebas a acceder a la URL **/example-with-variable**, verás que Symfony no ejecuta el controlador de esta ruta. El motivo es que por defecto todas las variables de las rutas deben tener un valor. La solución consiste en asignar un valor por defecto a determinadas variables de la ruta mediante el array defaults.

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-with-variable](http://127.0.0.1:8000/example-with-variable)**

![Test_Routing_Controller_show_Routing_With_Variable_Error](readme/captures/Test_Routing_Controller_show_Routing_With_Variable_Error.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

---------------------------------------------------------------------------------------------------------- 

## 5.1.Variables obligatorias y opcionales

Para añadir una nueva ruta llamada **example_routing_with_variable_required_optional** que muestra un listado de todos los elementos que tengamos.

Si necesitamos que esta ruta sea compatible con la paginación, por ejemplo la URL **/examplewithvariableRequiredOptional/2** muestra la segunda página de los artículos, tendremos que crear la ruta para que incluya una nueva variable llamada **{page}**:

_[/config/routes.yaml](/config/routes.yaml)_

```yml
example_routing_with_variable_required_optional:
    path: /example-with-variable-Required-Optional/{page}
    controller:  App\Controller\TestRoutingController::showRoutingWithVariableRequiredOptional
```

Al igual que la variable **{slug}** del ejemplo anterior, el valor asociado a **{page}** ahora estará disponible dentro del controlador. Así que ya podemos utilizar su valor para saber qué artículos debes mostrar en una determinada página.

El problema es que, como por defecto las variables de las rutas son obligatorias, esta ruta ya no funciona cuando un usuario solicita la URL **/example-with-variable-Required-Optional**. Así que para ver la primera página, el usuario tendrás que utilizar la URL **/example-with-variable-Required-Optional/1**. 

Obligar al usuario a recordar que siempre debe entrar en la primera página es ridículo. Así que vamos a modificar la ruta para que la variable **{page}** sea opcional. Para ello, asigna un valor por defecto a la variable dentro del array defaults:

_[/config/routes.yaml](/config/routes.yaml)_

```yml
example_routing_with_variable_required_optional:
    path: /example-with-variable-Required-Optional/{page}
    controller:  App\Controller\TestRoutingController::showRoutingWithVariableRequiredOptional
    defaults:
        page: 1 
```

_[/src/Controller/TestRoutingController.php](/src/Controller/TestRoutingController.php)_

```php
//..
/* MÉTODO CONTROLADOR CON VARIABLE OPCIONAL *******************************************************************/
    public function showRoutingWithVariableRequiredOptional($page) {
        return new Response('Ejemplo de routing con valor de variable $page: '.$page);
    }
/**************************************************************************************************************/
//..
```

Como la variable page ya dispone de un valor por defecto dentro de defaults, ya no es necesario indicarla siempre en la URL. Así que cuando el usuario solicite la URL **/example-with-variable-Required-Optional**, esta ruta sí que se ejecutará y se asignará automáticamente el valor 1 a la variable page. Si se solicita la URL **/example-with-variable-Required-Optional/2**, la ruta también se ejecuta y el valor de la variable page será 2, tal y como se indica en la propia ruta. 

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-with-variable-Required-Optional](http://127.0.0.1:8000/example-with-variable-Required-Optional)**

![Test_Routing_Controller_show_Routing_With_Variable_Required_Optional](readme/captures/Test_Routing_Controller_show_Routing_With_Variable_Required_Optional.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 5.2.Argumentos del controlador

Las variables o parámetros de la ruta (por ejemplo, **{slug}**) son muy importantes porque están disponibles como argumentos del método del controlador:

```php
public function showAction($slug) {
    // ...
}
```

En realidad, todas las variables del array defaults se combinan con las variables de la ruta para formar un solo array. Cada clave de ese array conjunto está disponible como un argumento del controlador.En otras palabras, por cada argumento de tu método controlador, Symfony busca una variable de ruta con ese nombre y asigna su valor a ese argumento.

En el ejemplo avanzado anterior, cualquier combinación de las siguientes variables (y en cualquier orden) se podría utilizar como argumentos para el método **showAction()**:

* **$_locale**
* **$year**
* **$title**
* **$_format**
* **$_controller**

Se combinan las variables con los valores definidos en defaults, el controlador tiene a su disposición incluso variables como **$_controller**.
Veremos estas variables en profundidad más adelante en este tema

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 5.3.Añadir Requisitos

Podemos unificar la etiqueta **@Route** y **$slug** para hacerlo todo en un único controlador de forma que no tengamos que modificar routes.yield.
Para crear rutas dinámicas de esta forma tendremos que añadir $slug a la etiqueta:

```php
/**
 * @Route("/ejemplo/{slug}")
 */
public function mostrar($slug) {
    return new Response(sprintf('Mi artículo en mi pagina de deportes: ruta %s', $slug));
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 5.4.Listar las rutas

Llegará un momento en el que tendremos una aplicación muy grande y no sabemos muy bien cuántas rutas tendremos, podemos averiguarlo desde la consola de comandos ejecutando el siguiente comando:

```bash
php bin/console debug:router
```

En la consola nos aparecerá algo como lo siguiente:

![console_routing_list](readme/captures/console_routing_list.jpg)

**Otros comandos**

Para obtener toda la información sobre una única ruta, añade el nombre de esa ruta como argumento del comando anterior:

```bash
 php bin/console debug:router frist_page
 ```
Se mostrará en la consola toda la información de la siguiente forma:

![console_routing_debug](readme/captures/console_routing_debug.jpg)

De la misma forma, para comprobar si una determinada URL cumple con las condiciones de una ruta, puedes utilizar el comando **router_match**:

```bash
php bin/console router:match /frist_page
```

Se mostrará en la consola toda la información de la siguiente forma:

![console_routing_match](readme/captures/console_routing_match.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 5.5.Rutas Avanzadas

Podemos crear rutas complejas que solo se muestran si ocurren determinadas cosas como puede ser que la página esté en un idioma determinado, un formato concreto, etc. 
Entre los **parámetros** tenemos algunos especiales que pueden ser:
* **_controller**: este parámetro se usa para determinar qué controlador se ejecuta cuando se accede a la ruta.
* **_format**: se usa para especificar el formato de la petición.
* **_fragment**: se usa para indicar el identificador del fragment, la parte opcional de una URL que comienza con #.
* **_locale**: sirve para indicar el país en la petición.
Para indicar los elementos requeridos en la ruta usamos la variable **requirements**, también podemos poner valores por defecto mediante la variable **defaults**.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 5.1.1.Ejemplo de Ruta Avanzada Mediante Anotación

_[/src/Controller/TestRoutingController.php](/src/Controller/TestRoutingController.php)_ (enrutamos usando .yml)

```php
/**
 * @Route(
 * "/ejemplo/{_language}/{date}/{section}/{team}/{page}",
 * defaults={"slug": "1","_format":"html","page":"1"},
 * requirements={
 * "_language": "es|en",
 * "_format": "html|json|xml",
 * "date": "[\d+]{8}",
 * "page"="\d+"
 * }
 * )
 */
public function showRoutingAdvanced($_language, $date, $section, $team, $page) {
    return new Response(sprintf(
        'Listado de noticias en idioma=%s, fecha=%s,deporte=%s,equipo=%s, página=%s ', $_language, $date, $section, $team, $page));
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 5.5.2.EJEMPLO RUTA AVANZADA MEDIANTE YAML

_[/config/routes.yaml](/config/routes.yaml)_ (enrutamos usando .yml)

```yml
# config/routes.yaml
example_routing_advanced:
    path: /example-routing-advanced/{_language}/{date}/{section}/{page}/{team}.{_format}
    controller: App\Controller\TestRoutingController::showRoutingAdvanced
    defaults:
        _format: html
    requirements:
        _idioma: en|fr
        _format: html|rss
        fecha: ([\d+]){8}
        pagina: \d+ 
```

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-routing-advanced/en/20180808/eco/2/valencia.html](http://127.0.0.1:8000/example-routing-advanced/en/20180808/eco/2/valencia.html)**

![Test_Routing_Controller_show_Routing_Advanced](readme/captures/Test_Routing_Controller_show_Routing_Advanced.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 5.5.3.Ejemplo Avanzado de Enrutamiento

(fuente: [routing.html](https://symfony.com/doc/current/routing.html))

```yml
# config/routes.yaml
article_show:
  path:     /articles/{_locale}/{year}/{slug}.{_format}
  controller: App\Controller\ArticleController::show
  defaults:
      _format: html
  requirements:
      _locale:  en|fr
      _format:  html|rss
      year:     \d+
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 5.5.4.Referencias Externas de Rutas

(fuente: [external_resources.html](https://symfony.com/doc/current/routing/external_resources.html))

```yml
      # config/routes.yaml
app_file:
    # carga rutas desde el archivo de enrutamiento dado almacenado en algún bundle
    resource: '@AcmeOtherBundle/Resources/config/routing.yml'

app_annotations:
    # carga rutas desde las anotaciones PHP de los controladores encontrados en ese directorio
    resource: '../src/Controller/'
    type:     annotation

app_directory:
    # carga rutas desde los archivos YAML o XML encontrados en ese directorio
    resource: '../legacy/routing/'
    type:     directory

app_bundle:
    # carga rutas desde los archivos YAML o XML encontrados en algún directorio de paquetes
    resource: '@AppBundle/Resources/config/routing/public/'
    type:     directory
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 5.6.Routing Distribuido

_[/config/routes.yaml](/config/routes.yaml)_

```yml
# ...
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
example_routing_distributed:
   # loads routes from the given routing file stored in some bundle
   resource: '..\src\Resources\config\routing.yaml' 
   type: yaml
```

_[/src/Resources/config/routing.yaml](/src/Resources/config/routing.yaml)_

```yml
###############################################################################################################
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
example_routing_distributed_level_1:
    path:     /test-advanced-route-1/
    controller: App\Controller\TestRoutingController::testAdvancedRouteLevel1
###############################################################################################################
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
example_routing_distributed_level_2:
    # loads routes from the given routing file stored in some bundle
    resource: 'routing\public\' 
    type: directory
###############################################################################################################  
```

_[/src/Resources/config/routing/public/routing_test.yaml](/src/Resources/config/routing/public/routing_test.yaml)_

```yml
###############################################################################################################
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
example_routing_distributed_level_3:
    path:     /test-advanced-route-2
    controller: App\Controller\TestRoutingController::testAdvancedRouteLevel2
###############################################################################################################
```

_[/src/Controller/TestRoutingController.php](/src/Controller/TestRoutingController.php)_

```php
//..
    public function testAdvancedRoute1() {
        return new Response('Ejemplo de ruta avanzada 1');
    } 
    public function test_advancedRoute2() {
        return new Response('Ejemplo de ruta avanzada 2');
    }     
//..
```

Cuando lo tengamos podremos ver los cambios en: 

**[http://127.0.0.1:8000/test-advanced-route-1](http://127.0.0.1:8000/test-advanced-route-1)**

![Test_Routing_Controller_test_advanced_Route1](readme/captures/Test_Routing_Controller_test_advanced_Route1.jpg)

**[http://127.0.0.1:8000/test-advanced-route-2](http://127.0.0.1:8000/test-advanced-route-2)**

![Test_Routing_Controller_test_advanced_Route2](readme/captures/Test_Routing_Controller_test_advanced_Route2.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

# 6.Controller

(fuente:  [controller.html](https://symfony.com/doc/current/controller.html))

Un controlador es una función PHP que crea y lee información del objeto Request, crea y devuelve el objeto Response. La respuesta podría ser una página HTML, JSON, XML, descargar archivos, redirigir, error 404 o cualquier otra cosa que pueda soñar. El controlador ejecuta cualquier lógica arbitraria que su aplicación necesite para representar el contenido de una página.

```php
use Symfony\Component\HttpFoundation\Response;
public function hello() {
 return new Response('Hola mundo');
}
```

Contenido muy importante (REVISAR)

El objetivo de un **controller** es siempre el mismo: crear y devolver un objeto `Response`. En el proceso puedes leer información del request, cargar una base de datos, enviar un email, o establecer información de la sesión de usuario. Pero en todos los casos el controller eventualmente devolverá un objeto `Response`, que se enviará al cliente. Podemos tener diferentes procesos utilizando un controller:

* El controller A prepara un objeto `Response` representando el contenido de la página principal del sitio.
* El controller B lee el parámetro `slug` del request para cargar una entrada de blog de la base de datos y crea un objeto `Response` mostrando la entrada. Si el slug no se encuentra en la base de datos, crea y devuelve un objeto `Response` con un **código de estado 404**.
* El controller C administra la **sumisión** de un formulario de contacto. Lee la información del formulario del request, guarda la información de contacto en la base de datos y envía un email al administrador con la información. Finalmente, crea un objeto `Response` y redirige al navegador a la página que indiquemos.

Cada petición manejada por un proyecto Symfony pasa por el mismo **ciclo de vida** básico. La plataforma se encarga de todas las tareas repetitivas iniciales y después, pasa la ejecución al controlador, que contiene el código personalizado de tu aplicación:

1. Cada petición es manejada por un **único** archivo controlador frontal el cual es responsable de iniciar la aplicación.
2. El sistema de enrutamiento (clase `Routing`) lee la información de la petición (por ejemplo, la URI), encuentra una ruta que coincida con esa información, y lee el parámetro `_controller` de la ruta.
3. Se ejecuta el controlador asignado a la ruta y este controlador crea y devuelve un objeto `Response`.
4. Las cabeceras **HTTP** y el contenido del objeto `Response` se envían de vuelta al cliente.

A pesar de que un controlador puede ser cualquier código ejecutable **PHP** (una función, un método en un objeto o un Closure), en Symfony un controlador suele ser un método dentro de un objeto de tipo controlador. Los controladores también se conocen como acciones.

_[/src/Controller/TestControllerController.php](/src/Controller/TestControllerController.php)_

```php
<?php
// src/Controller/ControllerController.php
namespace App\Controller;
// Permite usar el método response, genera una respuesta que se mostrará en pantalla que contiene código html.
    use Symfony\Component\HttpFoundation\Response;
// Permite utilizar el enrutamiento mediante Anotación
    use Symfony\Component\Routing\Annotation\Route;
/****************************************************************************************************************/
class TestControllerController {
//...
/* MÉTODO CONTROLLER ********************************************************************************************/
    public function showControllerWithVariable($slug) {
        return new Response('Ejemplo de controller con valor de variable $slug: '.$slug);
    } 
/**************************************************************************************************************/
}
```

El nuevo controlador devuelve una página HTML simple. Para poder probar realmente esta página en tu navegador, debes crear una ruta cuyo path sea la **URI** que quieres asociar al controlador:

_[/config/routes.yaml](/config/routes.yaml)_

```yml
###############################################################################################################
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
example_controller_with_variable:
    path: /example-controller-with-variable/{slug}
    controller: App\Controller\TestControllerController::showControllerWithVariable
###############################################################################################################
```

Ahora, al acceder a la URI **/example-controller-with-variable/hello_world** se ejecuta el controlador **TestControllerController::showControllerWithVariable** y se pasa el valor **hello_world** como una variable llamada **$slug**. De nuevo, crear una página significa simplemente que debes crear un método controlador y una ruta asociada.

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-controller-with-variable/hello_world](http://127.0.0.1:8000/example-controller-with-variable/hello_world)**

![Test_Controller_Controller_show_Controller_With_Variable_Default](readme/captures/Test_Controller_Controller_show_Controller_With_Variable_Default.jpg)

Observa la sintaxis utilizada para referirse al controlador: **TestControllerController::showControllerWithVariable**. Symfony utiliza esta notación corta para referirse a los controladores. Se trata de la sintaxis recomendada y le dice a Symfony que busque una clase controlador llamada **TestControllerController** y que después ejecute el método **showControllerWithVariable()**.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.1.Parámetros de la Ruta

Como ya se explicó anteriormente, el valor **ControllerController::showControllerWithVariable** del parámetro **controller: App\Controller\ControllerController::showControllerWithVariable** se refiere al método **showControllerWithVariable()**, ubicado dentro de **src/Controller**. Lo más interesante son los argumentos que se pasan a ese método:

_[/config/routes.yaml](/config/routes.yaml)_

```yml
###############################################################################################################
# Importante en los archivos con extensión .yaml cada sangrado equivale a 4 espacios!!!
example_controller_with_variable:
    path: /example-controller-with-variable/{slug}
    controller: App\Controller\TestControllerController::showControllerWithVariable
```

_[/src/Controller/TestControllerController.php](/src/Controller/TestControllerController.php)_

```php
<?php
// src/Controller/TestController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class TestControllerController extends Controller {
/* MÉTODO ROUTING ********************************************************************************************/
    public function showRoutingExample_1($slug) {
        return new Response('Ejemplo de Controlador con valor de variable $slug: '.$slug);
    }
}
```

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-controller-with-variable/hello_world](http://127.0.0.1:8000/example-controller-with-variable/hello_world)**

![Test_Controller_Controller_show_Controller_With_Variable](readme/captures/Test_Controller_Controller_show_Controller_With_Variable.jpg)

El controlador anterior tiene un solo argumento, llamado **$slug**, cuyo valor corresponde al parámetro **{slug}** de la ruta asociada (este valor es **hello_world** en nuestro ejemplo). De hecho, cuando ejecutas tu controlador, Symfony asocia cada argumento del controlador con un parámetro de la ruta. Considera el siguiente ejemplo:

_[/config/routes.yaml](/config/routes.yaml)_

```yml
# // config/routing.yml
example_controller_with_variable_default:
    path: example-controller-with-variable-default/{fristName}/{lastName}
    controller: App\Controller\TestControllerController::showControllerWithVariableDefault
    defaults:
        color: green 
```

Ahora el controlador admite varios argumentos:

_[/src/Controller/TestControllerController.php](/src/Controller/TestControllerController.php)_

```php
public function showControllerWithVariableDefault($fristName, $lastName, $color) {
    return new Response('Ejemplo de controlador con tres variables, dos por ruta: '.$fristName.' y '.$lastName.', y una por defecto '.$color);
}
```

Las variables **{fristName}** y **{lastName}** de la ruta se llaman placeholders, ya que **"guardan el sitio"** para que cualquier valor sustituya esta variable. Por otra parte, la variable **{color}** es una variable de tipo default, ya que su valor siempre está definido para todas las rutas.

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez](http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez)**

![Test_Controller_Controller_show_Controller_With_Variable_Default](readme/captures/Test_Controller_Controller_show_Controller_With_Variable_Default.jpg)

Independientemente del tipo de variable, los valores de **{first_name}**, **{last_name}** y **{color}** están disponibles en el controlador. Cuando se ejecuta una ruta, tanto los placeholders como las variables por defecto se fusionan en un único array que se pasa al controlador.

Asociar parámetros de la ruta a los argumentos del controlador es bastante **fácil** y **flexible**. Pero debes tener en cuenta las siguientes pautas mientras desarrollas.

Symfony es capaz de asociar los nombres de los parámetros de la ruta con los nombres de las variables en la declaración del método controlador. En otras palabras, se da cuenta de que el parámetro **{lastName}** coincide con el argumento **$lastName**.

Así que puedes cambiar el **orden** de los argumentos como quieras y todo seguirá funcionando bien:

_[/src/Controller/ControllerController.php](/src/Controller/ControllerController.php)_

```php
//public function showControllerWithVariableDefault($fristName, $lastName, $color) {
public function showControllerWithVariableDefault($lastName, $color, $firstName) {
    return new Response('Ejemplo de controlador con tres variables, dos por ruta: '.$fristName.' y '.$lastName.', y una por defecto '.$color);
}
```

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez](http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez)**

![Test_Controller_Controller_show_Controller_With_Variable_Default](readme/captures/Test_Controller_Controller_show_Controller_With_Variable_Default.jpg)

El siguiente código producirá una excepción de tipo **RuntimeException** porque no hay ningún parámetro foo definido en la ruta:

_[/src/Controller/TestControllerController.php](/src/Controller/TestControllerController.php)_

```php
public function showControllerWithVariableDefault($firstName, $lastName, $color, $foo) {
    // ...
}
```

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez](http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez)**

![Test_Controller_Controller_show_Controller_With_Variable_Default_error](readme/captures/Test_Controller_Controller_show_Controller_With_Variable_Default_error.jpg)

Sin embargo, es perfectamente válido hacer que el argumento sea opcional. El siguiente ejemplo no lanzará una excepción:

_[/src/Controller/TestControllerController.php](/src/Controller/TestControllerController.php)_

```php
public function showControllerWithVariableDefault($firstName, $lastName, $color, $foo = 1) {
    // ...
}
```

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez](http://127.0.0.1:8000/example-controller-with-variable-default/Luis/sanchez)**

![Test_Controller_Controller_show_Controller_With_Variable_Default](readme/captures/Test_Controller_Controller_show_Controller_With_Variable_Default.jpg)

No todos los parámetros de la ruta deben ser argumentos en tu controlador. Si por ejemplo, **lastName** no es tan importante para tu controlador, lo puedes omitir por completo:

_[/src/Controller/TestControllerController.php](/src/Controller/TestControllerController.php)_

```php
public function indexAction($firstName, $color) {
    // ...
}
```

Todas las rutas incluyen además un parámetro especial llamado **_route**, que guarda el nombre de la propia ruta (en este ejemplo, hello). Normalmente no se utiliza, pero también está disponible como argumento del controlador.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.2.Request como argumento del controlador

Suele ser muy útil disponer en el controlador del objeto **Request** asociado a la petición del usuario, especialmente cuando trabajas con formularios. Para hacer que **Symfony** pase este objeto automáticamente como argumento del controlador, utiliza el siguiente código:

_[/src/Controller/TestControllerController.php](/src/Controller/TestControllerController.php)_

```php
/* Indicamos el namespace del Bundle                     ******************************************************/
    namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
    use Symfony\Component\HttpFoundation\Request;
/**************************************************************************************************************/
class TestControllerController {
/* MÉTODO UPDATE **********************************************************************************************/
    public function update(Request $request) {
        $form = $this->createForm(...);
        $form->handleRequest($request);
        // ...
    }
```

Symfony proporciona una clase **Controller base**, que contiene varias utilidades para las tareas más comunes de los controladores y también incluye un acceso a cualquier otro recurso que necesite la clase del controlador. Para acceder a todos estos métodos útiles, haz que la clase que contiene tus acciones herede de la clase **Controller**.

Para ello, añade la siguiente instrucción use al principio de tu clase controlador y luego modifica la declaración de **TestControllerController** para extenderla:

_[/src/Controller/TestControllerController.php](/src/Controller/TestControllerController.php)_

```php
/* Indicamos el namespace del Bundle                     ******************************************************/
	namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;       // Permite extender el controlador
    use Symfony\Component\HttpFoundation\Response;                   // Permite usar la variables Request 
/**************************************************************************************************************/
class TestControllerController extends Controller {
/**************************************************************************************************************/
    public function showRoutingExample_1($slug) {
        return new Response('Ejemplo de routing con valor de variable $slug: '.$slug);
    }
/**************************************************************************************************************/
}
```

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/ejemplo_1/hello_world](http://127.0.0.1:8000/ejemplo_1/hello_world)**

![TestController_showRoutingExample_1](readme/captures/TestController_showRoutingExample_1.jpg)

Este cambio no afecta al funcionamiento del **controlador**. En la siguiente sección, se explican los **helpers** o métodos útiles que la clase base del controlador pone a tu disposición. Estos métodos sólo son atajos para utilizar más fácilmente las funcionalidades del núcleo de Symfony. Una buena manera de aprender en la práctica esas funcionalidades del núcleo es ver el código fuente de esa clase base en el archivo **Symfony\Bundle\FrameworkBundle\Controller\Controller**.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------
 
## 6.3.Redirigiendo

(fuente: [controller.html, Redirecting](https://symfony.com/doc/current/controller.html#redirecting))

Aunque un controlador puede hacer prácticamente cualquier cosa, la mayoría de los controladores siempre se encargan de las mismas tareas básicas. Estas tareas, tales como **redirigir** a otra página, **procesar plantillas** y acceder a **servicios básicos**, son muy fáciles de manejar en Symfony.

Si deseas redirigir al usuario a otra página, utiliza el método **redirect()** para redirigir a una página externa:

```php
use Symfony\Component\HttpFoundation\RedirectResponse;

public function exampleControllerRedirectExternalUrl() {
    // Redirigimos a una url externa
    return $this->redirect('http://symfony.com/doc');
}
```

El método `generateUrl()` es sólo una función auxiliar que genera la URL de una determinada ruta. Para más información, consulta el capítulo de enrutamiento. 

```php
use Symfony\Component\HttpFoundation\RedirectResponse;

public function exampleControllerRedirectInternalUrl() {
    // El método generateUrl () es solo un método auxiliar que genera la URL para una ruta determinada:
    $url = $this->generateUrl('example_routing_1', array('slug' => 10));
    return $this->redirectToRoute($url);
}
```

Por defecto, el método `redirectToRoute()` produce una redirección temporal de tipo 302. Para realizar una redirección permanente de tipo 301, modifica el segundo argumento:

```php
use Symfony\Component\HttpFoundation\RedirectResponse;

public function example_controller_redirect_2() {
    // does a permanent - 301 redirect
    return $this->redirectToRoute('homepage', array(), 301);
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.4.Reenviando

También resulta sencillo realizar redirecciones internas hacia otro controlador de la aplicación mediante el método forward(). En lugar de redirigir el navegador del usuario, se hace una nueva petición interna y se ejecuta el controlador especificado. El método `forward()` devuelve el objeto `Response` generado por el segundo controlador:

```php
public function indexAction($name) {
    $response = $this->forward('Hello:fancy', array(
        'name' => $name,
        'color' => 'green'
    ));
    // Puedes seguir modificando la respuesta o devolverla directamente
    return $response;
}
```

Ten en cuenta que el método `forward()` utiliza la notación corta habitual para indicar el controlador que se ejecuta. En este caso, la clase controlador de destino será `HelloController`. El array que se pasa como segundo parámetro del método se convierte en los argumentos utilizados en el controlador resultante.
Esta misma sintaxis se utiliza para ejecutar controladores directamente desde las plantillas, tal y como se explicará más adelante. El método del controlador destino debe tener un aspecto como el siguiente:

```php
public function fancyAction($name, $color) {
    // ... crea y devuelve un objeto Response
}
```

Como sucede con los argumentos de los controladores y las rutas, el orden de los argumentos para `fancyAction` no tiene la menor importancia. Symfony asocia las claves del array (por ejemplo, name) con el nombre del argumento del método (por ejemplo, `$name`). Si cambias el orden de los argumentos, Symfony continúa pasando el valor correcto a cada variable.

Al igual que otros métodos de la clase `base Controller`, el método forward sólo es un atajo de la funcionalidad del núcleo de Symfony. Puedes realizar un forward duplicando la petición actual y ejecutándola mediante el servicio `http_kernel`, que devuelve un objeto de tipo `Response`.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.5.Procesando Plantillas

Aunque no es obligatorio, la mayoría de los controladores acaban su ejecución renderizando una plantilla para generar el código **HTML** que se devuelve al usuario.
El método `renderView()` procesa una plantilla y devuelve su contenido renderizado. Así que puedes usar fácilmente una plantilla para generar el contenido del objeto `Response`:

```php
    use Symfony\Component\HttpFoundation\Response;
    //..........
    $content = $this->renderView('Hello:index.html.twig', array('name' => $name));
    return new Response($content);
```

Si lo prefieres, también dispones del método `render()` para hacer lo anterior en un solo paso, ya que crea un objeto Response y le añade como contenido el resultado de renderizar la plantilla:

```php
    return $this->render('Hello:index.html.twig', array('name' => $name) );
```

En ambos casos, la notación utilizada indica que se renderizará la plantilla que se encuentra en el archivo `Resources/views/Hello/index.html.twig`.
El motor de plantillas de Symfony se explica con gran detalle en el capítulo dedicado a las plantillas.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.6.Accediendo a otros servicios

Al extender la clase base del controlador, puedes acceder a cualquier servicio de Symfony a través del método `get()`. Estos son algunos de los servicios comunes que puedes necesitar:

```php
$templating = $this->get('templating');
$router = $this->get('router');
$mailer = $this->get('mailer');
```
Symfony dispones de infinidad de servicios ya creados, pero también puedes definir tus propios servicios. Para listar todos los servicios disponibles, utiliza el comando `container:debug` en la consola:

```bash 
php bin/console container:debug
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.7.Error 404

Cuando no se encuentra un recurso, el protocolo **HTTP** indica que debes devolver un error con código de **estado 404**. Para ello, debes lanzar en tu código una excepción especial. Si estás extendiendo la clase base del controlador, haz lo siguiente:

```php
public function indexAction() {
    $product = // Recupera el objeto desde la base de datos
    if (!$product) {
        throw $this->createNotFoundException('El producto solicitado no existe.');
    }
    return $this->render(...);
}
```

El método `createNotFoundException()` crea un objeto especial de tipo `NotFoundHttpException`, que a su vez genera una respuesta de tipo **404** en el interior de Symfony.
Obviamente puedes lanzar cualquier tipo de excepción en tu controlador. Symfony convierte automáticamente las excepciones en respuestas **HTTP** con código de **error 500**.

```php
throw new \Exception('Algo no ha salido bien.');
```

En ambos casos, el usuario final ve una página de error normal y a los desarrolladores se les muestra una página de error con mucha información de debug o depuración (siempre que utilices el entorno de ejecución de desarrollo).

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.8.Sesión

Symfony incluye un objeto de sesión que permite almacenar información **persistente** sobre el usuario, es decir, información que se guarda de una petición a otra. Por defecto Symfony almacena la información en una cookie usando las sesiones nativas de **PHP**.
Desde cualquier controlador resulta sencillo **almacenar** y **recuperar** información de la sesión, esta información se mantendrá asociada al usuario mientras no caduque su sesión.

```php
use Symfony\Component\HttpFoundation\Request;
public function indexAction(Request $request) {
    $session = $request->getSession();
    $session->set('foo', 'bar');
    $foo = $session->get('foo');
    $filters = $session->get('filters', array());
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.9.Mensajes Flash

Este tipo de mensajes se utilizan para almacenar una **pequeña cantidad de información** que solo está disponible durante la siguiente petición (después se borran automáticamente). Estos mensajes son muy útiles cuando procesas por ejemplo un formulario:

```php
use Symfony\Component\HttpFoundation\Request;
public function updateAction(Request $request) {
$form = $this->createForm(...);
$form->handleRequest($request);
if ($form->isValid()) {
$this->get('session')->getFlashBag()->add(
'Notice', 'Se han guardado los cambios.'
);
return $this->redirect($this->generateUrl(...));
}
return $this->render(...);
}
```

Después de procesar la petición, el controlador crea un mensaje **flash** llamado notice y luego redirige al usuario a otra página. El nombre del propio mensaje (notice en este caso) no tiene importancia, ya que solo es un identificador único que utilizas en tu código.
En la plantilla asociada a la siguiente petición, puedes mostrar (si quieres) el contenido de ese mensaje utilizando el siguiente código:


```twig
{% for flashMessage in app.session.flashbag.get('notice') %}
    <div class="flash-notice">
        {{ flashMessage }}
    </div>
{% endfor %}
```

Recuerda que los mensajes **flash** solo están disponibles durante la siguiente petición **después de haber sido creados**. Tanto si muestras su contenido como si lo ignoras, el mensaje flash se borra automáticamente después de esa petición. El objetivo de estos mensajes es mostrar algún aviso después de una redirección, tal y como se ha mostrado en el ejemplo anterior.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.10.Objeto Response

El único requisito para un controlador es que devuelva un objeto de tipo **Response**. La clase **Symfony\Component\HttpFoundation\Response** es una abstracción en **PHP** de la verdadera respuesta **HTTP** (que está formada por el contenido que se envía al usuario y las cabeceras **HTTP** adecuadas):

```php
// Crea una respuesta simple con un código de estado
// Igual a 200 (el predeterminado)
$response = new Response('Hello '.$name, Response::HTTP_OK);
// Crea una respuesta JSON con código de estado 200
$response = new Response(json_encode(array('name' => $name)));
$response->headers->set('Content-Type', 'application/json');
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 6.11.Objeto Request

Además de las variables definidas por la ruta, el controlador tiene acceso directo al objeto **Request**. El motivo es que Symfony inyecta automáticamente el objeto Request si el controlador define un argumento de tipo **Symfony\Component\HttpFoundation\Request** (no importa ni el nombre del argumento ni su posición). Al igual que el objeto **Response**, las cabeceras de la petición se almacenan en un objeto **HeaderBag** y son fácilmente accesibles.:

```php
use Symfony\Component\HttpFoundation\Request;
public function indexAction(Request $request) {
    $request->isXmlHttpRequest();
    $request->getPreferredLanguage(array('en', 'fr'));
    // Obtiene el valor de un parámetro $_GET
    $request->query->get('page');
    // Obtiene el valor de un parámetro $_POST
    $request->request->get('page');
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

# 7.Persistencia

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 7.1.¿Qué es Doctrine?

Una de las tareas más comunes y a la vez más complejas de la programación web consiste en la persistencia de la información en una base de datos. Afortunadamente, Symfony incluye la librería **Doctrine**, que proporciona herramientas para simplificar el **acceso** y **manejo** de la información de la base de datos. En este capítulo aprenderás la filosofía de trabajo de Doctrine y lo fácil que puede ser trabajar con bases de datos.
Doctrine no tiene ninguna relación con Symfony y su uso es totalmente opcional. Este capítulo se centra en el **ORM**, que te permite manejar la información de la base de datos como si fueran objetos de PHP. También puedes realizar consultas SQL directamente, para lo cual tienes que utilizar la librería DBAL de Doctrine en vez del ORM.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 7.2.Instalación y Configuración

### 7.2.1.Instalación

Para instalar Doctrine usamos el siguiente comando:

```bash
composer require doctrine maker
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.2.2.Configuración

La información de conexión de la base de datos se almacena como una variable de entorno llamada `DATABASE_URL`. Para el desarrollo, podemos modificarlo dentro de **.env**:

_[.env](.env)_
```diff
# .env
###> doctrine/doctrine-bundle ###
# Format described at http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# Configure your db driver and server_version in config/packages/doctrine.yaml
# DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
++ DATABASE_URL=mysql://root:@127.0.0.1:3306/symfony_4_test
++ # db_user: root
++ # db_password: 
++ # db_name: symfony_4_test
# to use sqlite:
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/app.db"
###< doctrine/doctrine-bundle ###
```

Esta variable se referencia en la configuración del contenedor de servicio usando `%env(DATABASE_URL)%`:

_[config/packages/doctrine.yaml](config/packages/doctrine.yaml)_
```yaml
# config/packages/doctrine.yaml
doctrine:
    dbal:
        url: '%env(DATABASE_URL)%'
    # ...
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 7.3.Ejemplo Sencillo

La forma más fácil de entender cómo funciona Doctrine consiste en verlo en acción. En esta sección se configura el acceso a la base de datos, se crea un objeto llamado **Product**, se persiste su información en la base de datos y se obtiene de nuevo mediante una consulta.

Ahora que **Doctrine** ya conoce tu base de datos, puedes utilizar el siguiente comando para crearla en el servidor:

```bash
php bin/console doctrine:database:create
```

Ahora tendremos la nueva base de datos ya creada.

![localHost_phpmyadmin_new_database](readme/captures/localHost_phpmyadmin_new_database.jpg)

Uno de los errores más habituales que cometen incluso los programadores más experimentados consiste en no configurar correctamente la codificación de caracteres de la base de datos.

En ocasiones, el problema es que lo configuran bien la primera vez, pero no cada vez que se crea de nuevo la base de datos. Esto sucede mucho cuando se desarrolla la aplicación, ya que es habitual emplear los siguientes comandos para borrar la **base de datos** y **regenerarla** con nueva información:

```bash
php bin/console doctrine:database:drop --force
```

![localHost_phpmyadmin_new_database](readme/captures/localHost_phpmyadmin_new_database.jpg)

```bash
php bin/console doctrine:database:create
```

![localHost_phpmyadmin_new_database](readme/captures/localHost_phpmyadmin_new_database.jpg)

**Doctrine** no permite configurar estos valores por defecto en su archivo de configuración, ya que trata de ser lo más agnóstico posible en lo que se refiere a la configuración del entorno de ejecución.

Así que la solución más sencilla consiste en establecer estos valores por defecto en la propia configuración del servidor de base de datos. Si utilizas MySQL, añade las dos siguientes líneas en su archivo de configuración, que normalmente es **my.cnf**:

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.1.Configuración de la base de datos como UTF-8

_[config/packages/doctrine.yaml](config/packages/doctrine.yaml)_
```yaml
# config/packages/doctrine.yaml
doctrine:
    dbal:
        # configure these for your database server
        driver: 'pdo_mysql'
        server_version: '5.7'
        charset: utf8mb4
        default_table_options:
            charset: utf8mb4
            collate: utf8mb4_unicode_ci
    # ...            
```

Si utilizas **SQLite** como base de datos, configura la ruta del archivo donde se guarda la información de la base de datos:

_[config/packages/doctrine.yaml](config/packages/doctrine.yaml)_
```yaml
# config/packages/doctrine.yaml
doctrine:
    dbal:
        # configure these for your database server
        driver: pdo_sqlite
        path: "%kernel.root_dir%/sqlite.db"
        server_version: '5.7'
        charset: UTF8
        default_table_options:
            charset: utf8mb4
            collate: utf8mb4_unicode_ci
    # ...            
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.2.Configuración del Tipo de Mapeo de las Entidades (Anotación o yaml)

La configuración que designa el Symfony de mapeo por defecto es la de **anotation**. Esta se encuentra definida en [config/packages/doctrine.yaml](config/packages/doctrine.yaml) dónde podremos verla de la siguiente manera:

_[config/packages/doctrine.yaml](config/packages/doctrine.yaml)_
```yaml
# config/packages/doctrine.yaml
        mappings:
            App:
                is_bundle: false
                type: annotation
                dir: '%kernel.project_dir%/src/Entity'
                prefix: 'App\Entity'
                alias: App
```

Para cambiar el sistema de mapeo a **yml** accederemos [config/packages/doctrine.yaml](config/packages/doctrine.yaml) dónde modificaremos la configuración para que quede de la siguiente forma.

_[config/packages/doctrine.yaml](config/packages/doctrine.yaml)_
```yaml
# config/packages/doctrine.yaml
        mappings:
            App:
                is_bundle: false
                # type: annotation
                type: yml
                # dir: '%kernel.project_dir%/src/Entity'
                dir: '%kernel.project_dir%/config/doctrine'
                prefix: 'App\Entity'
                alias: App
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.3.Creando una clase Entity

Esta clase normalmente se llama **"entidad"** o **"entity"**, lo que significa que es una clase muy sencilla que sólo se utiliza para almacenar datos. Aunque se trata de una clase muy básica, cumple su objetivo de representar a los productos de tu aplicación. No obstante, esta clase no se puede guardar en una base de datos es sólo una clase **PHP** simple.

Una vez aprendidos los conceptos fundamentales de **Doctrine**, podrás generar las clases de tipo entidad más fácilmente con el siguiente comando. Una vez ejecutado, Doctrine te hará varias preguntas para generar la entidad de forma interactiva:

```bash
php bin/console make:entity Product
```

A continuación la consola realizará una serie de preguntas sobre la entidad a crear. Posteriormente generará el archivo [src/Repository/ProductRepository.php](src/Repository/ProductRepository.php) y [src/Entity/Product.php](src/Repository/Product.php). De no haber generado [src/Entity/Product.php](src/Repository/Product.php), ejecutaremos:

```bash
php bin/console make:migration
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.4.Añadiendo información al mapeo

Trabajar con **Doctrine** es mucho más interesante que hacerlo directamente con la base de datos. En vez de trabajar con filas y tablas, **Doctrine** te permite guardar y obtener objetos enteros a partir de la información de la base de datos. El truco para que esto funcione consiste en mapear una clase PHP a una tabla de la base de datos y después, mapear las propiedades de la clase PHP a las columnas de esa tabla.

Doctrine simplifica al máximo este proceso, de manera que sólo tienes que añadir algunos metadatos a la clase PHP para configurar cómo se mapean la clase `Product` y sus propiedades. Estos metadatos se pueden configurar en archivos YAML, XML o directamente mediante anotaciones en la propia clase PHP:

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.4.1.Ejemplo con Anotaciones, no recomendable

Mapearemos la entidad [src/Entity/Product.php](src/Entity/Product.php) mediante **Anotación** de la siguiente manera:

_[src/Entity/Product.php](src/Entity/Product.php)_
```php
// src/Entity/Product.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product {
 /**
 * @ORM\Id
 * @ORM\Column(type="integer")
 * @ORM\GeneratedValue(strategy="AUTO")
 */
 protected $id;
 /**
 * @ORM\Column(type="string", length=100)
 */
 protected $name;
 /**
 * @ORM\Column(type="decimal", scale=2)
 */
 protected $price;
 /**
 * @ORM\Column(type="text")
 */
 protected $description;
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.4.2.Ejemplo con YAML, recomendable

Podremos mapear la entidad mediante **yaml** así::

_[config/doctrine/Product.orm.yml](config/doctrine/Product.orm.yml)_
```yaml
# config/doctrine/Product.orm.yml
App\Entity\Product:
    type: entity
    id:
        id:
            type: integer
            generator: { strategy: AUTO }
    fields:
        name:
            type: string
            length: 100
        price:
            type: decimal
            scale: 2
            nullable: true
```

En un mismo bundle no puedes mezclar diferentes formas de definir los metadatos. Si utilizas por ejemplo **YAML** en una entidad, no puedes utilizar anotaciones **PHP** en otras entidades.

El nombre de la tabla es opcional y si lo omites, se genera automáticamente en función del nombre de la clase **PHP**.

Doctrine incluye soporte para una gran variedad de tipos de campo, cada uno con sus propias opciones, tal y como se explicará más adelante en este mismo capítulo.

También puedes consultar la documentación oficial de Doctrine sobre el mapeo. Ten en cuenta que en la documentación de Doctrine no se explica que si utilizas anotaciones, tienes que prefijarlas todas con la cadena ORM\ (por ejemplo, **ORM\**Column(...)). Igualmente, no te olvides de añadir la declaración `use Doctrine\ORM\Mapping as ORM;` al principio de tus clases para importar el prefijo **ORM\**.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.5.Generando Setters y Getters

Doctrine ya sabe cómo persistir los objetos de tipo `Product` en la base de datos, pero esa clase no es muy útil por el momento. Como `Product` es una clase PHP normal y corriente, es necesario crear métodos **getters** y **setters** (`getName()`, `setName()`, etc.) para poder acceder a sus propiedades (porque son de tipo `privated`). Como esto es bastante habitual, desde PhpStorm podemos añadir estos métodos automáticamente:

```bash
PhpStorm -----> Code -> Generate -> Setters y Getters
```

* Generalmente no necesitaremos método setId() ya que no modificaremos el id.

_[src/Entity/Product.php](src/Entity/Product.php)_
```php
<?php
// src/Entity/Product.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
class Product {
    protected $id;
    public function getId() { return $this->id; }    
    protected $name;
    public function getName() { return $this->name; }
    public function setName($name): void { $this->name = $name; }   
    protected $price;
    public function getPrice() { return $this->price; }
    public function setPrice($price): void { $this->price = $price; }
    protected $description;    
    public function getDescription() { return $this->description; }
    public function setDescription($description): void { $this->description = $description; }
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.6.Creando tablas en la Base de datos

Aunque tienes una clase **Product** utilizable con información de mapeo para que **Doctrine** sepa persistirla, todavía no tienes su correspondiente tabla **product** en la base de datos. Afortunadamente, **Doctrine** puede crear automáticamente todas las tablas necesarias en la base de datos (una para cada entidad conocida de tu aplicación). Para ello, ejecuta el siguiente comando:

```bash
php bin/console doctrine:schema:update --force
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

#### 7.3.6.1.Alternativa

La clase Producto ya está configurada y lista para crear la tabla Producto. Para crear la tabla en nuestra base de datos se debe ejecutar el siguiente comando

```bash
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate
```

El primer comando es el encargado de crear el script SQL y el segundo comando es el encargado de buscar el script que se ha generado y ejecutarlo para realizar las acciones en nuestra base de datos.
Si queremos añadir nuevos campos a nuestras clases entidades después es necesario ejecutar de nuevo estos comando para que se realicen las acciones de **actualización** en nuestra base de datos.

![Test_Data_Base_Controller_action_phpmyadmin](readme/captures/Test_Data_Base_Controller_action_phpmyadmin.jpg)

--------------------------------------------------------------------------------------------------------------------------------------------------

Después de ejecutar este comando, la base de datos cuenta ahora con una tabla llamada **product** completamente funcional, y sus columnas coinciden con los metadatos que has especificado en la clase `Product`.

En realidad, este comando es muy poderoso. Internamente compara la estructura que debería tener tu base de datos (según la información de mapeo de tus entidades) con la estructura que realmente tiene y genera las sentencias **SQL** necesarias para actualizar la estructura de la base de datos.

En otras palabras, si añades una nueva propiedad a la clase `Product` y ejecutas este comando otra vez, se genera una sentencia de tipo `ALTER TABLE` para añadir la nueva columna a la tabla **product** existente.

Una forma aún mejor para aprovechar esta funcionalidad son las migraciones, que permiten generar estas instrucciones SQL y almacenarlas en unas clases PHP especiales que puedes ejecutar en tu servidor de producción para aplicar los cambios en las bases de datos.

----------------------------------------------------------------------------------------------------------

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.3.7.Persistencia en la Base de datos

Ahora que tienes mapeada una entidad **Product** y su tabla **product** correspondiente, ya puedes persistir la información en la base de datos. De hecho, persistir información dentro de un controlador es bastante sencillo. Añade el siguiente método al controlador **[TestDataBaseController](src/Controller/TestDataBaseController.php)**:

_[src/Resources/config/routing.yaml](src/Resources/config/routing.yaml)_
```yaml
example_database_insert:
    # loads routes from the given routing file stored in some bundle
    path: /test_database
    controller: App\Controller\TestDataBaseController::create
```

_[src/Controller/TestDataBaseController.php](src/Controller/TestDataBaseController.php)_
```php
<?php
// src/Controller/TestDataBaseController.php
/* Indicamos el namespace del Bundle                     ******************************************************/
namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
	use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;       // Permite extender el controlador
/**************************************************************************************************************/  /* CARGO ENTIDADES A UTILIZAR *********************************************************************************/
	use App\Entity\Product;     // Permite Enrutador
/**************************************************************************************************************/ 
class TestDataBaseController extends Controller{
    public function create() {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
        return new Response('Created product id '.$product->getId());
    }
}
```

Veamos detenidamente cómo funciona el ejemplo anterior:
**Líneas 8-10:** En esta sección, creas una instancia y trabajas con el objeto $product como harías con cualquier otro objeto PHP normal.
**Línea 11:** Esta línea obtiene el **"entity manager"** o gestor de entidades de Doctrine, que se utiliza para persistir y recuperar objetos hacia y desde la base de datos.
**Línea 12:** El método `persist()` le dice a Doctrine que debe persistir el objeto `$product`, pero todavía no se genera (y por tanto, tampoco se ejecuta) la sentencia SQL correspondiente.
**Línea 13:** Cuando se llama al método `flush()`, Doctrine examina todos los objetos que está gestionando para ver si es necesario persistirlos en la base de datos. En este ejemplo, el objeto `$product` aún no se ha persistido, por lo que el gestor de la entidad ejecuta una consulta de tipo **INSERT** y crea una fila en la tabla product.

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/test_database](http://127.0.0.1:8000/test_database)**

![Test_Data_Base_Controller_action](readme/captures/Test_Data_Base_Controller_action.jpg)

![Test_Data_Base_Controller_action_phpmyadmin_with_new_data](readme/captures/Test_Data_Base_Controller_action_phpmyadmin_with_new_data.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 7.4.Buscando Objetos

**Buscar información** de la base de datos y recuperar en forma de objeto es todavía más fácil. Imagina que has configurado una ruta de la aplicación para mostrar la información de un producto a partir del valor de su id. El código del controlador correspondiente podría ser el siguiente:

_[src/Resources/config/routing.yaml](src/Resources/config/routing.yaml)_
```yaml
example_database_fetching:
    # loads routes from the given routing file stored in some bundle
    path: /test_database_fetching/{id}
    controller: App\Controller\TestDataBaseController::show
```

_[src/Controller/TestDataBaseController.php](src/Controller/TestDataBaseController.php)_
```php
<?php
// src/Controller/TestDataBaseController.php
/* Indicamos el namespace del Bundle                     ******************************************************/
namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
	use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;       // Permite extender el controlador
/**************************************************************************************************************/  /* CARGO ENTIDADES A UTILIZAR *********************************************************************************/
	use App\Entity\Product;     // Permite Enrutador
/**************************************************************************************************************/ 
class TestDataBaseController extends Controller{
    // ...
    public function show($id) {
        $em = $this->getDoctrine()->getManager();
        $product_repo = $em->getRepository(Product::class);
        $product = $product_repo->find($id);
        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id );
        }
        var_dump($product->getName());die();
    // ... (pasar el objeto $product a una plantilla)
    }
    // ...
}
```

Al realizar una consulta por un determinado objeto, **Doctrine** siempre utiliza lo que se conoce como **"repositorio"**. Estos **repositorios** son como clases PHP cuyo trabajo consiste en ayudarte a buscar las entidades de una determinada clase. Puedes acceder al repositorio de la entidad de una clase mediante el código:

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/test_database_fetching/1](http://127.0.0.1:8000/test_database_fetching/1)**

![Test_Data_Base_Controller_show](readme/captures/Test_Data_Base_Controller_show.jpg)

```php
$em = $this->getDoctrine();
$product_repo = $em->getRepository(Product::class);
```
La cadena `Product::class` es un atajo que puedes utilizar en cualquier lugar de Doctrine en vez del nombre completo de la clase de la entidad (en este caso, src\Entity\Product). Este atajo funciona siempre que tu entidad se encuentre bajo el espacio de nombres Entity.

Una vez que obtienes el repositorio, tienes acceso a todo tipo de métodos útiles:

```php
// Consulta por la clave principal (generalmente 'id')
$product = $product_repo->find($id);
// Métodos con nombres dinámicos para buscar un valor en función de alguna columna
$product = $product_repo->findOneById($id);
$product = $product_repo->findOneByName('foo');
// Obtiene todos los productos
$products = $product_repo->findAll();
// Busca productos basándose en el valor de una columna
$products = $product_repo->findByPrice(19.99);
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.4.1.Buscando Objetos, DQL

En las secciones anteriores has visto cómo el objeto repositorio te permite realizar **consultas básicas** sin ningún esfuerzo:

```php
$repository->find($id);
$repository->findOneByName('Foo');
```

**Doctrine** también te permite escribir consultas más complejas utilizando el lenguaje de consulta Doctrine o DQL (por sus siglas en inglés, **Doctrine Query Language**). 

**DQL** es bastante similar a SQL, salvo que en este caso estás buscando objetos de una determinada entidad (por ejemplo, Product) en vez de buscar filas de una tabla (por ejemplo, product).

Además, al realizar consultas en Doctrine, tienes **dos opciones**: escribir las consultas enteras a mano o utilizar el generador de consultas de Doctrine.

**Doctrine** también te permite realizar consultas directamente con su lenguaje DQL:

```php
$em = $this->getEntityManager();
$query = $em->createQuery(
    'SELECT p
    FROM App\Entity\Product p
    WHERE p.price > :price
    ORDER BY p.price ASC'
    )->setParameter('price', 10 );
$products = $query->execute();
```

Si te manejas con soltura con SQL, verás que el nuevo lenguaje DQL es una forma muy natural de buscar información. La mayor diferencia es que tienes que pensar en términos de objetos en lugar de filas. Por esta razón, seleccionamos objetos de tipo Product y utilizamos el alias p.
La sintaxis **DQL** es increíblemente poderosa, permitiéndole unir fácilmente diferentes entidades (el tema de las relaciones se explica más adelante), realizar agrupaciones, etc.

Para más información, consulta la documentación oficial de **Doctrine Query Language**:

[http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/dql-doctrine-query-language.html](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/dql-doctrine-query-language.html)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

### 7.4.2.Repositorios

En las secciones anteriores, las consultas se crean y se ejecutan dentro del controlador. Sin embargo, para desacoplar el código, para poder crear tests fácilmente y para reutilizar las consultas, es mejor crear una clase propia de tipo **repositorio** e incluir en ella todos los métodos que necesites para realizar las consultas.

Para ello, añade en la información de **mapeo de la entidad** la ruta de la nueva clase de su repositorio:

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

#### 7.4.2.1.Anotación

```php
// src/Entity/Product.php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Entity\ProductRepository")
 */
class Product {
 //...
}
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

#### 7.4.2.2.Yaml

_[config/doctrine/Product.orm.yml](config/doctrine/Product.orm.yml)_
```yaml
# config/doctrine/Product.orm.yml
App\Entity\Product:
    type: entity
    repositoryClass: App\Repository\ProductRepository
    table: product    
    id:
        id:
            type: integer
            generator: { strategy: AUTO }
    fields:
        name:
            type: string
            length: 100
        price:
            type: decimal
            scale: 2
            nullable: true
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

#### 7.4.2.3.Repository

Doctrine genera el repositorio cuando creamos la entidad, podemos encontrar la clase en **//Repository/ProductRepository**.

A continuación, añade un nuevo método llamado `findAllOrderedByName()` a la clase del repositorio recién generado. Este método busca todas las entidades de tipo Product ordenadas alfabéticamente.

_[src/Repository/ProductRepository.php](src/Repository/ProductRepository.php)_
```php
<?php
// src/Entity/ProductRepository.php
namespace App\Repository;
use Doctrine\ORM\EntityRepository;
class ProductRepository extends EntityRepository {
    public function findAllOrderedByName() {
        return $this->getEntityManager()
        ->createQuery('SELECT p FROM App\Entity\Product p ORDER BY p.name ASC')
        ->getResult();
    }
}
```

Y ahora ya puedes utilizar este nuevo método para realizar la consulta dentro de un controlador de Symfony:

_[src/Controller/TestDataBaseController.php](src/Controller/TestDataBaseController.php)_
```php
$em = $this->getDoctrine()->getManager();
$products = $em->getRepository(Product::class)
 ->findAllOrderedByName();
```

Aunque utilices una clase **repositorio** propia, todavía puedes hacer uso de los métodos de búsqueda predeterminados como `find()` y `findAll()`.


----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

#### 7.4.2.4.Controlador y Routing

_[src/Resources/config/routing.yaml](src/Resources/config/routing.yaml)_
```yaml
example_database_repository:
    path: /test_database_repository_findAllOrderedByName/
    controller: App\Controller\TestDataBaseController::findAllOrderedByName  
```

_[src/Controller/TestDataBaseController.php](src/Controller/TestDataBaseController.php)_
```php
<?php
// src/Controller/TestDataBaseController.php
//...
    public function findAllOrderedByName() {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)
         ->findAllOrderedByName();
        var_dump($products);die();        
    }
//...    
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 7.5.Actualizando un Objeto

Una vez que hayas obtenido un objeto de **Doctrine**, actualizarlo es relativamente fácil. Supongamos que la aplicación dispone de una ruta que actualiza la información del producto cuyo **id** se indica:

_[src/Resources/config/routing.yaml](src/Resources/config/routing.yaml)_
```yaml
example_database_update:
    # loads routes from the given routing file stored in some bundle
    path: /test_database_update/{id}
    controller: App\Controller\TestDataBaseController::update
```

_[src/Controller/TestDataBaseController.php](src/Controller/TestDataBaseController.php)_
```php
<?php
// src/Controller/TestDataBaseController.php
/* Indicamos el namespace del Bundle                     ******************************************************/
namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
	use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;       // Permite extender el controlador
/**************************************************************************************************************/  /* CARGO ENTIDADES A UTILIZAR *********************************************************************************/
	use App\Entity\Product;     // Permite Enrutador
/**************************************************************************************************************/ 
class TestDataBaseController extends Controller{
    // ...
    public function update($id) {
        $em = $this->getDoctrine()->getManager();
        $product_repo = $em->getRepository(Product::class);
        $product = $product_repo->find($id);
        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        $product->setName('New product name!');
        $em->flush();
        return $this->redirectToRoute('example_database_fetching',['id'=>$product->getId()]);
    }
    // ...
}
```

![Test_Data_Base_Controller_action_phpmyadmin_with_new_data](readme/captures/Test_Data_Base_Controller_action_phpmyadmin_with_new_data.jpg)

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/test_database_update/1](http://127.0.0.1:8000/test_database_update/1)**

![Test_Data_Base_Controller_update](readme/captures/Test_Data_Base_Controller_update.jpg)

![Test_Data_Base_Controller_update_phpmyadmin_with_new_production_name](readme/captures/Test_Data_Base_Controller_update_phpmyadmin_with_new_production_name.jpg)

Actualizar un objeto requiere de tres pasos:
* Obtener el objeto utilizando **Doctrine**.
* Modificar el objeto.
* Invocar al método `flush()` del **entity manager**.

Observa que no hace falta llamar al método `$em->persist($product)`. Este método sirve para avisar a Doctrine de que vas a manipular un determinado objeto. En este caso, como el objeto `$product` lo has obtenido mediante una consulta a Doctrine, este ya sabe que debe estar atento a los posibles cambios del objeto.

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 7.6.Eliminando un Objeto

Eliminar objetos es un proceso similar, pero requiere invocar el método remove() del entity manager:

Como puede que imagines, el método `remove()` avisa a **Doctrine** que quieres eliminar esa entidad de la base de datos, pero no la borra realmente. La consulta **DELETE** correspondiente no se genera ni se ejecuta hasta que no se invoca el método `flush()`.

_[src/Resources/config/routing.yaml](src/Resources/config/routing.yaml)_
```yaml
example_database_remove:
    path: /test_database_remove/{id}
    controller: App\Controller\TestDataBaseController::remove
```

_[src/Controller/TestDataBaseController.php](src/Controller/TestDataBaseController.php)_
```php
<?php
// src/Controller/TestDataBaseController.php
/* Indicamos el namespace del Bundle                     ******************************************************/
namespace App\Controller;
/* COMPONENTES BÁSICOS DEL CONTROLADOR ************************************************************************/
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;     // Permite Enrutador
	use Symfony\Component\HttpFoundation\Response;                  // Permite ejecutar Response
	use Symfony\Bundle\FrameworkBundle\Controller\Controller;       // Permite extender el controlador
/**************************************************************************************************************/
/* CARGO ENTIDADES A UTILIZAR *********************************************************************************/
    use App\Entity\Product;     // Permite Enrutador
/**************************************************************************************************************/ 
class TestDataBaseController extends Controller{
    // ...
    public function remove($id) {
        $em = $this->getDoctrine()->getManager();
        $product_repo = $em->getRepository(Product::class);
        $product = $product_repo->find($id);        
        $em->remove($product);
        $em->flush();
        return $this->redirectToRoute('example_database_fetching',['id'=>$product->getId()]);        
    }
    // ...
}
```

![Test_Data_Base_Controller_action_phpmyadmin_with_new_data](readme/captures/Test_Data_Base_Controller_action_phpmyadmin_with_new_data.jpg)

Cuando lo tengamos podremos ver los cambios en: **[http://127.0.0.1:8000/test_database_remove/1](http://127.0.0.1:8000/test_database_remove/1)**

![Test_Data_Base_Controller_update](readme/captures/Test_Data_Base_Controller_update.jpg)

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------


## 7.7.Relaciones y asociaciones de Entidades

Extendiendo el ejemplo de las secciones anteriores, supón que los productos de la aplicación pertenecen a una (y sólo a una) categoría. En este caso, necesitarás un objeto de tipo **Category** y una manera de relacionar un objeto **Product** a un objeto **Category**.

En primer lugar, crea la nueva entidad **Category**. Para ello puedes utilizar el siguiente comando de **Doctrine**:

```bash
php bin/console make:entity Category
```

Esta tarea genera la entidad Category con un campo **id**, añadiremos un campo name y los **getters** y **setters** correspondientes.

### 7.7.1.Mapeando Relaciones

Para relacionar las entidades Category y Product, debes crear en primer lugar una propiedad llamada producto en la clase Category:

```php
// src/Entity/Category.php
// ...
use Doctrine\Common\Collections\ArrayCollection;
class Category {
 /**
 * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category")
 */
 protected $products;
 public function __construct() {
 $this->products = new ArrayCollection();
 }
}
```

Como un objeto **Category** puede estar **relacionado con muchos** objetos de tipo **Product**, se define la propiedad products de tipo array para poder almacenar todos esos objetos **Product**. Una vez más, esto no se hace porque lo necesite Doctrine, sino porque en la aplicación tiene sentido que cada Category almacene un array de objetos **Product**.

El código del método `__construct()` es importante porque **Doctrine** requiere que la propiedad $products sea un objeto de tipo **ArrayCollection**. Este objeto se comporta casi exactamente como un array, pero añade cierta flexibilidad. Si utilizar este objeto te parece raro, imagina que es un array normal y ya está.

A continuación, como cada clase Product se puede relacionar exactamente con un objeto **Category** (y sólo uno), puedes añadir una propiedad **$category** a la clase Product:

```php
// src/Entity/Product.php
// ...
class Product {
 // ...
 /**
 * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
 * @ORM\JoinColumn(nullable=true)
 */
 private $category;
}
```



----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 7.8.Lifecycle Callbacks

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------

## 7.9.Tipos de datos


# EXTRAS

## Gramática

La gramática se define como el estudio de las reglas y principios que estandarizan el uso del lenguaje dentro de la oración.

Si llevamos este término a la programación podríamos entender el concepto de la gramática como las reglas y principios que regulan la escritura del código.

No sólo es el hecho de escribir código como se nos dé la gana, debemos escribir código que sea entendible y ordenado.

No importa cuantas personas haya detrás del código, debe leérse como si una sóla persona lo haya escrito.

### Rotuing

Ver ejemplo siguiente

* **routes file**: En archivos usa snake_case, **`routes_admin.yaml`**
* **routing name**: En nombre de la ruta usa snake_case, **`frist_page`**
* **path**: En nombre de la ruta usa kebab_case, **`/blog/my-post`**

_[/config/routes.yaml](/config/routes.yaml)_

```yml
frist_page:
    # ruta por defecto
    path: /
    controller: App\Controller\FristController::fristPage
```

### Controller

Ver ejemplo siguiente

```php
const myObj = {}
const myNum = 1
const myMap = new Map()
function myFn() {}
```

* En clases y constructores usa **PascalCase** 

```php
class MyClass {}
function MyClass() {}
```

* En constantes usa **UPPER_CASE** 

```php
const MY_CONSTANT = 1
```

----------------------------------------------------------------------------------------------------------

**[⬆ regresar al índice](#indice)**

----------------------------------------------------------------------------------------------------------


DUDAS A RESOLVER
================

* ¿Trabajo con Cookies? ¿Cómo mantener Logueo? ¿Gestionar la caducidad de la conexión?
VARIABLE COOKIES y SESSION
* ¿Bundles o bloques de código reutilizables?
* ¿Event Listener?
* ¿Servicios?
* ¿Doctrine, persistencia comando consola?
* ¿Permisos?
* ¿añadir campos tabla?
