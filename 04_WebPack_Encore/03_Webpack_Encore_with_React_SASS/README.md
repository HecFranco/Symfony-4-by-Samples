# Purpose of the Demo - 03 Webpack Encore with React

We will do an installation from the beginning where we will include **Webpack Encore**, along with **React** and **Sass**.

# Phases of the Demo
1. [Project creation and ready](#1project-creation-and-ready)
2. [Installation of **WebPack Encore**](#2installation-of-webpack-encore)
3. [Installation and Configuration of **SASS**](#3installation-and-configuration-of-sass)
4. [Installation and configuration of **React**](#4installation-and-configuration-of-react)
5. [Create our component **React**](#5create-our-component-react)

-------------------------------------------------- -------------------------------------

* We will create the project through the command of the console:`composer create-project symfony/skeleton 03_Webpack_Encore_with_React_and_SASS`

---------------------------------------------------------------------------------------

# Summary of Symfony components to use

* Profiler Component, `composer require --dev profiler`, allows you to view the **Debug toolbar**.
* Server Component, `composer require server --dev`, allows launching the **local server**.
* Twig Component, `composer require twig`
* Asset Component, `composer require symfony/asset`
* WebPack Encore, `composer require encore`

# Summary of the components of the Webpack to use

* Npm.js Component, `npm install @symfony/webpack-encore --save-dev`
* Sass-loader Component, `npm install sass-loader --dev`
* Node Sass Component, `npm install node-sass --dev`
* Babel-preset-react Component, `npm install --dev babel-preset-react`
* React, React-Dom and Prop-types Component, `npm install react react-dom prop-types`

# Source

* [https://www.modernjsforphpdevs.com/react-symfony-4-starter-repo/](https://www.modernjsforphpdevs.com/react-symfony-4-starter-repo/)

# 03 Webpack Encore with React and SASS

--------------------------------------------------------------------------------------------

## 1.Project Creation and Ready

--------------------------------------------------------------------------------------------

1. We create our project using the commands of the console: 

```bash
composer create-project symfony/skeleton 03_Webpack_Encore_with_React_and_SASS
```

2. In the next step, we will access the project folder using:

```bash
cd 03_Webpack_Encore_with_React_and_SASS
```

3. We will create the **Controller**, [src/Controller/DefaultController.php](src/Controller/DefaultController.php), which will manage the view with the following content.

_[src/Controller/DefaultController.php](./src/Controller/DefaultController.php)_
```php
<?php
namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller {
    public function index() {
        return $this->render('Default/index.html.twig', []);
    }
    public function data() {
        return new JsonResponse([
            [
                'id' => 1,
                'author' => 'Chris Colborne',
                'avatarUrl' => 'http://1.gravatar.com/avatar/13dbc56733c2cc66fbc698cdb07fec12',
                'title' => 'Bitter Predation',
                'description' => 'Thirteen thin, round towers form an almost perfectly squared barrier around this marvelous castle and are connected by big, thin walls made of light pink stone. Rough windows are scattered thinly around the walls in fairly symmetrical patterns, along with overhanging crenelations for archers and artillery.',
            ],
            [
                'id' => 2,
                'author' => 'Louanne Perez',
                'avatarUrl' => 'https://randomuser.me/api/portraits/thumb/women/18.jpg',
                'title' => 'Strangers of the Ambitious',
                'description' => "A huge gate with thick metal doors, a regular bridge and large crenelations offers a warm haven within these cold, isolated landsand it's the only way in, at least to those unfamiliar with the castle and its surroundings.",
            ],
            [
                'id' => 3,
                'author' => 'Theodorus Dietvorst',
                'avatarUrl' => 'https://randomuser.me/api/portraits/thumb/men/49.jpg',
                'title' => 'Outsiders of the Mysterious',
                'description' => "Plain fields of a type of grass cover most of the fields outside of the castle, adding to the castle's aesthetics. This castle is relatively new, but so far it stood its ground with ease and it'll likely do so for ages to come.",
            ],
        ]);
    }
}
```

4. For this **Demo**, we will use a **yaml** routing, for this we configure it in [config/routes.yaml](config/routes.yaml).

_[config/routes.yaml](./config/routes.yaml)_
```yml
index:
    path: /
    controller: App\Controller\DefaultController::index
data:
    path: /data
    controller: App\Controller\DefaultController::data
```

5. For the view we will use **Twig**, so we will install your component using the following command:

```bash
composer require twig
```

6. Now, we will create our template with **Twig** in [templates/default/index.html.twig](templates/default/index.html.twig).

_[templates/default/index.html.twig](./templates/default/index.html.twig)_
```html
{% extends 'base.html.twig' %}
{% block body %}
{% endblock %}
```

(Source: [https://symfony.com/doc/current/page_creation.html#rendering-a-template](https://symfony.com/doc/current/page_creation.html#rendering-a-template))

7. How we need to reference the entries, **js** [build/app.js](build/app.js) and **css** [build/app.css](build/app.css), within the template we will install the **Asset Component** using the console command:

```bash
composer require symfony/asset
```

8. Next, we will add to the base template [templates/base.html.twig](templates/base.html.twig), the links to our entries **js** and **css**.

_[templates/base.html.twig](./templates/base.html.twig)_
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

( Source: [https://symfony.com/doc/current/frontend/encore/installation.html](https://symfony.com/doc/current/frontend/encore/installation.html) )

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

## 3.Installation and Configuration of **SASS**

--------------------------------------------------------------------------------------------

( Source: [https://symfony.com/doc/current/frontend/encore/css-preprocessors.html](https://symfony.com/doc/current/frontend/encore/css-preprocessors.html) )

1. After configuring the compilation process in **Webpack**, so that the system recognizes the result of the compilation process of the static files.

For before, you must add the dependencies that we need when we use **SASS** with the following command.

```bash
npm install sass-loader node-sass --dev
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
html {
  font-family: Arial, Helvetica, sans-serif;
}

.footer {
  display: flex;
  justify-content: center;
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

## 4.Installation and Configuration of **React**

--------------------------------------------------------------------------------------------

( Source: [https://symfony.com/doc/current/frontend/encore/reactjs.html](https://symfony.com/doc/current/frontend/encore/reactjs.html) )

1. After configuring the compilation process in **Webpack**, so that the system recognizes the result of the compilation process of the static files.

For before, you must add the dependencies that we need when we use **React** with the next pair of commands.

```bash
npm install --dev babel-preset-react
npm install react react-dom prop-types
```

2. Next we will configure the file [webpack.config.js](webpack.config.js) with the following directives.

_[webpack.config.js](webpack.config.js)_
```diff
var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
++    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
++    .setPublicPath('/build')
++    .cleanupOutputBeforeBuild()
++    .enableSourceMaps(!Encore.isProduction())
    // uncomment to create hashed filenames (e.g. app.abc123.css)
++    .enableVersioning(Encore.isProduction())
    // uncomment to define the assets of the project
    // .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/app', './assets/js/app.js')
    // .addStyleEntry('css/app', './assets/css/app.scss')
    .addStyleEntry('css/app', './assets/css/app.scss')
    // uncomment if you use Sass/SCSS files
    // .enableSassLoader()
    .enableSassLoader()
    // uncomment to enable React Preset
++    .enableReactPreset();

module.exports = Encore.getWebpackConfig();
```

--------------------------------------------------------------------------------------------

## 5.Create our component React

--------------------------------------------------------------------------------------------

1. We will created our `itemCard` component in [assets/js/Components/ItemCard.js](./assets/js/Components/ItemCard.js).

_[assets/js/Components/ItemCard.js](./assets/js/Components/ItemCard.js)_
```js
import React from 'react';
import { Card, CardHeader, CardTitle, CardText } from 'material-ui/Card';

const ItemCard = ({ author, avatarUrl, title, subtitle, style, children }) => (
  <Card style={style}>
    <CardHeader title={author} avatar={avatarUrl} />
    <CardTitle title={title} subtitle={subtitle} />
    <CardText>{children}</CardText>
  </Card>
);

export default ItemCard;
```

And our [app.js](./assets/js/app.js) in [assets/js/app.js](./assets/js/app.js)

_[assets/js/app.js](./assets/js/app.js)_
```js
import '../css/app.scss';
import React from 'react';
import ReactDOM from 'react-dom';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';

import ItemCard from './Components/ItemCard';

class App extends React.Component {
  constructor() {
    super();

    this.state = {
      entries: []
    };
  }

  componentDidMount() {
    fetch('/data')
      .then(response => response.json())
      .then(entries => {
        this.setState({
          entries
        });
      });
  }

  render() {
    return (
      <MuiThemeProvider>
        <div style={{ display: 'flex' }}>
          {this.state.entries.map(
            ({ id, author, avatarUrl, title, description }) => (
              <ItemCard
                key={id}
                author={author}
                title={title}
                avatarUrl={avatarUrl}
                style={{ flex: 1, margin: 10 }}
              >
                {description}
              </ItemCard>
            )
          )}
        </div>
      </MuiThemeProvider>
    );
  }
}

ReactDOM.render(<App />, document.getElementById('root'));
```

2. Now, we will modify our template in [templates/default/index.html.twig](templates/default/index.html.twig).

_[templates/default/index.html.twig](templates/default/index.html.twig)_
```diff
{% extends 'base.html.twig' %}
{% block body %}
++ <div id="root"></div>
{% endblock %}
```

3. Finally, we launch **loader** via `npm run watch`, and the **server** `php bin/console server:run` so we can see the results by clicking [http://127.0.0.1:8000](http://127.0.0.1:8000).

The final result is three React cards that fill the available space on the page.

![Final Result](../../99_Readme_Resources/04_WebPack_Encore/03_Webpack_Encore_with_React/final-result.png)