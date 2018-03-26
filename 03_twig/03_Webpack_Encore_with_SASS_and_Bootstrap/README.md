# Purpose of the Demo - 03_Webpack_Encore_with_SASS

We will make an installation from the beginning where we will include the **Webpack Encore** and **Sass**.

---------------------------------------------------------------------------------------

* We will create the project through the console command: `composer create-project symfony/skeleton 03_Webpack_Encore_with_SASS`

---------------------------------------------------------------------------------------

# Summary Symfony component`s to use

* Server Component, `composer require server --dev`
* Twig Component, `composer require twig`
* Asset Component, `composer require symfony/asset`
* WebPack Encore, `composer require encore`

# Summary Webpack component`s to use

* Npm.js Component, `npm install @symfony/webpack-encore --save-dev`
* Npm.js Sass and node Sass Component, `npm add sass-loader node-sass --dev`

# 03_Webpack_Encore_with_SASS

1. Created our project using the Console command's, 

```bash
composer create-project symfony/skeleton 03_Webpack_Encore_with_SASS
```

2. In the next step we will access the project folder using:

```bash
cd 03_Webpack_Encore_with_SASS
```

4. We are using **Flex** for your project, then we initialize our project for Encore via:

```bash
composer require encore
```

5. First, make sure you install **Node.js** and also the **Npm.js**.

```bash
npm install @symfony/webpack-encore --save-dev
```

This will create a [webpack.config.js](webpack.config.js) file, add the [assets/](assets/) directory, and add [node_modules/](node_modules/) to [.gitignore](.gitignore).

6. We will create the file [src/Controller/DefaultController.php](src/Controller/DefaultController.php) with the following content.

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
        //$em = $this->getDoctrine()->getManager();
        return $this->render('default/index.html.twig');
    }
}
```

7. We will use the routing type **yaml**, for them we configure the type of routing in [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](config/routes.yaml)_
```yml
# Important in the files with extension .yaml each bleeding equals 4 spaces!!!!
index:
    path: /
    controller: App\Controller\DefaultController::index
```

8. If you're returning HTML from your controller, you'll probably want to render a template. Fortunately, Symfony comes with Twig: a templating language that's easy, powerful and actually quite fun.

First, install Twig:

```bash
composer require twig
```

Now we will created our template with **Twig** in [templates/default/index.html.twig](templates/default/index.html.twig).

_[templates/default/index.html.twig](templates/default/index.html.twig)_
```html
{% extends 'base.html.twig' %}
{% block body %}
    <h1 class="text-center" data-toggle="tooltip" data-placement="bottom" title="js de bootstrap funcionando :)" >Hello, we are using <s>Sass</s> in our project!</h1>
{% endblock %}
```

(Source: [https://symfony.com/doc/current/page_creation.html#rendering-a-template](https://symfony.com/doc/current/page_creation.html#rendering-a-template))

9. Now, we must install the server component using the console command:

```bash
composer require server --dev
```

And if we launch the console command:

```bash
php bin/console server:run
```

We can see the results if we click on [http://127.0.0.1:8000](http://127.0.0.1:8000).

10. Next step, we created [assets/css/app.scss](assets/css/app.scss).

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

and add this line `import '../css/app.scss';` in [assets/js/app.js](assets/js/app.js).

_[assets/js/app.js](assets/js/app.js)_
```js
import '../css/app.scss';
```

11. Now we must configure the build process in Webpack and modify the base template so that the system recognizes the output of the build process of the static files.

For the first thing we must add the dependencies that we will need when using SASS with the following command.

```bash
npm add sass-loader node-sass --dev
```

12. Now we will configure the file [webpack.config.js](webpack.config.js) with the following directives.

_[webpack.config.js](webpack.config.js)_
```diff
    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
++    .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')
    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()
++    .enableSassLoader()
```

13. We will add to the file [templates/base.html.twig](templates/base.html.twig) the links to our files.

Frist, it is necessary install **Asset Componente** using the command console:

```bash
composer require symfony/asset
```

Now, we can create our **base template**.

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

Now we can access [http://127.0.0.1:8000](http://127.0.0.1:8000) again expecting to see our brand new corporate colors in the message we have written, but we will find two 404 errors corresponding to the [assets/css/app.css](assets/css/app.css) and [assets/js/app.js](assets/js/app.js) files that we just included in our base template.

To correct the errors we must launch the following command that will generate the files from the ones we created in the assets folder.

```bash
npm run watch
```

**Note:** If we launch a thread `npm run dev -watch` the system will be aware of changes that we make in the files and will be regenerating the files that link in our template to have the changes available.

16. Finally you can view the result of demo openning other terminal and writting the command console:

```bash
php bin/console server:run
```

5. Finally, you will have to click on the following link [http://127.0.0.1:8000](http://127.0.0.1:8000) to see your installation project.