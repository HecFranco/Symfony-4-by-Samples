# Objetivo de la demostración - 03 Webpack Encore with SASS and Bootstrap

Haremos una instalación desde el principio donde incluiremos **Webpack Encore**, junto a **Sass** y **Bootstrap**.

# Fases de la Demo
1. [Creación del proyecto y configuración](#1creación-del-proyecto-y-configuración)
2. [Instalación de **WebPack Encore**](#2instalación-de-webpack-encore)
3. [Instalación y Configuración de **SASS**](#3instalación-y-configuración-de-sass)
4. [Instalación y configuración de **Bootstrap**](#4instalación-y-configuración-de-bootstrap)

-------------------------------------------------- -------------------------------------

* Crearemos el proyecto a través del comando de la consola: `composer create-project symfony/skeleton 03_Webpack_Encore_with_SASS_and_Bootstrap`

---------------------------------------------------------------------------------------

# Resumen de los componentes de Symfony para usar

* Componente del servidor, `composer require server --dev`
* Twig Component, `composer require twig`
* Componente activo, `composer require symfony/asset`
* WebPack Encore, `composer require encore`

# Resumen de los componentes de la Webpack para usar

* Componente Npm.js, `npm install @symfony/webpack-encore --save-dev`
* Componente Npm-Sass y node Sass , `npm add sass-loader node-sass --dev`

# 03 Webpack Encore with SASS

--------------------------------------------------------------------------------------------

## 1.Creación del proyecto y configuración

--------------------------------------------------------------------------------------------

1. Creo nuestro proyecto usando los comandos de la consola: 

```bash
composer create-project symfony/skeleton 03_Webpack_Encore_with_SASS_and_Bootstrap
```

2. En el siguiente paso accederemos a la carpeta del proyecto usando:

```bash
cd 03_Webpack_Encore_with_SASS_and_Bootstrap
```

4. Crearemos el **Controlador**, [src/Controller/DefaultController.php](src/Controller/DefaultController.php), que gestionará la vista con el siguiente contenido.

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

5. Para esta **Demo**, utilizaremos un enrutamiento **yaml**, para ello lo configuramos dentro de [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](config/routes.yaml)_
```yml
# Importante en los archivos con la extensión .yaml cada sangría es igual a 4 espacios !!!!
index:
    path: /
    controller: App\Controller\DefaultController::index
```

6. Para la vista usaremos **Twig**, por lo que instalaremos su componente mediante el siguiente comando:

```bash
composer require twig
```

7. Ahora crearemos nuestra plantilla con **Twig** en [templates/default/index.html.twig](templates/default/index.html.twig).

_[templates/default/index.html.twig](templates/default/index.html.twig)_
```html
{% extends 'base.html.twig' %}
{% block body %}
    <h1 class="text-center" data-toggle="tooltip" data-placement="bottom" title="js de bootstrap funcionando :)" >
        Hello, we are using <s>Sass</s> in our project!
    </h1>    
{% endblock %}
```

**Nota**: Esta plantilla dispone de clases propias de **Bootstrap**.

(Source: [https://symfony.com/doc/current/page_creation.html#rendering-a-template](https://symfony.com/doc/current/page_creation.html#rendering-a-template))

8. Además, instalaremos el **Componente Asset** usando el comando de consola:

```bash
composer require symfony/asset
```

para referenciar las entradas **js** [build/app.js](build/app.js) y **css** [build/app.css](build/app.css).

9. Seguidamente, añadiremos a la plantilla base [templates/base.html.twig](templates/base.html.twig), los enlaces a nuestras entradas **js** y **css**.

_[templates/base.html.twig](templates/base.html.twig)_
```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>{% block title %}Welcome!{% endblock %}</title>
        {# add next line .............................................................................. #}
            <link rel="stylesheet" href="{{ asset('build/app.css') }}">
        {# add add previous line line ................................................................. #}
        {% block stylesheets %}{% endblock %}
    </head>
    <body>
        {% block body %}{% endblock %}
        {# add next line .............................................................................. #}
            <script src="{{ asset('build/app.js') }}"></script>
        {# add add previous line line ................................................................. #}            
        {% block javascripts %}{% endblock %}
    </body>
</html>
```

9. Ahora, debemos instalar el **componente servidor** mediante el comando de consola:

```bash
composer require server --dev
```

Y lanzar el comando de consola:

```bash
php bin/console server:run
```

Para poder ver los resultados, para ello hacemos clic en [http://127.0.0.1:8000](http://127.0.0.1:8000).

--------------------------------------------------------------------------------------------

## 2.Instalación de **WebPack Encore**

--------------------------------------------------------------------------------------------

1. Estamos utilizando **Symfony Flex** para el proyecto, asi que inicializaremos nuestro proyecto para **Webpack Encore** a través de:

```bash
composer require encore
```

2. Antes, es necesario asegurarse de tener instalado **Node.js**.

3. Instalaremos **Npm.js**, mediante el comando:

```bash
npm install @symfony/webpack-encore --save-dev
```

Este componente generará un archivo [webpack.config.js](webpack.config.js), y agregará los directorios [assets/](assets/) y [node_modules/](node_modules/) a [.gitignore](.gitignore).

--------------------------------------------------------------------------------------------

## 3.Instalación y Configuración de **SASS**

--------------------------------------------------------------------------------------------

1. Después debemos configurar el proceso de compilación en **Webpack**, para que el sistema reconozca el resultado del proceso de compilación de los archivos estáticos.

Para antes, debemos agregar las dependencias que necesitaremos cuando usemos **SASS** con el siguiente comando.

```bash
npm add sass-loader node-sass --dev
```

2. Seguidamente configuraremos el archivo [webpack.config.js](webpack.config.js) con las siguientes directivas.

_[webpack.config.js](webpack.config.js)_
```diff
    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
++   .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')
++   .addStyleEntry('css/app', './assets/css/app.scss')
    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()
++    .enableSassLoader()
```

Para activar **SassLoader**, que es el **Lector de SASS**, e indicar la ubicación de las entradas y salidas de los componentes **js** y **css**. Indicando `.addEntry('js/app', './assets/js/app.js')` para la compilación de **js** y `.addStyleEntry('css/app', './assets/css/app.scss')` para el **css**.

3. En el siguiente paso, crearemos nuestra hoja de estilos [assets/css/app.scss](assets/css/app.scss) usando **SASS**. Esta hoja será transpilada a **CSS**.

_[assets/css/app.scss](assets/css/app.scss)_
```scss
$acceVerde: #84a640;
$acceAzul: #396696;
h1 {
    color: $acceVerde;
    s {
        color: $acceAzul;
    }
}
```

4. A continuación, agregamos esta línea `import '../css/app.scss';` en [assets/js/app.js](assets/js/app.js).

_[assets/js/app.js](assets/js/app.js)_
```js
import '../css/app.scss';
```

5. Ahora podemos acceder [http://127.0.0.1:8000](http://127.0.0.1:8000) de nuevo esperando ver nuestros cambios en la plantilla, pero encontraremos dos **errores 404** correspondientes a los archivos [assets/css/app.css](assets/css/app.css) y [assets/js/app.js](assets/js/app.js) que acabamos de incluir en nuestra plantilla base.

Para corregir los errores, debemos ejecutar el siguiente comando que generará los archivos a partir de los que creamos en las carpetas [assets/js/](assets/js/) y [assets/css/](assets/css/).

```bash
npm run watch
```

**Nota:** Si lanzamos un subproceso `npm run dev -watch`, el sistema reconocerá los cambios que realicemos en los archivos y regenerará los archivos que se vinculan en nuestra plantilla para que los cambios estén disponibles.

9. Ahora podremos lanzar el servidor nuevamente y acceder a [http://127.0.0.1:8000](http://127.0.0.1:8000) para ver los cambios referidos en [assets/css/app.scss](assets/css/app.scss).

--------------------------------------------------------------------------------------------

## 4.Instalación y configuración de **Bootstrap**

--------------------------------------------------------------------------------------------

1. Para importar **Bootstrap** en nuestro proyecto solo tendremos que ejecutar.

```bash
npm add jquery
npm add bootstrap-sass --dev
```

2. Adicionalmente en esta demo instalaremos la librería **poppe.js** usando el comando:

```bash
npm add popper.js
```

3. Seguidamente configuraremos el archivo [webpack.config.js](webpack.config.js) con las siguientes directivas. Descomentaremos la siguiente línea del fichero [webpack.config.js](webpack.config.js) para facilitar **jQuery** a **Bootstrap**.

_[webpack.config.js](webpack.config.js)_
```diff
    // uncomment for legacy applications that require $/jQuery as a global variable
    // .autoProvidejQuery()
++ .autoProvidejQuery()
```

4. En el siguiente paso, modificaremos nuestra hoja de estilos [assets/css/app.scss](assets/css/app.scss) importando la librería de **Bootstrap**. **Nota**: Esta hoja será transpilada a **CSS**.

_[assets/css/app.scss](assets/css/app.scss)_
```diff
++ @import '~bootstrap-sass/assets/stylesheets/bootstrap';
$acceVerde: #84a640;
$acceAzul: #396696;
h1 {
    color: $acceVerde;
    s {
        color: $acceAzul;
    }
}
```

5. A continuación, agregamos estas líneas en [assets/js/app.js](assets/js/app.js).

_[assets/js/app.js](assets/js/app.js)_
```diff
++ import $ from 'jquery';
++ import 'bootstrap-sass';
import '../css/app.scss';
++ (function() {
++     $('h1').tooltip()
++ })();
```