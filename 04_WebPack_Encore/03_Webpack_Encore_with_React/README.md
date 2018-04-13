# Purpose of the Demo - 03 Webpack Encore with React

We will do an installation from the beginning where we will include **Webpack Encore**, along with **Sass**, **Vue** and **VueBootstrap** (Vue + Bootstrap 4).

# Phases of the Demo
1. [Project creation and ready](#1project-creation-and-ready)
2. [Installation of **WebPack Encore**](#2installation-of-webpack-encore)
3. [Installation and Configuration of **SASS**](#3installation-and-configuration-of-sass)
4. [Installation and configuration of **Bootstrap-Vue**](#4installation-and-configuration-of-bootstrap-vue)

-------------------------------------------------- -------------------------------------

* We will create the project through the command of the console:`composer create-project symfony/skeleton 03_Webpack_Encore_with_React`

---------------------------------------------------------------------------------------

# Summary of Symfony components to use

* Profiler Component, `composer require --dev profiler`, allows you to view the **Debug toolbar**.
* Server Component, `composer require server --dev`, allows launching the **local server**.
* Twig Component, `composer require twig`
* Asset Component, `composer require symfony/asset`
* WebPack Encore, `composer require encore`

# Summary of the components of the Webpack to use

* Npm.js Component, `npm install @symfony/webpack-encore --save-dev`
* Sass-loader Component, `npm add sass-loader --dev`
* Node Sass Component, `npm add node-sass --dev`
* Vue plugin, `npm install --save vue`
* Bootstrap-Vue, `npm i bootstrap-vue`

# Source

* [https://www.modernjsforphpdevs.com/react-symfony-4-starter-repo/](https://www.modernjsforphpdevs.com/react-symfony-4-starter-repo/)

# 04 Webpack Encore with SASS Vue and Bootstrap-Vue

--------------------------------------------------------------------------------------------

## 1.Project Creation and Ready

--------------------------------------------------------------------------------------------

1. We create our project using the commands of the console: 

```bash
composer create-project symfony/skeleton 03_Webpack_Encore_with_React
```

2. In the next step, we will access the project folder using:

```bash
cd 03_Webpack_Encore_with_React
```

3. We will create the **Controller**, [src/Controller/DefaultController.php](src/Controller/DefaultController.php), which will manage the view with the following content.

_[src/Controller/DefaultController.php](src/Controller/DefaultController.php)_
```php
<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller{
    public function data()
    {
        return new JsonResponse([
            [
                'id' => 1,
                'author' => 'Chris Colborne',
                'avatarUrl' => 'http://1.gravatar.com/avatar/13dbc56733c2cc66fbc698cdb07fec12',
                'title' => 'Bitter Predation',
                'description' => 'Thirteen thin, round towers …',
            ],
            [
                'id' => 2,
                'author' => 'Louanne Perez',
                'avatarUrl' => 'https://randomuser.me/api/portraits/thumb/women/18.jpg',
                'title' => 'Strangers of the Ambitious',
                'description' => "A huge gate with thick metal doors …",
            ],
            [
                'id' => 3,
                'author' => 'Theodorus Dietvorst',
                'avatarUrl' => 'https://randomuser.me/api/portraits/thumb/men/49.jpg',
                'title' => 'Outsiders of the Mysterious',
                'description' => "Plain fields of a type of grass cover …",
            ],
        ]);
    }
}
```

4. For this **Demo**, we will use a **yaml** routing, for this we configure it in [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](config/routes.yaml)_
```yml
index:
    path: /data
    controller: App\Controller\DefaultController::data
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
  <div id="root"></div>
  <script type="text/javascript" src="{{ asset('build/js/app.js') }}"></script>
{% endblock %}
```

**Note**: This template has classes of **Bootstrap 3**.

(Source: [https://symfony.com/doc/current/page_creation.html#rendering-a-template](https://symfony.com/doc/current/page_creation.html#rendering-a-template))

7. How we need to reference the entries, **js** [build/app.js](build/app.js) and **css** [build/app.css](build/app.css), within the template we will install the **Asset Component** using the console command:

```bash
composer require symfony/asset
```

8. Next, we will add to the base template [templates/base.html.twig](templates/base.html.twig), the links to our entries **js** and **css**.

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

9. Now, we must install the **server component**, in order to launch our local server, through the console command:

```bash
composer require server --dev
```

We will launch the **Local Server** using the console command:

```bash
php bin/console server:run
```

In order to see the results, we will click on [http://127.0.0.1:8000](http://127.0.0.1:8000).

--------------------------------------------------------------------------------------------

## 2.Installation of **WebPack Encore**

--------------------------------------------------------------------------------------------

1. We are using **Symfony Flex** for the project, so we will initialize our project for **Webpack Encore** through:

```bash
composer require encore
```

2. Before, you need to make sure you have **Node.js** installed, otherwise you can access [https://nodejs.org/en/](https://nodejs.org/es/) and download it for your installation.

3. Next, we will install **Npm.js**, using the command:

```bash
npm install @symfony/webpack-encore --save-dev
```

This component will generate a file [webpack.config.js](webpack.config.js), and add the directories [assets/](assets/) and [node_modules/](node_modules/) to [.gitignore](.gitignore) .

--------------------------------------------------------------------------------------------

## 3.Installation and Configuration of **React**

--------------------------------------------------------------------------------------------

1. After configuring the compilation process in **Webpack**, so that the system recognizes the result of the compilation process of the static files.

For before, you must add the dependencies that we need when we use **SASS** with the following command.

```bash
npm add --dev babel-preset-react
npm add react react-dom prop-types
```

2. 2. Next we will configure the file [webpack.config.js](webpack.config.js) with the following directives.

_[webpack.config.js](webpack.config.js)_
```diff
var Encore = require('@symfony/webpack-encore');

Encore
  // the project directory where compiled assets will be stored
  .setOutputPath('public/build/')
  // the public path used by the web server to access the previous directory
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .addEntry('app', './assets/js/app.js')
  .enableReactPreset();

module.exports = Encore.getWebpackConfig();
```

#Set up a demo JSON API

