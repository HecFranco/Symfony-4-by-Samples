# Purpose of the Demo - 04 Webpack Encore with SASS Vue and Bootstrap-Vue

We will do an installation from the beginning where we will include **Webpack Encore**, along with **Sass**, **Vue** and **VueBootstrap** (Vue + Bootstrap 4).

# Phases of the Demo
1. [Project creation and ready](#1project-creation-and-ready)
2. [Installation of **WebPack Encore**](#2installation-of-webpack-encore)
3. [Installation and Configuration of **SASS**](#3installation-and-configuration-of-sass)
4. [Installation and configuration of **Bootstrap-Vue**](#4installation-and-configuration-of-bootstrap-vue)

-------------------------------------------------- -------------------------------------

* We will create the project through the command of the console:`composer create-project symfony/skeleton 04_Webpack_Encore_with_SASS_Vue_and_Vue_Bootstrap`

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

# 04 Webpack Encore with SASS Vue and Bootstrap-Vue

--------------------------------------------------------------------------------------------

## 1.Project Creation and Ready

--------------------------------------------------------------------------------------------

1. We create our project using the commands of the console: 

```bash
composer create-project symfony/skeleton 04_Webpack_Encore_with_SASS_Vue_and_Vue_Bootstrap
```

2. In the next step, we will access the project folder using:

```bash
cd 04_Webpack_Encore_with_SASS_Vue_and_Vue_Bootstrap
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
    <h1>04 Webpack Encore with SASS Vue and VueBootstrap</h1>
    <form class="form-signin">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
    </form>
{% endblock %}
```

**Note**: This template has classes of **Bootstrap 4**.

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
            <link rel="stylesheet" href="{{ asset('build/css/app.css') }}">
        {# add add previous line line ................................................................. #}
        {% block stylesheets %}{% endblock %}
    </head>
    <body>
        {% block body %}{% endblock %}
        {# add next line .............................................................................. #}
            <script src="{{ asset('build/js/app.js') }}"></script>
        {# add add previous line line ................................................................. #}            
        {% block javascripts %}{% endblock %}
    </body>
</html>
```

9. Now, we must install the **Profiler Componente** to use the **toolbar Debug**, and the **server component**, in order to launch our **local server**, through the console commands:

```bash
composer require --dev profiler
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

This component will generate a file [webpack.config.js](webpack.config.js), and add the directories [assets/](assets/) and [node_modules/](node_modules/) to [.gitignore](.gitignore).

--------------------------------------------------------------------------------------------

## 3.Installation and Configuration of **SASS**

--------------------------------------------------------------------------------------------

1. After configuring the compilation process in **Webpack**, so that the system recognizes the result of the compilation process of the static files.

For before, you must add the dependencies that we need when we use **SASS** with the following command.

```bash
npm add sass-loader node-sass --dev
```

2. Next we will configure the file [webpack.config.js](webpack.config.js) with the following directives.

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

To activate **Sass-Loader**, which is the **SASS Reader**, and indicate the location of the inputs and outputs of the components **js** and **css**. Indicating `.addEntry ('js/app', './assets/js/app.js')` for the compilation of **js** and `.addStyleEntry (' css/app ',' ./assets/css/app.scss') `for the **css**.

3. In the next step, we will create our stylesheet [assets/css/app.scss](assets/css/app.scss) using **SASS**. This sheet will be transpiled to **CSS**.

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

4. Next, we add this line `import '../css/app.scss';` in [assets/js/app.js](assets/js/app.js) to be able to compile **Sass** in **css**.

_[assets/js/app.js](assets/js/app.js)_
```js
import '../css/app.scss';
```

5. Now, we can access [http://127.0.0.1:8000](http://127.0.0.1:8000) again expecting to see our changes in the template, but we will find two **404 errors** corresponding to the files [assets/css/app.css](assets/css/app.css) and [assets/js/app.js](assets/js/app.js) that we just included in our base template.

To correct the errors, we must execute the following command that will generate the files from those created in the folders  [assets/css/app.css](assets/css/app.css) and [assets/js/app.js](assets/js/app.js).

```bash
npm run watch
```

**Note:** If we launch a `npm run dev -watch` thread, the system will recognize the changes we make to the files and will regenerate the files that are linked in our template so that the changes are available.

6. Now we can launch the server again using `php bin/console server:run` and access [http://127.0.0.1:8000](http://127.0.0.1:8000) to see the changes referred to in [assets/css/app.scss](assets/css/app.scss).

--------------------------------------------------------------------------------------------

## 4.Installation and configuration of **Bootstrap-Vue**

--------------------------------------------------------------------------------------------

* First it is necessary to install **Vue**, then add the **Bootstrap-Vue** (Bootstrap-4) plugin.

```bash
npm install --save vue
npm i bootstrap-vue
```

2. In the next step, we will modify our stylesheet [assets/css/app.scss](assets/css/app.scss) by importing the **Bootstrap** library. 

_[assets/css/app.scss](assets/css/app.scss)_
```diff
++ @import '~bootstrap/dist/css/bootstrap.css'
++ @import '~bootstrap-vue/dist/bootstrap-vue.css'
$acceVerde: #84a640;
$acceAzul: #396696;
h1 {
    color: $acceVerde;
    s {
        color: $acceAzul;
    }
}
```

**Note**: This sheet will be compiled to **CSS**.

3. Next, we add these lines in [assets/js/app.js](assets/js/app.js).

_[assets/js/app.js](assets/js/app.js)_
```diff
++ import Vue from 'vue'
++ import BootstrapVue from 'bootstrap-vue'
++ Vue.use(BootstrapVue);

import '../css/app.scss';
```

4. Now, we launch **loader-sass** via `npm run watch`, and the **server** `php bin/console server:run` so we can see the results by clicking [http://127.0.0.1:8000](http://127.0.0.1:8000).